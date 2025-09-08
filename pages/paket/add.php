<?php 
include "../../template/header.php"; 
include "../../config/database.php";

if (isset($_POST['save'])) {
    $id_outlet  = $_POST['id_outlet'];
    $jenis      = $_POST['jenis'];
    $nama_paket = $_POST['nama_paket'];
    $harga      = $_POST['harga'];

    mysqli_query($conn, "INSERT INTO tb_paket (id_outlet, jenis, nama_paket, harga)
        VALUES ('$id_outlet', '$jenis', '$nama_paket', '$harga')");

    header("Location: index.php");
}
?>

<div class="container-fluid">
  <h3 class="fw-bold mb-3">Tambah Paket</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Outlet</label>
      <select name="id_outlet" class="form-control" required>
        <option value="">-- Pilih Outlet --</option>
        <?php 
        $outlets = mysqli_query($conn, "SELECT * FROM tb_outlet");
        while ($o = mysqli_fetch_assoc($outlets)) { ?>
          <option value="<?= $o['id']; ?>"><?= $o['nama_outlet']; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis</label>
      <select name="jenis" class="form-control" required>
        <option value="">-- Pilih Jenis Barang --</option>
        <option value="kiloan">Kiloan</option>
        <option value="selimut">Selimut</option>
        <option value="bed_cover">Bed Cover</option>
        <option value="kaos">Kaos</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Paket</label>
      <input type="text" name="nama_paket" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="harga" class="form-control" required>
    </div>
    <button type="submit" name="save" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
