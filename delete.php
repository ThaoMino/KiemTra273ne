<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

include 'dbconnect.php'; 

$Ma_NV = $_GET['Ma_NV'];

if (!$Ma_NV) {
    echo "Không tìm thấy mã nhân viên cần xóa.";
} else {
    $sql = "DELETE FROM NHANVIEN WHERE Ma_NV = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Ma_NV);

    if ($stmt->execute()) {
        echo "Nhân viên đã được xóa thành công.";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}

header('Location: manage.php'); 
?>
