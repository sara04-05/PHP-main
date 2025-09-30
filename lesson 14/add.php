<?php

	include_once('config.php');

	if(isset($_POST['submit']))
	{

	    $name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];


			$sql = "INSERT INTO users( name, surname, email) VALUES ( :name, :surname, :email)";

			$insertSql = $conn->prepare($sql);

			$insertSql->bindParam(':name', $name);
			$insertSql->bindParam(':surname', $surname);
			$insertSql->bindParam(':email', $email);
			
			$insertSql->execute();

			echo "The user has been added successfully";

			echo "<br>";

			echo "<a href='dashboard.php'>Dashboard</a>";

	}


?>