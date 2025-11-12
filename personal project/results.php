<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

$sql = "SELECT l.*, u.email 
        FROM loja l
        JOIN users u ON l.user_id = u.id
        WHERE l.user_id = :user_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Your Game Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('pics/bg.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0c7230;
            padding: 20px 40px;
            color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .back-btn {
            background: white;
            color: #0c7230;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
        }

        .back-btn:hover {
            background: #e0ffe0;
            transform: translateY(-2px);
        }

        /* TABLE */
        table {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
            border-collapse: collapse;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 15px 20px;
            text-align: center;
            font-size: 1rem;
            color: white;
        }

        th {
            background-color: #0c7230;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tr:nth-child(even) td {
            background-color: rgba(0,0,0,0.2);
        }

        tr:hover td {
            background-color: rgba(0,0,0,0.3);
        }

        p {
            text-align: center;
            color: white;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Your Game Results</h1>
    <a href="game.php" class="back-btn">Back to Game</a>
</div>

<?php if (empty($results)) : ?>
    <p>You have not submitted any games yet.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Emer</th>
            <th>Mbiemer</th>
            <th>Shtet</th>
            <th>Qytet</th>
            <th>Kafsh</th>
            <th>Send</th>
            >
        </tr>
        <?php foreach ($results as $result): ?>
            <tr>
                <td><?php echo htmlspecialchars($result['emer'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($result['mbiemer'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($result['shtet'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($result['qytet'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($result['kafsh'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($result['send'] ?? ''); ?></td>
    
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
