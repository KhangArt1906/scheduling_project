<link href="../sources/css/bootstrap.min.css" rel="stylesheet">
<link href="../sources/css/font-awesome.min.css" rel="stylesheet">
<link href="../sources/css/datepicker3.css" rel="stylesheet">
<link href="../sources/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../sources/css/styles.css" rel="stylesheet">


<?php
include('../db_connect.php');
if (isset($_GET['room_id'])){
    $get_room_id = $_GET['room_id'];
    $get_room_sql = "SELECT * FROM room NATURAL JOIN room_type WHERE room_id = '$get_room_id'";
    $get_room_result = mysqli_query($conn, $get_room_sql);
    $get_room = mysqli_fetch_assoc($get_room_result);

    $get_room_type_id = $get_room['room_type_id'];
    $get_room_type = $get_room['room_type'];
    $get_room_no = $get_room['room_no'];
    $get_room_ram = $get_room['room_type_ram'];
    $get_room_cpu = $get_room['room_type_cpu'];
    $get_max_person = $get_room['max_person'];
    $get_room_return = $get_room['return'];
}

            
// Lấy các thông tin từ URL nếu tồn tại
if (isset($_GET['term_id']) && isset($_GET['class_term_id']) && isset($_GET['teacher_name']) &&
    isset($_GET['ordinal_class_term']) && isset($_GET['quantity_students']) && isset($_GET['software_name']) && isset($_GET['time_day']) &&
isset($_GET['time_lesson'])
&&
isset($_GET['time_week'])
&&
isset($_GET['software_category'])
&& isset($_GET['term_title'])

) {
    $term_id = $_GET['term_id'];
    $term_title = $_GET['term_title'];
    $class_term_id = $_GET['class_term_id'];
    $teacher_name = $_GET['teacher_name'];
    $ordinal_class_term = $_GET['ordinal_class_term'];
    $quantity_students = $_GET['quantity_students'];
    $software_name = $_GET['software_name'];
    $software_category = $_GET['software_category'];
    $time_lesson = $_GET['time_lesson'];
     $time_day = $_GET['time_day'];
      $time_week = $_GET['time_week'];
    
    // Lấy các thông tin khác từ URL nếu cần
}
else{
    $term_id = "";
    $term_title = "";
    $class_term_id = "";
    $teacher_name = "";
    $ordinal_class_term = "";
    $quantity_students = "";
    $software_name = "";
    $software_category = "";
    $time_lesson = "";
    $time_day = "";
    $time_week = "";
}

?>




