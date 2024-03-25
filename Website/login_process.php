<?php
session_start();
require 'Database/databaseweb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $user["username"];
            $_SESSION["message"] = "Login successful!";
            header("Location: profile.php"); 
            exit;  
        } else {
            $_SESSION["error"] = "Invalid username or password!";
            header("Location: register_login.php");
            exit; 
        }        
    } catch (PDOException $e) {
        $_SESSION["error"] = "Error: " . $e->getMessage();
        header("Location: register_login.php");
    }
}
?>
