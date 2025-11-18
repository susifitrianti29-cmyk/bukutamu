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

// 🔹 Data Tamu Terbaru
$sql_tamu_terbaru = "SELECT nama, instansi, alamat, keperluan, tanggal_kunjungan FROM buku_tamu ORDER BY tanggal_kunjungan DESC";
$result_tamu_terbaru = $conn->query($sql_tamu_terbaru);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buku Tamu Digital | Dashboard</title>

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

    /* Konten utama */
    .main-content {
        margin-left: 230px;
        padding: 20px;
        width: calc(100% - 230px);
    }

    .header {
        background-color: #00923f;
        color: white;
        padding: 25px;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        font-size: 22px;
        line-height: 1.5;
    }

    .logo-header {
        width: 120px;
        height: auto;
        margin-bottom: 10px;
    }

    /* Statistik */
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

    /* Form */
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

    /* --- VISI MISI CSS --- */
    .profil-container {
        background: #ffffff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.12);
        margin-top: 20px;
    }

    .profil-title {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #003366;
    }

    .visi-title, .misi-title {
        font-size: 22px;
        font-weight: bold;
        color: #0056b3;
        margin-top: 20px;
    }

    .visi-text {
        font-size: 18px;
        font-weight: bold;
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
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="#" class="active" onclick="showPage('dashboard')"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="#" onclick="showPage('bukuTamu')"><i class="fa-solid fa-building"></i> Profil Instansi</a>
    <a href="#" onclick="showPage('formTamu')"><i class="fa-solid fa-pen-to-square"></i> Isi Buku Tamu</a>
</div>

<!-- Konten utama -->
<div class="main-content">

    <!-- DASHBOARD -->
    <div id="dashboard" class="page active">
        <div class="header">
            <img src="Logo Kabupaten Belitung (Maju Terus Mawas Diri) (1).png" class="logo-header"><br>
            SISTEM INFORMASI BUKU TAMU<br>Dinas Komunikasi dan Informatika
        </div>

        <div class="statistik">
            <div class="card"><h3>Tamu Hari Ini</h3><p><?php echo $jumlah_tamu_hari_ini; ?></p></div>
            <div class="card"><h3>Tamu Bulan Ini</h3><p><?php echo $jumlah_tamu_bulan_ini; ?></p></div>
            <div class="card"><h3>Total Semua Tamu</h3><p><?php echo $total_tamu; ?></p></div>
        </div>

        <h2>Data Tamu Terbaru</h2>
        <table id="bukuTamuTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Instansi</th>
                    <th>Alamat</th>
                    <th>Keperluan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($result_tamu_terbaru->num_rows > 0) {
                    while ($row = $result_tamu_terbaru->fetch_assoc()) {
                        echo "<tr>
                            <td>".$no++."</td>
                            <td>".$row["nama"]."</td>
                            <td>".$row["tanggal_kunjungan"]."</td>
                            <td>".$row["instansi"]."</td>
                            <td>".$row["alamat"]."</td>
                            <td>".$row["keperluan"]."</td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- PROFIL INSTANSI (VISI MISI) -->
    <div id="bukuTamu" class="page">
        <div class="profil-container">
            <div class="profil-title">Visi & Misi Dinas Komunikasi dan Informatika<br>Kabupaten Belitung</div>

            <div class="visi-title">Visi</div>
            <p class="visi-text">“Terwujudnya pelayanan komunikasi dan informatika yang berkualitas”</p>

            <div class="misi-title">Misi</div>
            <ol class="misi-list">
                <li>Meningkatkan pelayanan publik berbasis TIK.</li>
                <li>Mengoptimalkan keterbukaan informasi publik.</li>
                <li>Mengoptimalkan penyelenggaraan TIK.</li>
                <li>Mengoptimalkan “Belitung Satu Data”.</li>
            </ol>
        </div>
    </div>

    <!-- FORM TAMU -->
    <div id="formTamu" class="page">
        <div class="header">FORMULIR BUKU TAMU</div>
        <div class="form-section">
            <h2>Formulir Data Tamu</h2>
            <form action="proses_buku_tamu.php" method="post">
                <label>Nama</label><input type="text" name="nama" required>
                <label>Instansi</label><input type="text" name="instansi">
                <label>Alamat</label><input type="text" name="alamat">
                <label>No HP</label><input type="text" name="no_hp">
                <label>Email</label><input type="email" name="email">
                <label>Keperluan</label><input type="text" name="keperluan">
                <label>Tanggal Kunjungan</label><input type="date" name="tanggal_kunjungan" required>
                <button type="submit">Kirim</button>
            </form>
        </div>
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
