<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../../public/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw - Bank Al Hasra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .withdraw-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }
        .withdraw-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }
        .btn {
            display: block;
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .withdraw-summary {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }
        .withdraw-summary p {
            margin: 5px 0;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="withdraw-container">
        <h1>Withdraw</h1>
        <form method="POST" action="/banking-system-alHasra/src/views/process_withdraw.php">
            <div class="form-group">
                <label for="wallet">Pilih Wallet</label>
                <select id="wallet" name="wallet" required>
                    <option value="btc">Bitcoin (BTC)</option>
                    <option value="eth">Ethereum (ETH)</option>
                    <option value="bnb">Binance Coin (BNB)</option>
                    <option value="usdt">Tether (USDT)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Jumlah Withdraw</label>
                <input type="number" id="amount" name="amount" placeholder="Masukkan jumlah coin" required min="1">
            </div>
            <button type="submit" class="btn">Withdraw</button>
        </form>
        <div class="withdraw-summary">
            <p>Saldo Anda: <strong>1000 USDT</strong></p>
            <p>Minimal withdraw: <strong>10 USDT</strong></p>
        </div>
        <a href="home.php" class="back-link">Kembali ke Halaman Home</a>
    </div>
</body>
</html>
