<!DOCTYPE html>
<html>
<head>
    <title>Buku Tamu Digital</title>
     <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header-box">
  <img src="Logo Kabupaten Belitung (Maju Terus Mawas Diri).png" alt="Logo-belitung" class="logo">
  <div class="header-text">
    <h1>BUKU TAMU</h1>
    <p>DINAS KOMUNIKASI DAN INFORMATIKA<br>KABUPATEN BELITUNG</p>
  </div>
</div>
    <h2>Buku Tamu Digital 2025</h2>
     <form action="simpan.php" method="post" enctype="multipart/form-data">
        Nama: <input type="text" name="nama" required><br>
        Instansi: <input type="text" name="instansi"><br>
        Alamat: <input type="text" name="alamat"><br>
        No HP: <input type="text" name="no_hp"><br>
        Email: <input type="email" name="email"><br>
        Keperluan: <input type="text" name="keperluan"><br>
        Tanggal Kunjungan: <input type="date" name="tanggal_kunjungan" required><br>
        <!-- Tanda Tangan (upload gambar): <input type="file" name="ttd_digital" accept="image/*"><br>
        Foto (upload gambar): <input type="file" name="foto" accept="image/*"><br> -->
        <input type="submit" value="Kirim">
    </form>
</body>
</html>
