<?php
// Hubungkan ke database
include 'koneksi.php';

// Cek apakah form dikirim menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data & hindari SQL Injection
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $instansi = mysqli_real_escape_string($koneksi, $_POST['instansi']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $keperluan = mysqli_real_escape_string($koneksi, $_POST['keperluan']);
    $tanggal_kunjungan = mysqli_real_escape_string($koneksi, $_POST['tanggal_kunjungan']);

    // Query simpan data
    $query = "INSERT INTO buku_tamu (nama, instansi, alamat, no_hp, email, keperluan, tanggal_kunjungan)
    VALUES ('$nama', '$instansi', '$alamat', '$no_hp', '$email', '$keperluan', '$tanggal_kunjungan')";

    // Jalankan query
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href = 'index.php';
              </script>";
    } else {
        $error = mysqli_error($koneksi);
        echo "<script>
                alert('Terjadi kesalahan: $error');
                window.location.href = 'index.php';
              </script>";
    }

    mysqli_close($koneksi);
    
} else {
    echo "Akses tidak diizinkan!";
}
?>
