<?php
session_start();

$dataFile = 'db.json';
$data = json_decode(file_get_contents($dataFile), true);

// Nhận dữ liệu
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm_password'] ?? '';

// Kiểm tra nhập trống
if ($username === '' || $password === '' || $confirm === '') {
    exit("❌ Vui lòng điền đầy đủ thông tin.");
}

// Kiểm tra unicode
if (preg_match('/[^\x20-\x7E]/', $username)) {
    exit("❌ Username không được dùng kí tự unicode.");
}
if (preg_match('/[^\x20-\x7E]/', $password)) {
    exit("❌ Password không được dùng kí tự unicode.");
}

// Kiểm tra độ dài
if (strlen($username) < 4 || strlen($password) < 4) {
    exit("❌ Username và mật khẩu phải dài ít nhất 4 ký tự.");
}

// Kiểm tra xác nhận mật khẩu
if ($password !== $confirm) {
    exit("❌ Mật khẩu xác nhận không khớp.");
}

// Kiểm tra username đã tồn tại
if (isset($data['users'][$username])) {
    exit("❌ Tên đăng nhập đã tồn tại.");
}

// Thêm người dùng mới
$data['users'][$username] = $password;
file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

// Đăng nhập tự động
$_SESSION['user'] = $username;

// Điều hướng về trang home
header('Location: home.php');
exit;
