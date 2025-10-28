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
</head>
<body>
  <center><h2>Data Buku Tamu</h2></center>
   <link rel="stylesheet" href="style.css">
  <table border="1" cellpadding="8">
    <tr>
     <center> <th>No</th></center>
      <center><th>Nama</th></center>
      <center><th>Instansi</th></center>
     <center> <th>Alamat</th></center>
      <center><th>No HP</th></center>
      <center><th>Email</th></center>
     <center> <th>Keperluan</th></center>
      <center><th>Tanggal Kunjungan</th></center>
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
      <a href="index.php">Kembali ke Form</a><br><br>
      $no++;
    }
    ?>
  </table>
</body>
</html>
