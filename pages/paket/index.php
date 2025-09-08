<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$q = mysqli_query($conn, "SELECT * FROM tb_paket");
?>

<div class="container-fluid mt-5 pt-3"> 
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Data Paket</h3>
    <a href="add.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Member</a>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Jenis</th>
        <th>Nama Paket</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($row=mysqli_fetch_assoc($q)) { ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['jenis']; ?></td>
        <td><?= $row['nama_paket']; ?></td>
        <td>Rp <?= number_format($row['harga'],0,',','.'); ?></td>
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
