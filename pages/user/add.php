<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$outlets = mysqli_query($conn, "SELECT * FROM tb_outlet");

if(isset($_POST['simpan'])){
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];
  $id_outlet = $_POST['id_outlet'];

  mysqli_query($conn, "INSERT INTO tb_user (nama,username,password,role,id_outlet) 
                       VALUES ('$nama','$username','$password','$role','$id_outlet')");
  header("Location: index.php");
}
?>

<div class="container-fluid mt-5 pt-3">
  <h3 class="fw-bold mb-3">Tambah User</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Role</label>
      <select name="role" class="form-control" required>
        <option value="admin">Admin</option>
        <option value="kasir">Kasir</option>
        <option value="owner">Owner</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Outlet</label>
      <select name="id_outlet" class="form-control">
        <option value="">-- Pilih Outlet --</option>
        <?php while($o=mysqli_fetch_assoc($outlets)) { ?>
          <option value="<?= $o['id_outlet']; ?>"><?= $o['nama_outlet']; ?></option>
        <?php } ?>
      </select>
    </div>
    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
