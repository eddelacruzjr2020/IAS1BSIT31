<?php
$stored_hashed_password = password_hash("mypassword", PASSWORD_BCRYPT, ["cost" => 12]);

$entered_password = "mypassword";
if(password_verify($entered_password, $stored_hashed_password)){
    echo "✅ Password matches! User is authenticated.";
} else {
    echo "❌ Invalid password!";
}

?>