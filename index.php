<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal_hari_ini = date("l, d F Y");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku Tamu Digital | Dinas Kominfo</title>
  <style>
    /* ====== Global Style ====== */
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }

    header {
      background: #0b9444;
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    header h1 {
      font-size: 20px;
      margin: 0;
    }

    header small {
      font-size: 13px;
      color: #e0f7e9;
    }

    main {
      max-width: 1100px;
      margin: 40px auto;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      padding: 30px;
    }

    h2 {
      color: #0b9444;
      margin-bottom: 10px;
      text-align: center;
    }

    .subtitle {
      text-align: center;
      font-size: 13px;
      color: gray;
      margin-bottom: 20px;
    }

    /* ====== Statistik ====== */
    .statistik {
      display: flex;
      gap: 20px;
      justify-content: center;
      margin: 25px 0;
    }

    .card {
      flex: 1;
      text-align: center;
      padding: 20px;
      background: #f7fff9;
      border: 1px solid #d8f3dc;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .card h3 {
      color: #0b9444;
      margin-bottom: 8px;
    }

    .card span {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }

    /* ====== Tabel ====== */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border-radius: 8px;
      overflow: hidden;
    }

    th {
      background: #0b9444;
      color: white;
      padding: 10px;
      text-align: left;
      font-size: 14px;
    }

    td {
      padding: 10px;
      border-bottom: 1px solid #eee;
      font-size: 14px;
    }

    tr:nth-child(even) {
      background: #f9f9f9;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
      .statistik {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Dinas Komunikasi dan Informatika <br><small>Kabupaten Belitung</small></h1>
    <div><strong><?php echo $tanggal_hari_ini; ?></strong></div>
  </header>

  <main>
    <h2>Buku Tamu Digital</h2>
    <div class="subtitle">Rekap Data Tamu dan Statistik Kunjungan</div>

    <div class="statistik">
      <div class="card">
        <h3>Tamu Hari Ini</h3>
        <span>12</span>
      </div>
      <div class="card">
        <h3>Tamu Bulan Ini</h3>
        <span>54</span>
      </div>
      <div class="card">
        <h3>Total Semua Tamu</h3>
        <span>230</span>
      </div>
    </div>

    <h2 style="margin-top:20px;">Data Tamu Terbaru</h2>
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Instansi</th>
          <th>Tanggal Kunjungan</th>
          <th>Keperluan</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Mico</td><td>Pemerintah Daerah</td><td>2025-11-12</td><td>Kunjungan</td></tr>
        <tr><td>Dika</td><td>Pemerintah Daerah</td><td>2025-11-10</td><td>Koordinasi</td></tr>
        <tr><td>Rina</td><td>Swasta</td><td>2025-11-09</td><td>Kerjasama</td></tr>
      </tbody>
    </table>
  </main>

</body>
</html>


