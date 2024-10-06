<?php
class ProfileModel {
    private $conn;
    private $profile_table = 'profile';
    private $signup_table = 'sign_up';

    public $id;
    public $user_id;
    public $name;
    public $username;
    public $password;
    public $address;
    public $role;
    public $create_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy profile bằng user_id
    public function getProfileByUserId($user_id) {
        // Truy vấn JOIN để lấy thông tin từ cả hai bảng profile và sign_up
        $query = "SELECT 
                    p.id AS profile_id, 
                    p.user_id, 
                    s.name, 
                    s.username, 
                    s.password, 
                    p.address, 
                    s.role, 
                    s.create_id 
                  FROM " . $this->profile_table . " p 
                  JOIN " . $this->signup_table . " s ON p.user_id = s.id 
                  WHERE p.user_id = :user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt;
    }

    // Cập nhật thông tin profile
    public function updateProfile($user_id, $address, $number) {
        $query = "UPDATE " . $this->profile_table . " 
                  SET address = :address, number = :number
                  WHERE user_id = :user_id";

        $stmt = $this->conn->prepare($query);

        // Liên kết các giá trị
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':number', $number);

        // Thực thi truy vấn
        return $stmt->execute();
    }

    // Cập nhật thông tin đăng ký
    public function updateSignup($user_id, $name, $username, $password) {
        $query = "UPDATE " . $this->signup_table . " 
                  SET name = :name, username = :username, password = :password 
                  WHERE id = :user_id"; // Giả sử create_id trùng với id trong bảng sign_up

        $stmt = $this->conn->prepare($query);

        // Liên kết các giá trị
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // Lưu ý: Nên mã hóa mật khẩu

        // Thực thi truy vấn
        return $stmt->execute();
    }
}
?>
