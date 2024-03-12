<?php  
 //sort.php  
 $connect = mysqli_connect("localhost", "root", "", "faculty_scheduling");  
 $output = '';  
 $order = $_POST["order"];  
 if($order == 'desc')  
 {  
      $order = 'asc';  
 }  
 else  
 {  
      $order = 'desc';  
 }  
 $query = "SELECT * from register_scheduling 
 order by ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($connect, $query);  
 $output .= '  
 <table class="table table-bordered">  
    <thead>
    <th style="text-align: center"><a class="column_sort" id="term_id" data-order="'.$order.'" href="#">Term ID</a></th>  
    <th style="text-align: center"><a class="column_sort" id="class_term_id" data-order="'.$order.'" href="#">Class Term ID</a></th>  
    <th style="text-align: center"><a class="column_sort" id="ordinal_class_term" data-order="'.$order.'" href="#">Ordinal Class Term</a></th>  
    <th style="text-align: center"><a class="column_sort" id="quantity_students" data-order="'.$order.'" href="#">Quantity</a></th> 
    <th style="text-align: center"><a class="column_sort" id="teacher_name" data-order="'.$order.'" href="#">Teacher Name</a></th>  
    <th style="text-align: center"><a class="column_sort" id="time_day" data-order="'.$order.'" href="#">Days</a></th>
    <th style="text-align: center"><a class="column_sort" id="time_lesson" data-order="'.$order.'" href="#">Lesson</a></th>  
    <th style="text-align: center"><a class="column_sort" id="time_week" data-order="'.$order.'" href="#">Week</a></th>  
    <th style="text-align: center"><a class="column_sort" id="time_session" data-order="'.$order.'" href="#">Session</a></th>  
    <th style="text-align: center"><a class="column_sort" id="register_time" data-order="'.$order.'" href="#">Registered Time</a></th>  
    </thead>
 ';  


 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tbody> 
      <td style="text-align: center">' . $row["term_id"] . '</td>  
      <td style="text-align: center">' . $row["class_term_id"] . '</td>  
      <td style="text-align: center">' . $row["ordinal_class_term"] . '</td>  
      <td style="text-align: center">' . $row["quantity_students"] . '</td>  
      <td style="text-align: center">' . $row["teacher_name"] . '</td>  
      <td style="text-align: center">' . $row["time_day"] . '</td>
      <td style="text-align: center">' . $row["time_lesson"] . '</td>  
      <td style="text-align: center">' . $row["time_week"] . '</td>  
      <td style="text-align: center">' . $row["time_session"] . '</td>  
      <td style="text-align: center">' . $row["register_time"] . '</td>   
      </tbody>
      ';  
 }  
 $output .= '</table>';  
 echo $output;  
 ?>