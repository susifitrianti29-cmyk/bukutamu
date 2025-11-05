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

  // Query untuk mencari user dengan username dan password yang sesuai
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($koneksi, $sql);

  // Jika user ditemukan
  if (mysqli_num_rows($result) > 0) {
    // Simpan username ke dalam session
    $_SESSION['username'] = $username;

    // Redirect ke halaman admin
    header("Location: admin.php");
    exit;
  } else {
    // Jika login gagal
    $error = "Username atau password salah.";
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
