<?php
// proses_tambah_tamu.php

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $instansi = $_POST["instansi"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $email = $_POST["email"];
    $keperluan = $_POST["keperluan"];
    $tanggal_kunjungan = $_POST["tanggal_kunjungan"];

    // Validasi dan sanitasi data (contoh sederhana)
    $nama = htmlspecialchars($nama);
    $instansi = htmlspecialchars($instansi);
    $alamat = htmlspecialchars($alamat);
    $no_hp = htmlspecialchars($no_hp);
    $email = htmlspecialchars($email);
    $keperluan = htmlspecialchars($keperluan);
    $tanggal_kunjungan = htmlspecialchars($tanggal_kunjungan);

    $sql = "INSERT INTO buku_tamu (nama, instansi, alamat, no_hp, email, keperluan, tanggal_kunjungan) VALUES ('$nama', '$instansi', '$alamat', '$no_hp', '$email', '$keperluan', '$tanggal_kunjungan')";

    if ($conn->query($sql) === TRUE) {
        echo "Data tamu berhasil disimpan.";
        header("Location: index.php"); // Redirect ke halaman index
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
