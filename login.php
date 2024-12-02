<?php
session_start(); // Start the session

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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check user credentials
    $stmt = $conn->prepare("SELECT id, password, fullname, profile_photo FROM logindata WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password, $fullname, $profile_photo);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        // Set session variables and redirect to welcome.php
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['profile_photo'] = $profile_photo;
        header("Location: welcome.php"); // Redirect to the welcome page
        exit();
    } else {
        $error = "Invalid username or password.";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            background: url('https://t3.ftcdn.net/jpg/02/92/90/56/360_F_292905667_yFUJNJPngYeRNlrRL4hApHWxuYyRY4kN.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
        }

        /* Background overlay */
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

        input[type="text"], input[type="password"] {
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="text"], input[type="password"] {
            background-color: #eee;
            color: #333;
        }

        .error {
            color: red;
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

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            text-decoration: none;
            color: #FFD700;
        }

        .forgot-password a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="overlay"></div> <!-- Background color overlay -->
    <div class="container">
        <form method="POST" action="">
            <h2>Login</h2>
            <?php if ($error): ?>
                <p class="error"><?= $error; ?></p>
            <?php endif; ?>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>

            <div class="forgot-password">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <p class="switch">
                Don't have an account? <a href="registration.php">Register here</a>.
            </p>
        </form>
    </div>
</body>
</html>
