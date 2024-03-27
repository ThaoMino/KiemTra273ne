<?php
    
include 'dbconnect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Ma_NV = $_POST['Ma_NV'];
    $Ten_NV = $_POST['Ten_NV'];
    $Phai = $_POST['Phai'];
    $Noi_Sinh = $_POST['Noi_Sinh'];
    $Ma_Phong = $_POST['Ma_Phong'];
    $Luong = $_POST['Luong'];

    $sql = "UPDATE NHANVIEN SET Ten_NV=?, Phai=?, Noi_Sinh=?, Ma_Phong=?, Luong=? WHERE Ma_NV= ?";
    $stmt = $conn->prepare($sql);
   
    $stmt->bind_param("ssssis", $Ten_NV, $Phai, $Noi_Sinh, $Ma_Phong, $Luong, $Ma_NV);

    if ($stmt->execute()) {
        echo "Thông tin nhân viên đã được cập nhật thành công.";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}

header('Location: manage.php');
?>
