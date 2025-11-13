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

    .logo-container {
        text-align: center;
        margin-bottom: 25px;
    }

    .logo-container img {
        width: 90px;
        height: auto;
        border-radius: 10px;
        margin-bottom: 5px;
        background: white;
        padding: 5px;
    }

    .instansi-nama {
        font-size: 15px;
        font-weight: bold;
        color: #e2e8f0;
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
        padding: 15px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
    }

    .logo-header {
        width: 80px;
        height: auto;
        margin-bottom: 8px;
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

    .card h3 {
        color: #103b52;
        margin-bottom: 5px;
    }

    .card p {
        font-size: 22px;
        color: #00923f;
        font-weight: bold;
    }

    table img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
    }

    /* Form Buku Tamu */
    .form-section {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        max-width: 700px;
        margin: 20px auto;
    }

    .form-section h2 {
        text-align: center;
        color: #103b52;
        margin-bottom: 20px;
    }

    .form-row {
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
    }

    .form-row label {
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-row input {
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-row button {
        margin-top: 15px;
        background: #00923f;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-row button:hover {
        background: #007f35;
    }

    .page {
        display: none;
        animation: fadeIn 0.3s ease-in-out;
    }

    .page.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo-container">
    </div>

    <a href="#" class="active" onclick="showPage('dashboard')"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="#" onclick="showPage('bukuTamu')"><i class="fa-solid fa-book"></i> Buku Tamu</a>
    <a href="#" onclick="showPage('formTamu')"><i class="fa-solid fa-pen-to-square"></i> Isi Buku Tamu</a>
</div>

<!-- Konten utama -->
<div class="main-content">

    <!-- Dashboard -->
    <div id="dashboard" class="page active">
        <div class="header">
            <img src="Logo Kabupaten Belitung (Maju Terus Mawas Diri) (1).png" alt="Logo Kabupaten Belitung" class="logo-header"><br>
            SISTEM INFORMASI BUKU TAMU<br>Dinas Komunikasi dan Informatika
        </div>

        <div class="statistik">
            <div class="card">
                <h3>Tamu Hari Ini</h3>
                <p><?php echo $jumlah_tamu_hari_ini; ?></p>
            </div>
            <div class="card">
                <h3>Tamu Bulan Ini</h3>
                <p><?php echo $jumlah_tamu_bulan_ini; ?></p>
            </div>
            <div class="card">
                <h3>Total Semua Tamu</h3>
                <p><?php echo $total_tamu; ?></p>
            </div>
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
                    <th>Tanda Tangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($result_tamu_terbaru->num_rows > 0) {
                    while ($row = $result_tamu_terbaru->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$no++."</td>";
                        echo "<td>".$row["nama"]."</td>";
                        echo "<td>".$row["tanggal_kunjungan"]."</td>";
                        echo "<td>".$row["instansi"]."</td>";
                        echo "<td>".$row["alamat"]."</td>";
                        echo "<td>".$row["keperluan"]."</td>";
                        echo "<td><img src='https://cdn-icons-png.flaticon.com/512/149/149071.png'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Belum ada data tamu.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Form Buku Tamu -->
    <div id="formTamu" class="page">
        <div class="header">FORMULIR BUKU TAMU</div>
        <div class="form-section">
            <h2>Formulir Data Tamu</h2>
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
                <div class="form-row">
                    <button type="submit">Kirim</button>
                </div>
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
