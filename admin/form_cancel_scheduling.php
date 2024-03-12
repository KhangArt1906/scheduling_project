<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <section id="sections" class="py-4 mb-4 bg-faded">
                <div class="container">
                    <div class="row">

                        <div class="col-md-3">
                            <a href="#" class="btn btn-warning btn-block" style="border-radius:0%;" data-toggle="modal"
                                data-target="#addPostModal"><i class="fa fa-spinner"></i>
                                Pending Cancel</a>
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="btn btn-success btn-block" style="border-radius:0%;" data-toggle="modal"
                                data-target="#addCateModal"><i class="fa fa-check"></i>
                                Approved</a>
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="btn btn-primary btn-block" style="border-radius:0%;" data-toggle="modal"
                                data-target="#addUsertModal"><i class="fa fa-th"></i>
                                Total Cancel</a>
                        </div>

                        <div class="col-md-3">
                            <a href="#" class="btn btn-info btn-block" style="border-radius:0%;" data-toggle="modal"
                                data-target="#addRoomModal"><i class="fa fa-check"></i>
                                Room Cancel</a>
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
                                            include ('./db_connect.php');
									$sql = "SELECT * FROM cancel_scheduling ORDER BY cancel_id DESC";
									$que = mysqli_query($conn,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
                                        $id=$result['cancel_id'];
									?>


                                <tr align="center">
                                    <td><?php echo $cnt;?></td>
                                    <td><?php echo $result['cancel_name']; ?></td>
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
							 	$cnt++;	?>

                                    </td>
                                    <td>
                                        <a id="removeme" href="cancel_scheduling_del.php?id=<?php echo $id;?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <?php    } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <!----Section3 footer ---->

            <div class="modal fade" id="addPostModal">

                <div class="col-xm-12">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="width: 1100px; height: 450px; overflow: scroll">
                            <div class="modal-header bg-warning text-white">
                                <div class="modal-title">
                                    <h3>Pending</h3>
                                </div>
                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body" style="width: 100%">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead align="center">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Email</th>
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
									$sql = "SELECT * FROM cancel_scheduling WHERE cancel_status = 0";
									$que = mysqli_query($conn,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
                                        ?>


                                        <tr align="center">
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $result['cancel_name']; ?></td>
                                            <td><?php echo $result['cancel_email'] ?></td>
                                            <td><?php echo $result['cancel_dept_code']; ?></td>
                                            <td><?php echo $result['cancel_date']; ?></td>
                                            <td><?php echo $result['cancel_time']; ?></td>
                                            <td><?php echo $result['cancel_room']; ?></td>
                                            <td><?php echo $result['cancel_subject']; ?></td>
                                            <td><?php echo $result['cancel_reason']; ?></td>
                                            <td>
                                                <?php 
							 			if ($result['cancel_status'] == 0) {
                                             echo "Pending";
							 				?>
                                            </td>
                                            <td>
                                                <form
                                                    action="form_accept_scheduling.php?id=<?php echo $result['cancel_id']; ?>"
                                                    method="POST">
                                                    <input type="hidden" name="appid"
                                                        value="<?php echo $result['cancel_id']; ?>">
                                                    <input type="submit" class="btn btn-sm btn-success" name="approve"
                                                        value="Approve">
                                                </form>
                                            </td>
                                            <?php
							 			}
							 			else{
							 				echo "Approved";
							 			}
							 	$cnt++;	}
							 		 ?>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                        </form>
                    </div>
                </div>

            </div>


            <div class="modal fade" id="addCateModal">
                <div class="col-xm-12">

                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="width: 1100px; height: 450px; overflow: scroll">
                            <div class="modal-header bg-success text-white">
                                <div class="modal-title">
                                    <h3>Approved Leaves</h3>
                                </div>
                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead align="center">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Detail Time</th>
                                        <th>Room</th>
                                        <th>Subject</th>
                                        <th>Reason</th>
                                        <th>Status</th>

                                    </thead>
                                    <tbody>
                                        <?php 
									$sql = "SELECT * FROM cancel_scheduling WHERE cancel_status = 1";
									$que = mysqli_query($conn,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>


                                        <tr align="center">
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $result['cancel_name']; ?></td>
                                            <td><?php echo $result['cancel_email'] ?></td>
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
                <div class="col-xm-12">


                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="width: 1100px; height: 450px; overflow: scroll">
                            <div class="modal-header bg-primary text-white">
                                <div class="modal-title">
                                    <h3>Total Cancel</h3>
                                </div>
                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead align="center">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Detail Time</th>
                                        <th>Room</th>
                                        <th>Subject</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        <?php 
									$sql = "SELECT * FROM cancel_scheduling ORDER BY cancel_id DESC";
									$que = mysqli_query($conn,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>


                                        <tr align="center">
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $result['cancel_name']; ?></td>
                                            <td><?php echo $result['cancel_email'] ?></td>
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

            <div class="modal fade" id="addRoomModal">
                <div class="col-xm-12">


                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="width: 1100px; height: 450px; overflow: scroll">
                            <div class="modal-header bg-primary text-white">
                                <div class="modal-title">
                                    <h3>Room Cancel</h3>
                                </div>
                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead align="center">
                                        <th>#</th>
                                        <th>Room</th>
                                        <th>Date</th>
                                        <th>Detail Time</th>
                                        <th>Status</th>

                                    </thead>
                                    <tbody>
                                        <?php 
									$sql = "select distinct cancel_room, cancel_date, cancel_time , cancel_status from cancel_scheduling where cancel_status = 1";
									$que = mysqli_query($conn,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>


                                        <tr align="center">
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $result['cancel_room']; ?></td>
                                            <td><?php echo $result['cancel_date']; ?></td>
                                            <td><?php echo $result['cancel_time']; ?></td>
                                            <td>
                                                <?php 
							 			if ($result['cancel_status'] == 0) {
											echo "<span class='badge badge-danger'>Unavailable</span>";
							 			}
							 			else{
											echo "<span class='badge badge-primary'>Available</span>";
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

        </section>

    </div>
</div>

</div>
<!-- #region -->
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/tether.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1');
</script>
</body>

</html>