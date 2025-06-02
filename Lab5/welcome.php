<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome</title>
    <script>
        let timeout;

        function resetTimer(){
            clearTimeout(timeout);
            timeout = setTimeout(()=>{
                alert("You have been logged out due to inactivity.");
                window.location.href="logout.php";
            }, 5000); //5secs
        }

        window.onload = resetTimer;
        window.onmousemove = resetTimer;
        window.onkeydown = resetTimer;
        window.onclick = resetTimer;
        window.onscroll = resetTimer;
    </script>
</head>
<body>
    <h2>Welcome <?php echo htmlspecialchars($_SESSION['username']);?></h2>
    <p>This page will auto-logout after 5 seconds of inactivity</p>
    <a href="logout.php">Logout</a>
</body>
</html>