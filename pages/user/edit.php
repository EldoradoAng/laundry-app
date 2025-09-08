<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$id = $_GET['id'];

// ambil user berdasarkan id
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$id'");
$data  = mysqli_fetch_assoc($query);

// kalau data user tidak ditemukan
if (!$data) {
    echo "<div class='alert alert-danger'>User dengan ID $id tidak ditemukan.</div>";
    include "../../template/footer.php";
    exit;
}

if (isset($_POST['update'])) {
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id_outlet= $_POST['id_outlet'];
    $role     = $_POST['role'];

    mysqli_query($conn, "UPDATE tb_user SET 
        nama='$nama', 
        username='$username', 
        password='$password', 
        id_outlet='$id_outlet', 
        role='$role'
        WHERE id='$id'");

    header("Location: index.php");
}
?>

<div class="container-fluid">
  <h3 class="fw-bold mb-3">Edit User</h3>
  <form method="POST">
    <div class="mb-3">
      <label>Nama</label>
      <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Username</label>
      <input type="text" name="username" value="<?= $data['username']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="text" name="password" value="<?= $data['password']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Outlet</label>
      <select name="id_outlet" class="form-control" required>
        <?php 
        $outlets = mysqli_query($conn, "SELECT * FROM tb_outlet");
        while ($o = mysqli_fetch_assoc($outlets)) { ?>
          <option value="<?= $o['id']; ?>" <?= ($data['id_outlet'] == $o['id']) ? 'selected' : ''; ?>>
            <?= $o['nama_outlet']; ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-control" required>
        <option value="admin" <?= ($data['role']=="admin")?"selected":""; ?>>Admin</option>
        <option value="kasir" <?= ($data['role']=="kasir")?"selected":""; ?>>Kasir</option>
        <option value="owner" <?= ($data['role']=="owner")?"selected":""; ?>>Owner</option>
      </select>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
