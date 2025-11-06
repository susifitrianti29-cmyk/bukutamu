<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <h2>SISTEM INFORMASI PERPUSTAKAAN</h2>
        <div class="menu">
            <a href="#">Dashboard</a>
            <a href="#">Buku</a>
            <a href="#">Anggota</a>
            <a href="#">Pengumuman</a>
            <a href="#">Laporan</a>
            <a href="#">Pengaturan</a>
            <a href="#">Keluar</a>
        </div>
    </div>

    <!-- Isi Dashboard -->
    <div class="container">
        <h3>Dashboard</h3>
        <div class="cards">
            <div class="card blue">
                <h4>Buku</h4>
                <p>
                    <?php
                    $buku = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM buku");
                    $hasil = mysqli_fetch_assoc($buku);
                    echo $hasil['jumlah'] . " Judul buku";
                    ?>
                </p>
                <button>Tambah</button>
            </div>

            <div class="card red">
                <h4>Akun</h4>
                <p>
                    <?php
                    $akun = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM anggota");
                    $hasil = mysqli_fetch_assoc($akun);
                    echo $hasil['jumlah'] . " anggota";
                    ?>
                </p>
                <button>Tambah</button>
            </div>

            <div class="card yellow">
                <h4>Jurnal</h4>
                <p>1 Judul</p>
                <button>Tambah</button>
            </div>

            <div class="card green">
                <h4>Transaksi</h4>
                <p>0 transaksi selesai</p>
                <button>Tambah</button>
            </div>
        </div>

        <div class="pengumuman">
            <h4>Pengumuman</h4>
            <p>test pengumuman</p>
            <ul>
                <li>Test pengumuman2</li>
                <li>Test pengumuman3</li>
            </ul>
        </div>
    </div>

    <footer>
        Copyright &copy; 2025 - SMAN 1 KOTAKU | Dikembangkan oleh <b>webdevteam</b>
    </footer>

</body>
</html>
