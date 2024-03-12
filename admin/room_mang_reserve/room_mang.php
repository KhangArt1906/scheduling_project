<link href="../sources/css/bootstrap.min.css" rel="stylesheet">
<link href="../sources/css/font-awesome.min.css" rel="stylesheet">
<link href="../sources/css/datepicker3.css" rel="stylesheet">
<link href="../sources/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../sources/css/styles.css" rel="stylesheet">



<div class="col-md-10 col-sm-offset-2 col-lg-offset-2 main">
    <div style="width: 445px;">
        <ol class="breadcrumb">
            <li><a href="/School Faculty Scheduling/scheduling/admin/index.php?page=home">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Manage Rooms</li>
        </ol>
    </div>
    <!--/.row-->

    <br>

    <div class="row">
        <div class="col-lg-12">
            <div id="success"></div>
        </div>
    </div>

    <div class="row col-md-10">
        <div class="col-xl-1">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Rooms
                    <button class="btn btn-secondary pull-right" style="border-radius:0%" data-toggle="modal"
                        data-target="#addRoom">Add Rooms</button>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error on Delete !
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully Delete !
                            </div>";
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"
                        id="rooms">
                        <thead>
                            <tr>
                                <th style="text-align: center">Room No</th>
                                <th style="text-align: center">Room Type</th>
                                <th style="text-align: center">Booking Status</th>
                                <th style="text-align: center">Check In</th>
                                <th style="text-align: center">Check Out</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php
                            include('../db_connect.php');
                        $room_query = "SELECT * FROM room NATURAL JOIN room_type WHERE deleteStatus = 0";
                        $rooms_result = mysqli_query($conn, $room_query);
                        if (mysqli_num_rows($rooms_result) > 0) {
                            while ($rooms = mysqli_fetch_assoc($rooms_result)) { ?>
                            <tr>
                                <td><?php echo $rooms['room_no'] ?></td>
                                <td><?php echo $rooms['room_type'] ?></td>
                                <td>
                                    <?php
                                        if ($rooms['status'] == 0) {
                                            echo '<a href="reservation.php?room_id=' . $rooms['room_id'] . '&room_type_id=' . $rooms['room_type_id'] . '" class="btn btn-success" style="border-radius:0%">Book Room</a>';
                                        } else {
                                            echo '<a href="#" class="btn btn-danger" style="border-radius:0%">Booked</a>';
                                        }
                                        ?>


                                <td>
                                    <?php
                                        if ($rooms['status'] == 1 && $rooms['check_in_status'] == 0) {
                                            echo '<button class="btn btn-warning" id="checkInRoom"  data-id="' . $rooms['room_id'] . '" data-toggle="modal" style="border-radius:0%" data-target="#checkIn">Check In</button>';
                                        } elseif ($rooms['status'] == 0) {
                                            echo '-';
                                        } else {

                                            echo '<a href="#" class="btn btn-danger" style="border-radius:0%">Checked In</a>';
                                        }
                                        ?>
                                </td>
                                <td>
                                    <?php
                                        if ($rooms['status'] == 1 && $rooms['check_in_status'] == 1) {
                                            echo '<button class="btn btn-primary" style="border-radius:0%" id="checkOutRoom" data-id="' . $rooms['room_id'] . '">Check Out</button>';
                                        } elseif ($rooms['status'] == 0) {
                                            echo '-';
                                        }
                                        ?>
                                </td>
                                <td>

                                    <button title="Edit Room Information" style="border-radius:60px;"
                                        data-toggle="modal" data-target="#editRoom"
                                        data-id="<?php echo $rooms['room_id']; ?>" id="roomEdit" class="btn btn-info"><i
                                            class="fa fa-pencil"></i></button>
                                    <?php
                                        if ($rooms['status'] == 1) {
                                            echo '<button title="Teacher Information" data-toggle="modal" data-target="#teacherDetailsModal" data-id="' . $rooms['room_id'] . '" id="customerDetails" class="btn btn-warning" style="border-radius:60px;"><i class="fa fa-eye"></i></button>';
                                        }
                                        elseif ($rooms['status'] == 0) {
    echo '<button title="Change Room" data-toggle="modal" data-target="#changeRoomModal" data-id="' . $rooms['room_id'] . '" id="changeRoom" class="btn btn-success" style="border-radius:60px;"><i class="fa fa-exchange"></i></button>';
}
                                        ?>

                                    <a href="ajax_room.php?delete_room=<?php echo $rooms['room_id']; ?>"
                                        class="btn btn-danger" style="border-radius:60px;"
                                        onclick="return confirm('Are you Sure?')"><i class="fa fa-trash"
                                            alt="delete"></i></a>


                                </td>
                            </tr>
                            <?php }
                        } else {
                            echo "No Rooms";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Room Modal -->
    <div id="addRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Room</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="addRoom" data-toggle="validator" role="form">
                                <div class="response"></div>
                                <div class="form-group">
                                    <label>Room Type</label>
                                    <select class="form-control" id="room_type_id" required
                                        data-error="Select Room Type">
                                        <option selected disabled>Select Room Type</option>
                                        <?php
                                        $query = "SELECT * FROM room_type";
                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($room_type = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $room_type['room_type_id'] . '">' . $room_type['room_type'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label>Room No</label>
                                    <input class="form-control" placeholder="Room No" id="room_no"
                                        data-error="Enter Room No" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <button class="btn btn-success pull-right">Add Room</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--Edit Room Modal -->
    <div id="editRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Room</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="roomEditFrom" data-toggle="validator" role="form">
                                <div class="edit_response"></div>
                                <div class="form-group">
                                    <label>Room Type</label>
                                    <select class="form-control" id="edit_room_type" required
                                        data-error="Select Room Type">
                                        <option selected disabled>Select Room Type</option>
                                        <?php
                                        $query = "SELECT * FROM room_type";
                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($room_type = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $room_type['room_type_id'] . '">' . $room_type['room_type'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label>Room No</label>
                                    <input class="form-control" placeholder="Room No" id="edit_room_no" required
                                        data-error="Enter Room No">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="edit_room_id">
                                <button class="btn btn-success pull-right">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!---customer details-->
    <div id="teacherDetailsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Teacher's Detail</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                <!-- <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Detail</th>
                                </tr>
                                </thead> -->
                                <tbody>
                                    <!-- <tr>
                                        <td><b>Salut</b></td>
                                        <td id="customer_salut"></td>
                                    </tr> -->
                                    <tr>
                                        <td><b>Term ID</b></td>
                                        <td id="customer_term_id"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Class Term ID</b></td>
                                        <td id="customer_class_term_id"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Teacher Name</b></td>
                                        <td id="customer_teacher_name"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Term Title</b></td>
                                        <td id="customer_term_title"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Ordinal Class Term</b></td>
                                        <td id="customer_ordinal_class_term"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Quantity Students</b></td>
                                        <td id="customer_quantity_students"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Software Name</b></td>
                                        <td id="customer_software_name"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Time Day</b></td>
                                        <td id="customer_time_day"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Time Lesson</b></td>
                                        <td id="customer_time_lesson"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Time Week</b></td>
                                        <td id="customer_time_week"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Software Category</b></td>
                                        <td id="customer_software_category"></td>
                                    </tr>
                                    <!-- <tr>
                                        <td><b>Contact Number</b></td>
                                        <td id="customer_contact_no"></td>
                                    </tr> -->

                                    <!-- <tr>
                                        <td><b>Email</b></td>
                                        <td id="customer_email"></td>
                                    </tr> -->
                                    <!-- <tr>
                                        <td><b>Term ID</b></td>
                                        <td id="customer_term_id"></td>
                                    </tr> -->

                                    <!-- <tr>
                                        <td><b>Department</b></td>
                                        <td id="customer_department"></td>
                                    </tr> -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---customer details ends here-->

    <!-- Check In Modal -->
    <div id="checkIn" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Room - Check In</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">

                                <tbody>
                                    <tr>
                                        <td><b>Customer Name</b></td>
                                        <td id="getCustomerName"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Room Type</b></td>
                                        <td id="getRoomType"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Room Number</b></td>
                                        <td id="getRoomNo"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Check In</b></td>
                                        <td id="getCheckIn"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Check Out</b></td>
                                        <td id="getCheckOut"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Time Start</b></td>
                                        <td id="getTimeStart"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Time End</b></td>
                                        <td id="getTimeEnd"></td>
                                    </tr>

                                </tbody>
                            </table>
                            <form role="form" id="advanceReturn">
                                <div class="signal-response"></div>
                                <div class="form-group col-lg-12">
                                    <label>Advance to Checkout</label>
                                    <input type="hidden" class="form-control" id="advance_return"
                                        placeholder="Type 0/1 to get advance to Checkout Procedure.">
                                </div>
                                <input type="hidden" id="getBookingID" value="">
                                <button type="submit" class="btn btn-primary pull-right">Click to Check-out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Check Out Modal-->
    <div id="checkOut" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Room - Check Out</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">

                                <tbody>
                                    <tr>
                                        <td><b>Customer Name</b></td>
                                        <td id="getCustomerName_n"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Room Type</b></td>
                                        <td id="getRoomType_n"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Room Number</b></td>
                                        <td id="getRoomNo_n"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Check In</b></td>
                                        <td id="getCheckIn_n"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Check Out</b></td>
                                        <td id="getCheckOut_n"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Time Start</b></td>
                                        <td id="getTimeStart_n"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Time Out</b></td>
                                        <td id="getTimeEnd_n"></td>
                                    </tr>

                                </tbody>
                            </table>
                            <form role="form" id="checkOutRoom_n" data-toggle="validator">
                                <div class="checkout-response"></div>
                                <div class="form-group col-lg-12">
                                    <label><b>Final Procedure</b></label>
                                    <input type="text" class="form-control" id="remaining_return"
                                        placeholder="Type 'Yes' to complete return Room " required
                                        data-error="Please Enter Yes">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="getBookingId_n" value="">
                                <button type="submit" class="btn btn-primary pull-right">Proceed Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Thêm modal cho Change Room -->
    <div class="modal fade" id="changeRoomModal" tabindex="-1" role="dialog" aria-labelledby="changeRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeRoomModalLabel">Change Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form để chọn phòng mới và xác nhận -->
                    <form id="changeRoom">


                        <label for="bookingID">Select Booking ID:</label>
                        <select name="bookingID" id="bookingID" required>
                            <!-- Populate customer options from database -->
                            <?php
    // Thực hiện truy vấn để lấy danh sách các khách hàng có return_status = 0 và đã đặt phòng
    $get_booking_sql = "SELECT booking_id from booking where return_status = 0";

    $get_booking_result = mysqli_query($conn, $get_booking_sql);

    // Hiển thị danh sách các khách hàng trong thẻ select
    while ($booking = mysqli_fetch_assoc($get_booking_result)) {
        echo '<option value="' . $booking['booking_id'] . '">' . $booking['booking_id'] . '</option>';
    }
    ?>
                        </select>
                        <br />
                        <label for="customerSelect">Select Customer:</label>

                        <select name="customerSelect" id="customerSelect" required>
                            <!-- Populate customer options from database -->
                            <?php
    // Thực hiện truy vấn để lấy danh sách các khách hàng có return_status = 0 và đã đặt phòng
    $get_customer_sql = "SELECT DISTINCT c.teacher_id, c.teacher_name, b.booking_id,
                         c.term_id, c.ordinal_class_term FROM customer c
                         INNER JOIN booking b ON c.teacher_id = b.teacher_id
                         WHERE b.return_status = 0";

    $get_customer_result = mysqli_query($conn, $get_customer_sql);

    // Hiển thị danh sách các khách hàng trong thẻ select
    while ($customer = mysqli_fetch_assoc($get_customer_result)) {
        echo '<option value="' . $customer['teacher_id'] . '">' . "ID: " . $customer['booking_id'] . " " . $customer['teacher_name'] . " " . $customer['term_id'] . " " . $customer['ordinal_class_term'] . '</option>';
    }
    ?>
                        </select>

                        <br />
                        <label for="oldRoom">Select Old Room:</label>
                        <select name="oldRoom" id="oldRoom" required>
                            <!-- Populate options from database -->
                            <?php
    $get_old_rooms_sql = "SELECT room_id, room_no FROM room WHERE status = 1 AND (check_in_status = 1 or check_in_status = 0) AND (check_out_status = 1 or check_out_status = 0)";
    $get_old_rooms_result = mysqli_query($conn, $get_old_rooms_sql);

    while ($oldRoom = mysqli_fetch_assoc($get_old_rooms_result)) {
        echo '<option value="' . $oldRoom['room_id'] . '">' . $oldRoom['room_no'] .  '</option>';
    }
    ?>
                        </select>

                        <br />
                        <label for="newRoom">Select New Room:</label>

                        <select name="newRoom" id="newRoom" required>
                            <!-- Populate room options from database -->
                            <?php
                        // Thực hiện truy vấn để lấy danh sách các phòng từ cơ sở dữ liệu
                        $get_rooms_sql = "SELECT room_id, room_no FROM room WHERE check_in_status = 0 and check_out_status = 0 or check_out_status = 1"; // Lấy các phòng có status = 0 (trống)
                        $get_rooms_result = mysqli_query($conn, $get_rooms_sql);

                        // Hiển thị danh sách các phòng trong thẻ select
                        while ($room = mysqli_fetch_assoc($get_rooms_result)) {
                            echo '<option value="' . $room['room_id'] . '">' . $room['room_no'] . '</option>';
                        }
                        ?>
                        </select>


                        <br />
                        <button type="button" onclick="confirmChangeRoom()" class="btn btn-success">Confirm
                            Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="change_room.js"></script>



    <div class="row">
        <div class="col-sm-12">
            <p class="back-link"><b> © 2022 All rights reserved. Made with &#x1F49C; by <a
                        href="https://www.youtube.com/channel/UC4_6-VSWBw_QHMyjrDDEvVQ"> GPW</a> Team.</b> </p>
        </div>
    </div>

</div>
<!--/.main-->

<script src="change_room.js"></script>
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