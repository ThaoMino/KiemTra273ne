<?php
include 'dbconnect.php'; 

$Ma_NV = $_GET['Ma_NV'];

$sql = "SELECT * FROM NHANVIEN WHERE Ma_NV = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Ma_NV);
$stmt->execute();
$result = $stmt->get_result();
$nv = $result->fetch_assoc();

if (!$nv) {
    echo "Không tìm thấy nhân viên";
    exit;
}
?>

<h3>Sửa Thông Tin Nhân Viên</h3>
<form action="update.php" method="post">
    <input type="hidden" name="Ma_NV" value="<?php echo $nv['Ma_NV']; ?>">
    Tên Nhân Viên: <input type="text" name="Ten_NV" value="<?php echo $nv['Ten_NV']; ?>"><br>
    Giới Tính: <input type="text" name="Phai" value="<?php echo $nv['Phai']; ?>"><br>
    Nơi Sinh: <input type="text" name="Noi_Sinh" value="<?php echo $nv['Noi_Sinh']; ?>"><br>
    Mã Phòng: <input type="text" name="Ma_Phong" value="<?php echo $nv['Ma_Phong']; ?>"><br>
    Lương: <input type="text" name="Luong" value="<?php echo $nv['Luong']; ?>"><br>
    <button type="submit">Cập nhật</button>
</form>
