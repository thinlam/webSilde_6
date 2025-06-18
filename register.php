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

// Không chứa ký tự Unicode
if (preg_match('/[^\x20-\x7E]/', $password)) {
    echo "❌ Password không được dùng kí tự Unicode.";
    return;
}

// Kiểm tra yêu cầu bảo mật
if (
    !preg_match('/[a-z]/', $password) ||       // ít nhất 1 chữ thường
    !preg_match('/[A-Z]/', $password) ||       // ít nhất 1 chữ hoa
    !preg_match('/[0-9]/', $password) ||       // ít nhất 1 số
    !preg_match('/[\W_]/', $password)          // ít nhất 1 ký tự đặc biệt (không phải chữ/số)
) {
    echo "❌ Mật khẩu phải có ít nhất 1 chữ thường, 1 chữ hoa, 1 số và 1 ký tự đặc biệt.";
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
