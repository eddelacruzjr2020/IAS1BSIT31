<?php session_start(); ?>
<form action="verify_otp.php" method="POST">
    <p>Enter OTP sent to your email:</p>
    <input type="text" name="otp" required><br>
    <button type="submit">Verify</button>
</form>