<div class="col-md-10 col-sm-offset-3 col-lg-offset-2 main">
    <div style="width: 445px;">
        <ol class="breadcrumb">
            <li><a href="/School Faculty Scheduling/scheduling/admin/index.php?page=home">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Reservation</li>
        </ol>
    </div>


    <div class="row col-md-10">
        <div class="col-xl-1">
            <form role="form" id="booking" data-toggle="validator">
                <div class="response"></div>
                <div class="col-xl-12">
                    <?php
                    if (isset($_GET['room_id'])){?>

                    <div class="panel panel-default">
                        <div class="panel-heading">Room Information:
                            <a class="btn btn-secondary pull-right" href="./room_mang.php">Replan Booking</a>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label>Room Type</label>
                                <select class="form-control" id="room_type" data-error="Select Room Type" required>
                                    <option selected disabled>Select Room Type</option>
                                    <option selected value="<?php echo $get_room_type_id; ?>">
                                        <?php echo $get_room_type; ?></option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Room No</label>
                                <select class="form-control" id="room_no" onchange="fetch_return(this.value)" required
                                    data-error="Select Room No">
                                    <option selected disabled>Select Room No</option>
                                    <option selected value="<?php echo $get_room_id; ?>"><?php echo $get_room_no; ?>
                                    </option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Check In Date</label>
                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date"
                                    data-error="Select Check In Date" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Check Out Date</label>
                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date"
                                    data-error="Select Check Out Date" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Time Start</label>
                                <input type="time" class="form-control" placeholder="00:00" id="time_start"
                                    data-error="Select Time Start" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Time End</label>
                                <input type="time" class="form-control" placeholder="00:00" id="time_end"
                                    data-error="Select Time End" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="col-lg-12">

                                <h4 style="font-weight: bold">CPU: <span id="cpu"><?php echo  $get_room_cpu; ?></span>
                                </h4>
                                <h4 style="font-weight: bold">RAM: <span id="ram"><?php echo  $get_room_ram; ?></span>
                                </h4>
                                <h4 style="font-weight: bold">Max Person: <span
                                        id="max_person"><?php echo $get_max_person ?></span></h4>
                                <hr>
                                <h4 style="font-weight: bold;">Status: <span
                                        id="return"><?php echo $get_room_return; ?></span></h4>
                                <h4 style="font-weight: bold;">All is <i class="fa fa-check-circle"
                                        style="color: green"></i>: <span id="total_response">Null</span></h4>
                            </div>
                        </div>
                    </div>
                    <?php } else{?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Room Information:</b>
                            <a class="btn btn-secondary pull-right" style="border-radius:0%"
                                href="./reservation.php">Replan Booking</a>
                        </div>
                        <div class="panel-body">

                            <?php
// Kiểm tra và lấy giá trị của software_category từ URL params
if (isset($_GET['software_category'])) {
    $software_category = $_GET['software_category'];
} else {
    $software_category = ""; // Hoặc giá trị mặc định khác tùy vào yêu cầu của bạn
}
?>
                            <div class="form-group col-lg-6">
                                <label>Room Type</label>
                                <select class="form-control" id="room_type"
                                    onchange="fetch_room(this.value); fetch_ram(this.value); fetch_cpu(this.value); fetch_max_person(this.value)"
                                    required data-error="Select Room Type">
                                    <option selected disabled>Select Room Type</option>
                                    <?php
 $query = "";
        switch ($software_category) {
            case "Low":
                $query = "SELECT * FROM room_type WHERE room_type IN ('Low', 'Low-Medium')";
                break;
            case "Low-Medium":
                $query = "SELECT * FROM room_type WHERE room_type IN ('Low-Medium', 'Medium')";
                break;
            case "Medium":
                $query = "SELECT * FROM room_type WHERE room_type IN ('Medium', 'Medium-High')";
                break;
            case "Medium-High":
                $query = "SELECT * FROM room_type WHERE room_type IN ('Medium-High', 'High')";
                break;
            case "High":
                $query = "SELECT * FROM room_type WHERE room_type IN ('High', 'Ultra')";
                break;
            default:
                // Xử lý khi không có software_category
                $query = "SELECT * FROM room_type";
        }

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($room_type = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$room_type['room_type_id'].'">'.$room_type['room_type'].'</option>';
            }
        } else {
            // Xử lý khi không tìm thấy phòng phù hợp
            echo '<option value="" disabled selected>Không có phòng phù hợp</option>';
        }
