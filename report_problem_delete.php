<?php
    include('./admin/db_connect.php');
    $status = $conn->query("DELETE FROM problems WHERE id = " . $_GET['id']);
    if ($status) {
        echo '<script>
            alert("Delete successfully !");
            window.location.href = "report_problem.php";
        </script>';
    }