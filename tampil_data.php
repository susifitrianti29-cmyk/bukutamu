<!DOCTYPE html>
<html>
<head>
    <title>Data Buku Tamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header-box">
            <h1>Data Buku Tamu</h1>
            <p>Dinas Komunikasi dan Informatika</p>
        </div>
        <a href="form_buku_tamu.html">Kembali ke Form</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Instansi</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Keperluan</th>
                    <th>Tanggal Kunjungan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php'; // Pastikan file ini ada dan benar

                $sql = "SELECT * FROM tamu";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["instansi"] . "</td>";
                        echo "<td>" . $row["alamat"] . "</td>";
                        echo "<td>" . $row["no_hp"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["keperluan"] . "</td>";
                        echo "<td>" . $row["tanggal_kunjungan"] . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data.</td></tr>";
                }

                mysqli_close($koneksi);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
