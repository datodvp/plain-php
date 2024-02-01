<?php

class DVDProduct extends Product {
    public $size;

    public function __construct(array $attributes) {
        parent::__construct($attributes);
        $this->type_id = 2;
        $this->size = $attributes['type_value'];

        $this->createDBRecord();
    }

    private function getSize() {
        return $this->size;
    }

    protected function createDBRecord() {

        $db = Database::getConnection();

        $sql = "INSERT INTO `products`.`products` (`type_id`, `name`, `sku`, `price`, `type_value`) VALUES (?, ?, ?, ?, ?)";

        $statement = $db->prepare($sql);
        
        $type_id = $this->getType();
        $name = $this->getName();
        $sku = $this->getSKU();
        $price = $this->getPrice();
        $size = $this->getSize();
        
        $statement->bind_param("issis", $type_id, $name, $sku, $price, $size);
        
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