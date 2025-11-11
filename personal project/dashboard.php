<?php
session_start();

// Admin check
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php'); 
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamee";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all game results
$result = $conn->query("SELECT emer, mbiemer, shtet, qytet, kafsh, send FROM loja");
$gameResults = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gameResults[] = [
            "emer" => $row["emer"],
            "mbiemer" => $row["mbiemer"],
            "shtet" => $row["shtet"],
            "qytet" => $row["qytet"],
            "kafsh" => $row["kafsh"],
            "send" => $row["send"],
        ];
    }
}

// Fetch users
$userResult = $conn->query("SELECT username, email FROM users"); // Adjust columns if needed
$users = [];
if ($userResult->num_rows > 0) {
    while ($row = $userResult->fetch_assoc()) {
        $users[] = $row;
    }
}

// Stats
$stats = [
    "totalUsers" => count($users),
    "gamesPlayed" => count($gameResults),
    "gamesCompleted" => count($gameResults), // assuming all rows are completed
    "gamesFailed" => 0, // no concept of failed yet
];

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - LetterDash</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }
        body { background: #f0f0f0; color: #333; }
        
        header {
            background-color: #0c7230;
            color: white;
            padding: 20px;
            position: relative; /* allow absolute positioning */
            text-align: center;
        }
        
        header h1 { margin: 0; }
        
        .logout-btn {
            padding: 8px 15px;
            background-color: #c70000;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            position: absolute; /* move relative to header */
            top: 10px;          /* distance from top of header */
            right: 20px;        /* distance from right edge */
        }
        
        .logout-btn:hover { background-color: #ff0000; }
        
        .container { padding: 20px; display: flex; flex-wrap: wrap; gap: 20px; }
        .card { background: white; border-radius: 12px; padding: 20px; flex: 1 1 200px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .card h2 { margin-bottom: 15px; color: #0c7230; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #0c7230; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .status-completed { color: green; font-weight: bold; }
        .status-failed { color: red; font-weight: bold; }
    </style>
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
    <form method="post">
        <button name="logout" class="logout-btn">Logout</button>
    </form>
</header>

<div class="container">
    <!-- Statistics -->
    <div class="card">
        <h2>Statistics</h2>
        <p>Total Users: <strong><?php echo $stats['totalUsers']; ?></strong></p>
        <p>Games Played: <strong><?php echo $stats['gamesPlayed']; ?></strong></p>
        <p>Games Completed: <strong><?php echo $stats['gamesCompleted']; ?></strong></p>
        <p>Games Failed: <strong><?php echo $stats['gamesFailed']; ?></strong></p>
    </div>

    <!-- Users Table -->
    <div class="card">
        <h2>Users</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
            </tr>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Game Results Table -->
    <div class="card" style="flex: 2 1 400px;">
        <h2>All Game Results</h2>
        <table>
            <tr>
                <th>Emer</th>
                <th>Mbiemer</th>
                <th>Shtet</th>
                <th>Qytet</th>
                <th>Kafsh</th>
                <th>Send</th>
            </tr>
            <?php foreach($gameResults as $game): ?>
            <tr>
                <td><?php echo $game['emer']; ?></td>
                <td><?php echo $game['mbiemer']; ?></td>
                <td><?php echo $game['shtet']; ?></td>
                <td><?php echo $game['qytet']; ?></td>
                <td><?php echo $game['kafsh']; ?></td>
                <td><?php echo $game['send']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

</body>
</html>
