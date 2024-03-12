<?php include('db_connect.php');
error_reporting(0);
?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Report Problem</b>
                        <?php if ($_SESSION['login_type'] == "2"): ?>
                        <span>
                            <a href="index.php?page=report_problem_add"
                                class="btn btn-primary btn-block btn-sm col-sm-2 float-right">
                                <i class="fa fa-plus"></i> New</a>
                        </span>
                        <?php endif; ?>
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
                                        <?php if ($_SESSION['login_type'] != "1"): ?>
                                        <th>Admin</th>
                                        <?php endif ?>
                                        <?php if ($_SESSION['login_type'] != "4"): ?>
                                        <th>Technical Staff</th>
                                        <?php endif ?>
                                        <th>Status</th>
                                        <th width="150" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
										$i = 1;
										if ($_SESSION['login_type'] == "1") {
											$problem =  $conn->query("SELECT * from problems WHERE admin_id = " . $_SESSION['login_id']);
										} elseif ($_SESSION['login_type'] == "2") {
											$problem =  $conn->query("SELECT * from problems WHERE user_id = " . $_SESSION['login_id']);
										} else {
											$problem =  $conn->query("SELECT * from problems WHERE technical_staff_id = " . $_SESSION['login_id']);
										}
										while ($row = $problem->fetch_assoc()) {
											$user = $conn->query("SELECT * from users WHERE id = " . $row['user_id'])->fetch_assoc();
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
                                            <p><?= $row['teacher_name'] ?></p>

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
                                        <?php if ($_SESSION['login_type'] != "1"): ?>
                                        <td>
                                            <p><?= $admin['name'] ?></p>
                                        </td>
                                        <?php endif; ?>
                                        <?php if ($_SESSION['login_type'] != "4"): ?>
                                        <td>
                                            <p><?= !empty($staff) ? $staff['name'] : '' ?></p>
                                        </td>
                                        <?php endif ?>
                                        <td><?= $row['status'] == 0 ? '<span class="badge badge-primary">Processing</span>' : '<span class="badge badge-success">Completed</span>'; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($_SESSION['login_type'] == "2"): ?>
                                            <?php if ($row['status'] == 0): ?>
                                            <a href="index.php?page=report_problem_edit&id=<?= $row['id'] ?>"
                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                            <button class="btn btn-sm btn-outline-danger delete_report" type="button"
                                                data-id="<?= $row['id'] ?>">Delete</button>
                                            <?php endif; ?>
                                            <?php elseif ($_SESSION['login_type'] == "4"): ?>
                                            <?php if ($row['status'] == 0): ?>
                                            <a href="index.php?page=report_problem_update_status&id=<?= $row['id'] ?>"
                                                class="btn btn-sm btn-outline-success">Completed</a>
                                            <?php endif; ?>
                                            <?php elseif ($_SESSION['login_type'] == "1"): ?>
                                            <?php if ($row['status'] == 0): ?>
                                            <a href="index.php?page=assign_technical_staff&id=<?= $row['id'] ?>"
                                                class="btn btn-sm btn-outline-info">Assign</a>
                                            <?php endif; ?>
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

</div>
<script>
$(document).ready(function() {
    $('table').dataTable()
})
$('.delete_report').click(function() {
    _conf("Are you sure to delete this report?", "delete_report", [$(this).attr('data-id')], 'mid-large')
})

function delete_report($id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_report',
        method: 'POST',
        data: {
            id: $id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            }
        }
    })
}
</script>