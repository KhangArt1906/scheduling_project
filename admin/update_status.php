<?php
include("./db_connect.php");

// Kiểm tra xem register_id có được gửi từ AJAX không
if(isset($_POST['register_id'])) {
    // Cập nhật trạng thái của bản ghi có register_id tương ứng thành "đã duyệt"
    $register_id = $_POST['register_id'];
    $query = "UPDATE register_scheduling SET status = 'da_duyet' WHERE register_id = $register_id";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        echo "Cập nhật trạng thái thất bại: " . mysqli_error($conn);
        exit();
    }
    echo "Cập nhật trạng thái thành công!";
} else {
    echo "Không có dữ liệu gửi đi!";
}
?>