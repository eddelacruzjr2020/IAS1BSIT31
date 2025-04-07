<?php
// XSS-Protected Example
if (isset($_GET['message'])) {
    // Sanitize the input to prevent XSS
    $message = htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8');
    echo "<h1>$message</h1>";
}
?>

<form action="xss_secure.php" method="GET">
    <input type="text" name="message" placeholder="Enter a message">
    <input type="submit" value="Submit">
</form>
