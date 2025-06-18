<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quên mật khẩu</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #8e2de2, #4a00e0);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background: white;
      padding: 30px;
      border-radius: 15px;
      width: 350px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="email"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #3b82f6;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2563eb;
    }

    .back-link {
      display: flex;
      justify-content: space-between;
      margin-top: 15px;
      font-size: 14px;
    }

    .back-link a {
      text-decoration: none;
      color: #3b82f6;
    }

    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Quên mật khẩu</h2>
    <form action="forgot-password-handler.php" method="POST">
      <input type="email" name="email" placeholder="Nhập email đã đăng ký" required>
      <button type="submit">Gửi yêu cầu</button>
    </form>
    <div class="back-link">
      <a href="index.html">← Đăng nhập</a>
      <a href="register.html">Đăng ký</a>
    </div>
  </div>
</body>
</html>
