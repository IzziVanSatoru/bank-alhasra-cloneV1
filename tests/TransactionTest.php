<?php
use App\Models\Account;

require_once '../src/models/Account.php';

class TransactionTest {
    private $account;

    public function __construct() {
        $this->account = new Account();
    }

    public function testDeposit() {
        $userId = 1; // Example user ID
        $amount = 100; // Deposit $100
        $result = $this->account->performTransaction($userId, 'deposit', $amount);

        if ($result) {
            echo "Deposit Test Passed\n";
        } else {
            echo "Deposit Test Failed\n";
        }
    }

    public function testWithdraw() {
        $userId = 1; // Example user ID
        $amount = 50; // Withdraw $50
        $result = $this->account->performTransaction($userId, 'withdraw', $amount);

        if ($result) {
            echo "Withdraw Test Passed\n";
        } else {
            echo "Withdraw Test Failed\n";
        }
    }
}

// Run the tests
$test = new TransactionTest();
$test->testDeposit();
$test->testWithdraw();
?>
