<?php
session_start();
include "../config/database.php";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
    $row = mysqli_fetch_assoc($sql);

    if ($row) {
        $_SESSION['id_user']   = $row['id'];
        $_SESSION['nama']      = $row['nama'];
        $_SESSION['role']      = $row['role'];
        $_SESSION['id_outlet'] = $row['id_outlet'];

        header("Location: ../dashboard.php");
    } else {
        echo "<script>alert('Username / Password salah!');window.location='../index.php';</script>";
    }
}
?>
