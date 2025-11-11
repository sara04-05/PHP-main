<?php

	include_once('config.php');

	if(isset($_POST['submit']))
	{
        $username = $_POST['username'];
        $name =$_POST['name'];
        $surname =$_POST['surname'];
		$email = $_POST['email'];
        $password = $_POST['password']; 

	 if (empty($username) || empty($name) || empty($surname) || empty($email) || empty($password)) {
        echo "You have not filled in all the fields.";
        exit;
    }

    $checkSql = "SELECT * FROM users WHERE email = :email";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':email', $email);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        echo " This email is already registered. Please log in instead.";
        exit;
    }



		 if (empty($username) || empty($name) || empty($surname) || empty($email) || empty($password)) {
        echo "You have not filled in all the fields.";
        exit;
       }else
		{
         $sql = "INSERT INTO users(username, name, surname, email, password) VALUES (:username, :name, :surname, :email, :password)";
         $insertSql = $conn->prepare($sql);
			

		$insertSql = $conn->prepare($sql);
        $insertSql->bindParam(':username', $username);
        $insertSql->bindParam(':name', $name);
        $insertSql->bindParam(':surname', $surname);
        $insertSql->bindParam(':email', $email);
        $insertSql->bindParam(':password', $password);

			$insertSql->execute();

			header("Location: login.php");


		}



	}


?>