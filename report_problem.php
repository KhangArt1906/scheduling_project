<?php
session_start();
if (!isset($_SESSION['login_id'])) {
  header('location:login.php');
}
include('./header.php');

include('./admin/db_connect.php');
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
                            <b>Report Problem</b>
                            <span>
                                <a href="report_problem_add.php"
                                    class="btn btn-primary btn-block btn-sm col-sm-2 float-right">
                                    <i class="fa fa-plus"></i> New</a>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Teacher</th>
                                            <th>Computer Number</th>
                                            <th>Room</th>
                                            <th>Reason</th>
                                            <th>Admin</th>
                                            <th>Technical Staff</th>
                                            <th>Status</th>
                                            <th width="150" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                    $i = 1;
                    $problem =  $conn->query("SELECT * from problems WHERE user_id = " . $_SESSION['login_id']);
                    while ($row = $problem->fetch_assoc()) {
                      $admin = $conn->query("SELECT * from users WHERE id = " . $row['admin_id'])->fetch_assoc();
                      if (!empty($row['technical_staff_id'])) {
                        $staff = $conn->query("SELECT * from users WHERE id = " . $row['technical_staff_id'])->fetch_assoc();
                      } else {
                        $staff = null;
                      }
                    ?>
                                        <tr>

                                            <td><?= $i++ ?></td>
                                            <td>
                                                <p><?= $row['date'] ?></p>

                                            </td>
                                            <td>
                                                <p><?= $row['teacher_name']?></p>
                                            </td>
                                            <td>
                                                <p><?= $row['computer_number'] ?></p>
                                            </td>
                                            <td>
                                                <p><?= $row['room_no'] ?></p>
                                            </td>
                                            <td>
                                                <p><?= $row['reason'] ?></p>
                                            </td>
                                            <td>
                                                <p><?= $admin['name'] ?></p>
                                            </td>
                                            <td>
                                                <p><?= !empty($staff) ? $staff['name'] : '' ?></p>
                                            </td>
                                            <td><?= $row['status'] == 0 ? '<span class="badge badge-primary">Processing</span>' : '<span class="badge badge-success">Completed</span>'; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row['status'] == 0) : ?>
                                                <a href="report_problem_edit.php?id=<?= $row['id'] ?>"
                                                    class="btn btn-sm btn-outline-info">Edit</a>
                                                <a href="report_problem_delete.php?id=<?= $row['id'] ?>"
                                                    onclick="return confirm('Are you sure to delete this report?')"
                                                    class="btn btn-sm btn-outline-danger">Delete</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table Panel -->
            </div>
        </div>
    </main>

</html>
<script>
$(document).ready(function() {
    $('table').dataTable()
})
</script>