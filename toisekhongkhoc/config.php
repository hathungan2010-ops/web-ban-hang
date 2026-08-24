<?php
// Cấu hình thông tin kết nối
$host = 'localhost';       // Máy chủ (XAMPP mặc định là localhost)
$dbname = 'he_thong_ban_hang';  // Tên Database bạn vừa tạo trên phpMyAdmin
$username = 'root';        // Tên tài khoản (XAMPP mặc định là root)
$password = '';            // Mật khẩu (XAMPP mặc định để trống)

try {
    // Tạo kết nối PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Cài đặt chế độ báo lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}
?>