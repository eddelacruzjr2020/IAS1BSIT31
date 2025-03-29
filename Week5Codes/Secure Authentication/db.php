<?php
// Database connection
$host = "localhost";
$user = "root";  // Default XAMPP user
$pass = "";      // No password by default
$dbname = "user_auth"; 

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}
?>
