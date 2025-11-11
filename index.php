<?php
include 'koneksi.php';
session_start();

// Proses simpan data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $keperluan = $_POST['keperluan'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];

    $sql = "INSERT INTO buku_tamu (nama, instansi, alamat, no_hp, email, keperluan, tanggal_kunjungan)
            VALUES ('$nama', '$instansi', '$alamat', '$no_hp', '$email', '$keperluan', '$tanggal_kunjungan')";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        echo "<script>alert('Data tamu berhasil disimpan!');</script>";
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}

// Statistik tamu
$sql_hari_ini = "SELECT COUNT(*) AS jumlah FROM buku_tamu WHERE DATE(tanggal_kunjungan) = CURDATE()";
$res_hari_ini = mysqli_query($koneksi, $sql_hari_ini);
$data_hari_ini = mysqli_fetch_assoc($res_hari_ini);
$jumlah_hari_ini = $data_hari_ini['jumlah'] ?? 0;

$sql_bulan_ini = "SELECT COUNT(*) AS jumlah FROM buku_tamu WHERE MONTH(tanggal_kunjungan)=MONTH(CURDATE()) AND YEAR(tanggal_kunjungan)=YEAR(CURDATE())";
$res_bulan_ini = mysqli_query($koneksi, $sql_bulan_ini);
$data_bulan_ini = mysqli_fetch_assoc($res_bulan_ini);
$jumlah_bulan_ini = $data_bulan_ini['jumlah'] ?? 0;

// Data tamu terbaru
$sql_tamu = "SELECT * FROM buku_tamu ORDER BY tanggal_kunjungan DESC LIMIT 5";
$res_tamu = mysqli_query($koneksi, $sql_tamu);

// Format tanggal
setlocale(LC_TIME, 'id_ID.UTF-8');
date_default_timezone_set('Asia/Jakarta');
$tanggal_sekarang = strftime("%A, %d %B %Y");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container mt-4 mb-5">
    <!-- Header -->
    <div class="header-kabupaten d-flex align-items-center mb-4">
        <img src="images/logo-Kabupaten Belitung (Maju Terus Mawas Diri).png" alt="Logo Kabupaten Belitung" width="80" class="mr-3">
        <div class="header-text">
            <h4 class="mb-1">Dinas Komunikasi dan Informatika</h4>
            <p class="mb-0 small">Jalan Anwar Komp Marakas Tanjungpandan RT 025 RW 010 - 33412</p>
            <p class="mb-0 small">Telp: +6271924942 | Email: kominfo[at]belitung.go.id</p>
        </div>
    </div>

    <!-- Judul -->
    <div class="text-center mb-4">
        <h2>Buku Tamu Digital</h2>
        <p class="text-muted">Tanggal: <?php echo ucfirst($tanggal_sekarang); ?></p>
    </div>

    <!-- Formulir -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white">Formulir Data Tamu</div>
        <div class="card-body">
            <form method="post" action="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama:</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Instansi:</label>
                        <input type="text" name="instansi" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Alamat:</label>
                        <input type="text" name="alamat" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No HP:</label>
                        <input type="text" name="no_hp" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Keperluan:</label>
                        <input type="text" name="keperluan" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Kunjungan:</label>
                        <input type="date" name="tanggal_kunjungan" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block">Kirim</button>
            </form>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row text-center mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Tamu Hari Ini</h5>
                    <p class="display-4 text-primary mb-0"><?php echo $jumlah_hari_ini; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Tamu Bulan Ini</h5>
                    <p class="display-4 text-success mb-0"><?php echo $jumlah_bulan_ini; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tamu Terbaru -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Tamu Terbaru</div>
        <div class="card-body table-responsive">
            <table class="table table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($res_tamu) > 0) {
                        while ($row = mysqli_fetch_assoc($res_tamu)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['instansi']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tanggal_kunjungan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['keperluan']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Belum ada data tamu.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
