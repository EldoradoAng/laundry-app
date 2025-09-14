<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE id='$id'"));
$members = mysqli_query($conn, "SELECT * FROM tb_member");
$pakets  = mysqli_query($conn, "SELECT * FROM tb_paket");
$details = mysqli_query($conn, "
  SELECT dt.*, p.nama_paket, p.harga
  FROM tb_detail_transaksi dt
  JOIN tb_paket p ON dt.id_paket = p.id
  WHERE dt.id_transaksi='$id'
");

if(isset($_POST['update'])){
  $id_member   = $_POST['id_member'];
  $tgl         = $_POST['tgl'];
  $batas_waktu = $_POST['batas_waktu'];
  $status      = $_POST['status'];
  $dibayar     = $_POST['dibayar'];

  // tambahan
  $biaya_tambahan = $_POST['biaya_tambahan'];
  $diskon         = $_POST['diskon'];
  $pajak          = $_POST['pajak'];

  mysqli_query($conn, "UPDATE tb_transaksi SET
    id_member='$id_member', tgl='$tgl', batas_waktu='$batas_waktu',
    status='$status', dibayar='$dibayar',
    biaya_tambahan='$biaya_tambahan', diskon='$diskon', pajak='$pajak'
    WHERE id='$id'
  ");

  // hapus detail lama
  mysqli_query($conn, "DELETE FROM tb_detail_transaksi WHERE id_transaksi='$id'");

  // simpan detail baru
  if(isset($_POST['paket'])){
    foreach($_POST['paket'] as $i=>$id_paket){
      $qty = $_POST['qty'][$i];
      mysqli_query($conn, "INSERT INTO tb_detail_transaksi (id_transaksi,id_paket,qty) VALUES ('$id','$id_paket','$qty')");
    }
  }

  header("Location: index.php");
}
?>

<div class="container-fluid mt-5 pt-3">
  <h3 class="fw-bold mb-3">Edit Transaksi</h3>
  <form method="POST">
    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label>Member</label>
          <select name="id_member" class="form-control" required>
            <?php while($m=mysqli_fetch_assoc($members)){ ?>
              <option value="<?= $m['id']; ?>" <?= ($m['id']==$data['id_member'])?'selected':''; ?>>
                <?= $m['nama']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Tanggal</label>
          <input type="date" name="tgl" value="<?= $data['tgl']; ?>" class="form-control">
        </div>
        <div class="mb-3">
          <label>Batas Waktu</label>
          <input type="date" name="batas_waktu" value="<?= $data['batas_waktu']; ?>" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-control">
            <option value="baru" <?= $data['status']=='baru'?'selected':''; ?>>Baru</option>
            <option value="proses" <?= $data['status']=='proses'?'selected':''; ?>>Proses</option>
            <option value="selesai" <?= $data['status']=='selesai'?'selected':''; ?>>Selesai</option>
            <option value="diambil" <?= $data['status']=='diambil'?'selected':''; ?>>Diambil</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Dibayar</label>
          <select name="dibayar" class="form-control">
            <option value="belum_dibayar" <?= $data['dibayar']=='belum_dibayar'?'selected':''; ?>>Belum Dibayar</option>
            <option value="dibayar" <?= $data['dibayar']=='dibayar'?'selected':''; ?>>Dibayar</option>
          </select>
        </div>

        <!-- tambahan -->
        <div class="mb-3">
          <label>Biaya Tambahan</label>
          <input type="number" name="biaya_tambahan" class="form-control" value="<?= $data['biaya_tambahan']; ?>">
        </div>
        <div class="mb-3">
          <label>Diskon (%)</label>
          <input type="number" name="diskon" class="form-control" value="<?= $data['diskon']; ?>">
        </div>
        <div class="mb-3">
          <label>Pajak (%)</label>
          <input type="number" name="pajak" class="form-control" value="<?= $data['pajak']; ?>">
        </div>
      </div>
    </div>

    <hr>
    <h5>Detail Paket</h5>
    <div id="paket-container">
      <?php while($d=mysqli_fetch_assoc($details)){ ?>
      <div class="row g-2 mb-2 paket-row">
        <div class="col-md-6">
          <select name="paket[]" class="form-control">
            <?php mysqli_data_seek($pakets,0); while($p=mysqli_fetch_assoc($pakets)){ ?>
              <option value="<?= $p['id']; ?>" <?= $p['id']==$d['id_paket']?'selected':''; ?>>
                <?= $p['nama_paket']; ?> (Rp <?= number_format($p['harga']); ?>)
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-4">
          <input type="number" name="qty[]" class="form-control" value="<?= $d['qty']; ?>" required>
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-danger remove-row">X</button>
        </div>
      </div>
      <?php } ?>
    </div>
    <button type="button" id="add-row" class="btn btn-secondary mb-3">+ Tambah Paket</button>

    <div>
      <button type="submit" name="update" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>

<script>
document.getElementById("add-row").addEventListener("click", function(){
  let container = document.getElementById("paket-container");
  let firstRow = container.querySelector(".paket-row");
  let row = firstRow.cloneNode(true);

  row.querySelectorAll("input").forEach(i=>i.value="");
  row.querySelectorAll("select").forEach(s=>s.selectedIndex=0);

  container.appendChild(row);

  row.querySelector(".remove-row").addEventListener("click", function(){
    row.remove();
  });
});

document.querySelectorAll(".remove-row").forEach(btn=>{
  btn.addEventListener("click", function(){ btn.closest(".paket-row").remove(); });
});
</script>

<?php include "../../template/footer.php"; ?>
