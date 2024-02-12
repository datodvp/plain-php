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

        }

        $statement->close();

        return $DVDProduct;
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
        if(!$bookProduct->getSize()) {
            $errors['size'] = 'Please, submit required data';
        }
        if(!$bookProduct->getType()) {
            $errors['type_id'] = 'Please, submit required data';
        }

        return $errors;
    }

}

?>