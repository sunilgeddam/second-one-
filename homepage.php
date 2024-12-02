<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$fullname = $_SESSION['fullname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Homepage</title>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?= htmlspecialchars($fullname); ?>!</h2>
        <p>Thank you for registering. Enjoy browsing our website!</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
