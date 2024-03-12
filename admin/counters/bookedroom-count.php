<?php 
    include './db.php';  error_reporting(0);
    include '../db_connect.php';
    $sql = "SELECT * FROM room WHERE status = '1'";
    $query = $conn->query($sql);

    echo "$query->num_rows";

?>