<?php
include 'koneksi.php';

// 🔹 Periksa koneksi database
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// 🔹 Statistik Jumlah Tamu
$sql_tamu_hari_ini = "SELECT COUNT(*) AS jumlah FROM buku_tamu WHERE DATE(tanggal_kunjungan) = CURDATE()";
$result_tamu_hari_ini = $conn->query($sql_tamu_hari_ini);
$jumlah_tamu_hari_ini = ($result_tamu_hari_ini && $result_tamu_hari_ini->num_rows > 0)
    ? $result_tamu_hari_ini->fetch_assoc()["jumlah"] : 0;

$sql_tamu_bulan_ini = "SELECT COUNT(*) AS jumlah FROM buku_tamu WHERE MONTH(tanggal_kunjungan) = MONTH(CURDATE()) AND YEAR(tanggal_kunjungan) = YEAR(CURDATE())";
$result_tamu_bulan_ini = $conn->query($sql_tamu_bulan_ini);
$jumlah_tamu_bulan_ini = ($result_tamu_bulan_ini && $result_tamu_bulan_ini->num_rows > 0)
    ? $result_tamu_bulan_ini->fetch_assoc()["jumlah"] : 0;

$sql_total_tamu = "SELECT COUNT(*) AS jumlah FROM buku_tamu";
$result_total_tamu = $conn->query($sql_total_tamu);
$total_tamu = ($result_total_tamu && $result_total_tamu->num_rows > 0)
    ? $result_total_tamu->fetch_assoc()["jumlah"] : 0;

$sql_tamu_terbaru = "SELECT nama, instansi, alamat, keperluan, tanggal_kunjungan FROM buku_tamu ORDER BY tanggal_kunjungan DESC";
$result_tamu_terbaru = $conn->query($sql_tamu_terbaru);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN BUKU TAMU DIGITAL</title>

    <!-- FontAwesome & DataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            display: flex;
            background-color: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            width: 230px;
            background: linear-gradient(180deg, #0f3b52, #145773);
            color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 25px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.2);
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
            font-size: 15px;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #00a36c;
            border-left: 4px solid #ffffff;
            padding-left: 16px;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 17px;
        }

        .main-content {
            margin-left: 230px;
            padding: 20px;
            width: calc(100% - 230px);
        }

        .header {
            background-color: #00923f;
            color: white;
            padding: 18px;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 22px;
            line-height: 1.2;
        }

        .logo-header {
            width: 120px;
            height: auto;
            margin-bottom: 5px;
        }

        .statistik {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            flex: 1;
            min-width: 200px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            padding: 15px;
        }

        .form-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 700px;
            margin: 20px auto;
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        /* Profil Instansi CSS */
        .profil-header {
            background-color: #00923f;
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .profil-header img {
            width: 80px;
            margin-bottom: 10px;
        }

        .profil-header h2 {
            margin: 0;
            font-size: 26px;
        }

        .profil-header p {
            margin: 4px 0;
            font-size: 16px;
        }

        .profil-container {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.12);
            margin-bottom: 20px;
        }

        .profil-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #003366;
        }

        .visi-title, .misi-title, .sejarah-title, .struktur-title {
            font-size: 20px;
            font-weight: bold;
            color: #0056b3;
            margin-top: 20px;
        }

        .visi-text {
            font-size: 18px;
            background: #e8f2ff;
            padding: 12px;
            border-left: 5px solid #0056b3;
            border-radius: 6px;
            margin-top: 10px;
        }

        .misi-list {
            background: #f7faff;
            padding: 15px;
            border-radius: 8px;
            border-left: 5px solid #0056b3;
            margin-top: 10px;
        }

        .misi-list li {
            margin-bottom: 8px;
            line-height: 1.5;
            font-size: 16px;
        }

        .sejarah-text, .struktur-text {
            font-size: 16px;
            line-height: 1.6;
            margin-top: 10px;
        }

        .struktur-list {
            margin-top: 10px;
            padding-left: 20px;
        }

        .struktur-list li {
            margin-bottom: 6px;
        }
        /* Style untuk formulir buku tamu */
        .form-row {
    margin-bottom: 15px;
}

.form-row label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-row input {
    width: 100%;
    padding: 10px;
    border: 1px solid #bbb;
    border-radius: 6px;
    font-size: 15px;
}

.form-section {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    max-width: 600px;
    margin: 30px auto;
}

    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="#" class="active" onclick="showPage('formTamu')"><i class="fa-solid fa-house"></i> Isi Buku Tamu</a>
    <a href="#" onclick="showPage('dashboard')"><i class="fa-solid fa-building"></i> Laporan Buku Tamu</a>
    <a href="#" onclick="showPage('statistik')"><i class="fa-solid fa-chart-column"></i> Statistik & Grafik</a>
    <a href="#" onclick="showPage('profilInstansi')"><i class="fa-solid fa-pen-to-square"></i> Profil Instansi</a>
</div>

<!-- Konten utama -->
<div class="main-content">

    <!-- STATISTIK & GRAFIK PAGE -->
<div id="statistik" class="page">

    <div class="header">
        <h2>Statistik & Grafik Buku Tamu</h2>
    </div>

    <div style="width:90%; margin:auto; margin-top:30px;">
        <h3>Grafik Kunjungan Per Hari</h3>
        <canvas id="chartHarian"></canvas>
    </div>

    <div style="width:90%; margin:auto; margin-top:40px;">
        <h3>Grafik Kunjungan Per Instansi</h3>
        <canvas id="chartInstansi"></canvas>
    </div>

    <div style="width:90%; margin:auto; margin-top:40px;">
        <h3>Pie Chart Keperluan Tamu</h3>
        <canvas id="chartKeperluan"></canvas>
    </div>

