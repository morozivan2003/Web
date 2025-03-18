<?php
namespace App\models;
use App\core\Database
use PDO;

class User{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM users");

        return $stmt -> fetchALL(PDO::FETCH_ASSOC);
    }
#Это надо изменить под себя
    public function addUser(string $name, string $email, string $age): void {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, age) VALUES (:name, :email, :age)");
        $stmt->execute([
            "name" => htmlspecialchars($name),
            "email" => filter_var($email, FILTER_SANITIZE_EMAIL),
            "age" => $age
        ]);
    }