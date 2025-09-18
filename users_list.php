<?php
require_once 'conf.php';

// Connect to task_app
$host = 'localhost';
$user = 'root';
$pass = '1234';
$db   = 'task_app'; // ← MUST match signup.php

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT Name, email FROM users ORDER BY Name ASC");

// DEBUG: Show how many rows found
echo "<p>Debug: Found " . $result->num_rows . " users.</p>";

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Users</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        ol { margin: 20px 0; padding-left: 20px; }
        li { margin: 5px 0; padding: 8px; background: #f9f9f9; border-left: 4px solid #007BFF; }
    </style>
</head>
<body>
<div class="container">';

if ($result->num_rows > 0) {
    echo "<h2>Registered Users</h2>";
    echo "<ol>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>{$row['Name']}</strong> <{$row['email']}></li>";
    }
    echo "</ol>";
} else {
    echo "<p>No users have signed up yet.</p>";
}

echo '</div></body></html>';

$mysqli->close();
?>