</div>

    <!-- DASHBOARD PAGE -->
    <div id="dashboard" class="page active">
        <div class="header">
            <img src="Logo Kabupaten Belitung (Maju Terus Mawas Diri) (1).png" class="logo-header">
           <h2>SISTEM INFORMASI BUKU TAMU</h2>
            <p>Dinas Komunikasi dan Informatika</p>
        </div>

        <h2>Laporan Buku Tamu</h2>
        <table id="bukuTamuTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Instansi</th>
                    <th>Alamat</th>
                    <th>Keperluan</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = $result_tamu_terbaru->fetch_assoc()) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['tanggal_kunjungan']}</td>
                            <td>{$row['instansi']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['keperluan']}</td>
                        
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- PROFIL INSTANSI PAGE -->
    <div id="profilInstansi" class="page">
        <div class="profil-header">
            <img src="Logo Kabupaten Belitung (Maju Terus Mawas Diri) (1).png" alt="Logo Belitung">
            <h2>SISTEM INFORMASI BUKU TAMU</h2>
            <p>Dinas Komunikasi dan Informatika</p>
        </div>

        <div class="profil-container">
            <div class="profil-title">Visi & Misi</div>

            <div class="visi-title">Visi</div>
            <p class="visi-text">“Terwujudnya pelayanan komunikasi dan informatika yang berkualitas”</p>

            <div class="misi-title">Misi</div>
            <ol class="misi-list">
                <li>Meningkatkan pelayanan publik berbasis TIK.</li>
                <li>Mengoptimalkan keterbukaan informasi publik.</li>
                <li>Mengoptimalkan penyelenggaraan TIK.</li>
                <li>Mengoptimalkan “Belitung Satu Data”.</li>
            </ol>

            <div class="sejarah-title">Sejarah Instansi</div>
            <p class="sejarah-text">
                Dinas Komunikasi dan Informatika Kabupaten Belitung dibentuk sebagai bagian dari upaya
                pemerintah daerah dalam mengembangkan infrastruktur digital dan layanan publik berbasis
                informasi. Seiring perkembangan teknologi dan kebutuhan masyarakat, Kominfo Belitung
                terus berkembang dengan menyesuaikan tugas pokok dan fungsinya. Sebagai instansi yang
                mengatur komunikasi, informatika, persandian, dan statistik, Kominfo Belitung memainkan peran
                penting dalam digitalisasi pemerintahan, transparansi data, dan layanan publik modern.
            </p>

            <div class="struktur-title">Struktur Organisasi</div>
            <ul class="struktur-list">
                <li>Kepala Dinas</li>
                <li>Sekretariat
                    <ul>
                        <li>Sub Bagian Perencanaan & Pelaporan, Keuangan & Aset</li>
                        <li>Sub Bagian Umum & Kepegawaian</li>
                    </ul>
                </li>
                <li>Bidang Informasi & Komunikasi Publik
                    <ul>
                        <li>Seksi Pengelolaan Aspirasi & Produksi Informasi</li>
                        <li>Seksi Saluran Komunikasi Publik</li>
                        <li>Seksi Kemitraan & Layanan Informasi Publik</li>
                    </ul>
                </li>
                <li>Bidang Penyelenggaraan e-Government
                    <ul>
                        <li>Seksi Infrastruktur & Teknologi</li>
                        <li>Seksi Pengembangan Aplikasi</li>
                        <li>Seksi Layanan e-Government</li>
                    </ul>
                </li>
                <li>Bidang Keamanan Informasi, Persandian & Statistik
                    <ul>
                        <li>Seksi Persandian & Keamanan Informasi</li>
                        <li>Seksi Statistik & Pengelolaan Data</li>
                    </ul>
                </li>
                <li>Unit Pelaksana Teknis Dinas (UPTD)</li>
                <li>Kelompok Jabatan Fungsional</li>
            </ul>
            <p class="struktur-text"><em>Sumber struktur organisasi: Dokumen SOTK Kominfo Kabupaten Belitung</em></p>
        </div>
    </div>
<!-- FORM TAMU PAGE -->
<div id="formTamu" class="page">

    <div class="form-section">

        <div class="judul-box" style="text-align:center; margin-bottom:20px;">
            <h1 style="margin:0;">Buku Tamu Digital</h1>
            <p style="margin-top:5px; font-size:16px;">Dinas Komunikasi dan Informatika</p>
        </div>

        <h2 style="text-align:center;">Formulir Data Tamu</h2>

        <form action="proses_buku_tamu.php" method="post">

            <div class="form-row">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div class="form-row">
                <label for="instansi">Instansi:</label>
                <input type="text" id="instansi" name="instansi">
            </div>

            <div class="form-row">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat">
            </div>

            <div class="form-row">
                <label for="no_hp">No HP:</label>
                <input type="text" id="no_hp" name="no_hp">
            </div>

            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>

            <div class="form-row">
                <label for="keperluan">Keperluan:</label>
                <input type="text" id="keperluan" name="keperluan">
            </div>

            <div class="form-row">
                <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
                <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" required>
            </div>

            <div class="form-wrapper" style="text-align:center; margin-top:20px;">
                <button type="submit" style="
                    padding:10px 20px;
                    background:#00923f;
                    color:white;
                    border:none;
                    border-radius:5px;
                    cursor:pointer;
                    font-size:16px;">
                    Kirim
                </button>
            </div>

        </form>

    </div>

</div>


<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#bukuTamuTable').DataTable();
});

function showPage(pageId) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.getElementById(pageId).classList.add('active');
    document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
    event.target.closest('a').classList.add('active');
}
</script>

</body>
</html>