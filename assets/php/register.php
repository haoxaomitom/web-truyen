<?php
session_start();
$serverName = "localhost";
$username = "id20992771_users";
$password = "Gicungduoc.3009";
$dbname = "id20992771_users";

$conn = mysqli_connect($serverName, $username, $password, $dbname);

if (!$conn) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password']; 

// Kiểm tra xem email đã tồn tại hay chưa
$emailQuery = "SELECT * FROM users WHERE email = '$email'";
$emailResult = mysqli_query($conn, $emailQuery);

if (mysqli_num_rows($emailResult) > 0) {
    $response = array('error' => 'Email already exists');
    echo json_encode($response);
    exit();
}

// Kiểm tra xem username đã tồn tại hay chưa
$usernameQuery = "SELECT * FROM users WHERE username = '$username'";
$usernameResult = mysqli_query($conn, $usernameQuery);

if (mysqli_num_rows($usernameResult) > 0) {
    $response = array('error' => 'Username already exists');
    echo json_encode($response);
    exit();
}

// Tiến hành đăng kí người dùng vào cơ sở dữ liệu
$sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES ('$firstName', '$lastName', '$email', '$username', '$password')";

if (mysqli_query($conn, $sql)) {
    echo '<script>let result = confirm("Đăng kí thành công! Bạn có muốn tới trang đăng kí không?");
    if (result) {
      window.location.href = "/login.html";
    } else {
      window.location.href = "/index.html";
    }</script>';
    exit();
} else {
    $response = array('error' => 'An error to register');
    echo json_encode($response);
    exit();
}

mysqli_close($conn);
?>
