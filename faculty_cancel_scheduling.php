<?php
    session_start();
     include('./header.php'); 
 ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="content-wrapper bg-light">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section id="header_apply">
            <div class="container">
                <h1 style="text-align: center; color: black">Welcome to Apply Leaves Application</h1>
            </div>
        </section>
        <section id="sections" class="py-4 mb-4 bg-faded" style="margin-top: 32px;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <a class="btn btn-danger btn-block" style="border-radius:0%;" href="./index.php">
                            <i class="fa-solid fa-calendar"></i>
                            Scheduling
                            Calendar</a>
                    </div>

                    <div class="col-xl-3">
                        <a href="#" class="btn btn-primary btn-block" style="border-radius:0%;" data-toggle="modal"
                            data-target="#addPostModal"><i class="fa fa-plus"></i> Apply
                            Leave</a>
                    </div>
                    <div class="col-xl-3">
                        <a href="#" class="btn btn-warning btn-block" style="border-radius:0%;" data-toggle="modal"
                            data-target="#addCateModal"><i class="fa fa-spinner"></i>
                            Pendings</a>
                    </div>
                    <div class="col-xl-3">
                        <a href="#" class="btn btn-success btn-block" style="border-radius:0%;" data-toggle="modal"
                            data-target="#addUsertModal"><i class="fa fa-check"></i>
                            Approved Leaves</a>
                    </div>

                </div>
            </div>

        </section>

        <section id="post">
            <div class="container">
                <div class="row">
                    <table class="table table-bordered table-hover table-striped">
                        <thead align="center">
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Detail Time</th>
                            <th>Room</th>
                            <th>Subject</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                     include ('./admin/db_connect.php');
									$sql = "SELECT * FROM cancel_scheduling";
									$que = mysqli_query($conn,$sql);
									$cnt=1;
									while ($result = mysqli_fetch_assoc($que)) {
                                        $id=$result['cancel_id'];
									?>


                            <tr align="center">
                                <td><?php echo $cnt;?></td>
                                <td width="10%"><?php echo $result['cancel_name']; ?></td>
                                <td><?php echo $result['cancel_email']; ?></td>
                                <td><?php echo $result['cancel_dept_code']; ?></td>
                                <td width="10%"><?php echo $result['cancel_date']; ?></td>
                                <td><?php echo $result['cancel_time']; ?></td>
                                <td><?php echo $result['cancel_room']; ?></td>
                                <td><?php echo $result['cancel_subject']; ?></td>
                                <td><?php echo $result['cancel_reason']; ?></td>
                                <td>
                                    <?php 
							 			if ($result['cancel_status'] == 0) {
							 				echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else{
							 				echo "<span class='badge badge-success'>Approved</span>";
							 			}
							 	$cnt++; ?>
                                </td>
                                <td>
                                    <a id="removeme" href="faculty_scheduling_del.php?id=<?php echo $id;?>">
                                        <i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <!----Section3 footer ---->

        <div class="modal fade" id="addPostModal" style="overflow-y: scroll">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <div class="modal-title">
                            <h5>Apply Leave</h5>
                        </div>
                        <button class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">

                            <div class="form-group">
                                <label for="faculty" class="control-label">Faculty</label>
                                <select name="cancel_name" required class="custom-select select2">
                                    <option value="<?php echo $_SESSION['login_name'] ?>" selected>
                                        <?php echo $_SESSION['login_name'] ?></option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="email" class="form-control-label">Email</label>
                                <input placeholder="teacher@gmail.com" required id="email" type="text"
                                    name="cancel_email" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="department" class="form-control-label">Department</label>
                                <select required id="department" name="cancel_department" class="form-control">
                                    <option selected disabled>Choose</option>
                                    <option value="Hệ thống thông tin">Hệ thống thông tin</option>
                                    <option value="Mạng máy tính">Mạng máy tính</option>
                                    <option value="An toàn thông tin">An toàn thông tin</option>
                                    <option value="Trí tuệ nhân tạo">Trí tuệ nhân tạo</option>
                                    <option value="Cấu trúc dữ liệu & giải thuật">Cấu trúc dữ liệu & giải thuật</option>
                                    <option value="Designer">Designer</option>
                                    <option value="Tester">Tester</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cancel_date" class="form-control-label">Cancel Date</label>
                                <input required id="cancel_date" type="date" name="cancel_date" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="subject" class="control-label">Subject</label>
                                <select required name="cancel_subject" id="subject" class="custom-select select2">
                                    <option value="0" disabled selected>Choose...</option>
                                    <?php 
							$subject = $conn->query("SELECT * from subjects");
							while($row= $subject->fetch_array()):
						?>
                                    <option value="<?php echo $row['subject'] ?>"
                                        <?php echo isset($subject) && $subject == $row['subject'] ? 'selected' : '' ?>>
                                        <?php echo ucwords($row['subject']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class='form-group'>
                                <label for="time_cancel" class="form-control-label">Time Detail</label>
                                <input placeholder="Time Lesson: 1,2,3 or Time Week: 1,2,3" required id="time_cancel"
                                    type="text" class="form-control" name="cancel_time">
                            </div>


                            <div class="form-group">
                                <label for="room_no" class="control-label">Room No</label>
                                <select required name="cancel_room" id="room_no" class="custom-select select2">
                                    <option value="0" disabled selected>Choose</option>
                                    <?php 
							$room_no = $conn->query("SELECT * from room where deleteStatus = 0 and status = 1");
							while($row= $room_no->fetch_array()):
						?>
                                    <option value="<?php echo $row['room_no'] ?>"
                                        <?php echo isset($room_no) && $room_no == $row['room_no'] ? 'selected' : '' ?>>
                                        <?php echo ucwords($row['room_no']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>





                            <div class="form-group">
                                <label for="reason">Reason For Leave</label>
                                <textarea required name="editor1" id="reason" class="form-control"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" style="border-radius:0%;" data-dismiss="modal">Close</button>
                        <input type="hidden" name="status" value="0">
                        <input type="submit" class="btn btn-success" style="border-radius:0%;" name="apply"
                            value="Apply">
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="addCateModal">

            <div class="col-md-10">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="width: 1000px; height: 350px">
                        <div class="modal-header bg-warning text-white">
                            <div class="modal-title">
                                <h5>Pending Leaves</h5>
                            </div>
                            <button class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Date</th>
                                    <th>Specific Time</th>
                                    <th>Room</th>
                                    <th>Subject</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php 
									$sql = "SELECT * FROM cancel_scheduling WHERE cancel_status = 0";
									$que = mysqli_query($conn,$sql);
									$cnt=1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>


                                    <tr>
                                        <td><?php echo $cnt;?></td>
                                        <td><?php echo $result['cancel_name']; ?></td>
                                        <td><?php echo $result['cancel_email']; ?></td>
                                        <td><?php echo $result['cancel_dept_code']; ?></td>
                                        <td><?php echo $result['cancel_date']; ?></td>
                                        <td><?php echo $result['cancel_time']; ?></td>
                                        <td><?php echo $result['cancel_room']; ?></td>
                                        <td><?php echo $result['cancel_subject']; ?></td>
                                        <td><?php echo $result['cancel_reason']; ?></td>
                                        <td>
                                            <?php 
							 			if ($result['cancel_status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else{
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
							 	$cnt++;	}
							 		 ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>


        </div>


        <div class="modal fade" id="addUsertModal">

            <div class="col-md-10">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="overflow:scroll; width: 1200px; height: 400px">
                        <div class="modal-header bg-success text-white">
                            <div class="modal-title">
                                <h5>Total Approved Leaves</h5>
                            </div>
                            <button class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Date</th>
                                    <th>Specific Time</th>
                                    <th>Room</th>
                                    <th>Subject</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php 
									$sql = "SELECT * FROM cancel_scheduling WHERE cancel_status = 1";
									$que = mysqli_query($conn,$sql);
									$cnt=1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>


                                    <tr>
                                        <td><?php echo $cnt;?></td>
                                        <td><?php echo $result['cancel_name']; ?></td>
                                        <td><?php echo $result['cancel_email']; ?></td>
                                        <td><?php echo $result['cancel_dept_code']; ?></td>
                                        <td><?php echo $result['cancel_date']; ?></td>
                                        <td><?php echo $result['cancel_time']; ?></td>
                                        <td><?php echo $result['cancel_room']; ?></td>
                                        <td><?php echo $result['cancel_subject']; ?></td>
                                        <td><?php echo $result['cancel_reason']; ?></td>
                                        <td>
                                            <?php 
							 			if ($result['cancel_status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else{
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
							 	$cnt++;	}
							 		 ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

</div>

<section id="main-footer" class="text-center text-white bg-inverse mt-4 p-4">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead">&copy; <?php echo date("Y")?> SOLM</p>
            </div>
        </div>
    </div>
</section>


<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/tether.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1');
</script>


<?php 
	if (isset($_POST['apply'])){
		$name = $_POST['cancel_name'];
		$email = $_POST['cancel_email'];
		$department = $_POST['cancel_department'];
        $timecancel = $_POST['cancel_time'];
		$canceldate = $_POST['cancel_date'];
        $room = $_POST['cancel_room'];
        $subject_title = $_POST['cancel_subject'];
		$editor1 = $_POST['editor1'];
		$status = $_POST['cancel_status'];

		$sql = "INSERT INTO cancel_scheduling(cancel_name,cancel_email,cancel_dept_code,cancel_date,cancel_time,cancel_room,cancel_subject,cancel_reason,cancel_status)
        VALUES('$name','$email','$department','$canceldate','$timecancel', '$room','$subject_title','$editor1','$status')";

		$run = mysqli_query($conn,$sql);

		if($run == true){
			
			echo "<script> 
					alert('Leave Requested, Please wait for approval status');
					window.open('faculty_cancel_scheduling.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed To Apply');
			</script>";
		}
	}
	
 ?>