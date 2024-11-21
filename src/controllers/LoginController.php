<?php
namespace App\Controllers;

use App\Models\User;

class LoginController {
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm() {
        require __DIR__ . '/../views/login.php';
    }

    /**
     * Menangani proses login.
     */
    public function handleLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Cek username dan password menggunakan User.php
        $userModel = new User();
        $user = $userModel->verifyUser($username, $password);

        if ($user) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];

            // Arahkan ke halaman deposit
            header('Location: http://localhost/banking-system-alHasra/src/views/deposit.php');
            exit;
        } else {
            $errorMessage = "Username atau password salah.";
            require __DIR__ . '/../views/login.php';
        }
    }
}
?>
