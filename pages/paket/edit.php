<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_paket WHERE id_paket='$id'"));

if(isset($_POST['update'])){
  $jenis = $_POST['jenis'];
  $nama = $_POST['nama_paket'];
  $harga = $_POST['harga'];

  mysqli_query($conn, "UPDATE tb_paket SET jenis='$jenis', nama_paket='$nama', harga='$harga' WHERE id_paket='$id'");
  header("Location: index.php");
}
?>

<div class="container-fluid">
  <h3 class="fw-bold mb-3">Edit Paket</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Jenis</label>
      <input type="text" name="jenis" value="<?= $data['jenis']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Paket</label>
      <input type="text" name="nama_paket" value="<?= $data['nama_paket']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="harga" value="<?= $data['harga']; ?>" class="form-control" required>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
