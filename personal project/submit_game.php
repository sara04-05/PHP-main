<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamee";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Database connection failed: " . $conn->connect_error
    ]));
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Return a special code for frontend to handle redirect
    echo json_encode([
        "status" => "error",
        "message" => "login_required"
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect POST inputs and sanitize
    $emer = $conn->real_escape_string($_POST['emer'] ?? '');
    $mbiemer = $conn->real_escape_string($_POST['mbiemer'] ?? '');
    $shtet = $conn->real_escape_string($_POST['shtet'] ?? '');
    $qytet = $conn->real_escape_string($_POST['qytet'] ?? '');
    $kafsh = $conn->real_escape_string($_POST['kafsh'] ?? '');
    $send = $conn->real_escape_string($_POST['send'] ?? '');
    $user_id = intval($_SESSION['user_id']); // link game to logged-in user

    // Check if all fields are filled
    if (empty($emer) || empty($mbiemer) || empty($shtet) || empty($qytet) || empty($kafsh) || empty($send)) {
        echo json_encode([
            "status" => "error",
            "message" => "All fields are required."
        ]);
        exit;
    }

    // Insert into loja table
    $sql = "INSERT INTO loja (emer, mbiemer, shtet, qytet, kafsh, send, user_id) 
            VALUES ('$emer', '$mbiemer', '$shtet', '$qytet', '$kafsh', '$send', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => "success",
            "message" => "Game result saved!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Database error: " . $conn->error
        ]);
    }

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method."
    ]);
}

$conn->close();
?>
