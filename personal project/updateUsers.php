<?php 
include_once('config.php');

if (isset($_POST['submit'])) {
    // Retrieve form values
    $id = $_POST['id'];
    $name = $_POST['emer'];      // match 'emer' input from form
    $surname = $_POST['mbiemer']; // match 'mbiemer' input from form
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "UPDATE users  SET name = :name, surname = :surname,  username = :username,  email = :email WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating user.";
    }
}
?>
