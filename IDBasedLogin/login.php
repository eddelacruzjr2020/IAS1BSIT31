<?php
session_start();
$conn = new mysqli("localhost", "root", "", "auth_demo");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = $_POST['user_id'];
$password = md5($_POST['password']);
$sql = "SELECT * FROM users WHERE user_id='$user_id' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['user_id'] = $user_id;
    header("Location: dashboard.php");
} else {
    echo "Invalid credentials!";
}
$conn->close();
?>