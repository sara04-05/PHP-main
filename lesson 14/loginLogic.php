<?php 
session_start();
require 'config.php';

if(isset($_POST['submit']))
{
  $email = $_POST['email'];

  if(empty($email))
  {
    echo "Fill the email field!";
    header( "refresh:2; url=login.php" ); 
  }else{
    $sql = "SELECT * FROM users WHERE email=:email";
    $insertSql = $conn->prepare($sql);
    $insertSql->bindParam(':email', $email);

    $insertSql->execute();
    
    if($insertSql->rowCount() > 0) { 
        $data = $insertSql->fetch();
        $_SESSION['email'] = $data['email'];
        header("Location: dashboard.php");
        exit; 
    } else {
        echo "User not found!";
        header("refresh:2; url=login.php"); 
        exit;
    }
  }
}
?>

