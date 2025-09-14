<?php 
include "../../template/header.php"; 
include "../../config/database.php"; 

// Ringkasan
$q1 = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM tb_transaksi");
$total_transaksi = (int)mysqli_fetch_assoc($q1)['jml'];

$q2 = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM tb_member");
$total_member = (int)mysqli_fetch_assoc($q2)['jml'];

$total_pendapatan = 0;
$q3 = mysqli_query($conn, "SELECT id FROM tb_transaksi WHERE dibayar='dibayar'");
while($t = mysqli_fetch_assoc($q3)){
  $total_pendapatan += hitung_total_transaksi($conn, $t['id']);
}

$q4 = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM tb_transaksi WHERE dibayar='belum_dibayar'");
$total_belum = (int)mysqli_fetch_assoc($q4)['jml'];

// Detail
$sqlDetail = "
  SELECT t.id, t.tgl, t.batas_waktu, t.status, t.dibayar, 
         t.biaya_tambahan, t.diskon, t.pajak,
         m.nama AS nama_member
  FROM tb_transaksi t
  JOIN tb_member m ON t.id_member = m.id
  ORDER BY t.tgl DESC
";
$detail = mysqli_query($conn, $sqlDetail);
?>
<div class="container-fluid mt-5 pt-3">
  <h3 class="fw-bold mb-4">Laporan Laundry</h3>

  <!-- Ringkasan -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Total Transaksi</h6>
        <h4 class="fw-bold"><?= $total_transaksi; ?></h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Total Member</h6>
        <h4 class="fw-bold"><?= $total_member; ?></h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Total Pendapatan</h6>
        <h4 class="fw-bold text-success">Rp <?= number_format($total_pendapatan,0,',','.'); ?></h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Belum Dibayar</h6>
        <h4 class="fw-bold text-danger"><?= $total_belum; ?></h4>
      </div>
    </div>
  </div>

  <!-- Detail -->
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">Detail Transaksi</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Member</th>
            <th>Tanggal</th>
            <th>Batas Waktu</th>
            <th>Subtotal Paket</th>
            <th>Biaya Tambahan</th>
            <th>Diskon</th>
            <th>Pajak</th>
            <th>Total Akhir</th>
            <th>Status</th>
            <th>Dibayar</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; while($row=mysqli_fetch_assoc($detail)) { ?>
          <?php 
            $subtotal    = hitung_subtotal_paket($conn, $row['id']); 
            $total_akhir = hitung_total_transaksi($conn, $row['id']); 
          ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_member']; ?></td>
            <td><?= $row['tgl']; ?></td>
            <td><?= $row['batas_waktu']; ?></td>
            <td>Rp <?= number_format($subtotal,0,',','.'); ?></td>
            <td>Rp <?= number_format($row['biaya_tambahan'],0,',','.'); ?></td>
            <td><?= $row['diskon']; ?>%</td>
            <td><?= $row['pajak']; ?>%</td>
            <td><b>Rp <?= number_format($total_akhir,0,',','.'); ?></b></td>
            <td><span class="badge bg-info"><?= ucfirst($row['status']); ?></span></td>
            <td>
              <span class="badge <?= $row['dibayar']=='dibayar'?'bg-success':'bg-danger'; ?>">
                <?= ucfirst($row['dibayar']); ?>
              </span>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include "../../template/footer.php"; ?>
