<?php

Flight::route('GET /users/@id', function ($id) {
    $userService = new UserService(); 
    $user = $userService->getUserById($id);

    if (!$user) {
        Flight::json(['error' => 'User not found'], 404);
        return;
    }

    Flight::json($user);
});


Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData(); 
    $email = $data['email'] ?? null;
    $password = $data['password'] ?? null;

    if (!$email || !$password ) {
        Flight::json(['error' => 'Missing required fields'], 400);
        return;
    }

    $userService = new UserService();
    $userService->addUser($data); 
    Flight::json(['status' => "User created sucessfuly!"]);
});

Flight::route('DELETE /users/@id', function ($id) {
    if ($id === null) {
        Flight::json(['error' => 'Missing user ID'], 400);
        return;
    }

    $userService = new UserService();
    $deletedRows = $userService->deleteUser($id);

    if ($deletedRows > 0) {
        Flight::json(['message' => 'User deleted successfully']);
    } else {
        Flight::json(['error' => 'User not found or already deleted'], 404);
    }
});

Flight::route('POST /login', function () {
    $data = Flight::request()->data->getData();

    $email = $data['email'] ?? null;
    $password = $data['password'] ?? null;

    if (!$email || !$password) {
        Flight::json(['error' => 'Email and password required'], 400);
        return;
    }

    $userService = new UserService(); 
    $user = $userService->getUserByEmail($email);

    if (!$user) {
        Flight::json(['error' => 'user not found'], 404);
        return;
    }

    if ($user && password_verify($data['password'], $user['password'])) {
        // In future mazbe add token so we add authorisation to app
        Flight::json(['message' => 'Login successful'], 200);
    } else {
        // Invalid credentials
        Flight::json(['error' => 'Invalid credentials'], 401);
    }
});


