<?php
// dashboard.php

// Sertakan file koneksi database
include 'koneksi.php';

// Mulai sesi
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Hubungkan ke file CSS -->
</head>
<body>
    <div class="container">
        <h2>BUKU TAMU DIGITAL</h2>
        <p>DINAS KOMUNIKASI DAN INFORMATIKA</p>
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
