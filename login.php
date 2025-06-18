<?php
session_start();

$data = json_decode(file_get_contents('db.json'), true);
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']);

// Kiểm tra nhập trống
if ($username === '' || $password === '') {
    exit("❌ Điền đầy đủ username và password");
}

// Kiểm tra ký tự unicode
if (preg_match('/[^\x20-\x7E]/', $username)) {
    exit("❌ Username không được dùng kí tự unicode");
}

if (preg_match('/[^\x20-\x7E]/', $password)) {
    exit("❌ Password không được dùng kí tự unicode");
}

// Kiểm tra username tồn tại
if (!isset($data['users'][$username])) {
    exit("❌ Sai thông tin đăng nhập");
}

// Kiểm tra password khớp
if ($data['users'][$username] !== $password) {
    exit("❌ Sai thông tin đăng nhập");
}

// Thành công → tạo SESSION
$_SESSION['user'] = $username;

// Nếu nhớ → lưu cookie trong 7 ngày
if ($remember) {
    setcookie('remember_user', $username, time() + (86400 * 7), "/");
} else {
    setcookie('remember_user', '', time() - 3600, "/"); // xóa nếu có cũ
}

// Điều hướng về home
header('Location: home.php');
exit;
