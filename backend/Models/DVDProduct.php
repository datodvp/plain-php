<?php

class DVDProduct extends Product {
    public $attribute = "Size";
    public $measurement = "MB";
    public $size;

    public function __construct(array $attributes) {
        parent::__construct($attributes);
        $this->type_id = 2;
        $this->size = $attributes['type_value'];
    }

    private function getSize() {
        return $this->size;
    }

    public static function create(array $attributes) {
        $DVDProduct = new self($attributes);

        $db = Database::getConnection();

        $sql = "INSERT INTO `products`.`products` (`type_id`, `name`, `sku`, `price`, `type_value`) VALUES (?, ?, ?, ?, ?)";

        $statement = $db->prepare($sql);
        
        $type_id = $DVDProduct->getType();
        $name = $DVDProduct->getName();
        $sku = $DVDProduct->getSKU();
        $price = $DVDProduct->getPrice();
        $size = $DVDProduct->getSize();
        
        $statement->bind_param("issis", $type_id, $name, $sku, $price, $size);
        
        $statement->execute();

        if ($statement->affected_rows > 0) {
            // Retrieve the last inserted ID to set for the Class instance
            $lastInsertedId = $db->insert_id;
            
            $DVDProduct->setId($lastInsertedId);
            
            echo "Record added in db";
        } else {
            echo 'Failed to add record in db';
        }

        $statement->close();

        return $DVDProduct;
    }

}

?>