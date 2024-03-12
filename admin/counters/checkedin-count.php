<?php 
     error_reporting(0);
     include '../db_connect.php';
    $sql = "SELECT * FROM room WHERE check_in_status = '1'";
    $query = $conn->query($sql);

    echo "$query->num_rows";

?>