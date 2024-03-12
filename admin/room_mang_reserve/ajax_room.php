<?php
include_once '../db_connect.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$email && !$password) {
        header('Location:login.php?empty');
    } else {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username = '$email' OR email='$email' AND password='$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            header('Location:index.php?dashboard');
        } else {
            header('Location:login.php?loginE');
        }
    }
}

if (isset($_POST['add_room'])) {
    $room_type_id = $_POST['room_type_id'];
    $room_no = $_POST['room_no'];

    if ($room_no != '') {
        $sql = "SELECT * FROM room WHERE room_no = '$room_no'";
        if (mysqli_num_rows(mysqli_query($conn, $sql)) >= 1) {
            $response['done'] = false;
            $response['data'] = "Room No Already Exist";
        } else {
            $query = "INSERT INTO room (room_type_id,room_no) VALUES ('$room_type_id','$room_no')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $response['done'] = true;
                $response['data'] = 'Successfully Added Room';
            } else {
                $response['done'] = false;
                $response['data'] = "DataBase Error";
            }
        }
    } else {

        $response['done'] = false;
        $response['data'] = "Please Enter Room No";
    }

    echo json_encode($response);
}

if (isset($_POST['room'])) {
    $room_id = $_POST['room_id'];

    $sql = "SELECT * FROM room WHERE room_id = '$room_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $room = mysqli_fetch_assoc($result);
        $response['done'] = true;
        $response['room_no'] = $room['room_no'];
        $response['room_type_id'] = $room['room_type_id'];
    } else {
        $response['done'] = false;
        $response['data'] = "DataBase Error";
    }

    echo json_encode($response);
}

if (isset($_POST['edit_room'])) {
    $room_type_id = $_POST['room_type_id'];
    $room_no = $_POST['room_no'];
    $room_id = $_POST['room_id'];

    if ($room_no != '') {
        $query = "UPDATE room SET room_no = '$room_no',room_type_id = '$room_type_id' where room_id = '$room_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $response['done'] = true;
            $response['data'] = 'Successfully Edit Room';
        } else {
            $response['done'] = false;
            $response['data'] = "DataBase Error";
        }

    } else {

        $response['done'] = false;
        $response['data'] = "Please Enter Room No";
    }

    echo json_encode($response);
}

if (isset($_GET['delete_room'])) {
    $room_id = $_GET['delete_room'];
    $sql = "UPDATE room set deleteStatus = '1' WHERE room_id = '$room_id' AND status IS NULL";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:room_mang.php");
    } else {
        header("Location:room_mang.php");
    }
}

if (isset($_POST['room_type'])) {
    $room_type_id = $_POST['room_type_id'];

    $sql = "SELECT * FROM room WHERE room_type_id = '$room_type_id' AND status IS NULL AND deleteStatus = '0'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<option selected disabled>Select Room Type</option>";
        while ($room = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $room['room_id'] . "'>" . $room['room_no'] . "</option>";
        }
    } else {
        echo "<option>No Available</option>";
    }
}

if (isset($_POST['room_type_cpu'])) {
    $room_type_id = $_POST['room_type_id'];

    $sql = "SELECT distinct room_type_cpu from room_type WHERE room_type_id = '$room_type_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $room = mysqli_fetch_assoc($result);
        echo $room['room_type_cpu'];
    } else {
        echo "0";
    }
}


if (isset($_POST['room_type_ram'])) {
    $room_type_id = $_POST['room_type_id'];

    $sql = "SELECT distinct room_type_ram from room_type WHERE room_type_id = '$room_type_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $room = mysqli_fetch_assoc($result);
        echo $room['room_type_ram'];
    } else {
        echo "0";
    }
}


if (isset($_POST['room_max_person'])) {
    $room_type_id = $_POST['room_type_id'];

    $sql = "SELECT distinct max_person from room_type WHERE room_type_id = '$room_type_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $room = mysqli_fetch_assoc($result);
        echo $room['max_person'];
    } else {
        echo "0";
    }
}

if (isset($_POST['room_return'])) {
    $room_id = $_POST['room_id'];

    $sql = "SELECT * FROM room NATURAL JOIN room_type WHERE room_id = '$room_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $room = mysqli_fetch_assoc($result);
        echo $room['return'];
    } else {
        echo "0";
    }
}


if (isset($_POST['booking'])) {
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $total_response = $_POST['total_response'];


    //Customer
    $term_id = $_POST['term_id'];
    $class_term_id = $_POST['class_term_id'];
    $term_title = $_POST['term_title'];
    $ordinal_class_term = $_POST['ordinal_class_term'];
    $quantity_students = $_POST['quantity_students'];
    $teacher_name = $_POST['teacher_name'];
    $software_name = $_POST['software_name'];
    $time_day = $_POST['time_day'];
    $time_lesson = $_POST['time_lesson'];
    $time_week = $_POST['time_week'];
    $software_category = $_POST['software_category'];

    // $email = $_POST['email'];
    // $department = $_POST['department'];



    // Thực hiện chèn dữ liệu vào bảng customer
    $customer_sql = "INSERT INTO customer (term_id, 
    class_term_id, teacher_name, term_title, ordinal_class_term, quantity_students, software_name, time_day, time_lesson, time_week, software_category) 
    VALUES ('$term_id', '$class_term_id', '$teacher_name', '$term_title', '$ordinal_class_term', '$quantity_students', '$software_name', '$time_day', '$time_lesson', '$time_week', '$software_category')";
    $customer_result = mysqli_query($conn, $customer_sql);

    if ($customer_result) {
        $teacher_id = mysqli_insert_id($conn);
        $booking_sql = "INSERT INTO booking (teacher_id,room_id,check_in,check_out,time_start,time_end,total_response,remaining_response) 
        VALUES ('$teacher_id','$room_id','$check_in','$check_out','$time_start','$time_end','$total_response','$total_response')";
        $booking_result = mysqli_query($conn, $booking_sql);
        if ($booking_result) {
            $room_stats_sql = "UPDATE room SET status = '1' WHERE room_id = '$room_id'";
            if (mysqli_query($conn, $room_stats_sql)) {
                $response['done'] = true;
                $response['data'] = 'Successfully Booking';
            } else {
                $response['done'] = false;
                $response['data'] = "DataBase Error in status change";
            }
        } else {
            $response['done'] = false;
            $response['data'] = "DataBase Error booking";
        }
    } else {
        $response['done'] = false;
        $response['data'] = "DataBase Error add customer";
    }

    echo json_encode($response);
}

