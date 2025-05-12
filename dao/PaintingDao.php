<?php
require_once __DIR__ . '/../config/Database.php';

class PaintingDao
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllPaintings()
    {
        try {
            $query = "SELECT * FROM paintings";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching paintings: " . $e->getMessage();
            return [];
        }
    }

    public function getPaintingById($id)
    {
        try {
            $query = "SELECT * FROM paintings WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching painting: " . $e->getMessage();
            return null;
        }
    }

    public function addPainting($data)
    {
        try {
            $query = "INSERT INTO paintings (name, artist, price, style, size, image, user_id) 
                      VALUES (:name, :artist, :price, :style, :size, :image, user_id)";
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':artist', $data['artist'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
            $stmt->bindParam(':style', $data['style'], PDO::PARAM_STR);
            $stmt->bindParam(':size', $data['size'], PDO::PARAM_STR);
            $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);

            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo "Error adding painting: " . $e->getMessage();
            return null;
        }
    }

    public function updatePainting($id, $data)
    {
        try {
            $query = "UPDATE paintings SET 
                        name = :name,
                        artist = :artist,
                        price = :price,
                        style = :style,
                        size = :size,
                        image = :image 
                      WHERE id = :id";
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':id', $data['id'], PDO::PARAM_STR);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':artist', $data['artist'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
            $stmt->bindParam(':style', $data['style'], PDO::PARAM_STR);
            $stmt->bindParam(':size', $data['size'], PDO::PARAM_STR);
            $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);


            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error updating painting: " . $e->getMessage();
            return 0;
        }
    }

    public function deletePainting($id)
    {
        try {
            $query = "DELETE FROM paintings WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error deleting painting: " . $e->getMessage();
            return 0;
        }
    }
}
