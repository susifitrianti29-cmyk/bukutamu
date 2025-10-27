<?php
// Hubungkan ke database utama bukutamu_db
include 'koneksi.php';

// Ambil data dari tabel buku_tamu
$result = mysqli_query($conn, "SELECT * FROM buku_tamu ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Buku Tamu</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Data Buku Tamu</h2>
  <a href="index.php">Kembali ke Form</a><br><br>

  <table border="1" cellpadding="8">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Instansi</th>
      <th>Alamat</th>
      <th>No HP</th>
      <th>Email</th>
      <th>Keperluan</th>
      <th>Tanggal Kunjungan</th>
    </tr>

    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
              <td>{$no}</td>
              <td>{$row['nama']}</td>
              <td>{$row['instansi']}</td>
              <td>{$row['alamat']}</td>
              <td>{$row['no_hp']}</td>
              <td>{$row['email']}</td>
              <td>{$row['keperluan']}</td>
              <td>{$row['tanggal_kunjungan']}</td>
            </tr>";
      $no++;
    }
    ?>
  </table>
</body>
</html>
