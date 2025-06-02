<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "login_system";

$conn = new mysqli($host,$user,$pass, $dbname);
if($conn->connect_error) die("Connection failed:". $conn->connect_error);

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn ->prepare("SELECT password, locked FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows === 0){
    echo "User not found";
    $stmt->close();
    $conn->close();
    exit;
}

$stmt->bind_result($db_password,$locked);
$stmt->fetch();
$stmt->close();


if($locked){
    echo "Your account is locked due to many failed login attempts";
    $conn->close();
    exit;
}

//Check login attempts
$check=$conn->prepare("SELECT attempts FROM login_attempts WHERE username=?");
$check->bind_param("s", $username);
$check->execute();
$result=$check->get_result();

$attempts=0;
if($row=$result->fetch_assoc()){
    $attempts=$row["attempts"];
}

$check->close();

if($attempts >=5){
    $lockUser = $conn->prepare("UPDATE users SET locked = 1 WHERE username=?");
    $lockUser->bind_param("s", $username);
    $lockUser->execute();
    $lockUser->close();

    echo "Too many failed attempts. Your account has been locked";
    $conn->close();
    exit;
}

if($password == $db_password){
    $_SESSION['username']=$username;

    $reset=$conn->prepare("DELETE FROM login_attempts WHERE username=?");
    $reset->bind_param("s",$username);
    $reset->execute();
    $reset->close();

    header("Location: welcome.php");
    exit;
}else{
    $update=$conn->prepare("INSERT INTO login_attempts(username,attempts) VALUES(?,1) ON DUPLICATE KEY UPDATE attempts=attempts+1");
    $update->bind_param("s",$username);
    $update->execute();
    $update->close();

    $remaining = 5 - ($attempts +1);
    if($remaining <=0){
        $lockUser=$conn->prepare("UPDATE users SET locked = 1 WHERE username=?");
        $lockUser->bind_param("s",$username);
        $lockUser->execute();
        $lockUser->close();

        echo "Too many failed attempts. Your account has been locked";
    }else{
        echo "Invalid credentials. Attempt remaining left: $remaining";
    }

}

$conn->close();

?>