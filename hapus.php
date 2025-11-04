<?php
// hapus.php
include 'koneksi.php';

// Periksa apakah parameter ID ada dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  // Lindungi dari kemungkinan penghapusan data yang tidak ada
  // Periksa apakah data dengan ID tersebut benar-benar ada di database
  $cek_sql = "SELECT id FROM buku_tamu WHERE id = ?";
  $cek_stmt = mysqli_prepare($koneksi, $cek_sql);

  if ($cek_stmt === false) {
    echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    exit;
  }

  mysqli_stmt_bind_param($cek_stmt, "i", $id);
  mysqli_stmt_execute($cek_stmt);
  mysqli_stmt_store_result($cek_stmt); // Penting untuk mysqli_stmt_num_rows

  if (mysqli_stmt_num_rows($cek_stmt) == 0) {
    echo "Data dengan ID tersebut tidak ditemukan.";
    exit;
  }

  mysqli_stmt_close($cek_stmt);


  // Hapus data dari database menggunakan prepared statement
  $sql = "DELETE FROM buku_tamu WHERE id = ?";
  $stmt = mysqli_prepare($koneksi, $sql);

  if ($stmt === false) {
    echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    exit;
  }

  mysqli_stmt_bind_param($stmt, "i", $id);

  if (mysqli_stmt_execute($stmt)) {
    echo "<div style='color: green;'>Data berhasil dihapus.</div>";
    header("Location: tampil_data.php"); // Redirect ke halaman tampilan data
    exit;
  } else {
    echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($koneksi);
  }

  mysqli_stmt_close($stmt);
} else {
  echo "ID tidak valid.";
}

mysqli_close($koneksi);
?>
