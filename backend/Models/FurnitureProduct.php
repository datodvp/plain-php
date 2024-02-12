<?php

class FurnitureProduct extends Product {
    private $dimensions;
    private $width;
    private $height;
    private $length;

    public function __construct(array $attributes) {
        parent::__construct($attributes);
        $this->type_id = 3;
        $this->width = $attributes['width'];
        $this->height = $attributes['height'];
        $this->length = $attributes['length'];

        $this->dimensions = $attributes['height']. "x" . $attributes['width'] . "x" . $attributes['length'];
    }

    private function getDimensions() {
        return $this->dimensions;
    }

    public function getWidth() {
        return $this->width;
    }
    public function getHeight() {
        return $this->height;
    }
    public function getLength() {
        return $this->length;
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

    public static function validate(array $attributes) {
        $bookProduct = new self($attributes);

        $errors = [];

        if(!$bookProduct->getName()) {
            $errors['name'] = 'Please, submit required data';
        }
        if(!$bookProduct->getSKU()) {
            $errors['sku'] = 'Please, submit required data';
        }
        if(!$bookProduct->getType()) {
            $errors['type_id'] = 'Please, submit required data';
        }
        if(!$bookProduct->getPrice()) {
            $errors['price'] = 'Please, submit required data';
        }
        if(!$bookProduct->getWidth()) {
            $errors['width'] = 'Please, submit required data';
        }
        if(!$bookProduct->getHeight()) {
            $errors['height'] = 'Please, submit required data';
        }
        if(!$bookProduct->getLength()) {
            $errors['length'] = 'Please, submit required data';
        }

        return $errors;
    }

}

?>