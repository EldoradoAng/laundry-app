<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$q = mysqli_query($conn, "SELECT * FROM tb_member");
?>

<div class="container-fluid mt-5 pt-3"> 
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Data Member</h3>
    <a href="add.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Member</a>
  </div>


  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>Telepon</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($row=mysqli_fetch_assoc($q)) { ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['jenis_kelamin']; ?></td>
        <td><?= $row['tlp']; ?></td>
        <td>
          <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
          <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?');"><i class="bi bi-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include "../../template/footer.php"; ?>
