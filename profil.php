<?php  
// panggil koneksi
include 'koneksi.php';

// Ambil data instansi
$q = mysqli_query($conn, "SELECT * FROM instansi WHERE id = 1");
$data = mysqli_fetch_assoc($q);
?>

<h2>Profil Instansi</h2>
<hr>

<!-- TAMPILAN PROFIL -->
<div style="display:flex; gap:30px;">
    
    <!-- LOGO -->
    <div>
        <?php if($data['logo'] != "") { ?>
            <img src="uploads/<?php echo $data['logo']; ?>" width="150">
        <?php } else { ?>
            <p><i>Belum ada logo</i></p>
        <?php } ?>
    </div>

    <!-- DATA INSTANSI -->
    <div>
        <h3><?php echo $data['nama_instansi']; ?></h3>
        
        <p><b>Visi: </b><br><?php echo nl2br($data['visi']); ?></p>
        <p><b>Misi: </b><br><?php echo nl2br($data['misi']); ?></p>
        <p><b>Program Kerja: </b><br><?php echo nl2br($data['program_kerja']); ?></p>
    </div>

</div>

<hr>

<!-- FORM UBAH PROFIL -->
<h3>Ubah Profil Instansi</h3>

<form method="post" enctype="multipart/form-data">

    <label>Nama Instansi</label><br>
    <input type="text" name="nama_instansi" value="<?php echo $data['nama_instansi']; ?>" style="width:400px;"><br><br>

    <label>Visi</label><br>
    <textarea name="visi" rows="3" style="width:400px;"><?php echo $data['visi']; ?></textarea><br><br>

    <label>Misi</label><br>
    <textarea name="misi" rows="3" style="width:400px;"><?php echo $data['misi']; ?></textarea><br><br>

    <label>Program Kerja</label><br>
    <textarea name="program_kerja" rows="4" style="width:400px;"><?php echo $data['program_kerja']; ?></textarea><br><br>

    <label>Logo Instansi</label><br>
    <input type="file" name="logo"><br><br>

    <button type="submit" name="simpan">Simpan Perubahan</button>

</form>


<?php
// PROSES UPDATE
if(isset($_POST['simpan'])){

    $nama = $_POST['nama_instansi'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $program = $_POST['program_kerja'];

    // upload logo jika ada
    if($_FILES['logo']['name'] != ""){
        $logo = $_FILES['logo']['name'];
        $tmp = $_FILES['logo']['tmp_name'];
        move_uploaded_file($tmp, "uploads/".$logo);
        $logo_query = ", logo='$logo'";
    } else {
        $logo_query = "";
    }

    mysqli_query($conn, "UPDATE instansi SET 
        nama_instansi='$nama',
        visi='$visi',
        misi='$misi',
        program_kerja='$program'
        $logo_query
        WHERE id=1
    ");

    echo "<script>alert('Profil berhasil diperbarui'); window.location='dashboard.php?page=profil';</script>";
}
?>
