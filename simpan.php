<?php
include 'koneksi.php'; // Pastikan file ini ada dan benar

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $nama   = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];
    $email  = $_POST['email'];
    $keperluan = $_POST['keperluan'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];

    // Gunakan prepared statements untuk keamanan
    $sql = "INSERT INTO tamu (nama, instansi, alamat, no_hp, email, keperluan, tanggal_kunjungan) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Persiapkan statement
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        // Bind parameter ke statement
        mysqli_stmt_bind_param($stmt, "sssssss", $nama, $instansi, $alamat, $no_hp, $email, $keperluan, $tanggal_kunjungan);

        // Eksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<h3 style='color:green; text-align:center;'>✅ Data berhasil disimpan!</h3>";
        } else {
            echo "<h3 style='color:red; text-align:center;'>❌ Gagal menyimpan data: " . mysqli_error($koneksi) . "</h3>";
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<h3 style='color:red; text-align:center;'>❌ Gagal mempersiapkan statement: " . mysqli_error($koneksi) . "</h3>";
    }

    // Tutup koneksi
    mysqli_close($koneksi);
}
?>
