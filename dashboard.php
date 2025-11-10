<?php
include 'db.php';

$dari = isset($_GET['dari']) ? $_GET['dari'] : '';
$sampai = isset($_GET['sampai']) ? $_GET['sampai'] : '';

$where = "";
if ($dari && $sampai) {
    $where = "WHERE hari_tanggal BETWEEN '$dari' AND '$sampai'";
}

$sql = "SELECT * FROM buku_tamu $where ORDER BY hari_tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Buku Tamu - EntryEase</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        /* Contoh styling sederhana */
        .btn-export {
            padding: 6px 12px; border-radius: 3px; text-decoration:none; color:#fff; font-weight:600;margin-right:10px;
        }
        .btn-excel {background-color:#28a745;}
        .btn-pdf {background-color:#fd7e14;}
        .btn-isi {background-color:#007bff;}
        table {
            width: 100%; border-collapse: collapse; margin-top: 10px;
        }
        th, td {
            padding: 10px; border: 1px solid #ddd; text-align: center; vertical-align: middle;
        }
        th {
            background-color: #2f8e2f; color: #fff;
        }
        .aksi .btn {
            padding: 6px 12px; border: none; border-radius: 3px; color: #fff; cursor: pointer; font-weight: bold;
            margin-right: 5px;
        }
        .btn-ubah {background-color: #ff9800;}
        .btn-hapus {background-color: #dc3545;}
        img.sign {
            width: 80px; height: auto;
        }
        img.avatar {
            width: 40px; height: auto; border-radius: 50%;
        }
    </style>
</head>
<body>
<div class="container">

    <h2>Buku Tamu</h2>

    <form method="GET" action="" style="margin-bottom: 15px;">
        Dari: <input type="date" name="dari" value="<?php echo htmlspecialchars($dari); ?>" />
        Sampai: <input type="date" name="sampai" value="<?php echo htmlspecialchars($sampai); ?>" />
        <button type="submit" style="padding:6px 15px; background:#2f8e2f; color:#fff; border:none; border-radius:4px; cursor:pointer;">Cari</button>
    </form>

    <a href="export_excel.php?dari=<?php echo urlencode($dari); ?>&sampai=<?php echo urlencode($sampai); ?>" class="btn-export btn-excel">Export To Excel</a>
    <a href="export_pdf.php?dari=<?php echo urlencode($dari); ?>&sampai=<?php echo urlencode($sampai); ?>" class="btn-export btn-pdf">Export To PDF</a>
    <a href="tambah_buku_tamu.php" class="btn-export btn-isi">Isi Buku Tamu</a>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Hari & Tanggal</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Makud & Tujuan</th>
                <th>Tanda Tangan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($result && $result->num_rows > 0):
                $no = 1;
                while($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td>
                    <?php 
                    if (!empty($row['foto'])) { 
                        echo '<img class="avatar" src="uploads/'.$row['foto'].'" alt="Foto '.$row['nama'].'"><br>';
                    }
                    ?>
                    <?php echo htmlspecialchars($row['nama']); ?>
                </td>
                <td><?php echo htmlspecialchars(date('l, d-m-Y', strtotime($row['hari_tanggal']))); ?></td>
                <td><?php echo htmlspecialchars($row['jabatan']); ?></td>
                <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                <td><?php echo htmlspecialchars($row['maksud_tujuan']); ?></td>
                <td>
                    <?php 
                    if (!empty($row['tanda_tangan'])) { 
                        echo '<img class="sign" src="signatures/'.$row['tanda_tangan'].'" alt="TTD '.$row['nama'].'">';
                    } else {
                        echo '-';
                    }
                    ?>
                </td>
                <td class="aksi">
                    <a href="edit_buku_tamu.php?id=<?php echo $row['id']; ?>" class="btn btn-ubah">Ubah</a>
                    <a href="hapus_buku_tamu.php?id=<?php echo $row['id']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                </td>
            </tr>
            <?php
                endwhile;
            else:
            ?>
            <tr><td colspan="8">Belum ada data buku tamu.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
