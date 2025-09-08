<?php
include "../../template/header.php";
include "../../config/database.php";

$sql = <<<SQL
  SELECT u.*, o.nama_outlet AS outlet_nama
  FROM tb_user u
  LEFT JOIN tb_outlet o ON u.id_outlet = o.id
SQL;
$q = mysqli_query($conn, $sql);
?>
<div class="container-fluid mt-5 pt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Data User</h3>
    <a href="add.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah User</a>
  </div>
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>No</th><th>Nama</th><th>Username</th><th>Role</th><th>Outlet</th><th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($row=mysqli_fetch_assoc($q)) { ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['username']; ?></td>
        <td><span class="badge bg-info"><?= ucfirst($row['role']); ?></span></td>
        <td><?= $row['outlet_nama'] ?? '-'; ?></td>
        <td>
          <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
          <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?');"><i class="bi bi-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php include "../../template/footer.php"; ?>
