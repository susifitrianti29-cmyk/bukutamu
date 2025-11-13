<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard & Buku Tamu | EntryEase</title>

<!-- DataTables & Font Awesome -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        background-color: #f4f6f9;
    }

    /* Sidebar kiri */
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

    .sidebar a:hover {
        background-color: #145773;
    }

    .sidebar a i {
        margin-right: 10px;
    }

    /* Konten utama */
    .main-content {
        margin-left: 230px;
        padding: 20px;
        width: 100%;
        min-height: 100vh;
    }

    .header {
        background-color: #00923f;
        color: white;
        padding: 15px;
        border-radius: 5px 5px 0 0;
        font-weight: bold;
    }

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

    h1 {
        margin-top: 0;
    }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>EntryEase <i class="fa-solid fa-right-to-bracket"></i></h2>
    <a href="#dashboard"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="#agenda"><i class="fa-solid fa-calendar-days"></i> Agenda & Kegiatan</a>
    <a href="#buku-tamu" id="menu-buku-tamu"><i class="fa-solid fa-book"></i> Buku Tamu</a>
    <a href="#surat"><i class="fa-solid fa-envelope"></i> Kelola Tata Surat</a>
    <a href="#dokumen"><i class="fa-solid fa-folder-open"></i> Kelola Dokumen & Arsip</a>
    <a href="#pengguna"><i class="fa-solid fa-users"></i> Manajemen Pengguna</a>
</div>

<!-- Konten utama -->
<div class="main-content">
    <!-- Halaman Dashboard -->
    <div id="dashboard" class="page">
        <h1>Selamat Datang di Dashboard</h1>
        <p>Ini adalah area utama yang tampil di sebelah kanan sidebar.</p>
    </div>

    <!-- Halaman Buku Tamu -->
    <div id="buku-tamu" class="page" style="display:none;">
        <div class="header">BUKU TAMU</div>

        <div class="filter-section">
            Dari: <input type="date" id="dari">
            Sampai: <input type="date" id="sampai">
            <button><i class="fa fa-search"></i> Cari</button>
        </div>

        <div>
            <button class="btn btn-excel"><i class="fa fa-file-excel"></i> Export To Excel</button>
            <button class="btn btn-pdf"><i class="fa fa-file-pdf"></i> Export To PDF</button>
            <button class="btn btn-tambah"><i class="fa fa-plus"></i> Isi Buku Tamu</button>
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
</div>

<!-- Script DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#bukuTamuTable').DataTable();

    // Script sederhana untuk berpindah halaman tanpa reload
    $('.sidebar a').click(function(e){
        e.preventDefault();
        $('.page').hide();
        var target = $(this).attr('href');
        $(target).show();
    });
});
</script>

</body>
</html>
