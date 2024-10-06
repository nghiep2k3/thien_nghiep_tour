<?php
class SignUpModel {
    private $conn;
    private $table = 'sign_up';
    private $profile_table = 'profile'; // Bảng profile

    public $id;
    public $name;
    public $username;
    public $password;
    public $create_id;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Tạo mới user
    public function create() {
        $query = "INSERT INTO " . $this->table . "
                  (name, username, password, create_id, role) 
                  VALUES (:name, :username, :password, :create_id, :role)";

        $stmt = $this->conn->prepare($query);

        // Mã hóa mật khẩu trước khi lưu
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Liên kết các giá trị
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':create_id', $this->create_id);
        $stmt->bindParam(':role', $this->role);

        // Thực thi truy vấn
        if($stmt->execute()) {
            // Lấy ID của user vừa tạo
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // Thêm user_id vào bảng profile sau khi tạo tài khoản
    public function createProfile() {
        $query = "INSERT INTO " . $this->profile_table . " 
                  (user_id, number, address) 
                  VALUES (:user_id, NULL, NULL)"; // Các trường khác để NULL

        $stmt = $this->conn->prepare($query);

        // Liên kết giá trị user_id
        $stmt->bindParam(':user_id', $this->id); // Sử dụng ID vừa tạo từ bảng sign_up

        // Thực thi truy vấn
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Kiểm tra xem username đã tồn tại chưa
    public function checkUsername() {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
?>
