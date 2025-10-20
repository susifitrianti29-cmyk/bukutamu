<?php
include 'koneksi.php'; // Pastikan file ini ada dan benar

// Ambil data dari form
$nama   = $_POST['nama'];
$instansi = $_POST['instansi'];
$alamat = $_POST['alamat'];
$no_hp= $_POST['no_HP'];
$email = $_POST['email'];
$keperluan = $_POST['keperluan'];
$tanggal_kunjungan= $_POST['tanggal_kunjungan'];


// SQL untuk menyimpan data
$sql = "INSERT INTO tamu (nama, instansi, alamat, no_hp, email, keperluan, tanggal_kunjungan) VALUES (?, ?, ?, ?, ?, ?, ?)";


mysqli_stmt_bind_param($stmt, "sssssss", $nama, $instansi, $alamat, $no_hp, $email, $keperluan, $tanggal_kunjungan);
$exec = mysqli_stmt_execute($stmt);

if ($exec) {
    echo "<h3 style='color:green;'>✅ Data berhasil disimpan!</h3>";
} else {
    echo "<h3 style='color:red;'>❌ Gagal menyimpan data: " . mysqli_error($koneksi) . "</h3>";
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
