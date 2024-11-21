<?php
require_once '../config/config.php'; // Include database connection and autoloaders
require_once '../src/models/User.php'; // Include the User model

use App\Models\User;

// Initialize the User model
$userModel = new User();

// Create a new user
if ($userModel->createUser('newuser', 'newpassword')) {
    echo "User created successfully!";
} else {
    echo "Failed to create user.";
}
?>
