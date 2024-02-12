<?php

class BookProduct extends Product {
    private $weight;

    public function __construct(array $attributes) {
        parent::__construct($attributes);
        $this->type_id = 1;
        $this->weight = $attributes['weight'];
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
        }

        $statement->close();

        return $BookProduct;
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
        if(!$bookProduct->getWeight()) {
            $errors['weight'] = 'Please, submit required data';
        }

        return $errors;
    }

}

?>