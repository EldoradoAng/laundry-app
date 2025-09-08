<?php 
include "../../config/database.php";
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tb_user WHERE id_user='$id'");
header("Location: index.php");
