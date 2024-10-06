<?php
class Login {
    // Khai báo các thuộc tính
    private $conn;
    private $table = 'sign_up'; // Bảng sign_up

    public $username;
    public $password;

    // Constructor để kết nối đến cơ sở dữ liệu
    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm đăng nhập và lấy thông tin người dùng
    public function login() {
        // Truy vấn SQL để lấy thông tin username và mật khẩu đã mã hóa từ bảng 'sign_up'
        $query = "SELECT 
                    s.id AS sign_up_id, 
                    s.name AS real_name, 
                    s.username, 
                    s.password,  -- Mật khẩu đã mã hóa
                    s.role, 
                    s.create_id, 
                    p.id AS profile_id, 
                    p.user_id, 
                    p.address, 
                    p.number 
                  FROM " . $this->table . " s 
                  LEFT JOIN profile p ON s.id = p.user_id
                  WHERE s.username = :username 
                  LIMIT 1";

        // Chuẩn bị truy vấn
        $stmt = $this->conn->prepare($query);

        // Ràng buộc các giá trị đầu vào
        $stmt->bindParam(':username', $this->username);

        // Thực thi truy vấn
        $stmt->execute();

        // Kiểm tra nếu có kết quả
        if($stmt->rowCount() > 0) {
            // Trả về dữ liệu người dùng kèm thông tin từ bảng profile
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            // Trả về false nếu không tìm thấy người dùng
            return false;
        }
    }
}
