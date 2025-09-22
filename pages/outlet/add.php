<?php 
include "../../template/header.php"; 
include "../../config/database.php";

if(isset($_POST['simpan'])){
  $nama = $_POST['nama_outlet'];
  $alamat = $_POST['alamat'];
  $tlp = $_POST['tlp'];

  mysqli_query($conn, "INSERT INTO tb_outlet (nama_outlet,alamat,tlp) VALUES ('$nama','$alamat','$tlp')");
  header("Location: index.php");
}
?>

<div class="container-fluid mt-5 pt-3">
  <h3 class="fw-bold mb-3">Tambah Cabang</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nama Cabang</label>
      <input type="text" name="nama_outlet" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Telepon</label>
      <input type="text" name="tlp" class="form-control">
    </div>
    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
