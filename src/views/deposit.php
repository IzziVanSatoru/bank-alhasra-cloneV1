<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../../public/login.php');
    exit;
}

// Tangani form deposit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'] ?? 0;

    if ($amount > 0) {
        // Simpan data deposit ke sesi (untuk pengujian sementara)
        $_SESSION['deposit'] = $amount;

        // Redirect ke home page setelah deposit
        header('Location: home.php');
        exit;
    } else {
        $errorMessage = "Jumlah coin harus lebih besar dari 0.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit - Bank Al Hasra</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            overflow: hidden;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 400px;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        .container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .container label {
            font-size: 1.1rem;
            color: #444;
        }

        .container input[type="number"] {
            padding: 10px;
            border: none;
            border-radius: 10px;
            box-shadow: inset 0px 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
        }

        .container button {
            background: linear-gradient(135deg, #ff512f, #dd2476);
            border: none;
            border-radius: 20px;
            color: #fff;
            padding: 10px 20px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container button:hover {
            transform: scale(1.1);
            box-shadow: 0px 10px 20px rgba(255, 0, 128, 0.3);
        }

        .container .logout {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .container .logout:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Deposit</h1>
        <?php if (!empty($errorMessage)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>
        <form method="POST" action="deposit.php">
            <label for="amount">Jumlah Coin:</label>
            <input type="number" id="amount" name="amount" required min="1" placeholder="Masukkan jumlah coin">
            <button type="submit">Deposit</button>
        </form>
        <a href="../../public/logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
