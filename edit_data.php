<?php
include 'koneksi.php';

// Jika tidak ada ID → kembali ke halaman utama
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Ambil data berdasarkan ID
$sql = mysqli_query($conn, "SELECT * FROM buku_tamu WHERE id = '$id'");
$data = mysqli_fetch_assoc($sql);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Jika tombol update ditekan
if (isset($_POST['update'])) {

    $nama      = $_POST['nama'];
    $instansi  = $_POST['instansi'];
    $alamat    = $_POST['alamat'];
    $no_hp     = $_POST['no_hp'];
    $email     = $_POST['email'];
    $keperluan = $_POST['keperluan'];
    $tanggal   = $_POST['tanggal_kunjungan'];

    $update = mysqli_query($conn, "UPDATE buku_tamu SET 
        nama='$nama',
        instansi='$instansi',
        alamat='$alamat',
        no_hp='$no_hp',
        email='$email',
        keperluan='$keperluan',
        tanggal_kunjungan='$tanggal'
        WHERE id='$id'
    ");

    if ($update) {
        header("Location: index.php?pesan=update_sukses");
        exit;
    } else {
        echo "Gagal update data!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Tamu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }
        .container {
            background: white;
            padding: 25px;
            width: 500px;
            margin: 40px auto;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        label { font-weight: bold; margin-top: 10px; display: block; }
        input {
            width: 100%; padding: 10px; margin-top: 5px;
            border: 1px solid #ccc; border-radius: 6px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #00923f; color: white;
            border: none; border-radius: 6px; cursor: pointer;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Edit Data Buku Tamu</h2>

    <form method="post">

        <label>Nama</label>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required>

        <label>Instansi</label>
        <input type="text" name="instansi" value="<?= $data['instansi']; ?>">

        <label>Alamat</label>
        <input type="text" name="alamat" value="<?= $data['alamat']; ?>">

        <label>No HP</label>
        <input type="text" name="no_hp" value="<?= $data['no_hp']; ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?= $data['email']; ?>">

        <label>Keperluan</label>
        <input type="text" name="keperluan" value="<?= $data['keperluan']; ?>">

        <label>Tanggal Kunjungan</label>
        <input type="date" name="tanggal_kunjungan" value="<?= $data['tanggal_kunjungan']; ?>" required>

        <button type="submit" name="update">Simpan Perubahan</button>
    </form>

    <a href="index.php">← Kembali</a>
</div>

</body>
</html>
