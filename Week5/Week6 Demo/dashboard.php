<?php 
session_start();

//Check if user logged in
if(!isset($_SESSION['username'])){
    header("Location:sql_injection.php");
    exit();
}
?>

<h1>Welcome to your dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
<p>You are now logged in.</p>