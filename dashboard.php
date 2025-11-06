<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Buku Tamu</title>
    <!-- Hubungkan ke file CSS eksternal -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <h2>Dashboard Buku Tamu Digital</h2>
    </div>

    <div class="container">
        <h3>Data Tamu</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Tanggal</th>
            </tr>

            <?php
            // koneksi ke database
            $koneksi = mysqli_connect("localhost", "root", "", "bukutamu");

            // ambil data tamu
            $data = mysqli_query($koneksi, "SELECT * FROM tamu ORDER BY id DESC");
            $no = 1;
            while ($d = mysqli_fetch_array($data)) {
                echo "<tr>
                        <td>$no</td>
                        <td>{$d['nama']}</td>
                        <td>{$d['instansi']}</td>
                        <td>{$d['tanggal']}</td>
                      </tr>";
                $no++;
            }
            ?>
        </table>
    </div>

</body>
</html>
