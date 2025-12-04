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
    $tujuan   = $_POST['tujuan'];


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

        <label>Pihak yang Dituju</label>
<select name="tujuan" required style="
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
">
    <option value="">-- Pilih Pihak --</option>
    <option value="Kepala Dinas" <?= ($data['tujuan']=="Kepala Dinas"?'selected':''); ?>>
        KASIMIN, S.IP, MAB (Kepala Dinas)
    </option>
    <option value="Sekretaris Dinas" <?= ($data['tujuan']=="Sekretaris Dinas"?'selected':''); ?>>
        ZAINAL HARISON, SE (Sekretaris Dinas)
    </option>
    <option value="Kabid Aplikasi Informatika" <?= ($data['tujuan']=="Kabid Aplikasi Informatika"?'selected':''); ?>>
        APDIAN MUDIE PRIYANBADI, ST, MM
    </option>
    <option value="Kabid Informasi Komunikasi Publik" <?= ($data['tujuan']=="Kabid Informasi Komunikasi Publik"?'selected':''); ?>>
        PADILA, ST
    </option>
    <option value="Kabid Keamanan Informasi Persandian  & Statistik" <?= ($data['tujuan']=="Kabid Keamanan Informasi Persandian  & Statistik"?'selected':''); ?>>
        MUHAMMAD SAPRIL, S.Sos
    </option>
    <option value="Kasubbag Kepegawaian dan Umum" <?= ($data['tujuan']=="Kasubbag Kepegawaian dan Umum"?'selected':''); ?>>
        DESY RESMITA, S.Sos
    </option>
    <option value="Sandiman" <?= ($data['tujuan']=="Sandiman"?'selected':''); ?>>
        MOHD ISNAINI, S.Sos
    </option>
    <option value="Pranata Hubungan Masyarakat Ahli Muda" <?= ($data['tujuan']=="Pranata Hubungan Masyarakat Ahli Muda"?'selected':''); ?>>
        UPIK SUMARTI, SS
    </option>
    <option value="Analis Kebijakan Ahli Muda" <?= ($data['tujuan']=="Analis Kebijakan Ahli Muda"?'selected':''); ?>>
        ROSDIANSYAH, SE
    </option>
    <option value="Pranata Hubungan Masyarakat Ahli Muda 2" <?= ($data['tujuan']=="Pranata Hubungan Masyarakat Ahli Muda 2"?'selected':''); ?>>
        VERRY YUDHISTIRA, S.Ikom, M.I.Kom
    </option>
    <option value="Pranata Komputer Muda" <?= ($data['tujuan']=="Pranata Komputer Muda"?'selected':''); ?>>
        FIRIK, S.Ikom
    </option>
    <option value="Pranata Komputer Muda 2" <?= ($data['tujuan']=="Pranata Komputer Muda 2"?'selected':''); ?>>
        ERLINA SETYOWATI HANDAYANI, S.I.Kom
    </option>
    <option value="Penelaah Teknis Kebijakan" <?= ($data['tujuan']=="Penelaah Teknis Kebijakan"?'selected':''); ?>>
        ICHSAN ZAINUL HAKIM, ST
    </option>
    <option value="Penelaah Teknis Kebijakan 2" <?= ($data['tujuan']=="Penelaah Teknis Kebijakan 2"?'selected':''); ?>>
        IRHAM ASYHARI, S.Kom
    </option>

</select>

        <label>Tanggal Kunjungan</label>
        <input type="date" name="tanggal_kunjungan" value="<?= $data['tanggal_kunjungan']; ?>" required>

        <button type="submit" name="update">Simpan Perubahan</button>
    </form>

    <a href="index.php">← Kembali</a>
</div>

</body>
</html>
