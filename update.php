<?php
// update.php
include 'koneksi.php';

// Periksa apakah data dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Periksa apakah parameter ID ada dan valid
  if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];

    // Ambil data dari form
    $nama = htmlspecialchars($_POST['nama']); // Sanitize input
    $instansi = htmlspecialchars($_POST['instansi']); // Sanitize input
    $alamat = htmlspecialchars($_POST['alamat']); // Sanitize input
    $no_hp = htmlspecialchars($_POST['no_hp']); // Sanitize input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email
    $keperluan = htmlspecialchars($_POST['keperluan']); // Sanitize input
    $tanggal_kunjungan = htmlspecialchars($_POST['tanggal_kunjungan']); // Sanitize input

    // Validasi data
    $errors = array();

    if (empty($nama)) {
      $errors[] = "Nama harus diisi.";
    }

    if (empty($instansi)) {
      $errors[] = "Instansi harus diisi.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Email tidak valid.";
    }

    // Jika ada error, tampilkan pesan error
    if (!empty($errors)) {
      echo "Terjadi kesalahan:<br>";
      foreach ($errors as $error) {
        echo "- " . $error . "<br>";
      }
      echo "<a href='javascript:history.back()'>Kembali ke form edit</a>"; // Tambahkan link kembali
      exit;
    }

    // Update data ke database menggunakan prepared statement
    $sql = "UPDATE buku_tamu SET
              nama = ?,
              instansi = ?,
              alamat = ?,
              no_hp = ?,
              email = ?,
              keperluan = ?,
              tanggal_kunjungan = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt === false) {
      echo "Terjadi kesalahan: " . mysqli_error($koneksi);
      exit;
    }

    mysqli_stmt_bind_param($stmt, "sssssssi", $nama, $instansi, $alamat, $no_hp, $email, $keperluan, $tanggal_kunjungan, $id);

    if (mysqli_stmt_execute($stmt)) {
      echo "<div style='color: green;'>Data berhasil diupdate.</div>";
      echo "<a href='tampil_data.php'>Kembali ke daftar data</a>"; // Tambahkan link kembali
      exit;
    } else {
      echo "Terjadi kesalahan saat mengupdate data: " . mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt);
  } else {
    echo "ID tidak valid.";
  }
} else {
  echo "Akses tidak sah.";
}

mysqli_close($koneksi);
?>
