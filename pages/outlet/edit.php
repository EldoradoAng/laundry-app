<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_outlet WHERE id_member='$id'"));

if(isset($_POST['update'])){
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $jk = $_POST['jenis_kelamin'];
  $tlp = $_POST['tlp'];

  mysqli_query($conn, "UPDATE tb_outlet SET nama='$nama', alamat='$alamat', jenis_kelamin='$jk', tlp='$tlp' WHERE id_member='$id'");
  header("Location: index.php");
}
?>

<div class="container-fluid">
  <h3 class="fw-bold mb-3">Edit Member</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label>
      <select name="jenis_kelamin" class="form-control" required>
        <option value="L" <?= ($data['jenis_kelamin']=="L")?"selected":""; ?>>Laki-laki</option>
        <option value="P" <?= ($data['jenis_kelamin']=="P")?"selected":""; ?>>Perempuan</option>
      </select>
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
