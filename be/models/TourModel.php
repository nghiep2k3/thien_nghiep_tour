<?php
class TourModel
{
    private $conn;
    private $table = 'tour';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Hàm để lấy tất cả các tour
    public function getAllTours()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function createTour($title, $description, $price, $time_frame, $rate, $discount)
    {
        $query = "INSERT INTO " . $this->table . " (title, description, price, time_frame, rate, discount) 
                  VALUES (:title, :description, :price, :time_frame, :rate, :discount)";

        $stmt = $this->conn->prepare($query);

        // Ràng buộc giá trị
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':time_frame', $time_frame);
        $stmt->bindParam(':rate', $rate);
        $stmt->bindParam(':discount', $discount);

        // Thực thi truy vấn
        return $stmt->execute();
    }
    public function updateTour($id, $title, $description, $price, $time_frame, $rate, $discount)
    {
        $query = "UPDATE " . $this->table . " 
                  SET title = :title, 
                      description = :description, 
                      price = :price, 
                      time_frame = :time_frame, 
                      rate = :rate, 
                      discount = :discount 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Ràng buộc giá trị
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':time_frame', $time_frame);
        $stmt->bindParam(':rate', $rate);
        $stmt->bindParam(':discount', $discount);

        // Thực thi truy vấn
        return $stmt->execute();
    }
    public function tourExists($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Nếu có ít nhất một dòng được trả về, tour tồn tại
        return $stmt->rowCount() > 0;
    }
    public function deleteTour($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Ràng buộc giá trị
        $stmt->bindParam(':id', $id);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>