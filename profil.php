<?php
include "koneksi.php";

// Ambil data instansi
$data = mysqli_query($koneksi, "SELECT * FROM instansi WHERE id=1");
$instansi = mysqli_fetch_assoc($data);

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {

    $nama = $_POST['nama_instansi'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $program = $_POST['program_kerja'];

    // Logo
    $logo = $_FILES['logo']['name'];
    $tmp = $_FILES['logo']['tmp_name'];

    if ($logo != "") {
        move_uploaded_file($tmp, "logo/" . $logo);
        $up_logo = ", logo='$logo'";
    } else {
        $up_logo = "";
    }

    // Update database
    $sql = "UPDATE instansi SET
            nama_instansi='$nama',
            visi='$visi',
            misi='$misi',
            program_kerja='$program'
            $up_logo
            WHERE id=1";

    mysqli_query($conn, $sql);

    echo "<script>alert('Profil berhasil diperbarui!'); window.location='profil.php';</script>";
}
?>
<h3>Profil Instansi</h3>
<form action="" method="POST" enctype="multipart/form-data">

    <label>Logo Instansi</label><br>
    <img src="logo/<?= $instansi['logo'] ?>" width="100"><br><br>
    <input type="file" name="logo" class="form-control">

    <label>Nama Instansi</label>
    <input type="text" name="nama_instansi" class="form-control"
           value="<?= $instansi['nama_instansi'] ?>" required>

    <label>Visi Instansi</label>
    <textarea name="visi" class="form-control" rows="3" required>
        <?= $instansi['visi'] ?>
    </textarea>

    <label>Misi Instansi</label>
    <textarea name="misi" class="form-control" rows="3" required>
        <?= $instansi['misi'] ?>
    </textarea>

    <label>Program Kerja Instansi</label>
    <textarea name="program_kerja" class="form-control" rows="4">
        <?= $instansi['program_kerja'] ?>
    </textarea>

    <br>
    <button type="submit" name="simpan" class="btn btn-success">Simpan Perubahan</button>
</form>
