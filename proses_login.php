<?php
// proses_login.php

// Aktifkan pelaporan kesalahan untuk membantu debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mulai sesi untuk manajemen pengguna
session_start();

// Periksa apakah formulir login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sertakan file koneksi database
    include 'koneksi.php';

    // Ambil data dari formulir dan bersihkan
    $username = trim($_POST["admin"]);
    $password = trim($_POST["admin"]);

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi.";
    } else {
        try {
            // Gunakan prepared statement untuk mencegah SQL injection
            $sql = "SELECT id, username, password FROM users WHERE username = ?";
            $stmt = $koneksi->prepare($sql);

            if ($stmt === false) {
                throw new Exception("Error preparing statement: " . $koneksi->error);
            }

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Verifikasi kata sandi yang di-hash
                if (password_verify($password, $row["password"])) {
                    // Otentikasi berhasil
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["id"] = $row["id"]; // Simpan juga ID pengguna

                    // Redirect ke halaman admin
                    header("Location: admin.php");
                    exit();
                } else {
                    $error = "Password salah.";
                }
            } else {
                $error = "Username tidak ditemukan.";
            }

            $stmt->close();
        } catch (Exception $e) {
            $error = "Terjadi kesalahan: " . $e->getMessage();
            // Log kesalahan ke file atau sistem pemantauan (Penting untuk produksi!)
            error_log($error, 0); // Sesuaikan dengan kebutuhan Anda
        } finally {
            $koneksi->close();
        }
    }
} else {
    // Jika bukan metode POST, redirect ke halaman login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Error</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <a href="login.php">Kembali ke Login</a>
    <?php endif; ?>
</body>
</html>
