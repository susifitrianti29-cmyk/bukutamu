<?php
$koneksi = mysqli_connect("localhost", "root", "", "bukutamu_db");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
