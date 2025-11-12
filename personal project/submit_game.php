<?php
session_start();
header('Content-Type: application/json');

// Kontrollo nëse useri është loguar
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'login_required']);
    exit;
}

// Vetëm POST lejohet
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// Merr input-et dhe pastro (trim + htmlspecialchars)
function clean_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$emer = clean_input($_POST['emer'][0] ?? '');
$mbiemer = clean_input($_POST['mbiemer'][0] ?? '');
$shtet = clean_input($_POST['shtet'][0] ?? '');
$qytet = clean_input($_POST['qytet'][0] ?? '');
$kafsh = clean_input($_POST['kafsh'][0] ?? '');
$send = clean_input($_POST['send'][0] ?? '');

// Kontrollo nëse të gjitha fushat janë të mbushura
if (empty($emer) || empty($mbiemer) || empty($shtet) || empty($qytet) || empty($kafsh) || empty($send)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    exit;
}

$user_id = intval($_SESSION['user_id']);

// Lidhu me DB
$conn = new mysqli("localhost", "root", "", "gamee");
if ($conn->connect_error) {
    echo json_encode(['status'=>'error','message'=>'Database connection failed']);
    exit;
}

// Prepared statement për të parandaluar SQL Injection
$stmt = $conn->prepare("INSERT INTO loja (emer, mbiemer, shtet, qytet, kafsh, send, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("ssssssi", $emer, $mbiemer, $shtet, $qytet, $kafsh, $send, $user_id);

// Ekzekuto dhe kthe përgjigje
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Game result saved!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
