<?php
// 1. Nhúng cấu hình kết nối Database (Lùi 1 bước để ra ngoài thư mục gốc)
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Nhận dữ liệu từ Form (Front-end)
    $username_form  = trim($_POST['username']);
    $ho_ten_form    = trim($_POST['ho_ten']);
    $email_form     = trim($_POST['email']);
    $password_form  = $_POST['password'];

    $vai_tro_id     = 2; // Mặc định

    // Kiểm tra không được để trống
    if (empty($username_form) || empty($email_form) || empty($password_form) || empty($ho_ten_form)) {
        die("Vui lòng nhập đầy đủ thông tin.");
    }

    // VỚI PDO, ta dùng khối try...catch để bắt lỗi dễ dàng hơn
    try {
        // =====================================================================
        // 3. KIỂM TRA TRÙNG LẶP USERNAME VÀ EMAIL (CHUẨN PDO)
        // =====================================================================
        $check_sql = "SELECT username, email FROM nguoi_dung WHERE username = ? OR email = ? LIMIT 1";
        $check_stmt = $conn->prepare($check_sql);
        
        // Cú pháp PDO: Gắn các biến vào 1 mảng (array) và ném thẳng vào execute()
        $check_stmt->execute([$username_form, $email_form]);
        
        // Lấy kết quả trả về dạng mảng kết hợp (Associative Array)
        $row = $check_stmt->fetch(PDO::FETCH_ASSOC);
        
        // Nếu $row có dữ liệu tức là đã có người sử dụng
        if ($row) {
            if ($row['username'] === $username_form) {
                die("<h3 style='color:red;'>Lỗi: Tên đăng nhập '$username_form' đã tồn tại. Vui lòng chọn tên khác!</h3><a href='../pages/dangky.php'>Quay lại</a>");
            }
            if ($row['email'] === $email_form) {
                die("<h3 style='color:red;'>Lỗi: Email '$email_form' đã được sử dụng. Vui lòng dùng email khác!</h3><a href='../pages/dangky.php'>Quay lại</a>");
            }
        }

        // =====================================================================
        // 4. TIẾN HÀNH LƯU VÀO DATABASE (CHUẨN PDO)
        // =====================================================================
        $mat_khau_ma_hoa = password_hash($password_form, PASSWORD_DEFAULT);

        $insert_sql = "INSERT INTO nguoi_dung (vai_tro_id, ho_ten, email, mat_khau, username) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        
        // Truyền các biến theo đúng thứ tự của 5 dấu chấm hỏi (?) ở trên
        $thuc_thi = $stmt->execute([
            $vai_tro_id, 
            $ho_ten_form, 
            $email_form, 
            $mat_khau_ma_hoa, 
            $username_form
        ]);
        
        if ($thuc_thi) {
            echo "<h2 style='color:green;'>Tạo tài khoản thành công!</h2>";
            echo "<a href='../pages/dangnhap.php'>Bấm vào đây để đăng nhập</a>";
        } else {
            echo "Lỗi khi lưu dữ liệu.";
        }

    } catch (PDOException $e) {
        // Nếu có lỗi SQL, PDO sẽ ném lỗi xuống đây
        die("Lỗi Database: " . $e->getMessage());
    }

    // Đóng kết nối PDO (gán bằng null)
    $conn = null;

} else {
    // Chặn truy cập trực tiếp bằng đường link
    header("Location: ../pages/dangky.php");
    exit();
}
?>