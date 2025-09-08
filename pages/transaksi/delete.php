<?php
include "../../config/database.php";
$id = $_GET['id'];

// hapus detail dulu
mysqli_query($conn, "DELETE FROM tb_detail_transaksi WHERE id_transaksi='$id'");

// hapus transaksi
mysqli_query($conn, "DELETE FROM tb_transaksi WHERE id_transaksi='$id'");

header("Location: index.php");
