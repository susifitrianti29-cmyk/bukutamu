<?php
include 'koneksi.php';

$sql = "SELECT * FROM buku_tamu ORDER BY id DESC";
$result = mysqli_query($koneksi, $sql);
?>

<table id="bukuTamuTable" class="display">
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
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['instansi']); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td><?= htmlspecialchars($row['no_hp']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['keperluan']); ?></td>
                <td><?= htmlspecialchars($row['tanggal_kunjungan']); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php mysqli_close($conn); ?>
