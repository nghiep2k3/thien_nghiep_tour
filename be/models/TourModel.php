<?php
class TourModel
{
    private $conn;
    private $table = 'tour';
    private $commentTable = 'comment';  // Bảng comment

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

    // Hàm tạo tour
    public function createTour($title, $description, $price, $time_frame, $rate, $discount)
    {
        $query = "INSERT INTO " . $this->table . " (title, description, price, time_frame, rate, discount) 
                  VALUES (:title, :description, :price, :time_frame, :rate, :discount)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':time_frame', $time_frame);
        $stmt->bindParam(':rate', $rate);
        $stmt->bindParam(':discount', $discount);

        return $stmt->execute();
    }

    // Hàm cập nhật tour
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

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':time_frame', $time_frame);
        $stmt->bindParam(':rate', $rate);
        $stmt->bindParam(':discount', $discount);

        return $stmt->execute();
    }

    // Hàm kiểm tra xem tour có tồn tại hay không
    public function tourExists($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    // Hàm xóa tour
    public function deleteTour($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Hàm để lấy thông tin chi tiết tour và các comment liên quan
    public function getTourDetails($tour_id)
    {
        $query = "SELECT t.*, c.id AS comment_id, c.description AS comment_description, c.image, c.username, c.create_id
              FROM " . $this->table . " t
              LEFT JOIN comment c ON t.id = c.tour_id
              WHERE t.id = :tour_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tour_id', $tour_id);
        $stmt->execute();

        $tourDetails = [];
        $comments = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (empty($tourDetails)) {
                $tourDetails = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'price' => $row['price'],
                    'time_frame' => $row['time_frame'],
                    'rate' => $row['rate'],
                    'discount' => $row['discount']
                ];
            }
            if ($row['comment_id']) {
                $comments[] = [
                    'id' => $row['comment_id'],
                    'description' => $row['comment_description'],
                    'username' => $row['username'],
                    'create_id' => $row['create_id'],
                    'image' => $row['image']
                ];
            }
        }

        // Thêm comments vào thông tin tour
        $tourDetails['comments'] = $comments;

        return $tourDetails;
    }



    public function getHotTours()
    {
        $query = "SELECT t.* FROM " . $this->table . " t
                  JOIN tour_hot th ON t.id = th.id_tour";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>