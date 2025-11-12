<?php
session_start();

header('Content-Type: application/json');

if(!isset($_SESSION['id'])) {
    echo json_encode(['status'=>'error','message'=>'login_required']);
    exit;
}

if(!isset($_POST['score'], $_POST['time'])) {
    echo json_encode(['status'=>'error','message'=>'Missing data']);
    exit;
}

$score = (int)$_POST['score'];
$time = (int)$_POST['time'];
$user_id = (int)$_SESSION['id'];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=gamee;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO game_results (user_id, score, time) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $score, $time]);

    echo json_encode(['status'=>'success','message'=>'Game submitted!']);
} catch (PDOException $e) {
    echo json_encode(['status'=>'error','message'=>'Database error']);
}


?>
