<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Buku Tamu</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <h2>Data Buku Tamu</h2>
    <div class="kembali">
      <a href="index.php">← Kembali ke Form</a>
    </div>

    <table>
      <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>INSTANSI</th>
        <th>ALAMAT</th>
        <th>NO HP</th>
        <th>EMAIL</th>
        <th>KEPERLUAN</th>
        <th>TANGGAL KUNJUNGAN</th>
      </tr>

      <?php
      include 'koneksi.php';
      $no = 1;
      $data = mysqli_query($koneksi, "SELECT * FROM buku_tamu ORDER BY id DESC");
      while($row = mysqli_fetch_array($data)){
      ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $row['nama'] ?></td>
          <td><?= $row['instansi'] ?></td>
          <td><?= $row['alamat'] ?></td>
          <td><?= $row['no_hp'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['keperluan'] ?></td>
          <td><?= $row['tanggal_kunjungan'] ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>

</body>
</html>
