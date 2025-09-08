<?php
include "../../config/database.php";
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM tb_member WHERE id_member='$id'");
header("Location: index.php");
