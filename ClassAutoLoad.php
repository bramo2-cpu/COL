<?php

// Load Composer's autoloader (installs PHPMailer and autoloads it)
require __DIR__ . '/vendor/autoload.php';

// Import PHPMailer classes into global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Create a new PHPMailer instance
$mail = new PHPMailer(true); // Enable exceptions

// Optional: Test output to confirm it works
echo "✅ PHPMailer loaded successfully!";