<?php 
    error_reporting(0);
    include '../db_connect.php';
    $sql = "SELECT * FROM room WHERE deleteStatus = '0'";
    $query = $conn->query($sql);

    echo "$query->num_rows";

?>