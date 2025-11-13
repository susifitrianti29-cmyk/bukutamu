<?php
// index.php

include 'koneksi.php';

// Periksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil data statistik dari database
$sql_tamu_hari_ini = "SELECT COUNT(*) AS jumlah FROM buku_tamu WHERE DATE(tanggal_kunjungan) = CURDATE()";
$result_tamu_hari_ini = $conn->query($sql_tamu_hari_ini);
$jumlah_tamu_hari_ini = ($result_tamu_hari_ini->num_rows > 0) ? $result_tamu_hari_ini->fetch_assoc()["jumlah"] : 0;

$sql_tamu_bulan_ini = "SELECT COUNT(*) AS jumlah FROM buku_tamu WHERE MONTH(tanggal_kunjungan) = MONTH(CURDATE()) AND YEAR(tanggal_kunjungan) = YEAR(CURDATE())";
$result_tamu_bulan_ini = $conn->query($sql_tamu_bulan_ini);
$jumlah_tamu_bulan_ini = ($result_tamu_bulan_ini->num_rows > 0) ? $result_tamu_bulan_ini->fetch_assoc()["jumlah"] : 0;

$sql_total_tamu = "SELECT COUNT(*) AS jumlah FROM buku_tamu";
$result_total_tamu = $conn->query($sql_total_tamu);
$total_tamu = ($result_total_tamu->num_rows > 0) ? $result_total_tamu->fetch_assoc()["jumlah"] : 0;

// Ambil data tamu terbaru
$sql_tamu_terbaru = "SELECT nama, instansi, tanggal_kunjungan, keperluan FROM buku_tamu ORDER BY tanggal_kunjungan DESC"; // Hapus LIMIT 5
$result_tamu_terbaru = $conn->query($sql_tamu_terbaru);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Buku Tamu Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* style.css */

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 5px;
        }

        .text-muted {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        .statistik {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #eee;
        }

        .card h3 {
            color: #555;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin: 0;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="container">

        <h1>Buku Tamu Digital</h1>
        <p class="text-muted">Rekap Data Tamu dan Statistik Kunjungan</p>

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
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Instansi</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Keperluan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_tamu_terbaru->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result_tamu_terbaru)) {
                        echo "<tr>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["instansi"] . "</td>";
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

</body>
</html>
