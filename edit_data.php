<?php
include 'koneksi.php';

// Jika tidak ada ID → kembali ke halaman utama
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// Ambil data berdasarkan ID
$sql  = mysqli_query($conn, "SELECT * FROM buku_tamu WHERE id='$id'");
$data = mysqli_fetch_assoc($sql);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Jika tombol UPDATE ditekan
if (isset($_POST['update'])) {

    $nama      = $_POST['nama'];
    $instansi  = $_POST['instansi'];
    $alamat    = $_POST['alamat'];
    $no_hp     = $_POST['no_hp'];
    $email     = $_POST['email'];
    $keperluan = $_POST['keperluan'];
    $tanggal   = $_POST['tanggal_kunjungan'];
    $tujuan    = $_POST['tujuan'];

    $update = mysqli_query($conn, "UPDATE buku_tamu SET 
        nama='$nama',
        instansi='$instansi',
        alamat='$alamat',
        no_hp='$no_hp',
        email='$email',
        keperluan='$keperluan',
        tujuan='$tujuan',
        tanggal_kunjungan='$tanggal'
        WHERE id='$id'
    ");

    if ($update) {
        header("Location: dashboard.php?pesan=update_sukses");
        exit;
    } else {
        echo "Gagal update data!";
    }
}
?>
