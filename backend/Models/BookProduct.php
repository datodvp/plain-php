<?php

class BookProduct extends Product {
    private $weight;

    public function __construct(array $attributes) {
        parent::__construct($attributes);
        $this->type_id = 1;
        $this->weight = $attributes['type_value'];

        $this->createDBRecord();
    }

    private function getWeight() {
        return $this->weight;
    }

    protected function createDBRecord() {

        $db = Database::getConnection();

        $sql = "INSERT INTO `products`.`products` (`type_id`, `name`, `sku`, `price`, `type_value`) VALUES (?, ?, ?, ?, ?)";

        $statement = $db->prepare($sql);
        
        $type_id = $this->getType();
        $name = $this->getName();
        $sku = $this->getSKU();
        $price = $this->getPrice();
        $weight = $this->getWeight();
        
        $statement->bind_param("issis", $type_id, $name, $sku, $price, $weight);
        
        $statement->execute();

        if ($statement->affected_rows > 0) {
            // Retrieve the last inserted ID to set for the Class instance
            $lastInsertedId = $db->insert_id;
            
            $this->setId($lastInsertedId);
            
            echo "Record added in db";
        } else {
            echo 'Failed to add record in db';
        }
        
        $statement->close();

    }

}

?>