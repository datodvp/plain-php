<?php

class BookProduct extends Product {
    public $attribute = "Weight";
    public $measurement = "Kg";
    public $weight;

    public function __construct(array $attributes) {
        parent::__construct($attributes);
        $this->type_id = 1;
        $this->weight = $attributes['type_value'];
    }

    private function getWeight() {
        return $this->weight;
    }

    public static function create(array $attributes) {
        $BookProduct = new self($attributes);

        $db = Database::getConnection();

        $sql = "INSERT INTO `products`.`products` (`type_id`, `name`, `sku`, `price`, `type_value`) VALUES (?, ?, ?, ?, ?)";

        $statement = $db->prepare($sql);
        
        $type_id = $BookProduct->getType();
        $name = $BookProduct->getName();
        $sku = $BookProduct->getSKU();
        $price = $BookProduct->getPrice();
        $weight = $BookProduct->getWeight();
        
        $statement->bind_param("issis", $type_id, $name, $sku, $price, $weight);
        
        $statement->execute();

        if ($statement->affected_rows > 0) {
            // Retrieve the last inserted ID to set for the Class instance
            $lastInsertedId = $db->insert_id;
            
            $BookProduct->setId($lastInsertedId);
            
            echo "Record added in db";
        } else {
            echo 'Failed to add record in db';
        }

        $statement->close();

        return $BookProduct;
    }

}

?>