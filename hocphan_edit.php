<?php
session_start();
require 'connect.php';

$MaHP = $_GET['MaHP'] ?? '';
if (!$MaHP) {
    die("Thiếu thông tin Mã HP để sửa.");
}

// Nếu form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $TenHP    = $_POST['TenHP'];
    $SoTinChi = $_POST['SoTinChi'];
    // $SoLuong  = $_POST['SoLuong'] ?? 0; // nếu có cột SoLuong

    $sql = "UPDATE HocPhan
            SET TenHP='$TenHP', SoTinChi='$SoTinChi'
            WHERE MaHP='$MaHP'";
    // Nếu có SoLuong:
    // $sql = "UPDATE HocPhan
    //         SET TenHP='$TenHP', SoTinChi='$SoTinChi', SoLuong='$SoLuong'
    //         WHERE MaHP='$MaHP'";

    if ($conn->query($sql) === TRUE) {
        header("Location: hocphan_index.php?success=1");
        exit();
    } else {
        $error = "Lỗi khi sửa học phần: " . $conn->error;
    }
} else {
    // Lấy thông tin cũ để hiển thị
    $sql = "SELECT * FROM HocPhan WHERE MaHP='$MaHP'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $hocphan = $result->fetch_assoc();
    } else {
        die("Không tìm thấy học phần với MaHP = $MaHP");
    }
}
?>

<?php include 'header.php'; ?>
<h1 class="mb-4">Sửa Học Phần</h1>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php if (!isset($hocphan)): ?>
  <div class="alert alert-danger">Không tìm thấy dữ liệu học phần.</div>
  <a href="hocphan_index.php" class="btn btn-secondary">Quay lại</a>
<?php else: ?>
  <form method="POST" class="row g-3" style="max-width: 600px;">
    <div class="col-md-6">
      <label class="form-label">Mã HP (không sửa):</label>
      <input type="text" class="form-control" value="<?= htmlspecialchars($hocphan['MaHP']) ?>" disabled>
    </div>
    <div class="col-md-6">
      <label class="form-label">Tên Học Phần:</label>
      <input type="text" name="TenHP" class="form-control"
             value="<?= htmlspecialchars($hocphan['TenHP']) ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Số Tín Chỉ:</label>
      <input type="number" name="SoTinChi" class="form-control"
             value="<?= htmlspecialchars($hocphan['SoTinChi']) ?>" required>
    </div>
    <!-- Nếu có SoLuong -->
    <!--
    <div class="col-md-6">
      <label class="form-label">Số Lượng:</label>
      <input type="number" name="SoLuong" class="form-control"
             value="<?= htmlspecialchars($hocphan['SoLuong']) ?>" required>
    </div>
    -->
    <div class="col-12">
      <button type="submit" class="btn btn-warning">Cập nhật</button>
      <a href="hocphan_index.php" class="btn btn-secondary">Quay lại</a>
    </div>
  </form>
<?php endif; ?>

<?php include 'footer.php'; ?>
