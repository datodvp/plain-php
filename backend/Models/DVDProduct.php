<?php

class DVDProduct extends Product {

    private $size;

    public function __construct(array $attributes) {
        parent::__construct($attributes);
        $this->type_id = 2;
        $this->size = $attributes['size'];
    }

    private function getSize() {
        return $this->size;
    }

    public static function create(array $attributes) {
        $DVDProduct = new self($attributes);

        $db = Database::getConnection();

        $sql = "INSERT INTO `products` (`type_id`, `name`, `sku`, `price`, `type_value`) VALUES (?, ?, ?, ?, ?)";

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

        }

        $statement->close();

        return $DVDProduct;
    }

    public static function validate(array $attributes) {
        $dvdProduct = new self($attributes);
    
        $errors = [];
    
        if(!$dvdProduct->getName()) {
            $errors['name'] = 'Please, submit required data';
        }
        if(!$dvdProduct->getSKU()) {
            $errors['sku'] = 'Please, submit required data';
        }
        if(!$dvdProduct->getType()) {
            $errors['type_id'] = 'Please, submit required data';
        }
        if(!$dvdProduct->getPrice()) {
            $errors['price'] = 'Please, submit required data';
        } elseif (!is_numeric($dvdProduct->getPrice())) {
            $errors['price'] = 'Please, provide the data of indicated type';
        }
        if(!$dvdProduct->getSize()) {
            $errors['size'] = 'Please, submit required data';
        } elseif (!is_numeric($dvdProduct->getSize())) {
            $errors['size'] = 'Please, provide the data of indicated type';
        }
        return $errors;
    }

}

?>