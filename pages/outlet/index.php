<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$q = mysqli_query($conn, "SELECT * FROM tb_outlet");
?>

<div class="container-fluid mt-5 pt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Data Outlet</h3>
    <a href="add.php" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Outlet
    </a>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama Outlet</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($row=mysqli_fetch_assoc($q)) { ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_outlet'] ?? $row['nama']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['tlp']; ?></td>
        <td>
          <a href="edit.php?id=<?= $row['nama_outlet']; ?>" 
             class="btn btn-sm btn-warning">
             <i class="bi bi-pencil"></i> Edit
          </a>
          <a href="delete.php?id=<?= $row['nama_outlet']; ?>" 
             class="btn btn-sm btn-danger"
             onclick="return confirm('Yakin hapus outlet ini?');">
             <i class="bi bi-trash"></i> Hapus
          </a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include "../../template/footer.php"; ?>
