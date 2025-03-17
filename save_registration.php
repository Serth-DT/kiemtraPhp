<?php
session_start();
require 'connect.php';

// Lấy MaSV (từ session hoặc GET)
$MaSV = $_SESSION['MaSV'] ?? '';
if (!$MaSV) {
    die("Chưa có thông tin sinh viên. Vui lòng đăng nhập.");
}

// JOIN các bảng: DangKy (dk), ChiTietDangKy (ct), HocPhan (hp), SinhVien (sv)
$sql = "
SELECT 
    sv.MaSV,
    sv.HoTen,
    sv.NgaySinh,
    sv.MaNganh,
    dk.MaDK,
    dk.NgayDK,
    hp.MaHP,
    hp.TenHP,
    hp.SoTinChi
FROM SinhVien sv
JOIN DangKy dk ON sv.MaSV = dk.MaSV
JOIN ChiTietDangKy ct ON dk.MaDK = ct.MaDK
JOIN HocPhan hp ON ct.MaHP = hp.MaHP
WHERE sv.MaSV = '$MaSV'
ORDER BY dk.MaDK
";

$result = $conn->query($sql);
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

// Nếu không tìm thấy bất kỳ dòng nào, nghĩa là sinh viên chưa đăng ký
if ($result->num_rows === 0) {
    // Kiểm tra SV tồn tại
    $sqlCheckSV = "SELECT * FROM SinhVien WHERE MaSV='$MaSV'";
    $rCheck = $conn->query($sqlCheckSV);
    if ($rCheck && $rCheck->num_rows > 0) {
        // Tồn tại SV, nhưng chưa đăng ký
        $svInfo = $rCheck->fetch_assoc();
        $student = [
            'MaSV'     => $svInfo['MaSV'],
            'HoTen'    => $svInfo['HoTen'],
            'NgaySinh' => $svInfo['NgaySinh'],
            'MaNganh'  => $svInfo['MaNganh']
        ];
        $courses = [];
    } else {
        // Không tồn tại SV
        die("Không tìm thấy thông tin sinh viên với MaSV = " . htmlspecialchars($MaSV));
    }
} else {
    // Có kết quả => đọc các dòng
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    // Lấy thông tin sinh viên từ dòng đầu
    $first = $rows[0];
    $student = [
        'MaSV'     => $first['MaSV'],
        'HoTen'    => $first['HoTen'],
        'NgaySinh' => $first['NgaySinh'],
        'MaNganh'  => $first['MaNganh']
    ];
    // courses là mảng chứa tất cả {MaDK, NgayDK, MaHP, TenHP, SoTinChi}
    $courses = [];
    foreach ($rows as $r) {
        $courses[] = [
            'MaDK'      => $r['MaDK'],
            'NgayDK'    => $r['NgayDK'],
            'MaHP'      => $r['MaHP'],
            'TenHP'     => $r['TenHP'],
            'SoTinChi'  => $r['SoTinChi']
        ];
    }
}
?>

<?php include 'header.php'; ?>
<div class="container">
    <h2 class="mb-4">Tất cả học phần đã đăng ký</h2>

    <!-- Thông tin sinh viên -->
    <div class="card p-3 mb-4" style="max-width: 600px;">
        <h5>Thông tin sinh viên</h5>
        <p><strong>Mã SV:</strong> <?= htmlspecialchars($student['MaSV'] ?? '') ?></p>
        <p><strong>Họ tên:</strong> <?= htmlspecialchars($student['HoTen'] ?? '') ?></p>
        <p><strong>Ngày sinh:</strong> <?= htmlspecialchars($student['NgaySinh'] ?? '') ?></p>
        <p><strong>Ngành học:</strong> <?= htmlspecialchars($student['MaNganh'] ?? '') ?></p>
    </div>

    <!-- Danh sách tất cả học phần đã đăng ký -->
    <?php if (empty($courses)): ?>
        <div class="alert alert-info">Sinh viên chưa đăng ký học phần nào.</div>
    <?php else: ?>
        <?php 
        // Tính tổng tín chỉ
        $totalCredits = 0;
        foreach ($courses as $c) {
            $totalCredits += $c['SoTinChi'];
        }
        ?>
        <table class="table table-bordered table-hover" style="max-width: 800px;">
            <thead class="table-dark">
                <tr>
                    <th>Mã ĐK</th>
                    <th>Ngày ĐK</th>
                    <th>Mã HP</th>
                    <th>Tên HP</th>
                    <th>Số tín chỉ</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($courses as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['MaDK']) ?></td>
                    <td><?= htmlspecialchars($c['NgayDK']) ?></td>
                    <td><?= htmlspecialchars($c['MaHP']) ?></td>
                    <td><?= htmlspecialchars($c['TenHP']) ?></td>
                    <td><?= htmlspecialchars($c['SoTinChi']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Hiển thị tổng tín chỉ bên dưới -->
        <p><strong>Tổng số tín chỉ:</strong> <?= $totalCredits ?></p>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary">Quay lại</a>
</div>
<?php include 'footer.php'; ?>
