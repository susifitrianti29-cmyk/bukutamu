<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

// Koneksi Database
include "koneksi.php";

// Hitung total tamu
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM buku_tamu");
$data = mysqli_fetch_assoc($result);
$total_tamu = $data['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin | Buku Tamu Dinas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.navbar {
    background-color: #0056b3 !important; 
}
.nav-link, .navbar-brand {
    color: white !important;
    font-weight: bold;
}
.card-icon {
    font-size: 45px;
    opacity: .4;
}
.footer {
    text-align:center;
    padding:10px;
    background:#f0f0f0;
    margin-top:20px;
    font-size:13px;
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark px-4">
  <a class="navbar-brand" href="#">📘 Buku Tamu Dinas</a>
  <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
      <li class="nav-item"><a class="nav-link" href="tampil_data.php">Data Tamu</a></li>
      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
  </ul>
</nav>

<!-- CONTENT -->
<div class="container mt-4">

  <h4>Selamat Datang, Admin</h4>
  <p>Sistem Buku Tamu Digital Dinas</p>

  <div class="row g-3">

    <!-- Card Data Tamu -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0 p-3 bg-primary text-white">
        <div class="d-flex justify-content-between">
            <div>
              <h2><?= $total_tamu; ?></h2>
              <span>Total Tamu</span>
            </div>
            <div class="card-icon">👤</div>
        </div>
      </div>
    </div>

    <!-- Card Lihat Tamu -->
    <div class="col-md-3">
      <a href="tampil_data.php" class="text-decoration-none">
      <div class="card shadow-sm border-0 p-3 bg-success text-white">
        <div class="d-flex justify-content-between">
            <div>
              <h2>📋</h2>
              <span>Lihat Data</span>
            </div>
        </div>
      </div>
      </a>
    </div>

    <!-- Card Export -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0 p-3 bg-warning text-dark">
        <div class="d-flex justify-content-between">
            <div>
              <h2>📤</h2>
              <span>Export</span>
            </div>
        </div>
      </div>
    </div>

    <!-- Card Pengaturan -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0 p-3 bg-danger text-white">
        <div class="d-flex justify-content-between">
            <div>
              <h2>⚙️</h2>
              <span>Pengaturan</span>
            </div>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="footer">
© <?= date('Y'); ?> Dinas Kominfo | Buku Tamu Digital
</div>

</body>
</html>
