<?php
class Category{
    private $conn;
    private $id;
    private $title;
    private $metaTitle;
    private $type;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getCategory(){
        $query = "SELECT * FROM category";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}


?>