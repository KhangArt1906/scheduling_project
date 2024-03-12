<?php 
	include('db_connect.php');
	$problem = $conn->query("SELECT * from problems WHERE id = " . $_GET['id'])->fetch_assoc();
	if (isset($_POST['submit'])) {
		$staff = $_POST['staff'];
		$query = "UPDATE problems SET technical_staff_id = {$staff} WHERE id = {$_GET['id']}";
		$status = $conn->query($query);
		if ($status) {
			echo '<script>
				alert("Assign successfully !");
				window.location.href = "index.php?page=report_problem";
			</script>';
		}
	}
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
						<b>Report Problem Assign</b>
					</div>
					<form action="" method="POST">
                        <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>" required>
						<div class="card-body">
							<div class="form-group">
								<label>Technical Staffs</label>

								<select class="form-control" name="staff" required>
									<?php
									$staffs =  $conn->query("SELECT * from users WHERE type = 4");
									while ($row = $staffs->fetch_assoc()) {
									?>
										<option value="<?= $row['id'] ?>" <?= $problem['technical_staff_id'] == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
									<?php }

									?>
								</select>

							</div>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="submit"> Update</button>
									<a href="index.php?page=report_problem" class="btn btn-sm btn-danger col-sm-3"> Back</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
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