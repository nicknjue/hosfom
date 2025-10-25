<?php
include_once "databaseconn.php";
require_once "classes/user.php";

$user = new User($conn);

// Create a new user (you can change values)
if ($user->createUser("nic", "nico@gmail.com", "1234")) {
    echo "✅ User created successfully!<br>";
} else {
    echo "❌ Failed to create user.<br>";
}
