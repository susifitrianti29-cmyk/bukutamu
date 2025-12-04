<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Buku Tamu</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { background: white; padding: 20px; border-radius: 8px; width: 400px; margin: auto; }
        input, textarea, select { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { padding: 10px; width: 100%; background: #007bff; color:white; border:none; }
        button:hover { background: #0056b3; cursor:pointer; }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Data Buku Tamu</h2>

    <form method="POST">

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
        <textarea name="keperluan"><?= $data['keperluan']; ?></textarea>

        <label>Tujuan</label>
        <select name="tujuan" required>
             <option value="">-- Pilih Pihak --</option>
        <option value="Kepala Dinas">KASIMIN, S.IP, MAB (Kepala Dinas)</option>
        <option value="Sekretaris Dinas">ZAINAL HARISON, SE (Sekretaris Dinas)</option>
        <option value="Kabid Aplikasi Informatika">APDIAN MUDIE PRIYANBADI,ST,MM (Kabid Aplikasi Informatika)</option>
        <option value="Kabid Informasi Komunikasi Publik">PADILA, ST (Kabid  Informasi Komunikasi Publik)</option>
        <option value="Kabid Keamanan Informasi Persandian  & Statistik">MUHAMMAD SAPRIL, S.Sos (Kabid Keamanan Informasi Persandian dan Statistik)</option>
        <option value="Kasubbag Kepegawaian dan Umum">DESY RESMITA, S.Sos (Kasubbag Kepegawaian dan Umum)</option>
        <option value="Sandiman">MOHD ISNAINI, S.Sos (Sandiman Muda)</option>
         <option value="Pranata Hubungan Masyarakat Ahli Muda">UPIK SUMARTI, SS (Pranata Hubungan Masyarakat Ahli Muda)</option>
         <option value="Analis Kebijakan Ahli Muda">ROSDIANSYAH, SE (Analis Kebijakan Ahli Muda)</option>
         <option value="Pranata Hubungan Masyarakat Ahli Muda">VERRY YUDHISTIRA, S.Ikom, M.I.Kom (Pranata Hubungan Masyarakat Ahli Muda)</option>
         <option value="Pranata Komputer Muda">FIRIK, S.Ikom (Pranata Komputer Muda)</option>
         <option value="Pranata Komputer Muda">ERLINA SETYOWATI HANDAYANI, S.I.Kom (Pranata Komputer Muda)</option>
         <option value="Penelaah Teknis Kebijakan">ICHSAN ZAINUL HAKIM, ST (Penelaah Teknis Kebijakan)</option>
         <option value="Penelaah Teknis Kebijakan">IRHAM ASYHARI, S.Kom	(Penelaah Teknis Kebijakan)</option>
    </select>

        <label>Tanggal Kunjungan</label>
        <input type="date" name="tanggal_kunjungan" value="<?= $data['tanggal_kunjungan']; ?>" required>

        <button type="submit" name="update">Update Data</button>
    </form>
</div>

</body>
</html>
