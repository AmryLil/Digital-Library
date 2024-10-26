<?php
require_once __DIR__ . '/../config/db.php';
class User {
    private $conn;
    private $table_name = "users";
    private $table_nameAdmin = "admin";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Fungsi login
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function loginAdmin($username, $password) {
        $query = "SELECT * FROM " . $this->table_nameAdmin . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($admin && $password === $admin['password']) {
            return $admin;
        }
    
        return false;
    }
    

    // Fungsi signup
    public function signup($fullname, $username, $email, $password) {
      $query = "INSERT INTO " . $this->table_name . " (fullname, username, email, password) VALUES (:fullname, :username, :email, :password)";
      $stmt = $this->conn->prepare($query);
  
      $stmt->bindParam(':fullname', $fullname);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $password);
  
      try {
          if ($stmt->execute()) {
              return $this->login($username, $password);
          }
      } catch (PDOException $e) {
          echo "Database Error: " . $e->getMessage();
          return false;
      }
  
      return false;
  }
  
}
