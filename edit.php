<?php
// edit.php
include 'koneksi.php';

// Periksa apakah parameter ID ada dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  // Ambil data buku tamu dari database
  $sql = "SELECT * FROM buku_tamu WHERE id = ?"; // Gunakan prepared statement
  $stmt = mysqli_prepare($koneksi, $sql);

  if ($stmt === false) {
    echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    exit;
  }

  mysqli_stmt_bind_param($stmt, "i", $id); // "i" menandakan integer
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($result === false) {
    echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    exit;
  }

  $row = mysqli_fetch_assoc($result);

  // Periksa apakah data ditemukan
  if ($row === null) {
    echo "Data tidak ditemukan.";
  } else {
    // Tampilkan form edit
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Edit Data Buku Tamu</title>
      <link rel="stylesheet" href="style.css"> <!-- Pastikan file CSS Anda terhubung -->
    </head>
    <body>
      <div class="container">
        <h1>Edit Data Buku Tamu</h1>
        <form action="update.php" method="post">
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

          <label for="nama">Nama:</label><br>
          <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>"><br><br>

          <label for="instansi">Instansi:</label><br>
          <input type="text" id="instansi" name="instansi" value="<?php echo htmlspecialchars($row['instansi']); ?>"><br><br>

          <label for="alamat">Alamat:</label><br>
          <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($row['alamat']); ?>"><br><br>

          <label for="no_hp">No. HP:</label><br>
          <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($row['no_hp']); ?>"><br><br>

          <label for="email">Email:</label><br>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br><br>

          <label for="keperluan">Keperluan:</label><br>
          <input type="text" id="keperluan" name="keperluan" value="<?php echo htmlspecialchars($row['keperluan']); ?>"><br><br>

          <label for="tanggal_kunjungan">Tanggal Kunjungan:</label><br>
          <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" value="<?php echo htmlspecialchars($row['tanggal_kunjungan']); ?>"><br><br>

          <input type="submit" value="Simpan">
        </form>
      </div>
    </body>
    </html>
    <?php
    mysqli_free_result($result);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($koneksi);
} else {
  echo "ID tidak valid.";
}
?>
