<?php
// Allow CORS
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

require_once './vendor/autoload.php';
require_once './services/PaintingService.php';
require_once './dao/PaintingDao.php';  
require_once './routes/PaintingRoutes.php';
require_once './services/OrderService.php';
require_once './dao/OrderDao.php';  
require_once './routes/OrderRoutes.php';
require_once './services/UserService.php';
require_once './dao/UserDao.php';  
require_once './routes/UserRoutes.php';
Flight::start();
