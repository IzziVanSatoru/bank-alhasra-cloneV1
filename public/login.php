<?php
require_once '../config/config.php';
require_once '../src/controllers/LoginController.php';

use App\Controllers\LoginController;

$controller = new LoginController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleLogin();
} else {
    $controller->showLoginForm();
}
?>
