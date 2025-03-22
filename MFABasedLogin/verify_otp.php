<?php
session_start();
if ($_POST['otp'] == $_SESSION['otp']) {
    $_SESSION['authenticated'] = true;
    header("Location: dashboard.php");
} else {
    echo "Invalid OTP!";
}