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
}
?>