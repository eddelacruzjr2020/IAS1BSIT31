<?php
// XSS Example
if (isset($_GET['message'])) {
    $message = $_GET['message']; // No sanitization here, vulnerable to XSS
    echo "<h1>$message</h1>";  // The message is directly printed
}
?>

<form action="xss.php" method="GET">
    <input type="text" name="message" placeholder="Enter a message">
    <input type="submit" value="Submit">
</form>
