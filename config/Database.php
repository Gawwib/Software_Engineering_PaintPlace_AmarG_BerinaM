<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "paintingshop";
        $port = 3306;

        $dsn = "mysql:host=$servername;dbname=$dbname;port=$port";

        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
