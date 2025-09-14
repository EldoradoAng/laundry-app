<?php
include "../../config/database.php";

$id = $_GET['id'];

// hapus detail dulu (pakai id_transaksi)
mysqli_query($conn, "DELETE FROM tb_detail_transaksi WHERE id_transaksi='$id'");

// hapus transaksi (pakai id)
mysqli_query($conn, "DELETE FROM tb_transaksi WHERE id='$id'");

header("Location: index.php");
exit;
?>
