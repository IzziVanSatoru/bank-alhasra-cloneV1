<?php
session_start();
require_once '../config/config.php';
require_once '../src/models/Account.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$account = new \App\Models\Account();
$userId = $_SESSION['user_id'];
$transactions = $account->getTransactionHistory($userId, 5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banking System</title>
</head>
<body>
    <h1>Welcome to Your Dashboard</h1>
    <h2>Recent Transactions</h2>
    <table border="1">
        <tr><th>Type</th><th>Amount</th><th>Date</th></tr>
        <?php foreach ($transactions as $transaction): ?>
        <tr>
            <td><?= htmlspecialchars($transaction['type']) ?></td>
            <td><?= htmlspecialchars($transaction['amount']) ?></td>
            <td><?= htmlspecialchars($transaction['transaction_date']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="login.php?action=logout">Logout</a>
</body>
</html>
