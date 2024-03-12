<?php 
	include('db_connect.php');
	$query = "UPDATE problems SET status = 1 WHERE id = {$_GET['id']}";
	$status = $conn->query($query);
	if ($status) {
		echo '<script>
			alert("Update status successfully !");
			window.location.href = "index.php?page=report_problem";
		</script>';
	}
