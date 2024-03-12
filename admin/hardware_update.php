<?php 
session_start();
error_reporting(0);
if($_POST)
{
include('./db_connect.php');
	$id = $_POST['id'];
    $room_type = $_POST['room_type'];
    $room_type_prioprity = $_POST['room_type_prioprity'];
    $room_type_screen=$_POST['room_type_screen'];
    $room_type_ram=$_POST['room_type_ram'];
    $room_type_cpu=$_POST['room_type_cpu'];
    $room_type_hdd=$_POST['room_type_hdd'];
    $max_person=$_POST['max_person'];

	mysqli_query($conn,"update room_type set 
        room_type='$room_type', 
         room_type_prioprity = '$room_type_prioprity',
        room_type_screen='$room_type_screen', room_type_ram='$room_type_ram',
        room_type_cpu='$room_type_cpu',room_type_hdd='$room_type_hdd'
        ,max_person='$max_person' 
        where room_type_id='$id'")or die(mysqli_error($conn));
	echo "<script type='text/javascript'>alert('Successfully updated a room type!');</script>";	
	echo "<script>document.location='index.php?page=room_type'</script>";  
}	
	
?>