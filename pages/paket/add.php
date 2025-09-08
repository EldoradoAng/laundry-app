<?php 
include "../../template/header.php"; 
include "../../config/database.php";

if(isset($_POST['simpan'])){
  $jenis = $_POST['jenis'];
  $nama = $_POST['nama_paket'];
  $harga = $_POST['harga'];

  mysqli_query($conn, "INSERT INTO tb_paket (jenis,nama_paket,harga) VALUES ('$jenis','$nama','$harga')");
  header("Location: index.php");
}
?>

<div class="container-fluid">
  <h3 class="fw-bold mb-3">Tambah Paket</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Jenis</label>
      <input type="text" name="jenis" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Paket</label>
      <input type="text" name="nama_paket" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="harga" class="form-control" required>
    </div>
    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
