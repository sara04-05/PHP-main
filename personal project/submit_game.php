<?php
session_start();
include_once('config.php');
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];

$emer = $_POST['emer'][0];
$mbiemer = $_POST['mbiemer'][0];
$shtet = $_POST['shtet'][0];
$qytet = $_POST['qytet'][0];
$kafsh = $_POST['kafsh'][0];
$send = $_POST['send'][0];

$sql = "INSERT INTO loja (user_id, emer, mbiemer, shtet, qytet, kafsh, send)
        VALUES (:user_id, :emer, :mbiemer, :shtet, :qytet, :kafsh, :send)";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':user_id' => $user_id,
    ':emer' => $emer,
    ':mbiemer' => $mbiemer,
    ':shtet' => $shtet,
    ':qytet' => $qytet,
    ':kafsh' => $kafsh,
    ':send' => $send,
]);

echo json_encode(["status" => "success", "message" => "Your result has been saved!"]);
?>
