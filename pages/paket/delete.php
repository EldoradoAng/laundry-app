<?php
include "../../config/database.php";
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM tb_paket WHERE id_paket='$id'");
header("Location: index.php");
