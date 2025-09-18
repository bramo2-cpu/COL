<?php
require 'dbConnect.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName     = $_POST['name'] ?? '';
    $userEmail    = $_POST['email'] ?? '';
    $userPassword = $_POST['password'] ?? '';

    if (!empty($userName) && filter_var($userEmail, FILTER_VALIDATE_EMAIL) && !empty($userPassword)) {
        
        // Hash password
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        // Send welcome email
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'anekeabramwel@gmail.com';
            $mail->Password   = 'qrdb ejuo gktz enns'; // App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('anekeabramwel@gmail.com', 'BBIT Systems Admin');
            $mail->addAddress($userEmail, $userName);

            $mail->isHTML(true);
            $mail->Subject = 'Welcome to BBIT Enterprise';
            $mail->Body    = "<h3>Hello {$userName},</h3><p>Welcome to BBIT Enterprise!</p>";
            $mail->AltBody = "Hello $userName,\nWelcome to BBIT Enterprise!\n\nRegards,\nSystem Admin";

            $mail->send();

            echo "<p style='color: green; font-weight: bold; text-align: center;'>✅ Welcome {$userName}! A confirmation email has been sent to {$userEmail}.</p>";

        } catch (Exception $e) {
            echo "<p style='color: red; text-align: center;'>❌ Failed to send email: " . htmlspecialchars($mail->ErrorInfo) . "</p>";
        }

        // Save to DB
        $stmt = $conn->prepare("INSERT INTO users (Name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $userName, $userEmail, $hashedPassword);
        $stmt->execute();

    } else {
        echo "<p style='color: red; text-align: center;'>❌ Please fill in all fields with valid data.</p>";
    }
}

// Start HTML output
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #121212;
            border-radius: 12px;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            color: #e0e0e0;
            font-size: 14px;
        }
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: white;
            color: black;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .form-container button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            width: 100%;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .form-container p {
            text-align: center;
            font-size: 14px;
            color: #aaa;
            margin-top: 15px;
        }
        .form-container a {
            color: #007BFF;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Sign Up Form</h2>
    <form method="POST">
        <label for="name">Fullname</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email address</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Sign Up</button>

        <p>Already a member? <a href="login.php">Sign in here</a></p>
    </form>
</div>

</body>
</html>';