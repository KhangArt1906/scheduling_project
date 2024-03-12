<?php
    $k= $_POST['id'];

    $k = trim($k);

    if($k == 'Choose'){
        
    }
    include('./db_connect.php');
    $sql = "SELECT distinct
    software_id, software_name, software_version, term.term_id, term_title,
    term_credit  from software 
    inner join semester_year inner join term
    where software.term_id = term.term_id and term.sy_stt = semester_year.sy_stt
    and sy_deadlinedate = '{$k}'";

    $res = mysqli_query($conn, $sql);

    while($rows = mysqli_fetch_array($res)){
?>

<tr align="center">
    <td><?php echo $rows['software_id']; ?></td>
    <td><?php echo $rows['software_name']; ?></td>
    <td><?php echo $rows['software_version']; ?></td>
    <td><?php echo $rows['term_id']; ?></td>
    <td><?php echo $rows['term_title']; ?></td>
    <td><?php echo $rows['term_credit']; ?></td>
    <td><?php echo $k; ?></td>
</tr>

<?php 
}



?>