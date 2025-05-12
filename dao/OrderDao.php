<?php
require_once __DIR__ . '/../config/Database.php';

class OrderDao
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    // Get All Orders
    public function getAllOrders()
    {
        try {
            $query = "SELECT * FROM orders";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching orders: " . $e->getMessage();
            return [];
        }
    }

    // Add a New Order
    public function addOrder($userId, $paintingId, $quantity, $status)
    {
        try {
            $query = "INSERT INTO orders (user_id, painting_id, status, quantity) 
                      VALUES (:user_id, :painting_id, :status, :quantity)";
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':painting_id', $paintingId, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);

            $stmt->execute();
            return $this->connection->lastInsertId(); 
        } catch (PDOException $e) {
            echo "Error adding order: " . $e->getMessage();
            return null;
        }
    }

    // Update Order Status
    public function updateOrderStatus($orderId, $status)
    {
        try {
            $query = "UPDATE orders SET status = :status WHERE id = :id";
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->rowCount(); 
        } catch (PDOException $e) {
            echo "Error updating order status: " . $e->getMessage();
            return 0;
        }
    }

    // Delete Order 
    public function deleteOrder($orderId)
    {
        try {
            $query = "DELETE FROM orders WHERE id = :id";
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount(); 
        } catch (PDOException $e) {
            echo "Error deleting order status: " . $e->getMessage();
            return 0;
        }
    }
}
