<?php
session_start();

$dataFile = 'db.json';
$data = json_decode(file_get_contents($dataFile), true);

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm_password'] ?? '';

// Kiểm tra dữ liệu
if ($username === '' || $password === '' || $confirm === '') {
    echo "❌ Vui lòng điền đầy đủ thông tin.";
    return;
}

if (preg_match('/[^\x20-\x7E]/', $password)) {
    echo "❌ Password không được dùng kí tự unicode.";
    return;
}

if (strlen($username) < 8 || strlen($password) < 8) {
    echo "❌ Username và mật khẩu phải dài ít nhất 8 ký tự.";
    return;
}

if ($password !== $confirm) {
    echo "❌ Mật khẩu xác nhận không khớp.";
    return;
}

if (isset($data['users'][$username])) {
    echo "❌ Tên đăng nhập đã tồn tại.";
    return;
}

// Thêm người dùng mới
$data['users'][$username] = $password;
file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

$_SESSION['user'] = $username;

// Trả chuỗi báo hiệu thành công
echo "OK";
