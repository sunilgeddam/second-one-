<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'register';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $terms = isset($_POST['terms']);
    $profilePhoto = $_FILES['profile_photo'];

    // Validation
    if (!preg_match("/^[a-zA-Z\s]{4,}$/", $username)) {
        $error = "Username must be at least 4 characters long and contain only letters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/", $password)) {
        $error = "Password must be at least 6 characters long, include one uppercase letter, one number, and one special character.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (!$terms) {
        $error = "You must agree to the terms and conditions.";
    } elseif ($profilePhoto['error'] === 4) {
        $error = "Please upload a profile photo.";
    } else {
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($profilePhoto['type'], $allowedTypes)) {
            $error = "Only JPG and PNG files are allowed.";
        } else {
            $photoName = uniqid() . "_" . basename($profilePhoto['name']);
            $uploadDir = "uploads/";
            $uploadPath = $uploadDir . $photoName;

            if (move_uploaded_file($profilePhoto['tmp_name'], $uploadPath)) {
                $stmt = $conn->prepare("SELECT id FROM logindata WHERE username = ? OR email = ?");
                $stmt->bind_param("ss", $username, $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $error = "Username or email already exists.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $conn->prepare("INSERT INTO logindata (fullname, username, email, password, profile_photo) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $fullname, $username, $email, $hashed_password, $photoName);

                    if ($stmt->execute()) {
                        $success = "Registration successful! Redirecting to login...";
                        header("Refresh: 2; url=login.php");
                    } else {
                        $error = "Registration failed. Please try again.";
                    }
                }
                $stmt->close();
            } else {
                $error = "Failed to upload photo. Please try again.";
            }
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
    <title>Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('https://t3.ftcdn.net/jpg/02/92/90/56/360_F_292905667_yFUJNJPngYeRNlrRL4hApHWxuYyRY4kN.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.8);
            max-width: 400px;
            padding: 30px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            position: relative;
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
        input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            background-color: #eee;
            color: #333;
        }
        .error {
            color: red;
            font-size: 14px;
        }
        .success {
            color: green;
            font-size: 14px;
        }
        .terms {
            margin-top: 15px;
            display: flex;
            align-items: center;
        }
        .terms label {
            margin-left: 5px;
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
        .profile-photo-container {
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 150px;
            border-radius: 50% 50% 60% 60%;
            overflow: hidden;
            border: 3px solid white;
            background-color: #eee;
        }
        .profile-photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .upload-container {
            text-align: center;
            margin-top: 70px;
        }
        input[type="file"] {
            display: none;
        }
        .upload-label {
            cursor: pointer;
            color: #FFD700;
            text-decoration: underline;
        }
        #password-strength {
            margin-top: 10px;
            font-size: 14px;
            color: white;
        }
        /* Improved Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            overflow: auto;
        }
        .modal-content {
            background-color: rgba(255, 255, 255, 0.9);
            color: black;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 70%;
            max-width: 600px;
        }
        .modal-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }
        .modal-body {
            margin-top: 15px;
            text-align: justify;
        }
        .modal-body p {
            font-size: 16px;
            line-height: 1.6;
        }
        .modal-header .close {
            color: #444;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .modal-header .close:hover {
            color: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Profile Photo Preview -->
        <div class="profile-photo-container">
            <img id="profilePreview" src="https://via.placeholder.com/120x150" alt="Profile Photo">
        </div>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="upload-container">
                <label for="profile_photo" class="upload-label">Upload Profile Photo</label>
                <input type="file" id="profile_photo" name="profile_photo" accept="image/png, image/jpeg">
            </div>

            <h2>Register</h2>
            <?php if ($error): ?>
                <p class="error"><?= $error; ?></p>
            <?php elseif ($success): ?>
                <p class="success"><?= $success; ?></p>
            <?php endif; ?>

            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" required>
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <div id="password-strength">Password must be at least 6 characters, include an uppercase letter, a number, and a special character.</div>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <div class="terms">
                <input type="checkbox" id="terms" name="terms">
                <label for="terms">I agree to the <a href="#" id="viewTerms">Terms and Conditions</a></label>
            </div>

            <button type="submit">Register</button>

            <div class="switch">
                Already have an account? <a href="login.php">Login here</a>.
            </div>
        </form>
    </div>

    <!-- Modal for Terms and Conditions -->
    <div class="modal" id="termsModal">
        <div class="modal-content">
            <div class="modal-header">
                Terms and Conditions
                <span class="close" id="closeModal">&times;</span>
            </div>
            <div class="modal-body">
                <p>
                    By using this site, you agree to our terms and conditions. We respect your privacy and are committed to protecting your personal data.
                    Your information will be used solely for account registration and will not be shared with third parties without your consent.
                </p>
                <p>
                    Please ensure the accuracy of the details you provide during registration. We reserve the right to terminate accounts
                    that violate our policies.
                </p>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for Profile Photo Preview
        const profilePhotoInput = document.getElementById('profile_photo');
        const profilePreview = document.getElementById('profilePreview');

        profilePhotoInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    profilePreview.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // JavaScript for Terms Modal
        const termsLink = document.getElementById('viewTerms');
        const termsModal = document.getElementById('termsModal');
        const closeModal = document.getElementById('closeModal');

        termsLink.addEventListener('click', (e) => {
            e.preventDefault();
            termsModal.style.display = 'block';
        });

        closeModal.addEventListener('click', () => {
            termsModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === termsModal) {
                termsModal.style.display = 'none';
            }
        });
    </script>
</body>
</html>
