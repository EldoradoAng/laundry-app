<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_outlet WHERE id='$id'"));

if(isset($_POST['update'])){
  $nama_outlet = $_POST['nama_outlet'];
  $alamat      = $_POST['alamat'];
  $tlp         = $_POST['tlp'];

  mysqli_query($conn, "UPDATE tb_outlet SET 
      nama_outlet='$nama_outlet', 
      alamat='$alamat', 
      tlp='$tlp' 
      WHERE id='$id'");

  header("Location: index.php");
}
?>

<div class="container-fluid mt-5 pt-3">
  <h3 class="fw-bold mb-3">Edit Cabang</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nama Cabang</label>
      <input type="text" name="nama_outlet" value="<?= $data['nama_outlet']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Telepon</label>
      <input type="text" name="tlp" value="<?= $data['tlp']; ?>" class="form-control" required>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
