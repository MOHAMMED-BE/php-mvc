<?php
require_once 'config/database.php';
require_once 'helpers/UploadHelper.php';

class Product
{
    private $conn;
    private $table = 'products';
    private $uploadHelper;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->uploadHelper = new UploadHelper();
    }

    public function search($query, $limit, $offset)
    {
        $query = '%' . $query . '%';
        $sql = "SELECT * FROM products WHERE name LIKE :query LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':query', $query, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSearchCount($query)
    {
        $query = '%' . $query . '%';
        $sql = "SELECT COUNT(*) AS total FROM products WHERE name LIKE :query";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':query', $query, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getCount()
    {
        $query = "SELECT COUNT(*) AS total FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getPaginated($limit, $offset)
    {
        $query = "SELECT products.*, categories.name AS category_name
                  FROM products
                  LEFT JOIN categories ON products.category_id = categories.id
                  LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByIds($id)
    {
        $query = "SELECT products.*, categories.name AS category_name
              FROM " . $this->table . "
              LEFT JOIN categories ON products.category_id = categories.id
              WHERE products.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function create($name, $price, $quantity, $categoryId)
    {
        try {
            $imageName = $this->uploadHelper->upload($_FILES['image'], 'product_image');

            $query = "INSERT INTO products (name, price, quantity, image, category_id) VALUES (:name, :price, :quantity, :image, :category_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':image', $imageName);
            $stmt->bindParam(':category_id', $categoryId);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $name, $price, $quantity, $categoryId)
    {
        $query = "UPDATE products 
              SET name = :name, price = :price, quantity = :quantity, category_id = :category_id
              WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $this->deleteImageFile($id);

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    private function deleteImageFile($id)
    {
        $product = $this->getById($id);
        if ($product && !empty($product['image']) && file_exists(__DIR__ . '/../uploads/product_image/' . $product['image'])) {
            $this->uploadHelper->delete($product['image'], 'product_image');
        }
    }
}
