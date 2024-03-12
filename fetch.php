<?php
 include('./admin/db_connect.php');
 error_reporting(0);

 
if (isset($_POST['ordinary'])) {
    $class_term_id = $_POST['class_term_id'];

    $sql = "select distinct class_term_id from class_term where class_term_name ='$class_term_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $sub = mysqli_fetch_assoc($result);
        echo $sub['ordinary'];
    } else {
        echo "0";
    }
}

?>