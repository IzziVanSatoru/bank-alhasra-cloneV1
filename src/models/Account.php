<?php
namespace App\Models;

use PDO;
use PDOException;

class Account {
    private $db;

    public function __construct() {
        // Connect to the database
        $this->db = dbConnect();
    }

    /**
     * Get the user's balance across all wallets or a specific wallet.
     *
     * @param int $userId
     * @param string|null $wallet (optional) Specify the wallet to filter by.
     * @return float|bool
     */
    public function getBalance($userId, $wallet = null) {
        try {
            $query = "SELECT SUM(
                CASE
                    WHEN type = 'deposit' THEN amount
                    WHEN type = 'withdraw' THEN -amount
                END
            ) AS balance FROM transactions WHERE user_id = :user_id";

            if ($wallet) {
                $query .= " AND wallet = :wallet";
            }

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

            if ($wallet) {
                $stmt->bindParam(':wallet', $wallet, PDO::PARAM_STR);
            }

            $stmt->execute();
            $result = $stmt->fetch();
            return $result['balance'] ?? 0;
        } catch (PDOException $e) {
            error_log("Error fetching balance: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Perform a transaction (deposit/withdraw) for a specific user and wallet.
     *
     * @param int $userId
     * @param string $type (deposit or withdraw)
     * @param float $amount
     * @param string|null $wallet (optional) Specify the wallet for the transaction.
     * @return bool
     */
    public function performTransaction($userId, $type, $amount, $wallet = null) {
        if (!in_array($type, ['deposit', 'withdraw']) || $amount <= 0) {
            return false;
        }

        if ($type === 'withdraw') {
            $currentBalance = $this->getBalance($userId, $wallet);
            if ($currentBalance < $amount) {
                return false; // Insufficient funds
            }
        }

        try {
            $stmt = $this->db->prepare("INSERT INTO transactions (user_id, type, amount, wallet) VALUES (:user_id, :type, :amount, :wallet)");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->bindParam(':wallet', $wallet, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error performing transaction: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the transaction history for a user.
     *
     * @param int $userId
     * @param int $limit (optional) Number of records to fetch.
     * @return array|bool
     */
    public function getTransactionHistory($userId, $limit = 10) {
        try {
            $stmt = $this->db->prepare("SELECT type, amount, wallet, transaction_date FROM transactions WHERE user_id = :user_id ORDER BY transaction_date DESC LIMIT :limit");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error fetching transaction history: " . $e->getMessage());
            return false;
        }
    }
}
?>
