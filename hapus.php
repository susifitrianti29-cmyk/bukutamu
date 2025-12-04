<?php
include 'koneksi.php';

// Pastikan ada ID yang dikirim
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// Hapus data berdasarkan ID
$hapus = mysqli_query($conn, "DELETE FROM buku_tamu WHERE id='$id'");

if ($hapus) {
    header("Location: dashboard.php?pesan=hapus_sukses");
    exit;
} else {
    echo "Gagal menghapus data!";
}
?>
