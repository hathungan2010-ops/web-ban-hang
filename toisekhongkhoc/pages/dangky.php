<!-- File giao diện: dangky.php (hoặc index.php) -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
</head>
<body>
    <h2>Đăng ký thành viên</h2>

    <form action="../actions/xuly_dangky.php" method="POST">
        
        <!-- TRƯỜNG ẨN: Truyền vai_tro_id = 2 ngầm định xuống backend -->
        <input type="hidden" name="vai_tro_id" value="2">

        <div>
            <label for="username">Tên đăng nhập:</label><br>
            <input type="text" name="username" id="username" required>
        </div>
        <br>
        
        <!-- Bổ sung trường Họ và tên -->
        <div>
            <label for="ho_ten">Họ và tên:</label><br>
            <input type="text" name="ho_ten" id="ho_ten" required>
        </div>
        <br>

        <div>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required>
        </div>
        <br>

        <div>
            <label for="password">Mật khẩu:</label><br>
            <input type="password" name="password" id="password" required>
        </div>
        <br>

        <button type="submit">Đăng ký</button>
    </form>
</body>
</html>