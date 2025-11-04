<?php
session_start();
include_once('config.php');

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in all fields";
        header('Location: login.php');
        exit();
    }

    try {
        $sql = "SELECT * FROM users WHERE email=:email";
        $selectUser = $conn->prepare($sql);
        $selectUser->bindParam(":email", $email);
        $selectUser->execute();
        
        $data = $selectUser->fetch(PDO::FETCH_ASSOC);
        
        if ($data && password_verify($password, $data['password'])) {
            $_SESSION['id'] = $data['id'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];
            header('Location: game.php');
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password";
            header('Location: game.php');
            exit();
        }
    } catch(PDOException $e) {
        $_SESSION['error'] = "System error. Please try again later.";
        header('Location: game.php');
        exit();
    }
}
?>