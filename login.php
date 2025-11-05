<?php
// login.php
session_start(); // Mulai session

// Jika sudah login, redirect ke halaman admin
if (isset($_SESSION['username'])) {
  header("Location: admin.php");
  exit;
}

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
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>

  <?php if (isset($error)) { ?>
    <p style="color: red;"><?php echo $error; ?></p>
  <?php } ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>

    <input type="submit" value="Login">
  </form>
</body>
</html>
