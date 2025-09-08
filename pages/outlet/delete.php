<?php
include "../../config/database.php";
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM tb_outlet WHERE id='$id'");
header("Location: index.php");
