<?php

include('../db_connect.php');

$response = array();

if (isset($_POST['changeRoom'])) {
    $booking_id = $_POST['booking_id'];
    $teacher_id = $_POST['teacher_id'];
    $new_room_id = $_POST['new_room_id'];
    $old_room_id = $_POST['old_room_id'];

    // Kiểm tra trạng thái phòng hiện tại
    $current_room_status_sql = "SELECT status, check_in_status, check_out_status FROM room WHERE room_id = '$old_room_id'";
    $current_room_status_result = mysqli_query($conn, $current_room_status_sql);
    $current_room_status = mysqli_fetch_assoc($current_room_status_result);

    if (!empty($current_room_status) && $current_room_status['status'] == 1 && $current_room_status['check_in_status'] == 1 && ($current_room_status['check_out_status'] == 0 || $current_room_status['check_out_status'] == 1)) {
        // Update the booking with the new room
        $update_booking_sql = "UPDATE booking SET room_id = '$new_room_id' WHERE booking_id = '$booking_id'";
        $update_booking_result = mysqli_query($conn, $update_booking_sql);

        if ($update_booking_result) {
            // Cập nhật trạng thái phòng cũ
            $update_old_room_sql = "UPDATE room SET status = NULL, check_in_status = 0, check_out_status = 0 WHERE room_id = '$old_room_id'";
            $update_old_room_result = mysqli_query($conn, $update_old_room_sql);

            if ($update_old_room_result) {
                // Cập nhật trạng thái phòng mới
                $update_new_room_sql = "UPDATE room SET status = 1, check_in_status = 1, check_out_status = 1 WHERE room_id = '$new_room_id'";
                $update_new_room_result = mysqli_query($conn, $update_new_room_sql);

                if ($update_new_room_result) {
                    $response['done'] = true;
                    $response['data'] = 'Successfully Changed Room';
                } else {
                    $response['done'] = false;
                    $response['data'] = 'Error updating new room status';
                }
            } else {
                $response['done'] = false;
                $response['data'] = 'Error updating old room status';
            }
        } else {
            $response['done'] = false;
            $response['data'] = 'Error updating booking';
        }
    } else {
        $response['done'] = false;
        $response['data'] = 'Cannot change room. Current room is not available for change.';
    }
}

echo json_encode($response);
?>