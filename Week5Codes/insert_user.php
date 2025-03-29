<?php
$pdo = new PDO("mysql:host=localhost;dbname=secure_db",username: "root",password:"");


//user details
$username = "user1";
$password = "mypassword";

//Hashed password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);


//Insert to SQL
$sql = "INSERT INTO users(username, password) VALUES(:username,:password)";
$stmt = $pdo->prepare($sql);
$stmt->execute(["username" => $username,"password"=> $hashed_password]);

echo "User inserter with Bycrypt hash!";

?>