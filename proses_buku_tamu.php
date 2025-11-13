<?php
// Aktifkan error reporting (opsional saat debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ====== Koneksi Database ======
include 'koneksi.php'; // pastikan file koneksi.php ada di folder yang sama

// ====== Pastikan form dikirim lewat POST ======
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'] ?? '';
    $instansi = $_POST['instansi'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $no_hp = $_POST['no_hp'] ?? '';
    $email = $_POST['email'] ?? '';
    $keperluan = $_POST['keperluan'] ?? '';
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'] ?? '';

    // Validasi sederhana
    if ($nama != '' && $tanggal_kunjungan != '') {
        // Simpan ke database
        $sql = "INSERT INTO buku_tamu (nama, instansi, alamat, no_hp, email, keperluan, tanggal_kunjungan)
                VALUES ('$nama', '$instansi', '$alamat', '$no_hp', '$email', '$keperluan', '$tanggal_kunjungan')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data tamu berhasil disimpan!'); window.location='dashboard.php';</script>";
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Nama dan tanggal wajib diisi!'); window.history.back();</script>";
    }
} else {
    echo "Akses tidak valid.";
}
?>
