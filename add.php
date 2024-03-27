<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Ma_NV = $_POST['Ma_NV'];
    $Ten_NV = $_POST['Ten_NV'];
    $Phai = $_POST['Phai'];
    $Noi_Sinh = $_POST['Noi_Sinh'];
    $Ma_Phong = $_POST['Ma_Phong'];
    $Luong = $_POST['Luong'];

    $sql = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $Ma_NV, $Ten_NV, $Phai, $Noi_Sinh, $Ma_Phong, $Luong);

    if ($stmt->execute()) {
        echo "Nhân viên mới đã được thêm thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

header('Location: manage.php'); 
?>
