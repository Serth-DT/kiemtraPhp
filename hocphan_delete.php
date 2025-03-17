<?php
session_start();
require 'connect.php';

$MaHP = $_GET['MaHP'] ?? '';
if (!$MaHP) {
    die("Thiếu thông tin Mã HP để xóa.");
}

$sql = "DELETE FROM HocPhan WHERE MaHP='$MaHP'";
if ($conn->query($sql) === TRUE) {
    header("Location: hocphan_index.php?success=1");
    exit();
} else {
    die("Lỗi khi xóa học phần: " . $conn->error);
}
?>
