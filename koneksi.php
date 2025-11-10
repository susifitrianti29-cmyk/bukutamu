<?php
// File: koneksi.php
// Deskripsi: Berisi kode untuk terhubung ke database MySQL

// Konfigurasi database
$host     = "localhost";    // Host database
$user     = "root";          // Username database
$pass     = "";              // Password database (kosong jika tidak ada)
$db   = "bukutamu_db";   // Nama database

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Memeriksa apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Jika berhasil (optional)
# echo "Koneksi berhasil!";
?>
