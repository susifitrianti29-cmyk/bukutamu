<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $keperluan = $_POST['keperluan'];
    $tanggal = $_POST['tanggal_kunjungan'];

    $query = "INSERT INTO buku_tamu (nama, instansi, alamat, no_hp, email, keperluan, tanggal_kunjungan)
              VALUES ('$nama', '$instansi', '$alamat', '$no_hp', '$email', '$keperluan', '$tanggal')";

    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        echo "sukses";
    } else {
        echo "gagal";
    }
}
?>
