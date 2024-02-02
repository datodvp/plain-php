<?php

class FurnitureProduct extends Product {
    public $attribute = "Dimensions";
    public $measurement = null;
    public $dimensions;

    public function __construct(array $attributes) {
        parent::__construct($attributes);
        $this->type_id = 3;

        $this->dimensions = $attributes['height']. "x" . $attributes['width'] . "x" . $attributes['length'];
    }

    private function getDimensions() {
        return $this->dimensions;
    }

    public static function create(array $attributes) {
        $FurnitureProduct = new self($attributes);

        $db = Database::getConnection();

        $sql = "INSERT INTO `products`.`products` (`type_id`, `name`, `sku`, `price`, `type_value`) VALUES (?, ?, ?, ?, ?)";

        $statement = $db->prepare($sql);
        
        $type_id = $FurnitureProduct->getType();
        $name = $FurnitureProduct->getName();
        $sku = $FurnitureProduct->getSKU();
        $price = $FurnitureProduct->getPrice();
        $weight = $FurnitureProduct->getDimensions();
        
        $statement->bind_param("issis", $type_id, $name, $sku, $price, $weight);
        
        $statement->execute();

        if ($statement->affected_rows > 0) {
            // Retrieve the last inserted ID to set for the Class instance
            $lastInsertedId = $db->insert_id;
            
            $FurnitureProduct->setId($lastInsertedId);
            
        }

        $statement->close();

        return $FurnitureProduct;
    }

}

?>