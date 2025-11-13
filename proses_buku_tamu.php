<?php
include 'koneksi.php';

// Ambil data dari form
$nama = $_POST['nama'];
$instansi = $_POST['instansi'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$keperluan = $_POST['keperluan'];
$tanggal_kunjungan = $_POST['tanggal_kunjungan'];

// Query simpan ke database
$sql = "INSERT INTO buku_tamu (nama, instansi, alamat, no_hp, email, keperluan, tanggal_kunjungan)
        VALUES ('$nama', '$instansi', '$alamat', '$no_hp', '$email', '$keperluan', '$tanggal_kunjungan')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Data berhasil disimpan!');
            window.location.href='dashboard.php'; // arahkan ke dashboard kamu
          </script>";
} else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
