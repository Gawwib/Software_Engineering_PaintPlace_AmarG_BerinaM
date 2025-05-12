<?php
//require_once __DIR__ . '//config/UserRole.php';
use config\UserRole;
Flight::set('OrderService', new OrderService());

Flight::route('GET /orders', function () {
    $orders = Flight::get('OrderService')->getAllOrders();
    Flight::json($orders);
});

Flight::route('POST /orders', function () {
    $data = Flight::request()->data->getData();

    $userId = $data['user_id'] ?? null;
    $paintingId = $data['painting_id'] ?? null;
    $status = $data['status'] ?? 'pending';
    $quantity = $data['quantity'] ?? 'pending';

    if (!$userId || !$paintingId) {
        Flight::json(['error' => 'Missing required fields'], 400);
        return;
    }

    $userService = new UserService(); 
    $user = $userService->getUserById($userId);

    if(!$user) {
        Flight::json(['error' => 'User not found for selected id'], 400);
        return;
    }

    /*if ($user['role'] === UserRole::CUSTOMER) {
        Flight::json(['error' => 'User does not have requried role.'], 401);
        return;
    }*/

    $orderService = new OrderService();
    $orderId = $orderService->createOrder($userId, $paintingId, $quantity, $status);
    Flight::json(['order_id' => $orderId]);
});

Flight::route('PUT /orders', function () {
    $data = Flight::request()->data->getData();

    $orderId = $data['order_id'] ?? null;
    $status = $data['status'] ?? 'pending';

    if (!$orderId) {
        Flight::json(['error' => 'Missing order id.'], 400);
        return;
    }

    $orderService = new OrderService();
    $updatedRows = $orderService->updateOrderStatus($orderId, $status);

    if ($updatedRows > 0) {
        Flight::json(['status' => 'Order updated']);
    } else {
        Flight::json(['status' => 'Order not found'], 404);
    }
});

Flight::route('DELETE /orders/@id', function ($id) {
    if ($id === null) {
        Flight::json(['error' => 'Missing order ID'], 400);
        return;
    }

    $orderService = new OrderService();
    $deletedRows = $orderService->deleteOrder($id);

    if ($deletedRows > 0) {
        Flight::json(['message' => 'Order deleted successfully']);
    } else {
        Flight::json(['error' => 'Order not found or already deleted'], 404);
    }
});
