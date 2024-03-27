<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Nhân Viên</title>
</head>
<body>

<h2>THÔNG TIN NHÂN VIÊN</h2>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "baikiemtra";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 5; 
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

$sql = "SELECT NHANVIEN.Ma_NV, NHANVIEN.Ten_NV, NHANVIEN.Phai, NHANVIEN.Noi_Sinh, PHONGBAN.Ten_Phong, NHANVIEN.Luong FROM NHANVIEN JOIN PHONGBAN ON NHANVIEN.Ma_Phong = PHONGBAN.Ma_Phong LIMIT {$start}, {$perPage}";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Mã Nhân Viên</th><th>Tên Nhân Viên</th><th>Giới Tính</th><th>Nơi Sinh</th><th>Tên Phòng</th><th>Lương</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        $genderImage = $row["Phai"] == "NU" ? "woman.jpg" : "man.jpg";
        echo "<td><img src='image/" . (strtolower($row["Phai"]) == 'nu' ? "woman.jpg" : "man.jpg") . "' alt='Gender'  style='width:60px; height:auto;'/></td>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Phân trang
$total = $conn->query("SELECT COUNT(*) as total FROM NHANVIEN")->fetch_assoc()['total'];
$pages = ceil($total / $perPage);

for ($i = 1; $i <= $pages; $i++) {
    echo "<a href='?page=$i'>$i</a> ";
}

$conn->close();
?>

</body>
</html>
