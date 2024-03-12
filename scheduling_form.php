<?php
// Bắt đầu session
session_start();
include ('./header.php');
include ('./topbar.php');

// Đảm bảo rằng người dùng đã đăng nhập, nếu không, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['login_id'])) {
    header("Location: login.php");
    exit;
}

// Kết nối CSDL
include('./admin/db_connect.php');

// Lấy tên giảng viên từ session và sử dụng nó để truy vấn CSDL
$teacher_name = $_SESSION['login_name'];

// Truy vấn CSDL với sử dụng truyền tham số
$sql = "SELECT * FROM register_scheduling WHERE teacher_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $teacher_name);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
    echo "<h2>Danh sách đăng ký lịch thực hành của bạn:</h2>";
    echo "<table border='1' style='margin-top: 40px; transform: translateX(40%);
    height: 200px; width: 1100px
    '>
            <tr>
                <th style='text-align: center'>Term ID</th>
                <th style='text-align: center'>Class Term ID</th>
                <th style='text-align: center'>Ordinal Class Term</th>
                <th style='text-align: center'>Quantity Students</th>
                <th style='text-align: center'>Time Day</th>
                <th style='text-align: center'>Time Lesson</th>
                <th style='text-align: center'>Time Week</th>
                <th style='text-align: center'>Register Time</th>
                <th style='text-align: center; width: 120px'>Status</th>
                

            </tr>";

    // Xuất dữ liệu mỗi bản ghi
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='text-align: center'>" . $row['term_id'] . "</td>";
        echo "<td style='text-align: center'>" . $row['class_term_id'] . "</td>";
        echo "<td style='text-align: center'>" . $row['ordinal_class_term'] . "</td>";
        echo "<td style='text-align: center'>" . $row['quantity_students'] . "</td>";
        echo "<td style='text-align: center'>" . $row['time_day'] . "</td>";
        echo "<td style='text-align: center'>" . $row['time_lesson'] . "</td>";
        echo "<td style='text-align: center'>" . $row['time_week'] . "</td>";
        echo "<td style='text-align: center'>" . $row['register_time'] . "</td>";
         echo "<td style='text-align: center' >";

        // Kiểm tra giá trị của status và tạo thẻ span tương ứng
        if ($row['status'] == 'da_duyet') {
            echo "<span style='background-color: #28a745; color: white; padding: 4px; border-radius: 4px'>Đã Duyệt</span>";
        } elseif ($row['status'] == 'chua_duyet') {
            echo "<span style='background-color: #ffc107; color: black; padding: 4px; border-radius: 4px''>Chưa Duyệt</span>";
        } else {
            echo $row['status']; // Giá trị không khớp với định dạng đã xác định
        }

        echo "</td>";
    
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Không có đăng ký lịch thực hành nào được tìm thấy cho bạn.";
}

// Đóng kết nối CSDL
$stmt->close();
$conn->close();
?>