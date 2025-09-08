<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$sql = "
  SELECT t.*, m.nama AS nama_member
  FROM tb_transaksi t
  JOIN tb_member m ON t.id_member = m.id
  ORDER BY t.tgl DESC
";
$q = mysqli_query($conn, $sql);
?>
<div class="container-fluid mt-5 pt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Data Transaksi</h3>
    <a href="add.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Transaksi</a>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Member</th>
        <th>Tanggal</th>
        <th>Batas Waktu</th>
        <th>Status</th>
        <th>Dibayar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($row=mysqli_fetch_assoc($q)) { ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_member']; ?></td>
        <td><?= $row['tgl']; ?></td>
        <td><?= $row['batas_waktu']; ?></td>
        <td><span class="badge bg-info"><?= ucfirst($row['status']); ?></span></td>
        <td>
          <span class="badge <?= $row['dibayar']=='dibayar'?'bg-success':'bg-danger'; ?>">
            <?= ucfirst($row['dibayar']); ?>
          </span>
        </td>
        <td>
          <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
          <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus transaksi ini?');"><i class="bi bi-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php include "../../template/footer.php"; ?>
