<?php
// Hubungkan ke database
include 'koneksi.php';

// Cek apakah form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $keperluan = $_POST['keperluan'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];

    // Query untuk menyimpan data ke tabel buku_tamu
    $query = "INSERT INTO buku_tamu (nama, instansi, alamat, no_hp, email, keperluan, tanggal_kunjungan)
              VALUES ('$nama', '$instansi', '$alamat', '$no_hp', '$email', '$keperluan', '$tanggal_kunjungan')";

    // Jalankan query
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menyimpan data: " . mysqli_error($conn) . "');
                window.location.href = 'index.php';
              </script>";
    }

    // Tutup koneksi
    mysqli_close($conn);
} else {
    echo "Akses tidak diizinkan!";
}
?>
