<?php

require __DIR__ . '/../Models/BookProduct.php';
require __DIR__ . '/../Models/DVDProduct.php';

abstract class Product {
    protected $type_id;
    protected $name;
    protected $sku;
    protected $price;

    public function __construct(array $attributes) {
        $this->name = $attributes['name'];
        $this->sku = $attributes['sku'];
        $this->price = $attributes['price'];
    }

    protected function getType() {
        return $this->type_id;
    }

    protected function getName() {
        return $this->name;
    }

    protected function getSKU() {
        return $this->sku;
    }

    protected function getPrice() {
        return $this->price;
    }

    public static function all() {
        $db = Database::getConnection();

        $result = mysqli_query($db, 'SELECT * FROM products');
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($db);

        return json_encode($data);
    }

    public static function create(array $attributes) {
        $productType = self::getClassFromDB($attributes['type_id']);

        $product = new $productType($attributes);

        return $product;
    }

    public static function delete(array $id_list) {
        $ids = implode(',', $id_list);
        try {
            $db = Database::getConnection();

            $result = mysqli_query($db, "DELETE FROM products WHERE id IN ($ids)");
        } catch(\Exception $exception) {
            echo $exception;
        }

        return 'deleted succesfully';
    }

    private static function getClassFromDB(int $typeId) {

        $db = Database::getConnection();

        $sql = "SELECT * FROM product_types WHERE product_types.id = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param("i", $typeId);
        $statement->execute();
        $result = $statement->get_result();

        $productType = $result->fetch_assoc();

        $result->free();
        $statement->close();
        $db->close();
        
        return $productType['name'] . 'Product';
    }

}

?>