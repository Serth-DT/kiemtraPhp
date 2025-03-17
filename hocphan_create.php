<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $MaHP     = $_POST['MaHP'];
    $TenHP    = $_POST['TenHP'];
    $SoTinChi = $_POST['SoTinChi'];
    // $SoLuong  = $_POST['SoLuong'] ?? 0; // nếu có cột SoLuong

    // Tạo câu lệnh INSERT
    $sql = "INSERT INTO HocPhan (MaHP, TenHP, SoTinChi)
            VALUES ('$MaHP', '$TenHP', '$SoTinChi')";
    // Nếu có SoLuong: 
    // $sql = "INSERT INTO HocPhan (MaHP, TenHP, SoTinChi, SoLuong) 
    //         VALUES ('$MaHP', '$TenHP', '$SoTinChi', '$SoLuong')";

    if ($conn->query($sql) === TRUE) {
        header("Location: hocphan_index.php?success=1");
        exit();
    } else {
        $error = "Lỗi khi thêm học phần: " . $conn->error;
    }
}
?>

<?php include 'header.php'; ?>
<h1 class="mb-4">Thêm Học Phần</h1>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" class="row g-3" style="max-width: 600px;">
  <div class="col-md-6">
    <label class="form-label">Mã HP (duy nhất):</label>
    <input type="text" name="MaHP" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Tên Học Phần:</label>
    <input type="text" name="TenHP" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Số Tín Chỉ:</label>
    <input type="number" name="SoTinChi" class="form-control" required>
  </div>
  <!-- Nếu có SoLuong -->
  <!--
  <div class="col-md-6">
    <label class="form-label">Số Lượng:</label>
    <input type="number" name="SoLuong" class="form-control" required>
  </div>
  -->
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="hocphan_index.php" class="btn btn-secondary">Quay lại</a>
  </div>
</form>

<?php include 'footer.php'; ?>
