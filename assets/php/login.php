<?php
session_start(); // Khởi tạo session
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kiểm tra xem có yêu cầu đăng nhập hay không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thông tin kết nối cơ sở dữ liệu
    $serverName = "localhost"; // Tên máy chủ MySQL
    $username = "id20992771_users"; // Tên người dùng MySQL
    $password = "Gicungduoc.3009"; // Mật khẩu MySQL
    $dbname = "id20992771_users"; // Tên cơ sở dữ liệu MySQL

    // Kết nối tới cơ sở dữ liệu
    $conn = mysqli_connect($serverName, $username, $password, $dbname);

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối tới cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Kiểm tra sự tồn tại của username và password
if (isset($username) && isset($password)) {
    // Sử dụng câu truy vấn sẵn có để lấy dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT COUNT(*) AS count FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra kết quả truy vấn
    if (!$result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    // Lấy số lượng bản ghi khớp
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    // Kiểm tra số lượng bản ghi khớp
    if ($count > 0) {
        // Đăng nhập thành công
        // Chuyển hướng đến trang web chính
        header("Location: /index.html");
        exit();
    } else {
        // Kiểm tra sự tồn tại của username trong cơ sở dữ liệu
        $sql = "SELECT COUNT(*) AS count FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        // Kiểm tra kết quả truy vấn
        if (!$result) {
            die("Lỗi truy vấn: " . mysqli_error($conn));
        }

        // Lấy số lượng bản ghi khớp
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count == 0) {
            // Sai tên người dùng
            $loginError = "Sai tên người dùng.";
        } else {
            // Sai mật khẩu
            $loginError = "Sai mật khẩu.";
        }
    }
} else {
    // Người dùng không nhập tên người dùng và mật khẩu
    $loginError = "Vui lòng nhập tên người dùng và mật khẩu.";
}
    // Đóng kết nối
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Para Store</title>
    <link rel="icon" href="../img/Layer0.png" type="image/png">
    <link rel="stylesheet" href="../css/register.css">
</head>

<body>

    <div class="login">
        <div class="background-login">
            <div class="logo">
                <a href="/index.html">
                    <img src="../img/Layer0.png">
                </a>
            </div>
            <div class="type">
                <p>Đăng Nhập</p>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="login-form" onsubmit="return validateForm()">
                    <input type="text" name="username" placeholder="Tên tài khoản" id="username">
                    <span class="error-message" id="username-error">
                        <?php echo isset($loginError) && $loginError !== "Sai mật khẩu." ? ($loginError === "Vui lòng điền đầy đủ thông tin đăng nhập." ? $loginError : "Sai tên người dùng.") : ''; ?>
                        <style>.error-message{color:red;display:flex;justify-content: center;}</style>
                    </span>
                    <input type="password" name="password" placeholder="Mật Khẩu" id="password">
                    <span class="error-message" id="password-error">
                        <?php echo isset($loginError) && $loginError !== "Sai tên người dùng." ? ($loginError === "Vui lòng điền đầy đủ thông tin đăng nhập." ? $loginError : "Sai mật khẩu.") : ''; ?>
                        <style>.error-message{color:red;display:flex;justify-content: center;}</style>
                    </span>
                    <input type="submit" value="Đăng nhập">
                </form>
                <div class="register">
                    <span>Bạn chưa đăng kí ?</span>
                    <a href="/register.html">
                        Đăng kí ngay
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/login.js"></script>
</body>

</html>