<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'register';

// Connect to the database
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/", $new_password)) {
        $error = "Password must be at least 6 characters long, include an uppercase letter, a number, and a special character.";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM logindata WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();

            // Update password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE logindata SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashed_password, $email);

            if ($stmt->execute()) {
                $success = "Password updated successfully! You can now log in.";
            } else {
                $error = "Failed to update password. Please try again.";
            }
            $stmt->close();
        } else {
            $error = "Email not found.";
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            background: url('https://filestore.community.support.microsoft.com/api/images/d5dbbd0f-2395-43f9-aa44-4f650633412b') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Adjust opacity here */
            z-index: -1;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent white */
            max-width: 400px;
            padding: 30px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            color: white;
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="email"], input[type="password"] {
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="email"], input[type="password"] {
            background-color: #eee;
            color: #333;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }

        .success {
            color: lightgreen;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .switch {
            text-align: center;
            margin-top: 15px;
        }

        .switch a {
            text-decoration: none;
            color: #FFD700;
        }

        .switch a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="overlay"></div> <!-- Background color overlay -->
    <div class="container">
        <form method="POST" action="">
            <h2>Forgot Password</h2>
            <?php if ($error): ?>
                <p class="error"><?= $error; ?></p>
            <?php elseif ($success): ?>
                <p class="success"><?= $success; ?></p>
            <?php endif; ?>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Reset Password</button>
            <p class="switch">
                Remembered your password? <a href="login.php">Login</a>.
            </p>
        </form>
    </div>
</body>
</html>
