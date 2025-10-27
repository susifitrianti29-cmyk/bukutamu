<?php
// ====== Konfigurasi koneksi ======
$host = "localhost";     // Nama server MySQL (default: localhost)
$user = "root";          // Username MySQL (default: root di XAMPP)
$pass = "";              // Password MySQL (kosong kalau belum diubah)
$db   = "bukutamu_db";   // Nama database yang kamu buat di phpMyAdmin

// ====== Membuat koneksi ======
$conn = mysqli_connect($host, $user, $pass, $db);

// ====== Mengecek koneksi ======
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
// Jika berhasil (optional)
# echo "Koneksi berhasil!";
?>
