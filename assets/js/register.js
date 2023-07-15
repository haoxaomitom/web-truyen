function validateForm() {
    let ho = document.forms["register-form"]["first_name"].value;
    let ten = document.forms["register-form"]["last_name"].value;
    let email = document.forms["register-form"]["email"].value;
    let username = document.forms["register-form"]["username"].value;
    let password = document.forms["register-form"]["password"].value;
    let confirmPassword = document.forms["register-form"]["confirm-password"].value;

    if (ho == "") {
        alert("Vui lòng nhập họ của bạn!");
        return false;
    }
    if (ten == "") {
        alert("Vui lòng nhập tên của bạn!");
        return false;
    }
    if (email == "") {
        alert("Vui lòng nhập địa chỉ email của bạn!");
        return false;
    }
    if (username == "") {
        alert("Vui lòng nhập tên đăng nhập của bạn!");
        return false;
    }
    if (password == "") {
        alert("Vui lòng nhập mật khẩu của bạn!");
        return false;
    }
    if (confirmPassword == "") {
        alert("Vui lòng xác nhận mật khẩu của bạn!");
        return false;
    }
    if (password != confirmPassword) {
        alert("Mật khẩu xác nhận không trùng khớp!");
        return false;
    }
    nextto();
    return true
}
function showAlert() {
    let result = confirm("Đăng kí thành công! Bạn có muốn tới trang đăng kí không?");
    if (result) {
      window.location.href = "/login.html";
    } else {
      window.location.href = "/index.html";
    }
  }
  

function nextto() {
    //Sử dụng Ajax để gửi dữ liệu và nhận phản hồi từ PHP
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/assets/php/register.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.error) {
                    displayError(response.error);
                } else {
                    showAlert();
                }
            }
        }
    };

    const formData = new FormData();
    formData.append("first_name", ho);
    formData.append("last_name", ten);
    formData.append("email", email);
    formData.append("username", username);
    formData.append("password", password);

    xhr.send(formData);

    return false;
}

function displayError(errorMessage) {
    const errorElement = document.getElementById("error-message");
    errorElement.innerHTML = errorMessage;
    errorElement.style.display = "block";
}