if (isset($_POST['customerDetails'])) {
  
    $room_id = $_POST['room_id'];

    if ($room_id != '') {
        $sql = "SELECT * FROM room NATURAL JOIN room_type NATURAL JOIN booking NATURAL JOIN customer WHERE room_id = '$room_id' AND return_status = '0'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $customer_details = mysqli_fetch_assoc($result);
           
            $response['done'] = true;
            $response['teacher_id'] = $customer_details['teacher_id'];
            // $response['salut'] = $customer_details['salut'];
            $response['term_id'] = $customer_details['term_id'];
            $response['class_term_id'] = $customer_details['class_term_id'];
            $response['teacher_name'] = $customer_details['teacher_name'];
            $response['term_title'] = $customer_details['term_title'];
            $response['ordinal_class_term'] = $customer_details['ordinal_class_term'];
            $response['quantity_students'] = $customer_details['quantity_students'];
            $response['software_name'] = $customer_details['software_name'];
            $response['time_day'] = $customer_details['time_day'];
            $response['time_lesson'] = $customer_details['time_lesson'];
            $response['time_week'] = $customer_details['time_week'];
            $response['software_category'] = $customer_details['software_category'];

            $response['remaining_response'] = $customer_details['remaining_response'];
        } else {
            $response['done'] = false;
            $response['data'] = "DataBase Error";
        }

        echo json_encode($response);
    }
}

if (isset($_POST['booked_room'])) {
    $room_id = $_POST['room_id'];

    $sql = "SELECT * FROM room NATURAL JOIN room_type NATURAL JOIN booking NATURAL JOIN customer WHERE room_id = '$room_id' AND return_status = '0'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $room = mysqli_fetch_assoc($result);
        $response['done'] = true;
        $response['booking_id'] = $room['booking_id'];
        $response['teacher_name'] = $room['teacher_name'];
        $response['room_no'] = $room['room_no'];
        $response['room_type'] = $room['room_type'];
        $response['check_in'] = date('M j, Y', strtotime($room['check_in']));
        $response['check_out'] = date('M j, Y', strtotime($room['check_out']));
        $response['time_start'] = $room['time_start'];
        $response['time_end'] = $room['time_end'];
        $response['total_response'] = $room['total_response'];
        $response['remaining_response'] = $room['remaining_response'];
    } else {
        $response['done'] = false;
        $response['data'] = "DataBase Error";
    }

    echo json_encode($response);
}

if (isset($_POST['check_in_room'])) {
    $booking_id = $_POST['booking_id'];
    $advance_return = $_POST['advance_return'];

    if ($booking_id != '') {
        $query = "select * from booking where booking_id = '$booking_id'";
        $result = mysqli_query($conn, $query);
        $booking_details = mysqli_fetch_assoc($result);
        $room_id = $booking_details['room_id'];
        $remaining_response = $booking_details['remaining_response'];
        $updateBooking = "UPDATE booking SET remaining_response = '$remaining_response' where booking_id = '$booking_id'";
        $result = mysqli_query($conn, $updateBooking);
        if ($result) {
            $updateRoom = "UPDATE room SET check_in_status = '1' WHERE room_id = '$room_id'";
            $updateResult = mysqli_query($conn, $updateRoom);
            if ($updateResult) {
                $response['done'] = true;
            } else {
                $response['done'] = false;
                $response['data'] = "Problem in Update Room Check in status";
            }
        } else {
            $response['done'] = false;
            $response['data'] = "Problem in checkin";
        }
    } else {
        $response['done'] = false;
        $response['data'] = "Error With Booking";
    }
    echo json_encode($response);
}

if (isset($_POST['check_out_room'])) {
    $booking_id = $_POST['booking_id'];
    $remaining_return = $_POST['remaining_return'];

    if ($booking_id != '') {
        $query = "select * from booking where booking_id = '$booking_id'";
        $result = mysqli_query($conn, $query);
        $booking_details = mysqli_fetch_assoc($result);
        $room_id = $booking_details['room_id'];
        $remaining_response = $booking_details['remaining_response'];

        if ($remaining_response == $remaining_return) {
            $updateBooking = "UPDATE booking SET remaining_response = '0',return_status = '1' where booking_id = '$booking_id'";
            $result = mysqli_query($conn, $updateBooking);
            if ($result) {
                $updateRoom = "UPDATE room SET status = NULL,check_in_status = '0',check_out_status = '1' WHERE room_id = '$room_id'";
                $updateResult = mysqli_query($conn, $updateRoom);
                if ($updateResult) {
                    $response['done'] = true;
                } else {
                    $response['done'] = false;
                    $response['data'] = "Problem in Update Room Check in status";
                }
            } else {
                $response['done'] = false;
                $response['data'] = "Problem in checkout";
            }

        } else {
            $response['done'] = false;
            $response['data'] = "Please Enter Correct Word";
        }
    } else {
        $response['done'] = false;
        $response['data'] = "Error With Booking";
    }
    echo json_encode($response);
}