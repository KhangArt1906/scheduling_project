<?php
	include'./db_connect.php'; 
	if (isset($_POST['approve'])){
		$appid = $_POST['appid'];
		$sql = "UPDATE cancel_scheduling SET cancel_status='1' WHERE cancel_id = '$appid'";
		$run = mysqli_query($conn,$sql);
		if($run == true){
			
			echo "<script> 
					alert('Application Approved');
					window.open('index.php?page=form_cancel_scheduling','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed To Approved');
			</script>";
		}
	}
	
 ?>