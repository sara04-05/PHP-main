<?php
session_start();

// Only allow admin users
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php'); 
    exit;
}

include_once('config.php');

// Get user ID safely
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header('Location: dashboard.php'); 
    exit;
}

// Fetch user data
$sql = "SELECT * FROM users WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user_data) {
    header('Location: dashboard.php');
    exit;
}

// Handle logout
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
    <title>Edit User - Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; margin: 0; padding: 0; }
        header { background: #0c7230; color: white; padding: 20px; position: relative; text-align: center; }
        header h1 { margin: 0; }
        .logout-btn { position: absolute; top: 15px; right: 20px; background: #c70000; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; }
        .logout-btn:hover { background: #ff0000; }
        .container { padding: 20px; max-width: 600px; margin: auto; background: white; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 40px; }
        h2 { color: #0c7230; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; }
        button { background: #0c7230; color: white; padding: 12px; border: none; border-radius: 8px; width: 100%; cursor: pointer; font-size: 16px; }
        button:hover { background: #085f23; }
        a.back-link { display: inline-block; margin-bottom: 20px; color: #0c7230; text-decoration: none; }
        a.back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<header>
    <h1>Edit User</h1>
    <form method="post">
        <button name="logout" class="logout-btn">Logout</button>
    </form>
</header>

<div class="container">
    <a href="dashboard.php" class="back-link">&larr; Back to Dashboard</a>
    <h2>Edit User Details</h2>
    <form action="updateUsers.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_data['id']); ?>">


        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
        </div>

        <button type="submit" name="submit">Update User</button>
    </form>
</div>

</body>
</html>
