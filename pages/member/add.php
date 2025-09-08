<?php 
include "../../template/header.php"; 
include "../../config/database.php";

if(isset($_POST['simpan'])){
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $jk = $_POST['jenis_kelamin'];
  $tlp = $_POST['tlp'];

  mysqli_query($conn, "INSERT INTO tb_member (nama, alamat, jenis_kelamin, tlp) VALUES ('$nama','$alamat','$jk','$tlp')");
  header("Location: index.php");
}
?>

<div class="container-fluid">
  <h3 class="fw-bold mb-3">Tambah Member</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label>
      <select name="jenis_kelamin" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Telepon</label>
      <input type="text" name="tlp" class="form-control" required>
    </div>
    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
