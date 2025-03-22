<?php
session_start();
$conn = new mysqli("localhost", "root", "", "auth_demo");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = $_POST['user_id'];
$password = md5($_POST['password']);
$captcha = $_POST['captcha'];

if ($captcha != $_SESSION['captcha_answer']) die("Invalid CAPTCHA!");
$sql = "SELECT * FROM users WHERE user_id='$user_id' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['otp'] = rand(100000, 999999);
    $_SESSION['user_id'] = $user_id;
    echo "<h2>Your OTP is: " . $_SESSION['otp'] . "</h2>";
    echo '<a href="otp_verification.php">Proceed to OTP Verification</a>';
} else {
    echo "Invalid credentials!";
}
$conn->close();
?>
