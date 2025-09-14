<?php 
include "../../template/header.php"; 
include "../../config/database.php";

// Ambil data member & paket berdasarkan outlet login
$id_outlet = $_SESSION['id_outlet'];
$members = mysqli_query($conn, "SELECT * FROM tb_member");
$pakets  = mysqli_query($conn, "SELECT * FROM tb_paket WHERE id_outlet='$id_outlet'");

if(isset($_POST['simpan'])){
  $id_user   = $_SESSION['id_user'];
  $id_member = $_POST['id_member'];
  $tgl = $_POST['tgl'];
  $batas_waktu = $_POST['batas_waktu'];
  $status = $_POST['status'];
  $dibayar = $_POST['dibayar'];

  // insert transaksi
  mysqli_query($conn, "INSERT INTO tb_transaksi
    (id_outlet, kode_invoice, id_member, tgl, batas_waktu, status, dibayar, id_user, biaya_tambahan, diskon, pajak)
    VALUES
    ('$id_outlet','INV-".date("YmdHis")."','$id_member','$tgl','$batas_waktu','$status','$dibayar','$id_user',0,0,0)
  ");

  $id_transaksi = mysqli_insert_id($conn);

  // insert detail paket
  if(isset($_POST['paket'])){
    foreach($_POST['paket'] as $i=>$id_paket){
      if(!empty($id_paket)){
        $qty = (int)$_POST['qty'][$i];
        mysqli_query($conn, "INSERT INTO tb_detail_transaksi (id_transaksi, id_paket, qty) 
                             VALUES ('$id_transaksi','$id_paket','$qty')");
      }
    }
  }

  header("Location: index.php");
  exit;
}
?>

<div class="container-fluid mt-5 pt-3">
  <h3 class="fw-bold mb-3">Tambah Transaksi</h3>
  <form method="POST">
    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label>Member</label>
          <select name="id_member" class="form-control" required>
            <option value="">-- Pilih Member --</option>
            <?php while($m=mysqli_fetch_assoc($members)){ ?>
              <option value="<?= $m['id']; ?>"><?= $m['nama']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Tanggal</label>
          <input type="date" name="tgl" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Batas Waktu</label>
          <input type="date" name="batas_waktu" class="form-control" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-control">
            <option value="baru">Baru</option>
            <option value="proses">Proses</option>
            <option value="selesai">Selesai</option>
            <option value="diambil">Diambil</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Dibayar</label>
          <select name="dibayar" class="form-control">
            <option value="belum_dibayar">Belum Dibayar</option>
            <option value="dibayar">Dibayar</option>
          </select>
        </div>
      </div>
    </div>

    <hr>
    <h5>Detail Paket (Outlet: <?= $id_outlet; ?>)</h5>
    <div id="paket-container">
      <div class="row g-2 mb-2 paket-row">
        <div class="col-md-6">
          <select name="paket[]" class="form-control">
            <option value="">-- Pilih Paket --</option>
            <?php mysqli_data_seek($pakets,0); while($p=mysqli_fetch_assoc($pakets)){ ?>
              <option value="<?= $p['id']; ?>">
                <?= $p['nama_paket']; ?> (Rp <?= number_format($p['harga']); ?>)
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-4">
          <input type="number" name="qty[]" class="form-control" placeholder="Qty" required>
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-danger remove-row">X</button>
        </div>
      </div>
    </div>
    <button type="button" id="add-row" class="btn btn-secondary mb-3">+ Tambah Paket</button>

    <div>
      <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>

<script>
document.getElementById("add-row").addEventListener("click", function(){
  let container = document.getElementById("paket-container");
  let row = container.querySelector(".paket-row").cloneNode(true);
  row.querySelectorAll("input").forEach(i => i.value = "");
  row.querySelectorAll("select").forEach(s => s.selectedIndex = 0);
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
