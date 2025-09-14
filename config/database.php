<?php
// === Koneksi Database ===
$host = "localhost";
$user = "root";
$pass = "";
$db   = "laundry";

$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_error();
    exit;
}

// === Helper: Hitung Subtotal Paket ===
// (total harga paket tanpa tambahan/diskon/pajak)
function hitung_subtotal_paket($conn, $id_transaksi) {
  $q = mysqli_query($conn, "SELECT d.qty, p.harga 
    FROM tb_detail_transaksi d 
    JOIN tb_paket p ON d.id_paket=p.id 
    WHERE d.id_transaksi='$id_transaksi'");
  $subtotal = 0;
  while($d = mysqli_fetch_assoc($q)){
    $subtotal += $d['qty'] * $d['harga']; // harga paket x qty
  }
  return $subtotal;
}

// === Helper: Hitung Total Akhir ===
// (subtotal + tambahan - diskon + pajak)
function hitung_total_transaksi($conn, $id_transaksi) {
  $subtotal = hitung_subtotal_paket($conn, $id_transaksi);

  $t = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT biaya_tambahan, diskon, pajak 
    FROM tb_transaksi WHERE id='$id_transaksi'
  "));

  $biaya_tambahan = (int)$t['biaya_tambahan'];
  $diskon         = (float)$t['diskon'];
  $pajak          = (float)$t['pajak'];

  $total_setelah_tambahan = $subtotal + $biaya_tambahan;
  $total_setelah_diskon   = $total_setelah_tambahan - ($total_setelah_tambahan * ($diskon/100));
  $total_akhir            = $total_setelah_diskon + ($total_setelah_diskon * ($pajak/100));

  return $total_akhir;
}
?>
