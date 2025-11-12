<?php 

	include_once('config.php');

	if (isset($_POST['submit'])) {
		$emer = $_POST['emer'];
$mbiemer = $_POST['mbiemer'];
$username = $_POST['username'];
$email = $_POST['email'];

$sql = "UPDATE users SET name=:name, surname=:surname, username=:username, email=:email WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':surname', $surname);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

		header("Location: dashboard.php");
	}
 ?>