?>

                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Room No</label>
                                <select class="form-control" id="room_no" onchange="fetch_return(this.value)" required
                                    data-error="Select Room No">

                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Check In Date</label>
                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date"
                                    data-error="Select Check In Date" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Check Out Date</label>
                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date"
                                    data-error="Select Check Out Date" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Time Start</label>
                                <input type="time" class="form-control" placeholder="00:00" id="time_start"
                                    data-error="Select Time Start" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Time End</label>
                                <input type="time" class="form-control" placeholder="00:00" id="time_end"
                                    data-error="Select Time End" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="col-lg-12">

                                <h4 style="font-weight: bold">CPU: <span id="cpu">0 </span></h4>
                                <h4 style="font-weight: bold">RAM: <span id="ram">0</span></h4>
                                <h4 style="font-weight: bold">Max Person: <span id="max_person">0 </span></h4>
                                <hr>
                                <h4 style="font-weight: bold; ">Status: <span id="return">Null
                                    </span></h4>
                                <h4 style="font-weight: bold;">All <i class="fa fa-check-circle"
                                        style="color: green;"></i>: <span id="total_response">Null </span>
                                </h4>


                            </div>
                        </div>
                    </div>
                    <?php }
                    ?>

                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Teacher Details:</b></div>
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label>Term ID</label>
                                <input class="form-control" required data-error="Enter Term ID" class="form-control"
                                    id="term_id" value="<?php echo $term_id ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Class Term ID</label>
                                <input class="form-control" required data-error="Enter Class Term ID" id="class_term_id"
                                    value="<?php echo $class_term_id ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Teacher Name</label>
                                <input class="form-control" required data-error="Enter Teacher Name" id="teacher_name"
                                    value="<?php echo $teacher_name ?>">
                                <div class="help-block with-errors"></div>
                            </div>


                            <div class="form-group col-lg-6">
                                <label>Term Title</label>
                                <input class="form-control" required data-error="Enter Term Title" id="term_title"
                                    value="<?php echo $term_title ?>">
                                <div class="help-block with-errors"></div>
                            </div>


                            <div class="form-group col-lg-6">
                                <label>Ordinal Class Term</label>
                                <input class="form-control" required data-error="Enter Ordinal Class Term"
                                    id="ordinal_class_term" value="<?php echo $ordinal_class_term ?>">
                                <div class="help-block with-errors"></div>
                            </div>


                            <div class="form-group col-lg-6">
                                <label>Quantity Students</label>
                                <input type="number" class="form-control" required data-error="Enter Quantity Students"
                                    id="quantity_students" value="<?php echo $quantity_students ?>">
                                <div class="help-block with-errors"></div>
                            </div>


                            <div class="form-group col-lg-6">
                                <label>Software Name</label>
                                <input class="form-control" required data-error="Enter Software Name" id="software_name"
                                    value="<?php echo $software_name ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Time Day</label>
                                <input class="form-control" required data-error="Enter Time Day" id="time_day"
                                    value="<?php echo $time_day ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Time Lesson</label>
                                <input class="form-control" required data-error="Enter Time Lesson" id="time_lesson"
                                    value="<?php echo $time_lesson ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Time Week</label>
                                <input class="form-control" required data-error="Enter Time Week" id="time_week"
                                    value="<?php echo $time_week ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Software Category</label>
                                <input class="form-control" required data-error="Enter Software Category"
                                    id="software_category" value="<?php echo $software_category ?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-success pull-right"
                        style="border-radius:0%">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/.main-->
<!-- Booking Confirmation-->


<div id="bookingConfirm" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><b>Room Booking</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert bg-success alert-dismissable" role="alert"><em
                                class="fa fa-lg fa-check-circle">&nbsp;</em>Room Successfully Booked</div>
                        <table class="table table-striped table-bordered table-responsive">

                            <tbody>
                                <!-- <tr>
                                        <td><b>Salut</b></td>
                                        <td id="getSalut"></td>
                                    </tr> -->
                                <tr>
                                    <td><b>Term ID</b></td>
                                    <td id="getTermID"></td>
                                </tr>
                                <tr>
                                    <td><b>Teacher Name</b></td>
                                    <td id="getTeacherName"></td>
                                </tr>
                                <tr>
                                    <td><b>Ordinal Class Term</b></td>
                                    <td id="getOrdinalClassTerm"></td>
                                </tr>
                                <tr>
                                    <td><b>Room Type</b></td>
                                    <td id="getRoomType"></td>
                                </tr>
                                <tr>
                                    <td><b>Room No</b></td>
                                    <td id="getRoomNo"></td>
                                </tr>
                                <tr>
                                    <td><b>Check In Date</b></td>
                                    <td id="getCheckIn"></td>
                                </tr>
                                <tr>
                                    <td><b>Check Out Date</b></td>
                                    <td id="getCheckOut"></td>
                                </tr>
                                <tr>
                                    <td><b>Time Start</b></td>
                                    <td id="getTimeStart"></td>
                                </tr>
                                <tr>
                                    <td><b>Time Out</b></td>
                                    <td id="getTimeEnd"></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" style="border-radius:60px;" href="reservation.php"><i
                        class="fa fa-check-circle"></i></a>
            </div>
        </div>

    </div>
