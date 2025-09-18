<?php
require 'ClassAutoLoad.php';
require 'dbConnect.php';

$layouts = $layouts ?? ($ObjLayouts ?? null);
$forms   = $forms   ?? ($ObjForms   ?? null);
$ObjSendMail = $ObjSendMail ?? null;
$layouts->header($conf);

echo "<h2>Registered Users</h2>";

$result = $conn->query("SELECT id, name, email FROM users ORDER BY id ASC");

if ($result->num_rows > 0) {
    echo "<ol>"; // ordered list gives numbers automatically
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['name']} ({$row['email']})</li>";
    }
    echo "</ol>";
} else {
    echo "<p>No users found.</p>";
}

$layouts->footer($conf);
?>