<?php
class OrderService
{
    private $orderDao;

    public function __construct()
    {
        $this->orderDao = new OrderDao();
    }

    // Get all orders
    public function getAllOrders()
    {
        return $this->orderDao->getAllOrders();
    }

    // Create a new order
    public function createOrder($userId, $paintingId, $quantity, $status)
    {
        return $this->orderDao->addOrder($userId, $paintingId, $quantity, $status);
    }

    // Update order status
    public function updateOrderStatus($orderId, $status)
    {
        return $this->orderDao->updateOrderStatus($orderId, $status);
    }

    // Delete order status
    public function deleteOrder($orderId)
    {
        return $this->orderDao->deleteOrder($orderId);
    }
}
