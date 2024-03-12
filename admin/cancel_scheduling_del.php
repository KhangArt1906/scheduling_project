<?php
include("./db_connect.php");
$id=$_REQUEST['id'];
$result=mysqli_query($conn,"DELETE FROM cancel_scheduling WHERE cancel_id ='$id'")
	or die(mysqli_error($con));
	echo "<script type='text/javascript'>alert('Successfully deleted a cancel scheduling form!');
	window.open('index.php?page=form_cancel_scheduling','_self');
	</script>";
	
?>