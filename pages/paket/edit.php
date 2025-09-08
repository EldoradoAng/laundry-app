<?php 
include "../../template/header.php"; 
include "../../config/database.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_paket WHERE id='$id'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<div class='alert alert-danger'>Paket dengan ID $id tidak ditemukan.</div>";
    include "../../template/footer.php";
    exit;
}

if (isset($_POST['update'])) {
    $id_outlet  = $_POST['id_outlet'];
    $jenis      = $_POST['jenis'];
    $nama_paket = $_POST['nama_paket'];
    $harga      = $_POST['harga'];

    mysqli_query($conn, "UPDATE tb_paket SET 
        id_outlet='$id_outlet', 
        jenis='$jenis', 
        nama_paket='$nama_paket', 
        harga='$harga'
        WHERE id='$id'");

    header("Location: index.php");
}
?>

<div class="container-fluid">
  <h3 class="fw-bold mb-3">Edit Paket</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Outlet</label>
      <select name="id_outlet" class="form-control" required>
        <?php 
        $outlets = mysqli_query($conn, "SELECT * FROM tb_outlet");
        while ($o = mysqli_fetch_assoc($outlets)) { ?>
          <option value="<?= $o['id']; ?>" <?= ($data['id_outlet'] == $o['id']) ? 'selected' : ''; ?>>
            <?= $o['nama_outlet']; ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis</label>
      <select name="jenis" class="form-control" required>
        <option value="kiloan"   <?= ($data['jenis']=="kiloan")?"selected":""; ?>>Kiloan</option>
        <option value="selimut"  <?= ($data['jenis']=="selimut")?"selected":""; ?>>Selimut</option>
        <option value="bed_cover"<?= ($data['jenis']=="bed_cover")?"selected":""; ?>>Bed Cover</option>
        <option value="kaos"     <?= ($data['jenis']=="kaos")?"selected":""; ?>>Kaos</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Paket</label>
      <input type="text" name="nama_paket" value="<?= $data['nama_paket']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="harga" value="<?= $data['harga']; ?>" class="form-control" required>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include "../../template/footer.php"; ?>
