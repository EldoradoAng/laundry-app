<?php
include "template/header.php";
include "config/database.php";

// Total Pendapatan (hanya yang dibayar)
$sqlTotal = <<<SQL
  SELECT SUM(dt.qty * p.harga) AS total_bayar
  FROM tb_detail_transaksi dt
  JOIN tb_paket p       ON dt.id_paket = p.id
  JOIN tb_transaksi t   ON dt.id_transaksi = t.id
  WHERE t.dibayar = 'dibayar'
SQL;
$qTotal = mysqli_query($conn, $sqlTotal);
$total_bayar = ($row = mysqli_fetch_assoc($qTotal)) ? (int)$row['total_bayar'] : 0;

// Total Transaksi
$qTrans = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM tb_transaksi");
$jml_transaksi = (int)mysqli_fetch_assoc($qTrans)['jml'];

// Total Member
$qMember = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM tb_member");
$jml_member = (int)mysqli_fetch_assoc($qMember)['jml'];

// Total Outlet
$qOutlet = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM tb_outlet");
$jml_outlet = (int)mysqli_fetch_assoc($qOutlet)['jml'];
?>
<div class="container-fluid mt-5 pt-3">
  <h3 class="fw-bold mb-4">Dashboard</h3>
  <div class="row g-4">
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Total Pendapatan</h6>
        <h4 class="fw-bold text-success">Rp <?= number_format($total_bayar,0,',','.'); ?></h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Total Transaksi</h6>
        <h4 class="fw-bold"><?= $jml_transaksi; ?></h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Total Member</h6>
        <h4 class="fw-bold"><?= $jml_member; ?></h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Total Outlet</h6>
        <h4 class="fw-bold"><?= $jml_outlet; ?></h4>
      </div>
    </div>
  </div>
</div>
<?php include "template/footer.php"; ?>
