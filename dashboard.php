<?php
// dashboard.php

// Sertakan file koneksi database
include 'koneksi.php';

// Mulai sesi (tetap pertahankan, mungkin dibutuhkan untuk fitur lain)
session_start();

// Ambil data statistik dari database (seperti jumlah tamu)
$sql_jumlah_tamu_hari_ini = "SELECT COUNT(*) AS jumlah FROM tamu WHERE DATE(tanggal) = CURDATE()";
$result_jumlah_tamu_hari_ini = $koneksi->query($sql_jumlah_tamu_hari_ini);
$row_jumlah_tamu_hari_ini = $result_jumlah_tamu_hari_ini->fetch_assoc();
$jumlah_tamu_hari_ini = $row_jumlah_tamu_hari_ini["jumlah"];

$sql_jumlah_tamu_bulan_ini = "SELECT COUNT(*) AS jumlah FROM tamu WHERE MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())";
$result_jumlah_tamu_bulan_ini = $koneksi->query($sql_jumlah_tamu_bulan_ini);
$row_jumlah_tamu_bulan_ini = $result_jumlah_tamu_bulan_ini->fetch_assoc();
$jumlah_tamu_bulan_ini = $row_jumlah_tamu_bulan_ini["jumlah"];

// ... (Tambahkan query lain untuk mengambil data statistik lainnya) ...

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital - Dinas Komunikasi dan Informatika</title>
    <link rel="stylesheet" href="style.css"> <!-- Hubungkan ke file CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-alt"></i> Agenda & Kegiatan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data_tamu.php">
                                <i class="fas fa-address-book"></i> Buku Tamu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-file-alt"></i> Kelola Tata Surat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-archive"></i> Kelola Dokumen & Arsip
                            </a>
                        </li>
                        <!-- HAPUS BAGIAN INI: -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users-cog"></i> Manajemen Pengguna
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li> -->
                    </ul>
                </div>
            </nav>

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Buku Tamu</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </button>
                            <button type="button
