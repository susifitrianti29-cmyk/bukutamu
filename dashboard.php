<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard EntryEase</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
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

    .sidebar a:hover {
        background-color: #145773;
    }

    .sidebar a i {
        margin-right: 10px;
    }

    /* Konten utama */
    .main-content {
        margin-left: 230px; /* agar tidak tertutup sidebar */
        padding: 20px;
        width: 100%;
        background-color: #f4f6f9;
        min-height: 100vh;
    }
</style>
<!-- Untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="sidebar">
    <h2>EntryEase <i class="fa-solid fa-right-to-bracket"></i></h2>
    <a href="#"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="#"><i class="fa-solid fa-calendar-days"></i> Agenda & Kegiatan</a>
    <a href="#"><i class="fa-solid fa-book"></i> Buku Tamu</a>
    <a href="#"><i class="fa-solid fa-envelope"></i> Kelola Tata Surat</a>
    <a href="#"><i class="fa-solid fa-folder-open"></i> Kelola Dokumen & Arsip</a>
    <a href="#"><i class="fa-solid fa-users"></i> Manajemen Pengguna</a>
</div>

<div class="main-content">
    <h1>Selamat Datang di Dashboard</h1>
    <p>Ini adalah area konten utama yang tampil di sebelah kanan sidebar.</p>
</div>

</body>
</html>
