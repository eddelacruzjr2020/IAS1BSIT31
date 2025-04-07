<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vulnerable_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) { 
    die("Connection failed:". $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {  
    $user = $_POST  ['username'];
    $pass = $_POST ['password'];

    //Vulnerable SQL Query
    $query = "SELECT * FROM users WHERE username ='$user' AND password='$pass'";
    $result = $conn->query($query);

    if($result->num_rows > 0) { 

        //Set session variable for logged-in user
        $_SESSION['username']= $user;

        //Redirect to dashboard page
        header("Location:dashboard.php");
        exit(); 

    }else{
        echo "Invalid username or password.";
    }

}

$conn->close();
?>

<form method="POST" action="sql_injection.php" >
<input type="text" name="username" id="username" placeholder="Username" required><br>
<input type="password" name="password" id="password" placeholder="Password" required><br>
<input type="submit" value="Login">
</form>