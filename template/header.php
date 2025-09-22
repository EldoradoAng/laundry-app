<?php
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['id_user']) && basename($_SERVER['PHP_SELF']) != "index.php") {
    header("Location:/laundry-app/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laundry Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/laundry-app/public/css/style.css">
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
  <h4 class="text-center text-white mb-4">Laundry App</h4>
  <a href="/laundry-app/dashboard.php"><i class="bi bi-house"></i> Dashboard</a>
  <a href="/laundry-app/pages/user/index.php"><i class="bi bi-people"></i> User</a>
  <a href="/laundry-app/pages/outlet/index.php"><i class="bi bi-building"></i> Cabang</a>
  <a href="/laundry-app/pages/member/index.php"><i class="bi bi-people"></i> Member</a>
  <a href="/laundry-app/pages/paket/index.php"><i class="bi bi-box"></i> Paket</a>
  <a href="/laundry-app/pages/transaksi/index.php"><i class="bi bi-receipt"></i> Transaksi</a>
  <a href="/laundry-app/pages/laporan/index.php"><i class="bi bi-bar-chart"></i> Laporan</a>
  <a href="/laundry-app/auth/logout.php" class="text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Dashboard</span>
    <span class="text-white"><i class=" "></i> <?= $_SESSION['nama'] ?? ''; ?> (<?= $_SESSION['role'] ?? ''; ?>)</span>
  </div>
</nav>

<!-- Main content -->
<div class="main-content">
