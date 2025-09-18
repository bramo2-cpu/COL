<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=bram", "root", "");
    echo "<h2 style='color:green;'>✅ SUCCESS: Database driver loaded and connected!</h2>";
} catch (PDOException $e) {
    echo "<h2 style='color:red;'>❌ ERROR: " . $e->getMessage() . "</h2>";
}
?>