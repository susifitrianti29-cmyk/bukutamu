<?php
// dashboard.php

// Sertakan file koneksi database
include 'koneksi.php';

// Periksa apakah koneksi berhasil
if (!$koneksi) { // di file koneksi biasanya variabelnya $koneksi, bukan $conn
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mulai sesi
session_start();

// =======================
// 🔹 Statistik Jumlah Tamu
// =======================

// Jumlah tamu hari ini
$sql_jumlah_tamu_hari_ini = "SELECT COUNT(*) AS jumlah FROM buku_tamu WHERE DATE(tanggal_kunjungan) = CURDATE()";
$result_jumlah_tamu_hari_ini = mysqli_query($koneksi, $sql_jumlah_tamu_hari_ini);
$row_jumlah_tamu_hari_ini = mysqli_fetch_assoc($result_jumlah_tamu_hari_ini);
$jumlah_tamu_hari_ini = $row_jumlah_tamu_hari_ini['jumlah'] ?? 0;

// Jumlah tamu bulan ini
$sql_jumlah_tamu_bulan_ini = "SELECT COUNT(*) AS jumlah FROM buku_tamu WHERE MONTH(tanggal_kunjungan) = MONTH(CURDATE()) AND YEAR(tanggal_kunjungan) = YEAR(CURDATE())";
$result_jumlah_tamu_bulan_ini = mysqli_query($koneksi, $sql_jumlah_tamu_bulan_ini);
$row_jumlah_tamu_bulan_ini = mysqli_fetch_assoc($result_jumlah_tamu_bulan_ini);
$jumlah_tamu_bulan_ini = $row_jumlah_tamu_bulan_ini['jumlah'] ?? 0;

// =======================
// 🔹 Data tamu terbaru
// =======================
$sql_tamu_terbaru = "SELECT nama, tanggal_kunjungan, keperluan, foto FROM buku_tamu ORDER BY tanggal_kunjungan DESC LIMIT 5";
$result_tamu_terbaru = mysqli_query($koneksi, $sql_tamu_terbaru);

// =======================
// 🔹 Format tanggal Indonesia
// =======================
setlocale(LC_TIME, 'id_ID.UTF-8');
date_default_timezone_set('Asia/Jakarta');
$tanggal_hari_ini = strftime("%A, %d %B %Y");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital</title>
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar vh-100">
                <div class="sidebar-heading text-center mt-3 mb-4">
                    <img src="images/logo_belitung.png" alt="Logo Kabupaten Belitung" class="logo-kabupaten" width="80">
                    <h5 class="mt-2">DISKOMINFO</h5>
                </div>
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
                </ul>
            </nav>

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Header -->
                <nav class="navbar navbar-dark bg-primary sticky-top shadow">
                    <a class="navbar-brand" href="#">
                        <img src="images/logo_belitung.png" width="30" height="30" class="d-inline-block align-top mr-2" alt="">
                        Dinas Komunikasi dan Informatika
                    </a>
                    <span class="navbar-text text-white font-weight-bold">
                        <?php echo ucfirst($tanggal_hari_ini); ?>
                    </span>
                </nav>

                <!-- Isi Dashboard -->
                <div class="pt-4 pb-3 mb-3 border-bottom mt-3">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Data Statistik -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm border-left-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title">Tamu Hari Ini</h5>
                                <p class="card-text display-4 text-primary"><?php echo $jumlah_tamu_hari_ini; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm border-left-success">
                            <div class="card-body text-center">
                                <h5 class="card-title">Tamu Bulan Ini</h5>
                                <p class="card-text display-4 text-success"><?php echo $jumlah_tamu_bulan_ini; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Tamu Terbaru -->
                <h2 class="mt-4 mb-3">Tamu Terbaru</h2>
                <div class="table-responsive mb-5">
                    <table class="table table-striped table-bordered text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Keperluan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result_tamu_terbaru) > 0) {
                                while ($row = mysqli_fetch_assoc($result_tamu_terbaru)) {
                                    echo "<tr>";
                                    echo "<td><img src='" . htmlspecialchars($row['foto']) . "' alt='Foto' width='50' height='50' style='object-fit:cover;border-radius:50%;'></td>";
                                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['tanggal_kunjungan']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['keperluan']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Tidak ada data tamu terbaru.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
