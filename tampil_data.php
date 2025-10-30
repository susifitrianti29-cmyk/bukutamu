<?php
// tampil_data.php
// Panggil koneksi terlebih dahulu sehingga $koneksi tersedia sebelum ada output HTML
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Buku Tamu</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h2>Data Buku Tamu</h2>
    <div class="kembali">
      <a href="index.php">← Kembali ke Form</a>
    </div>
    <?php // Jalankan query dengan pengecekan $sql = "SELECT * FROM buku_tamu ORDER BY id DESC"; $data = mysqli_query($koneksi, $sql);
if ($data === false) { // Jika query gagal tampilkan pesan error (untuk debugging). Di produksi, tampilkan pesan umum.
echo '<div class="msg">Terjadi kesalahan pada query: ' . htmlspecialchars(mysqli_error($koneksi)) . '</div>'; } else{ // Jika tidak ada baris, tampilkan pesan if
(mysqli_num_rows($data) === 0) {
  echo '<div class="msg">Belum ada data tamu.</div>'; } else { // Tampilkan tabel
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
  // Escape output untuk mencegah XSS
  $nama  = htmlspecialchars($row['nama'] ?? '');
  $inst  = htmlspecialchars($row['instansi'] ?? '');
 $alamat= htmlspecialchars($row['alamat'] ?? '');
 $hp    = htmlspecialchars($row['no_hp'] ?? '');
 $email = htmlspecialchars($row['email'] ?? '');
$kep   = htmlspecialchars($row['keperluan'] ?? '');
$tgl   = htmlspecialchars($row['tanggal_kunjungan'] ?? '');
 echo "<tr>
 <td>{$no}</td>
<td>{$nama}</td>
<td>{$inst}</td>
<td>{$alamat}</td>
<td>{$hp}</td>
<td>{$email}</td>
<td>{$kep}</td>
<td>{$tgl}</td>
</tr>";
$no++;
     }
            echo '</tbody></table>';
        }
        // bebaskan hasil
        mysqli_free_result($data);
    }

    // Tutup koneksi (opsional)
  mysqli_close($koneksi);
    ?>
  </div>
</body>
</html> 
