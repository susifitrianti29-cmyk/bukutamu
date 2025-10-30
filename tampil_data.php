<?php
// tampil_data.php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Buku Tamu</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <h2 class="judul-halaman">Data Buku Tamu</h2>
  <div class="kembali">
    <a href="index.php">← Kembali ke Form</a>
  </div>

<?php
$sql = "SELECT * FROM buku_tamu ORDER BY id DESC";
$data = mysqli_query($koneksi, $sql);

if ($data === false) {
    echo '<div class="msg">Terjadi kesalahan: ' . htmlspecialchars(mysqli_error($koneksi)) . '</div>';
} else {
    if (mysqli_num_rows($data) === 0) {
        echo '<div class="msg">Belum ada data tamu.</div>';
    } else {
        echo '<table>';
        echo '<thead><tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>INSTANSI</th>
                <th>ALAMAT</th>
                <th>NO HP</th>
                <th>EMAIL</th>
                <th>KEPERLUAN</th>
                <th>TANGGAL KUNJUNGAN</th>
              </tr></thead>';
        echo '<tbody>';
        $no = 1;

        while ($row = mysqli_fetch_assoc($data)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>".htmlspecialchars($row['nama'])."</td>
                    <td>".htmlspecialchars($row['instansi'])."</td>
                    <td>".htmlspecialchars($row['alamat'])."</td>
                    <td>".htmlspecialchars($row['no_hp'])."</td>
                    <td>".htmlspecialchars($row['email'])."</td>
                    <td>".htmlspecialchars($row['keperluan'])."</td>
                    <td>".htmlspecialchars($row['tanggal_kunjungan'])."</td>
                  </tr>";
            $no++;
        }
        echo '</tbody></table>';
    }
    mysqli_free_result($data);
}
mysqli_close($koneksi);
?>
</div>

</body>
</html>
