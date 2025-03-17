<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Sinh viên & Học phần</title>
  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <!-- Navigation Bar cập nhật -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">QL Sinh viên & Học phần</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" 
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Menu bên trái -->
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Sinh viên</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register_hocphan.php">Đăng ký Học phần</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Thông tin đăng ký</a>
          </li>
        </ul>
        <!-- Menu bên phải: Đăng nhập/Đăng xuất -->
        <ul class="navbar-nav">
          <?php
          session_start();
          if (isset($_SESSION['MaSV'])) {
              echo '<li class="nav-item"><a class="nav-link" href="logout.php">Đăng xuất</a></li>';
          } else {
              echo '<li class="nav-item"><a class="nav-link" href="login.php">Đăng nhập</a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container my-4">
