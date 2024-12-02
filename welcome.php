<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user data from session
$username = $_SESSION['username'];
$fullname = $_SESSION['fullname'];
$profile_photo = $_SESSION['profile_photo'] ?? 'default-profile.png'; // Default image if none uploaded

// Redirect to index.php after 5 seconds
header("Refresh: 5; url=index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('https://img.freepik.com/free-photo/gradient-blurred-colorful-background_23-2149388878.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            object-fit: cover;
        }

        h1 {
            margin: 10px 0;
        }

        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="uploads/<?= htmlspecialchars($profile_photo); ?>" alt="Profile Photo" class="profile-photo">
        <h1>Welcome, <?= htmlspecialchars($fullname); ?>!</h1>
        <p>Redirecting you to the homepage...</p>
    </div>
</body>
</html>
