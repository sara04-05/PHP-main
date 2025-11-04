<?php
include_once('config.php');

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($name) || empty($surname) || empty($email) || empty($password)) {
        echo "You have not filled in all the fields.";
        exit;
    }

    try {
        // First check if the table exists
        $tableCheck = $conn->query("SHOW TABLES LIKE 'users'");
        if ($tableCheck->rowCount() === 0) {
            // Create the users table if it doesn't exist
            $conn->exec("CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100) NOT NULL,
                name VARCHAR(100) NOT NULL,
                surname VARCHAR(100) NOT NULL,
                email VARCHAR(200) NOT NULL,
                password VARCHAR(255) NOT NULL
            )");
        } else {
            // Check if email column exists
            $colCheck = $conn->query("SHOW COLUMNS FROM users LIKE 'email'");
            if ($colCheck->rowCount() === 0) {
                // Add email column if it doesn't exist
                $conn->exec("ALTER TABLE users ADD COLUMN email VARCHAR(200) NOT NULL AFTER surname");
            }
        }

        // prevent duplicate email
        $check = $conn->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $check->bindParam(':email', $email);
        $check->execute();
        if ($check->fetch()) {
            echo "Email already registered.";
            exit;
        }


        $sql = "INSERT INTO users(username, name, surname, email, password) VALUES (:username, :name, :surname, :email, :password)";
        $insertSql = $conn->prepare($sql);
        $insertSql->bindParam(':username', $username);
        $insertSql->bindParam(':name', $name);
        $insertSql->bindParam(':surname', $surname);
        $insertSql->bindParam(':email', $email);
        $insertSql->bindParam(':password', $password);

        if ($insertSql->execute()) {
            header("Location: login.php");
            exit;
        } else {
            echo "Registration failed.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit;
    }
}
?>