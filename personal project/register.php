<?php


	include_once('config.php');

	if(isset($_POST['submit']))
	{

		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];

		$tempPass = $_POST['password'];
		$password = password_hash($tempPass, PASSWORD_DEFAULT);


		if(empty($name) || empty($surname) || empty($email) || empty($password))
		{
			echo "You have not filled in all the fields.";
		}
		else
		{

			$sql = "INSERT INTO users(name,surname,email,password) VALUES (:name, :surname, :email, :password)";

			$insertSql = $conn->prepare($sql);
			

			$insertSql->bindParam(':name', $name);
			$insertSql->bindParam(':surname', $surname);
			$insertSql->bindParam(':email', $email);
			$insertSql->bindParam(':password', $password);

			$insertSql->execute();

			header("Location: login.php");


		}

//fix register

	}


?>