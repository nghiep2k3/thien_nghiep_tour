<?php
class OrderTourModel
{
    private $conn;
    private $table = 'order_tour';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getOrdersByUserId($user_id) {
        // Truy vấn để lấy thông tin đơn hàng của người dùng
        $query = "SELECT u.name, u.username, 
                         t.title AS tour_name, t.description, t.price, ot.amount
                  FROM " . $this->table . " ot
                  JOIN sign_up u ON ot.user_id = u.id
                  JOIN tour t ON ot.id_tour = t.id
                  WHERE ot.user_id = :user_id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    
        // Khởi tạo mảng kết quả
        $result = [];
        $result['data'] = []; // Khởi tạo mảng data
    
        // Nhóm tour theo người dùng
        $userOrders = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tourData = [
                'tour_name' => $row['tour_name'],
                'description' => $row['description'],
                'price' => $row['price']
            ];
    
            // Kiểm tra nếu người dùng đã tồn tại trong mảng kết quả
            if (!isset($userOrders[$row['username']])) {
                $userOrders[$row['username']] = [
                    'name' => $row['name'],
                    'username' => $row['username'],
                    'amount' => 0,
                    'tour' => []
                ];
            }
    
            // Cộng dồn giá trị tour vào danh sách tour của người dùng
            $userOrders[$row['username']]['tour'][] = $tourData;
    
            // Cộng dồn tổng tiền cho tour
            $userOrders[$row['username']]['amount'] += $row['price']; // Thay đổi ở đây
        }
    
        // Chuyển đổi mảng người dùng thành mảng kết quả
        foreach ($userOrders as $userOrder) {
            $result['data'][] = $userOrder;
        }
    
        return $result;
    }
    



}
?>