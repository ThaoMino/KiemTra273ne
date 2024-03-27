<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "baikiemtra";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT id, username, role FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

   
    header("Location: manage.php");
} else {
    echo "Sai thông tin đăng nhập!";
}

$conn->close();
?>
