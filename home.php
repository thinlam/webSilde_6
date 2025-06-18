<?php
session_start();

// Nếu chưa login mà có cookie → khôi phục login
if (!isset($_SESSION['user']) && isset($_COOKIE['remember_user'])) {
    $_SESSION['user'] = $_COOKIE['remember_user'];
}

// Nếu vẫn chưa có login → quay lại login
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang chính</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Quicksand', sans-serif;
      background: linear-gradient(to right, #74ebd5, #9face6);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background-color: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      text-align: center;
      width: 90%;
      max-width: 400px;
    }

    h2 {
      margin-bottom: 10px;
      color: #333;
    }

    p {
      color: #555;
      margin-bottom: 20px;
    }

    a.logout-btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #ff4b5c;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }

    a.logout-btn:hover {
      background-color: #e63946;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>👋 Chào mừng, <?= htmlspecialchars($user) ?>!</h2>
    <p>Chúc bạn một ngày làm việc hiệu quả.</p>
    <a href="logout.php" class="logout-btn">Đăng xuất</a>
  </div>
</body>
</html>
