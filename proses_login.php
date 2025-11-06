<?php
// proses_login.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Mulai session

// Periksa apakah form login sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sertakan file koneksi database
  include 'koneksi.php';

  // Ambil data dari form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validasi input (contoh sederhana)
  if (empty($username) || empty($password)) {
    $error = "Username dan password harus diisi.";
  } else {
    // Gunakan prepared statement untuk mencegah SQL injection
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt === false) {
      die("Error: " . mysqli_error($koneksi)); // Jangan tampilkan error ini di produksi
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Jika user ditemukan
    if ($row = mysqli_fetch_assoc($result)) {
      // Verifikasi password menggunakan password_verify()
      if (password_verify($password, $row['password'])) {
        // Simpan username ke dalam session
        $_SESSION['username'] = $row['username'];

        // Redirect ke halaman admin
        header("Location: admin.php");
        exit;
      } else {
        // Jika password salah
        $error = "Username atau password salah.";
      }
    } else {
      // Jika user tidak ditemukan
      $error = "Username atau password salah.";
    }

    mysqli_stmt_close($stmt);
  }

  // Tutup koneksi database
  mysqli_close($koneksi);
} else {
  // Jika bukan metode POST, redirect ke halaman login
  header("Location: login.php");
  exit;
}

// Jangan tampilkan pesan "Proses login selesai." jika login berhasil
// Pesan ini hanya ditampilkan jika terjadi kesalahan
if (isset($error)) {
  echo "<p style='color: red;'>$error</p>";
}
?>
