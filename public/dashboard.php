<?php
session_start();

// Check for success message
if (isset($_SESSION['success'])) {
    echo "<p style='color: green;'>{$_SESSION['success']}</p>";
    unset($_SESSION['success']);
}

// Other dashboard content goes here
?>
