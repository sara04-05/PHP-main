<?php
	include_once('config.php');	

	if(isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];

		// Check if any field is empty
		if(empty($name) || empty($surname) || empty($email))
		{
			echo "You need to fill all the fields.";
		}
		else
		{
			// Check if the email already exists
			$sql = "SELECT email FROM users WHERE email=:email";
			$tempSQL = $conn->prepare($sql);
			$tempSQL->bindParam(':email', $email);
			$tempSQL->execute();

			if($tempSQL->rowCount() > 0)
			{
				echo "Email exists!";
				header("refresh:2; url=signup.php"); 
			}
			else
			{
				// Insert new user into the database
				$sql = "INSERT INTO users (name, surname, email) VALUES (:name, :surname, :email)";
				$insertSql = $conn->prepare($sql);

				$insertSql->bindParam(':name', $name); 
				$insertSql->bindParam(':surname', $surname); 
				$insertSql->bindParam(':email', $email);

				$insertSql->execute();

				echo "Data saved successfully ...";
				header("refresh:2; url=login.php"); 
			}
		}
	}
?>
