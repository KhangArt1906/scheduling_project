<?php
// Kiểm tra xem phiên session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("./db_connect.php");

// Truy vấn để lấy ra các thông tin đã được duyệt
$query = "SELECT DISTINCT 
        term.term_id, term.term_title, software_name, class_term_id,
        ordinal_class_term, quantity_students, teacher_name, 
        register_time, time_day, time_lesson, time_week, software_category, status
        FROM register_scheduling 
        INNER JOIN software ON register_scheduling.term_id = software.term_id
        INNER JOIN term ON software.term_id = term.term_id
        INNER JOIN software_requirements ON software.software_id = software_requirements.software_id
        WHERE register_scheduling.status = 'da_duyet'
        ORDER BY register_time, time_week, time_day, software_prioprity, time_lesson
        ";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Lỗi truy vấn: " . mysqli_error($conn);
    exit();
}

// Kiểm tra xem có thông tin nào đã được duyệt hay không
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Checked scheduling information:</h2>";
    echo "<table border='1'>
            <tr>
                <th style='text-align: center'>Term ID</th>
                <th style='text-align: center'>Term Title</th>
                <th style='text-align: center'>Software Name</th>
                <th style='text-align: center'>C.Term ID</th>
                <th style='text-align: center'>Ordinal Term</th>
                <th style='text-align: center'>Quantity</th>
                <th style='text-align: center'>Teacher</th>
                <th style='text-align: center'>Software</th>
                <th style='text-align: center'>Days</th>
                <th style='text-align: center'>Lesson</th>
                <th style='text-align: center'>Week</th>
                <th style='text-align: center'>Software Category</th>
                 <th style='text-align: center'>Registered Time</th>
                 <th style='text-align: center'>Book Room</th>
                 <th style='text-align: center'>Status</th>

                <!-- Thêm các cột khác nếu cần -->
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td style='text-align: center' >".$row['term_id']."</td>
                <td style='text-align: center'>".$row['term_title']."</td>
                <td style='text-align: center'>".$row['software_name']."</td>
                <td style='text-align: center'>".$row['class_term_id']."</td>
                <td style='text-align: center'>".$row['ordinal_class_term']."</td>
                <td style='text-align: center'>".$row['quantity_students']."</td>
                <td style='text-align: center'>".$row['teacher_name']."</td>
                <td style='text-align: center'>".$row['software_name']."</td>
                <td style='text-align: center'>".$row['time_day']."</td>
                <td style='text-align: center'>".$row['time_lesson']."</td>
                <td style='text-align: center'>".$row['time_week']."</td>
                <td style='text-align: center'>".$row['software_category']."</td>
                <td style='text-align: center'>".$row['register_time']."</td>
                 <td style='text-align: center'>
                    <a class='btn-sm btn-info' href='./room_mang_reserve/reservation.php?
                    term_id=".$row['term_id']."&
                    term_title=".$row['term_title']."&
                    class_term_id=".$row['class_term_id']."&
                    ordinal_class_term=".$row['ordinal_class_term']."&
                    quantity_students=".$row['quantity_students']."&
                    teacher_name=".$row['teacher_name']."&
                    software_name=".$row['software_name']."&
                    time_day=".$row['time_day']."&
                    time_lesson=".$row['time_lesson']."&
                    time_week=".$row['time_week']."&
                    software_category=".$row['software_category']."&
                    register_time=".$row['register_time']."'>Book</a>      
                </td>
                <td style='text-align: center; width: 100px; height: 50px'>";
        // Kiểm tra giá trị của status và tạo thẻ span tương ứng
        if ($row['status'] == 'da_duyet') {
            echo "<span style='background-color: #28a745; color: white; padding: 4px; border-radius: 4px'>Đã Duyệt</span>";
        } elseif ($row['status'] == 'chua_duyet') {
            echo "<span style='background-color: #ffc107; color: black; padding: 4px; border-radius: 4px''>Chưa Duyệt</span>";
        } else {
            echo $row['status']; // Giá trị không khớp với định dạng đã xác định
        }
echo "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Không có thông tin nào đã được duyệt.";
}

// Giải phóng kết nối
mysqli_free_result($result);
mysqli_close($conn);
?>