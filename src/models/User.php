<?php
namespace App\Models;

use PDO;

class User {
    private $db;

    public function __construct() {
        $this->db = dbConnect(); // Koneksi ke database
    }

    public function verifyUser($username, $password) {
        try {
            // Query untuk memeriksa username dan password
            $stmt = $this->db->prepare("SELECT id FROM users WHERE username = :username AND password = :password");
            $stmt->execute([':username' => $username, ':password' => $password]);
            $user = $stmt->fetch();

            // Jika user ditemukan
            return $user ? $user : false;
        } catch (\PDOException $e) {
            error_log("Kesalahan saat verifikasi pengguna: " . $e->getMessage());
            return false;
        }
    }
}
?>
