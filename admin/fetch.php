<?php
 include('./db_connect.php');
 error_reporting(0);

 
if (isset($_POST['description'])) {
    $subject = $_POST['subject'];

    $sql = "select distinct description from subjects where subject ='$subject'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $sub = mysqli_fetch_assoc($result);
        echo $sub['description'];
    } else {
        echo "0";
    }
}

?>