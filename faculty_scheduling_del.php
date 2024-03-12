<?php 
session_start();
include("./admin/db_connect.php");
$id=$_REQUEST['id'];
$result=mysqli_query($conn,"DELETE FROM cancel_scheduling WHERE cancel_id ='$id'")
	or die(mysqli_error($conn));
	echo "<script type='text/javascript'>alert('Successfully deleted a cancel scheduling form!');</script>";	
	echo "<script>document.location='./faculty_cancel_scheduling.php'</script>";  
?>