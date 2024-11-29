<?php
require_once 'config/database.php';

class User
{
    private $conn;
    private $table = 'user';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($username, $password)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO " . $this->table . " (username, password) VALUES (:username, :password)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function loginCheck($username, $password)
    {
        session_start();

        if (isset($username) && isset($password)) {

            $query = "SELECT * FROM user WHERE username = :username";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetchObject();

                if (password_verify($password, $user->password)) {

                    $_SESSION['user'] = $user->id;
                    $_SESSION['username'] = $user->username;

                    session_regenerate_id(true);

                    header('Location: index.php?product/index');
                    exit;
                } else {
                    echo "Invalid username or password...";
                }
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "Please provide both username and password.";
        }
    }
}
