<?php
// proses_login.php
session_start(); // Mulai session

// Periksa apakah form login sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sertakan file koneksi database
  include 'koneksi.php';

  // Ambil data dari form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // ... (Kode pemrosesan login dari login.php) ...
} else {
  // Jika bukan metode POST, redirect ke halaman login
  header("Location: login.php");
  exit;
}
?>