</div>


<script>
// Lấy tham số từ URL
const urlParams = new URLSearchParams(window.location.search);



// Kiểm tra nếu các tham số tồn tại trong URL, thì gán giá trị cho các ô input tương ứng
if (urlParams.has('term_id')) {
    document.getElementById('term_id').value = urlParams.get('term_id');
}
if (urlParams.has('class_term_id')) {
    document.getElementById('class_term_id').value = urlParams.get('class_term_id');
}
if (urlParams.has('teacher_name')) {
    document.getElementById('teacher_name').value = urlParams.get('teacher_name');
}

if (urlParams.has('term_title')) {
    document.getElementById('term_title').value = urlParams.get('term_title');
}

if (urlParams.has('ordinal_class_term')) {
    document.getElementById('ordinal_class_term').value = urlParams.get('ordinal_class_term');
}

if (urlParams.has('quantity_students')) {
    document.getElementById('quantity_students').value = urlParams.get('quantity_students');
}

if (urlParams.has('software_name')) {
    document.getElementById('software_name').value = urlParams.get('software_name');
}

if (urlParams.has('time_day')) {
    document.getElementById('time_day').value = urlParams.get('time_day');
}


if (urlParams.has('time_lesson')) {
    document.getElementById('time_lesson').value = urlParams.get('time_lesson');
}


if (urlParams.has('time_week')) {
    document.getElementById('time_week').value = urlParams.get('time_week');
}

if (urlParams.has('software_category')) {
    document.getElementById('software_category').value = urlParams.get('software_category');
}


document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);


    const softwareCategory = urlParams.get('software_category');

    console.log(softwareCategory);

    if (softwareCategory) {
        const roomTypeSelect = document.getElementById('room_type');

        // Hàm chọn loại phòng dựa trên software_category
        const selectRoomType = function(softwareCategory) {
            switch (softwareCategory) {
                case "Low":
                    roomTypeSelect.value = "Low";
                    break;
                case "Low-Medium":
                    roomTypeSelect.value = "Low-Medium";
                    break;
                case "Medium":
                    roomTypeSelect.value = "Medium";
                    break;
                case "Medium-High":
                    roomTypeSelect.value = "Medium-High";
                    break;
                case "High":
                    roomTypeSelect.value = "High";
                    break;
                default:
                    console.error("Không tìm thấy loại phòng phù hợp");
                    break;
            }
        };

        // Chọn loại phòng ban đầu dựa trên software_category từ URL
        selectRoomType(softwareCategory);
    }
});



// Làm tương tự cho các ô input khác nếu cần
</script>

<script src="../sources/js/jquery-1.11.1.min.js"></script>
<script src="../sources/js/bootstrap-datepicker.min.js"></script>
<script src="../sources/js/select2.min.js"></script>
<script src="../sources/js/tether.min.js"></script>
<script src="../sources/js/bootstrap.min.js"></script>
<script src="../sources/js/jquery.dataTables.min.js"></script>
<script src="../sources/js/dataTables.bootstrap.min.js"></script>
<script src="../sources/js/foundation-datepicker.min.js"></script>
<script src="../sources/js/validator.min.js"></script>
<script src="../sources/js/custom.js"></script>
<script src="./ajax.js"></script>
<script src="../sources/js/jquery-te-1.4.0.min.js"></script>