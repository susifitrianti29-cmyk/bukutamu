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
            <a href="form.php">Form</a>
            <a href="pengumuman.php">Pengumuman</a>
            <a href="tentang.php">Tentang</a>
            <a href="profil.php">Profil</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html> 
