<?php
Flight::set('PaintingService', new PaintingService());

Flight::route('GET /connection-check', function () {
    try {
        $paintingDao = new PaintingDao();
        $paintingDao->getAllPaintings(); 
        Flight::json(['status' => 'success', 'message' => 'Connected to the database']);
    } catch (PDOException $e) {
        Flight::json(['status' => 'error', 'message' => 'Connection failed: ' . $e->getMessage()]);
    }
});

Flight::route('GET /paintings', function () {
    $paintings = Flight::get('PaintingService')->getPaintings(); 
    Flight::json($paintings);
});


Flight::route('POST /paintings', function () {
    $data = Flight::request()->data->getData(); // Get POST data
    $userId = $data['user_id'] ?? null;
    $arist = $data['artist'] ?? null;
    $name = $data['name'] ?? null;

    if (!$userId || !$arist || !$name) {
        Flight::json(['error' => 'Missing required fields'], 400);
        return;
    }

    $paintinService = new PaintingService();
    $paintingId = $paintinService->createPainting($data); 
    Flight::json(['painting_id' => $paintingId]);
});

Flight::route('PUT /paintings', function () {
    $data = Flight::request()->data->getData();

    $paintingId = $data['id'] ?? null;

    if (!$paintingId) {
        Flight::json(['error' => 'Missing painting id.'], 400);
        return;
    }

    $paintingService = new PaintingService();
    $updatedRows = $paintingService->updatePainting($paintingId, $data);

    if ($updatedRows > 0) {
        Flight::json(['status' => 'Painting updated']);
    } else {
        Flight::json(['status' => 'painting not found'], 404);
    }
});

Flight::route('DELETE /paintings/@id', function ($id) {
    if ($id === null) {
        Flight::json(['error' => 'Missing painting ID'], 400);
        return;
    }

    $paintingService = new PaintingService();
    $deletedRows = $paintingService->deletePainting($id);

    if ($deletedRows > 0) {
        Flight::json(['message' => 'Order deleted successfully']);
    } else {
        Flight::json(['error' => 'Order not found or already deleted'], 404);
    }
});