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
    } else {
        $sql = "SELECT * FROM users WHERE email=:email";
        $selectUser = $conn->prepare($sql);
        $selectUser->bindParam(":email", $email);
        $selectUser->execute();

        $data = $selectUser->fetch();

        if ($data == false) {
            echo "The user does not exist";
        } else {
            if ($password === $data['password']) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['password'] = $data['password'];
                $_SESSION['is_admin'] = $data['is_admin'];

                if ($data['is_admin'] == 1) {
                    header('Location: dashboard.php');
                    exit(); 
                } else {
                    header('Location: game.php');
                    exit();
                }
            } else {
                echo "The password is not valid";
            }
        }
    }
}
?>
