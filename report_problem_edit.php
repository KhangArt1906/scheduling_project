<?php
session_start();
if (!isset($_SESSION['login_id'])) {
	header('location:login.php');
}
include('./header.php');
include('./admin/db_connect.php');
$problem = $conn->query("SELECT * from problems WHERE id = " . $_GET['id'])->fetch_assoc();
$reasonArr = explode(', ', $problem['reason']);
if (isset($_POST['submit'])) {
	$date = $_POST['date'];
	$computerNumber = $_POST['computer-number'];
	$room = $_POST['room'];
	$reason = $_POST['reason'];
	$reason = implode(', ', $reason);
	$admin = $_POST['admin'];
	$userId = $_SESSION['login_id'];
    $teacherName = $_POST['teacher_name'];
	$query = "UPDATE problems SET date = '{$date}', computer_number = {$computerNumber}, room = {$room}, 
		reason = '{$reason}', admin_id = {$admin}, teacher_name = {$teacherName}, user_id = {$userId} WHERE id = {$_GET['id']}";
	$status = $conn->query($query);
	if ($status) {
		echo '<script>
				alert("Update successfully !");
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
                            <b>Report Problem Edit</b>
                        </div>
                        <form action="" method="POST">
                            <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>" required>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="datetime-local" class="form-control" name="date"
                                        value="<?= $problem['date'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Teacher Name</label>
                                    <input type="datetime-local" class="form-control" name="text"
                                        value="<?= $problem['teacher_name'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Computer Number</label>
                                    <input type="number" class="form-control" name="computer-number"
                                        value="<?= $problem['computer_number'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Room</label>
                                    <input type="number" class="form-control" name="room"
                                        value="<?= $problem['room'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Reason</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="reason[]" class="form-check-input reason"
                                                value="Disconnect wifi" onclick='toggleRequire("reason")'
                                                <?= in_array('Disconnect wifi', $reasonArr) ? 'checked required' : '' ?>>
                                            Disconnect wifi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="reason[]" class="form-check-input reason"
                                                value="Hard drive failures" onclick='toggleRequire("reason")'
                                                <?= in_array('Hard drive failures', $reasonArr) ? 'checked required' : '' ?>>
                                            Hard drive failures
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="reason[]" class="form-check-input reason"
                                                value="Malfunctioned computer" onclick='toggleRequire("reason")'
                                                <?= in_array('Malfunctioned computer', $reasonArr) ? 'checked required' : '' ?>>
                                            Malfunctioned computer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="reason[]" class="form-check-input reason"
                                                value="Speaker error" onclick='toggleRequire("reason")'
                                                <?= in_array('Speaker error', $reasonArr) ? 'checked required' : '' ?>>
                                            Speaker error
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
                                        <option value="<?= $row['id'] ?>"
                                            <?= $problem['admin_id'] == $row['id'] ? 'selected' : '' ?>>
                                            <?= $row['name'] ?></option>
                                        <?php }

										?>
                                    </select>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="submit">
                                Update</button>
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