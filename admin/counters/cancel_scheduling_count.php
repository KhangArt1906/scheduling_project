<?php 
    error_reporting(0);
    include '../db_connect.php';
    $sql = "SELECT * FROM cancel_scheduling where cancel_status = 1";
    $query = $conn->query($sql);

    echo "$query->num_rows";

?>