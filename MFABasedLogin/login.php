<?php 
session_start(); 
$num1 = rand(1, 10);
$num2 = rand(1, 10);
$_SESSION['captcha_answer'] = $num1 + $num2;
?>
<form action="captcha_login.php" method="POST">
    <input type="text" name="user_id" placeholder="User ID" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <p>Solve: <?php echo "$num1 + $num2"; ?> = ?</p>
    <input type="text" name="captcha" required><br>
    <button type="submit">Login</button>
</form>