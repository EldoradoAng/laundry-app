<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user='$id'"));
$outlets = mysqli_query($conn, "SELECT * FROM tb_outlet");

if(isset($_POST['update'])){
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $role = $_POST['role'];
  $id_outlet = $_POST['id_outlet'];

  // kalau password diisi, update juga
  if(!empty($_POST['password'])){
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "UPDATE tb_user SET nama='$nama', username='$username', password='$password', role='$role', id_outlet='$id_outlet' WHERE id_user='$id'";
  } else {
    $query = "UPDATE tb_user SET nama='$nama', username='$username', role='$role', id_outlet='$id_outlet' WHERE id_user='$id'";
  }

  mysqli_query($conn, $query);
  header("Location: index.php");
}
?>

<div class="container-fluid mt-5 pt-3">
  <h3 class="fw-bold mb-3">Edit User</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" value="<?= $data['username']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password (kosongkan jika tidak diubah)</label>
      <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Role</label>
      <select name="role" class="form-control" required>
        <option value="admin" <?= ($data['role']=='admin')?'selected':''; ?>>Admin</option>
        <option value="kasir" <?= ($data['role']=='kasir')?'selected':''; ?>>Kasir</option>
        <option value="owner" <?= ($data['role']=='owner')?'selected':''; ?>>Owner</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Outlet</label>
      <select name="id_outlet" class="form-control">
        <option value="">-- Pilih Outlet --</option>
        <?php while($o=mysqli_fetch_assoc($outlets)) { ?>
          <option value="<?= $o['id_outlet']; ?>" <?= ($data['id_outlet']==$o['id_outlet'])?'selected':''; ?>>
            <?= $o['nama_outlet']; ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
