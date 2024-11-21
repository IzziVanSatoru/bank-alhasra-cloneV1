-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS bank;

-- Gunakan database
USE bank;

-- Buat tabel `users` untuk menyimpan data pengguna
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tambahkan pengguna default untuk pengujian
INSERT INTO users (username, password)
VALUES ('admin', 'admin123'); -- Password: admin123
