<?php
// tampil_data.php

// Sertakan file koneksi database
include 'koneksi.php'; // Pastikan path ini benar

// Periksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel buku_tamu
$query = "SELECT * FROM buku_tamu";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tampil Data Buku Tamu</title>
</head>
<body>

    <h1>Data Buku Tamu</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Keperluan</th>
                <th>Tanggal Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Tampilkan data dari database
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["instansi"] . "</td>";
                echo "<td>" . $row["alamat"] . "</td>";
                echo "<td>" . $row["no_hp"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["keperluan"] . "</td>";
                echo "<td>" . $row["tanggal_kunjungan"] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
