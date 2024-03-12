<?php
session_start();
if (!isset($_SESSION['login_id'])) {
	header('location:login.php');
}
include('./header.php');
include('./admin/db_connect.php');
if (isset($_POST['submit'])) {
	$date = $_POST['date'];
	$computerNumber = $_POST['computer-number'];
	$room = $_POST['room'];
	$reason = $_POST['reason'];
	$reason = implode(', ', $reason);
	$admin = $_POST['admin'];
	$userId = $_SESSION['login_id'];
	$teacherName = $_POST['teacher_name'];
	$query = "INSERT INTO problems(date,user_id,teacher_name,computer_number,room_no,reason,admin_id) 
		VALUES('{$date}',{$userId},'{$teacherName}','{$computerNumber}','{$room}','{$reason}',{$admin})";
	$status = $conn->query($query);
	if ($status) {
		echo '<script>
				alert("Add successfully !");
				window.location.href = "report_problem.php";
			</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>School Faculty Scheduling System</title>
</head>
<style>
body {
    background: #80808045;
}
</style>

<body>
    <?php include 'topbar.php' ?>
    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
    </div>
    <main id="" style="margin-top: 3.5rem;" class="bg-dark">
        <div class="container pt-4 pb-4">
            <div class="row">
                <!-- FORM Panel -->

                <!-- Table Panel -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b>Report Problem Add</b>
                        </div>
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="datetime-local" class="form-control" name="date" required>
                                </div>
                                <div class="form-group">
                                    <label>Teacher</label>
                                    <select name="teacher_name" required class="custom-select select2">
                                        <option value="<?php echo $_SESSION['login_name'] ?>" selected>
                                            <?php echo $_SESSION['login_name'] ?></option>
                                    </select>
                                    <!-- <input type="text" class="form-control" name="teacher_name" required> -->
                                </div>
                                <div class="form-group">
                                    <label>Computer Number</label>
                                    <input type="text" placeholder="Computer 1, 2, 3" class="form-control"
                                        name="computer-number" required>
                                </div>
                                <div class="form-group">
                                    <label>Room No</label>
                                    <select required name="room" required class="custom-select select2">
                                        <option value="0" disabled selected>Choose... </option>
                                        <?php 
							$room_no = $conn->query("SELECT * from room where deleteStatus = 0 and status = 1");
							while($row= $room_no->fetch_array()):
						?>
                                        <option value="<?php echo $row['room_no'] ?>"
                                            <?php echo isset($room_no) && $room_no == $row['room_no'] ? 'selected' : '' ?>>
                                            <?php echo ucwords($row['room_no']) ?></option>
                                        <?php endwhile; ?>
                                    </select>

                                    <!-- <input type="number" class="form-control" name="room" required> -->
                                </div>
                                <div class="form-group">
                                    <label>Reason</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="reason[]" class="form-check-input reason"
                                                value="Disconnect wifi" onclick='toggleRequire("reason")' required>
                                            Disconnect wifi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="reason[]" class="form-check-input reason"
                                                value="Hard drive failures" onclick='toggleRequire("reason")' required>
                                            Hard drive failures
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="reason[]" class="form-check-input reason"
                                                value="Malfunctioned computer" onclick='toggleRequire("reason")'
                                                required> Malfunctioned computer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="reason[]" class="form-check-input reason"
                                                value="Speaker error" onclick='toggleRequire("reason")' required>
                                            Speaker error
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="reason[]" class="form-check-input reason"
                                                value="Others" onclick='toggleRequire("reason")' required> Others
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Admin</label>

                                    <select class="form-control" name="admin" required>
                                        <?php
										$admins =  $conn->query("SELECT * from users WHERE type = 1");
										while ($row = $admins->fetch_assoc()) {
										?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                        <?php }

										?>
                                    </select>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="submit">
                                Save</button>
                            <a href="report_problem.php" class="btn btn-sm btn-danger col-sm-3"> Back</a>
                        </form>
                    </div>
                </div>
                <!-- Table Panel -->
            </div>
        </div>
    </main>

</html>
<script>
function toggleRequire(elClass) {
    el = document.getElementsByClassName(elClass);

    var atLeastOneChecked = false; //at least one cb is checked
    for (i = 0; i < el.length; i++) {
        if (el[i].checked === true) {
            atLeastOneChecked = true;
        }
    }

    if (atLeastOneChecked === true) {
        for (i = 0; i < el.length; i++) {
            el[i].required = false;
        }
    } else {
        for (i = 0; i < el.length; i++) {
            el[i].required = true;
        }
    }
}
</script>