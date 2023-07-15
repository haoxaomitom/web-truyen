<?php
// Thông tin kết nối đến cơ sở dữ liệu
$servername = "HAOROG";  // Tên máy chủ cơ sở dữ liệu
$username = "sa";  // Tên đăng nhập cơ sở dữ liệu
$password = "1";  // Mật khẩu cơ sở dữ liệu
$dbname = "users";  // Tên cơ sở dữ liệu

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
?>
