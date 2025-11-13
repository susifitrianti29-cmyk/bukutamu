<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EntryEase | Dashboard</title>

<!-- FontAwesome & DataTables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        background-color: #f4f6f9;
    }

    /* Sidebar */
    .sidebar {
        width: 230px;
        background-color: #103b52;
        color: white;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        padding-top: 20px;
    }

    .sidebar h2 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 30px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: white;
        text-decoration: none;
        transition: 0.3s;
    }

    .sidebar a:hover, .sidebar a.active {
        background-color: #145773;
    }

    .sidebar a i {
        margin-right: 10px;
    }

    /* Konten utama */
    .main-content {
        margin-left: 230px;
        padding: 20px;
        width: calc(100% - 230px);
    }

    .header {
        background-color: #00923f;
        color: white;
        padding: 15px;
        border-radius: 5px 5px 0 0;
        font-weight: bold;
    }

    /* Buku tamu table */
    .filter-section {
        margin: 15px 0;
    }

    .filter-section input {
        padding: 5px;
        margin-right: 10px;
    }

    .filter-section button {
        background-color: #00923f;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .filter-section button:hover {
        background-color: #007f35;
    }

    .btn {
        padding: 6px 10px;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        margin-right: 5px;
    }

    .btn-excel { background-color: #28a745; }
    .btn-pdf { background-color: #dc3545; }
    .btn-tambah { background-color: #007bff; }

    .btn-edit { background-color: orange; color: white; border: none; border-radius: 3px; padding: 4px 8px;}
    .btn-hapus { background-color: red; color: white; border: none; border-radius: 3px; padding: 4px 8px;}

    table img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }

    /* Form Buku Tamu */
    .form-section {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        max-width: 700px;
        margin: auto;
    }

    .form-section h2 {
        text-align: center;
        color: #103b52;
        margin-bottom: 20px;
    }

    .form-row {
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
    }

    .form-row label {
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-row input, .form-row textarea {
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-row button {
        margin-top: 15px;
        background: #00923f;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-row button:hover {
        background: #007f35;
    }

    /* Halaman yang disembunyikan */
    .page {
        display: none;
        animation: fadeIn 0.3s ease-in-out;
    }

    .page.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>EntryEase <i class="fa-solid fa-right-to-bracket"></i></h2>
    <a href="#" class="active" onclick="showPage('dashboard')"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="#" onclick="showPage('bukuTamu')"><i class="fa-solid fa-book"></i> Buku Tamu</a>
    <a href="#" onclick="showPage('formTamu')"><i class="fa-solid fa-pen-to-square"></i> Isi Buku Tamu</a>
</div>

<!-- Konten utama -->
<div class="main-content">

    <!-- Dashboard -->
    <div id="dashboard" class="page active">
        <div class="header">DASHBOARD</div>
        <p>Selamat datang di EntryEase Dashboard! Gunakan menu di sebelah kiri untuk melihat Buku Tamu atau mengisi data tamu baru.</p>
    </div>

    <!-- Buku Tamu -->
    <div id="bukuTamu" class="page">
        <div class="header">BUKU TAMU</div>

        <div class="filter-section">
            Dari: <input type="date" id="dari">
            Sampai: <input type="date" id="sampai">
            <button><i class="fa fa-search"></i> Cari</button>
        </div>

        <div>
            <button class="btn btn-excel"><i class="fa fa-file-excel"></i> Export To Excel</button>
            <button class="btn btn-pdf"><i class="fa fa-file-pdf"></i> Export To PDF</button>
            <button class="btn btn-tambah" onclick="showPage('formTamu')"><i class="fa fa-plus"></i> Isi Buku Tamu</button>
        </div>

        <br>

        <table id="bukuTamuTable" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Hari & Tanggal</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Maksud & Tujuan</th>
                    <th>Tanda Tangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>dedi</td>
                    <td>Senin, 22-04-2019</td>
                    <td>Staff</td>
                    <td>Jalan Baru</td>
                    <td>Berkunjung</td>
                    <td><img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"></td>
                    <td>
                        <button class="btn-edit">Ubah</button>
                        <button class="btn-hapus">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Form Buku Tamu -->
    <div id="formTamu" class="page">
        <div class="header">FORMULIR BUKU TAMU</div>
        <div class="form-section">
            <h2>Formulir Data Tamu</h2>
            <form action="tampil_data.php" method="post">
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

                <div class="form-row">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script DataTables & Page Navigation -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#bukuTamuTable').DataTable();
});

function showPage(pageId) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.getElementById(pageId).classList.add('active');
    document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
    event.target.closest('a').classList.add('active');
}
</script>

</body>
</html>
