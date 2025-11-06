<?php
// dashboard.php

// Sertakan file koneksi database
include 'koneksi.php';

// Mulai sesi
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Hubungkan ke file CSS -->
</head>
<body>
    <div class="container">
        <h2>Selamat datang, <?php echo $_SESSION["username"]; ?>!</h2>
        <div class="menu">
            <a href="guru.php">Guru</a>
            <a href="siswa.php">Siswa</a>
            <a href="kelas.php">Kelas</a>
            <a href="perlengkapan.php">Perlengkapan</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html> css nya
