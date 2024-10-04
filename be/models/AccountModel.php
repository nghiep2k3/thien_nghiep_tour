<?php
class AccountModel {
    // Khai báo các thuộc tính tương ứng với các trường trong bảng 'account' và 'profile'
    private $conn;
    private $table = 'account';

    public $id;
    public $username;
    public $password;
    public $user_id;

    // Constructor để kết nối đến cơ sở dữ liệu
    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm đăng nhập và lấy thông tin người dùng
    public function login() {
        // Truy vấn SQL để JOIN bảng 'account' với bảng 'profile' dựa trên 'user_id'
        $query = "SELECT 
                    a.id AS account_id, 
                    a.username, 
                    p.id AS profile_id, 
                    p.number, 
                    p.password, 
                    p.address, 
                    p.create_id, 
                    p.role 
                  FROM " . $this->table . " a 
                  LEFT JOIN profile p ON a.user_id = p.id
                  WHERE a.username = :username AND a.password = :password 
                  LIMIT 1";

        // Chuẩn bị truy vấn
        $stmt = $this->conn->prepare($query);

        // Ràng buộc các giá trị đầu vào
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

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
