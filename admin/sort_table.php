<?php
session_start(); // Khởi động phiên session
include("./db_connect.php");
$db = $conn;

function fetch_data(){
    global $db;
    $query = "SELECT DISTINCT register_scheduling.register_id, term.term_id, term.term_title, software_name, class_term_id,
        ordinal_class_term, quantity_students, teacher_name, software_prioprity,
        register_time, time_day, time_lesson, time_week, software_category
        FROM register_scheduling 
        INNER JOIN software ON register_scheduling.term_id = software.term_id
        INNER JOIN term ON software.term_id = term.term_id
        INNER JOIN software_requirements ON software.software_id = software_requirements.software_id
        WHERE register_scheduling.status = 'chua_duyet' ";
    $exec = mysqli_query($db, $query);
    if(mysqli_num_rows($exec) > 0){
        $row = mysqli_fetch_all($exec, MYSQLI_ASSOC);
        usort($row, 'sort_scheduling'); // Sắp xếp dữ liệu trước khi trả về
        return $row;  
    } else {
        return [];
    }
}
function sort_scheduling($a, $b) {
    if ($a['register_time'] == $b['register_time']) {
        if ($a['time_day'] == $b['time_day']) {
            if ($a['time_week'] == $b['time_week']) {
                if ($a['software_prioprity'] == $b['software_prioprity']) {
                    return ($a['time_lesson'] < $b['time_lesson']) ? -1 : 1;
                }
                return ($a['software_prioprity'] < $b['software_prioprity']) ? -1 : 1; // So sánh theo chiều tăng dần của độ ưu tiên
            }
            return ($a['time_week'] < $b['time_week']) ? -1 : 1;
        }
        return ($a['time_day'] < $b['time_day']) ? -1 : 1;
    }
    return ($a['register_time'] < $b['register_time']) ? -1 : 1;
}


/*
function sort_scheduling($a, $b) {
    return $a['register_time'] <=> $b['register_time'] ?: 
           $a['time_day'] <=> $b['time_day'] ?: 
           $a['time_week'] <=> $b['time_week'] ?: 
           $a['software_prioprity'] <=> $b['software_prioprity'] ?: 
           $a['time_lesson'] <=> $b['time_lesson'];
}

*/



$fetchData = fetch_data();
show_data($fetchData);

function show_data($fetchData){
    echo '<div style="width: 1500px; transform: translateX(-12%);">';
    echo '<table id="bookingTable" class="table table-bordered">
        <tr>
            <th style="text-align: center">Term ID</th>
            <th style="text-align: center">Term Title</th>
            <th style="text-align: center">Class Term ID</th>
            <th style="text-align: center">Group Ordinal Term</th>
            <th style="text-align: center">Quantity</th>
            <th style="text-align: center">Teacher</th>
            <th style="text-align: center">Software</th>
            <th style="text-align: center">Weeks</th>
            <th style="text-align: center">Days</th>
            <th style="text-align: center">Lesson</th>
            <th style="text-align: center">Type Room</th>
            <th style="text-align: center">Register</th>
            <th style="text-align: center" colspan="2">Action</th>
        </tr>';

    if(count($fetchData) > 0){
        foreach($fetchData as $data){ 
            echo "<tr> <!-- Thêm ID cho mỗi dòng để dễ dàng xác định -->
                <td style='text-align: center'>".$data['term_id']."</td>
                <td style='text-align: center'>".$data['term_title']."</td>
                <td style='text-align: center'>".$data['class_term_id']."</td>
                <td style='text-align: center'>".$data['ordinal_class_term']."</td>
                <td style='text-align: center'>".$data['quantity_students']."</td>
                <td style='text-align: center'>".$data['teacher_name']."</td>
                <td style='text-align: center'>".$data['software_name']."</td>
                <td style='text-align: center'>".$data['time_week']."</td>
                <td style='text-align: center'>".$data['time_day']."</td>
                <td style='text-align: center'>".$data['time_lesson']."</td>
                <td style='text-align: center'>".$data['software_category']."</td>
                <td style='text-align: center'>".$data['register_time']."</td>
                <td style='text-align: center'>
                    <a class='btn btn-success' href='./room_mang_reserve/reservation.php?
                    term_id=".$data['term_id']."&
                    term_title=".$data['term_title']."&
                    class_term_id=".$data['class_term_id']."&
                    ordinal_class_term=".$data['ordinal_class_term']."&
                    quantity_students=".$data['quantity_students']."&
                    teacher_name=".$data['teacher_name']."&
                    software_name=".$data['software_name']."&
                    time_day=".$data['time_day']."&
                    time_lesson=".$data['time_lesson']."&
                    time_week=".$data['time_week']."&
                    software_category=".$data['software_category']."&
                    register_time=".$data['register_time']."'>Book</a>      
                </td>
               <td style='text-align: center'>
                    <button class='btn btn-primary duyet-btn' data-register-id='".$data['register_id']."'>Duyệt</button>
                </td>
                
            </tr>";
        }
    } else {
        echo "<tr>
            <td colspan='13'>No Data Found</td>
        </tr>"; 
    }
    echo "</table>";
    echo '</div>';

}
?>

<!-- Modal -->
<div id="confirmModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận duyệt thông tin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn duyệt thông tin này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="confirmYes">Yes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
jQuery.noConflict(); // Sử dụng jQuery.noConflict() để tránh xung đột với các thư viện jQuery khác

jQuery(document).ready(function($) { // Sử dụng $ là biến thay thế cho jQuery trong phạm vi này
    $('.duyet-btn').click(function() {
        var register_id = $(this).data('register-id');
        $('#confirmModal').modal('show'); // Sử dụng phần tử DOM trực tiếp thay vì $(...)

        $('#confirmYes').click(function() {
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: {
                    register_id: register_id
                },
                success: function(response) {
                    window.location.href = 'index.php?page=duyet_thong_tin';
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
});
</script>