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
    <title>Home - Bank Al Hasra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            color: #333;
            font-size: 2rem;
        }
        .content-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }
        .content-box button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }
        .content-box button:hover {
            background-color: #0056b3;
        }
        .content-box a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Selamat datang di Bank Al Hasra</h1>
    </header>

    <div class="content-box">
        <h2>Akses Layanan</h2>
        <p>Pilih layanan untuk melanjutkan</p>
        <a href="withdraw.php">
            <button>Ke Halaman Withdraw</button>
        </a>
    </div>
</body>
</html>
