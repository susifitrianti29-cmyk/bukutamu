<?php
// dashboard.php

// Sertakan file koneksi database
include 'koneksi.php';

// Periksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mulai sesi (tetap pertahankan, mungkin dibutuhkan untuk fitur lain)
session_start();

// Ambil data statistik dari database (seperti jumlah tamu)
$sql_jumlah_tamu_hari_ini = "SELECT COUNT(*) AS jumlah FROM buku_tamu WHERE DATE(tanggal_kunjungan) = CURDATE()";
$result_jumlah_tamu_hari_ini = $conn->query($sql_jumlah_tamu_hari_ini);
$row_jumlah_tamu_hari_ini = $result_jumlah_tamu_hari_ini->fetch_assoc();
$jumlah_tamu_hari_ini = $row_jumlah_tamu_hari_ini["jumlah"];

// ... (Kode lainnya) ...

// Format tanggal Indonesia
setlocale(LC_TIME, 'id_ID');
$tanggal_hari_ini = strftime("%A, %d %B %Y");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="sidebar-heading">
                  <img src="images/logo_belitung.png" alt="Logo Kabupaten Belitung" class="logo-kabupaten">
                </div>
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
                    </ul>
                </div>
            </nav>

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Header -->
                <nav class="navbar navbar-dark bg-primary fixed-top">
                    <a class="navbar-brand" href="#">
                        <img src="images/logo_belitung.png" width="30" height="30" class="d-inline-block align-top" alt="">
                        Dinas Komunikasi dan Informatika
                    </a>
                    <span class="navbar-text">
                        <?php echo $tanggal_hari_ini; ?>
                    </span>
                </nav>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Data Statistik -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card data-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Tamu Hari Ini</h5>
                                <p class="card-text"><?php echo $jumlah_tamu_hari_ini; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card data-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Tamu Bulan Ini</h5>
                                <p class="card-text"><?php echo $jumlah_tamu_bulan_ini; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Tamu Terbaru -->
                <h2>Tamu Terbaru</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm data-table">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Keperluan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result_tamu_terbaru->num_rows > 0) {
                                while ($row = $result_tamu_terbaru->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td><img src='" . $row["foto"] . "' alt='Foto' width='50'></td>";
                                    echo "<td>" . $row["nama"] . "</td>";
                                    echo "<td>" . $row["tanggal_kunjungan"] . "</td>";
                                    echo "<td>" . $row["keperluan"] . "</td>";
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
