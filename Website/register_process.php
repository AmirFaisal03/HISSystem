<?php
session_start();
require 'Database/databaseweb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $address = $_POST["address"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, address) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashed_password, $address]);
        $_SESSION["message"] = "Registration successful!";
        header("Location: register_login.php");
    } catch (PDOException $e) {
        
        $_SESSION["error"] = "Error: " . $e->getMessage();
        header("Location: register_login.php");
    }
}
?>
