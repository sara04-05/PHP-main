<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php'); 
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamee";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch game results
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

// Fetch users including Name and Surname
$userResult = $conn->query("SELECT id, name, surname, username, email FROM users"); 
$users = [];
if ($userResult->num_rows > 0) {
    while ($row = $userResult->fetch_assoc()) {
        $users[] = $row;
    }
}

// Statistics
$totalUsersQuery = $conn->query("SELECT COUNT(*) AS total FROM users");
$totalUsers = ($totalUsersQuery && $totalUsersQuery->num_rows > 0) ? $totalUsersQuery->fetch_assoc()['total'] : 0;

$gamesPlayedQuery = $conn->query("SELECT COUNT(*) AS total FROM loja");
$gamesPlayed = ($gamesPlayedQuery && $gamesPlayedQuery->num_rows > 0) ? $gamesPlayedQuery->fetch_assoc()['total'] : 0;

$stats = [
    "totalUsers" => $totalUsers,
    "gamesPlayed" => $gamesPlayed,
    "gamesCompleted" => $gamesPlayed, 
    "gamesFailed" => 0,
];

// Logout
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
            position: relative;
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
            position: absolute;
            top: 10px;
            right: 20px;
        }
        .logout-btn:hover { background-color: #ff0000; }
        .container { padding: 20px; display: flex; flex-wrap: wrap; gap: 20px; }
        .card { background: white; border-radius: 12px; padding: 20px; flex: 1 1 200px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .card h2 { margin-bottom: 15px; color: #0c7230; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #0c7230; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .action-btn { padding: 5px 10px; border-radius: 5px; text-decoration: none; color: white; }
        .edit-btn { background-color: #0c7230; }
        .delete-btn { background-color: #c70000; }
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
                <th>Name</th>
                <th>Surname</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['surname']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <a href="editUsers.php?id=<?php echo $user['id']; ?>" class="action-btn edit-btn">Edit</a>
                    <a href="deleteUsers.php?id=<?php echo $user['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

</body>
</html>
