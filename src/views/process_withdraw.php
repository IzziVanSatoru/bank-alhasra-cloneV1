<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../../public/login.php');
    exit();
}

// Include necessary files for database connection and models
require_once '../../config/config.php'; // Adjust the path if needed
require_once '../../src/models/Account.php'; // Adjust the path if needed

use App\Models\Account;

// Ensure required POST parameters are available
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wallet = $_POST['wallet'] ?? null; // Get the selected wallet
    $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT); // Validate and retrieve amount

    // Validate wallet selection and amount
    if (!$wallet || !in_array($wallet, ['btc', 'eth', 'bnb', 'usdt'])) {
        $_SESSION['error'] = "Invalid wallet selection.";
        header('Location: withdraw.php'); // Redirect back to withdraw form
        exit();
    }

    if (!$amount || $amount < 10) { // Assuming the minimum withdrawal amount is 10
        $_SESSION['error'] = "Invalid withdrawal amount. Minimum withdrawal is 10.";
        header('Location: withdraw.php'); // Redirect back to withdraw form
        exit();
    }

    try {
        // Create Account object (assuming you have this class for handling transactions)
        $account = new Account();

        // Check balance (assuming the getBalance method exists)
        $balance = $account->getBalance($_SESSION['user_id'], $wallet);

        if ($balance < $amount) {
            $_SESSION['error'] = "Insufficient balance in your $wallet wallet.";
            header('Location: withdraw.php'); // Redirect back to withdraw form
            exit();
        }

        // Process the withdrawal transaction (assuming the performTransaction method exists)
        $success = $account->performTransaction($_SESSION['user_id'], 'withdraw', $amount, $wallet);

        if ($success) {
            $_SESSION['success'] = "Withdrawal of " . number_format($amount, 2) . " $wallet was successful.";
            header('Location: dashboard.php'); // Redirect to dashboard on success
            exit();
        } else {
            $_SESSION['error'] = "Transaction failed. Please try again.";
            header('Location: withdraw.php'); // Redirect back to withdraw form
            exit();
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['error'] = "Database error occurred. Please try again later.";
        header('Location: withdraw.php'); // Redirect back to withdraw form
        exit();
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        $_SESSION['error'] = "An unexpected error occurred. Please try again.";
        header('Location: withdraw.php'); // Redirect back to withdraw form
        exit();
    }
} else {
    // Redirect to withdraw form if the request method is not POST
    header('Location: withdraw.php');
    exit();
}
