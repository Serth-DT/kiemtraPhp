<?php
session_start();
require 'connect.php';

$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);
?>

<?php include 'header.php'; ?>

<h1 class="mb-4">Danh sách Học Phần</h1>

<div class="mb-3">
  <a href="hocphan_create.php" class="btn btn-primary">Thêm Học Phần</a>
</div>

<table class="table table-bordered table-hover">
  <thead class="table-dark">
    <tr>
      <th>Mã HP</th>
      <th>Tên Học Phần</th>
      <th>Số Tín Chỉ</th>
      <!-- Nếu có SoLuong, thêm cột -->
      <!-- <th>Số Lượng</th> -->
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['MaHP']) ?></td>
        <td><?= htmlspecialchars($row['TenHP']) ?></td>
        <td><?= htmlspecialchars($row['SoTinChi']) ?></td>
        <!-- <td><?= htmlspecialchars($row['SoLuong'] ?? '') ?></td> -->
        <td>
          <a href="hocphan_detail.php?MaHP=<?= urlencode($row['MaHP']) ?>" class="btn btn-sm btn-info">Chi tiết</a>
          <a href="hocphan_edit.php?MaHP=<?= urlencode($row['MaHP']) ?>" class="btn btn-sm btn-warning">Sửa</a>
          <a href="hocphan_delete.php?MaHP=<?= urlencode($row['MaHP']) ?>"
             onclick="return confirm('Bạn có chắc muốn xóa học phần này?');"
             class="btn btn-sm btn-danger">Xóa</a>
        </td>
      </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="4" class="text-center">Chưa có học phần nào.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

<?php include 'footer.php'; ?>
