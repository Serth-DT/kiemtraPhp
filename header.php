<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Sinh viên & Học phần</title>
  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    .navbar-brand { font-weight: bold; }
    .nav-link { font-size: 1.1rem; }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <!-- Brand -->
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <i class="bi bi-mortarboard-fill me-2"></i>
        Quản lý Sinh viên & Học phần
      </a>
      <!-- Nút thu gọn menu trên mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Menu chính -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Menu bên trái -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="bi bi-people-fill me-1"></i> Sinh viên
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hocphan_index.php">
              <i class="bi bi-book me-1"></i> Học phần
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register_hocphan.php">
              <i class="bi bi-pencil-square me-1"></i> Đăng ký Học phần
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">
              <i class="bi bi-card-checklist me-1"></i> Thông tin đăng ký
            </a>
          </li>
        </ul>
        <!-- Menu bên phải: Đăng nhập/Đăng xuất -->
        <ul class="navbar-nav mb-2 mb-lg-0">
          <?php if (isset($_SESSION['MaSV'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                 data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($_SESSION['MaSV']) ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="profile.php">Thông tin cá nhân</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">
                  <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">
                <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="container my-4">
