<?php

abstract class Product implements JsonSerializable {
    public $id;
    public $type_id;
    public $name;
    public $sku;
    public $price;

    public function __construct(array $attributes) {
        $this->name = $attributes['name'];
        $this->sku = $attributes['sku'];
        $this->price = $attributes['price'];
    }

    protected function getId() {
        return $this->id;
    }

    protected function setId($id) {
        $this->id = $id;
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

        $result = mysqli_query($db, 'SELECT products.*, product_types.* FROM products JOIN product_types ON products.type_id = product_types.id;');
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($db);

        // remove class_name column before sending to user
        foreach($data as &$row) {
            unset($row['class_name']);
        }
        

        return json_encode($data);
    }

    public static function create(array $attributes) {
        $productModel = self::getProductModel($attributes['type_id']);

        $product = $productModel::create($attributes);

        return $product;
    }

    public static function massDelete(array $id_list) {
        $ids = implode(',', $id_list);
        try {
            $db = Database::getConnection();

            $result = mysqli_query($db, "DELETE FROM products WHERE id IN ($ids)");

            $db->close();
        } catch(\Exception $exception) {
            echo $exception;
        }

        return 'deleted succesfully';
    }

    private static function getProductModel(int $typeId) {

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
        
        return $productType['class_name'];
    }
    
    public function jsonSerialize(): array {
        $properties = get_object_vars($this);
        return $properties;
    }

}

?>