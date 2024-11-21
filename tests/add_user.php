<?php
require_once '../config/config.php';
$hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
$db = dbConnect();
$stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
$stmt->execute([':username' => 'admin', ':password' => $hashedPassword]);
echo "Pengguna admin berhasil ditambahkan!";
?>
