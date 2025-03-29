<?php

$password = "mypassword";

$options = ["cost" => 12];
$hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

echo $hashed_password;
?>