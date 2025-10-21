<!DOCTYPE html>
<html>
<head>
    <title>Buku Tamu Digital</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <center><div class="container"></center>
        <header>
           <center> <h1>Buku Tamu Digital</h1></center>
           <center><p>DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN BELITUNG</p></center> 
        </header>

       <center> <div class="form-wrapper"></center>
            <h2>Formulir Data Tamu</h2>
            <form action="proses_buku_tamu.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-row">
                    <label for="instansi">Instansi:</label>
                    <input type="text" id="instansi" name="instansi">
                </div>

                <div class="form-row">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat">
                </div>

                <div class="form-row">
                    <label for="no_hp">No HP:</label>
                    <input type="text" id="no_hp" name="no_hp">
                </div>

                <div class="form-row">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="form-row">
                    <label for="keperluan">Keperluan:</label>
                    <input type="text" id="keperluan" name="keperluan">
                </div>

                <div class="form-row">
                    <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
                    <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" required>
                </div>

                <button type="submit">Kirim</button>
            
            </form>
        </div>
    </div>
</body>
</html>
