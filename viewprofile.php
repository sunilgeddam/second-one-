<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = "";     // Default for XAMPP
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Fetch user data
$sql = "SELECT username, email, fullname, profile_photo FROM logindata WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user data found.";
    exit;
}

// Handle form submission to update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_fullname = $_POST['fullname'];
    $new_email = $_POST['email'];

    // Handle Profile Picture Update
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        $profile_photo = $_FILES['profile_photo'];
        $photo_name = basename($profile_photo['name']);
        $upload_dir = 'uploads/';
        $photo_path = $upload_dir . $photo_name;

        // Move the uploaded photo to the 'uploads' folder
        if (move_uploaded_file($profile_photo['tmp_name'], $photo_path)) {
            $update_sql = "UPDATE users SET fullname = ?, email = ?, profile_photo = ? WHERE username = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssss", $new_fullname, $new_email, $photo_name, $username);
        } else {
            $error_message = "Error uploading profile photo.";
        }
    } else {
        // Update profile without changing the photo
        $update_sql = "UPDATE logindata SET fullname = ?, email = ? WHERE username = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sss", $new_fullname, $new_email, $username);
    }

    if ($update_stmt->execute()) {
        $success_message = "Profile updated successfully!";
        // Update session data if changed
        $user['fullname'] = $new_fullname;
        $user['email'] = $new_email;
    } else {
        $error_message = "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <style>
        /* Background Image and Color Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://img.freepik.com/free-vector/black-geometric-memphis-social-banner_53876-116843.jpg') no-repeat center center fixed; 
            background-size: cover;
            color: #fff;
        }

        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            color: #f0f0f0;
        }

        .message, .error {
            font-size: 14px;
            text-align: center;
        }

        .message {
            color: #28a745;
        }

        .error {
            color: #dc3545;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
            color: #f0f0f0;
        }

        input[type="text"], input[type="email"], input[type="file"], input[type="submit"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"], button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #218838;
        }

        input[type="text"], input[type="email"], input[type="file"] {
            background-color: #fff;
            color: #333;
        }

        button {
            background-color: #007bff;
        }

        button:hover {
            background-color: #0056b3;
        }

        img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Profile</h2>

        <?php if (isset($success_message)) { ?>
            <p class="message"><?php echo $success_message; ?></p>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>

        <!-- Display Profile Photo -->
        <div style="text-align:center;">
            <?php if (isset($user['profile_photo']) && !empty($user['profile_photo'])): ?>
                <img src="<?php echo 'uploads/' . $user['profile_photo']; ?>" alt="Profile Photo">
            <?php else: ?>
                <img src="uploads/default-avatar.png" alt="Profile Photo">
            <?php endif; ?>
        </div>

        <form action="viewprofile.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>

            <label for="profile_photo">Profile Photo</label>
            <input type="file" id="profile_photo" name="profile_photo">

            <input type="submit" value="Update Profile">
        </form>

        <button onclick="window.location.href='index.php'">Home</button>
        <button onclick="window.location.href='logout.php'">Logout</button>
    </div>
</body>
</html>

<?php $conn->close(); ?>
