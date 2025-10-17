<?php
include 'koneksi.php'; // Pastikan file ini ada dan benar

// Ambil data dari form
$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];

// Ambil file upload
// $foto     = $_FILES['foto']['name'];
// $foto_tmp = $_FILES['foto']['tmp_name'];
// $ttd      = $_FILES['ttd_digital']['name'];
// $ttd_tmp  = $_FILES['ttd_digital']['tmp_name'];

// Cek jika foto dan tanda tangan kosong
// if (empty($foto) || empty($ttd)) {
//     echo "<script>
//         alert('Gagal! Foto dan tanda tangan harus diisi.');
//         window.location.href='index.php';
//     </script>";
//     exit();
// }

// Buat folder upload kalau belum ada
// if (!is_dir(_DIR_ . '/uploads')) {
//     mkdir(_DIR_ . '/uploads');
// }

// Pindahkan file ke folder uploads
// move_uploaded_file($foto_tmp, _DIR_ . '/uploads/' . $foto);
// move_uploaded_file($ttd_tmp, _DIR_ . '/uploads/' . $ttd);

// Simpan nama file untuk database
// $foto_db = 'uploads/' . $foto;
// $ttd_db  = 'uploads/' . $ttd;

// SQL untuk menyimpan data
$sql = "INSERT INTO tamu (nama, alamat, foto, ttd) VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);
if (mysqli_stmt_execute($stmt)) {
    echo "Data berhasil disimpan.";
} else 
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);

mysqli_stmt_bind_param($stmt, "ssss", $nama, $alamat, $foto_db, $ttd_db);
$exec = mysqli_stmt_execute($stmt);

if ($exec) {
    echo "<h3 style='color:green;'>✅ Data berhasil disimpan!</h3>";
} else {
    echo "<h3 style='color:red;'>❌ Gagal menyimpan data: " . mysqli_error($koneksi) . "</h3>";
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>