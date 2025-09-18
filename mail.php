<?php
// ✅ Import classes at the VERY TOP — before any logic
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Check if the form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $mail = new PHPMailer(true); // Enable exceptions

        try {
           
            $mail->SMTPDebug = 2; // Verbose debug output
            $mail->Debugoutput = 'html';

            // Server settings — GMAIL
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'anekeabramwel@gmail.com';  
            $mail->Password   = 'qrdb ejuo gktz enns';      
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('anekeabramwel@gmail.com', 'Task App Team');
            $mail->addAddress($email); // Recipient from form

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to your new Task App!';
            $mail->Body    = "
                <h1>Hello and Welcome!</h1>
                <p>Thank you for joining our application. We're excited to have you on board!</p>
                <p>Best regards,<br>The Task App Team</p>
            ";
            $mail->AltBody = 'Thank you for joining our application. We\'re excited to have you on board! Best regards, The Task App Team';

            // Send email
            $mail->send();
            echo "<h3>✅ Success! Welcome email sent to: " . htmlspecialchars($email) . "</h3>";

        } catch (Exception $e) {
            echo "<h3>❌ Failed to send email.</h3>";
            echo "<pre>Mailer Error: " . htmlspecialchars($mail->ErrorInfo) . "</pre>";
        }

    } else {
        echo "<h3>❌ Invalid email format: " . htmlspecialchars($email) . "</h3>";
    }

} else {
    echo "<h3> This script must be accessed via a form submission (POST request).</h3>";
}
?>