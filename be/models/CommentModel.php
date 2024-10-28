<?php
class CommentModel
{
    private $conn;
    private $table = 'comment';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Hàm để thêm comment vào tour
    public function addComment($tour_id, $description, $image, $username)
    {
        $query = "INSERT INTO " . $this->table . " (tour_id, description, image, username, create_id) 
                  VALUES (:tour_id, :description, :image, :username, NOW())";

        $stmt = $this->conn->prepare($query);

        // Ràng buộc giá trị
        $stmt->bindParam(':tour_id', $tour_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':username', $username);

        // Thực thi truy vấn
        return $stmt->execute();
    }
    public function deleteComment($id, $username)
    {
        // Kiểm tra xem comment có thuộc về người dùng đang đăng nhập không
        $query = "SELECT username FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Nếu username khớp, thực hiện xóa
            if ($row['username'] === $username) {
                $query = "DELETE FROM " . $this->table . " WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id);
                return $stmt->execute();
            } else {
                return false; // Tên người dùng không khớp
            }
        }
        return false; // Không tìm thấy comment
    }

    public function updateComment($id, $description, $username)
    {
        // Kiểm tra xem comment có thuộc về người dùng không
        $query = "SELECT username FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Nếu username khớp, thực hiện cập nhật
            if ($row['username'] === $username) {
                $query = "UPDATE " . $this->table . " SET description = :description WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':id', $id);
                return $stmt->execute();
            } else {
                return false; // Tên người dùng không khớp
            }
        }
        return false; // Không tìm thấy comment
    }


}
?>