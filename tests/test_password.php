<?php
$inputPassword = 'admin123'; // Password yang dimasukkan pengguna
$storedHash = '$2y$10$KbqQs4Hs.HlPCx7UjLUdmOsQn6.E7Z0KR8M0Noc2pTIrAG28sdZe2'; // Hash dari database

if (password_verify($inputPassword, $storedHash)) {
    echo "Password sesuai!";
} else {
    echo "Password tidak sesuai.";
}
?>
