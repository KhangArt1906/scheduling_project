<?php 
	include ('./db_connect.php');
    $query = "SELECT * FROM register_scheduling order by register_time desc";  
    $result = mysqli_query($conn, $query);  
?>



<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <p style="font-weight: bold">Total Register Forms:
            <?php include 'counters/register-scheduling-count.php'?>
        </p>
        <h2 align="center">Scheduling Forms</h2>


        <div id="register_table" class="order_table">
            <table class="table table-bordered">
                <!-- <thead>
                    <tr>
                        <th style="text-align: center"><a class="column_sort" id="term_id" data-order="desc"
                                href="#">Term ID</a></th>
                        <th style="text-align: center"><a class="column_sort" id="class_term_id" data-order="desc"
                                href="#">C.Term ID</a></th>
                        <th style="text-align: center"><a class="column_sort" id="ordinal_class_term" data-order="desc"
                                href="#">O.Class Term</a></th>
                        <th style="text-align: center"><a class="column_sort" id="quantity_students" data-order="desc"
                                href="#">Quantity</a></th>
                        <th style="text-align: center"><a class="column_sort" id="teacher_name" data-order="desc"
                                href="#">Teacher</a></th>
                        <th style="text-align: center"><a class="column_sort" id="time_day" data-order="desc"
                                href="#">Days</a></th>
                        <th style="text-align: center"><a class="column_sort" id="time_lesson" data-order="desc"
                                href="#">Lesson</a></th>
                        <th style="text-align: center"><a class="column_sort" id="time_week" data-order="desc"
                                href="#">Week</a></th>
                        <th style="text-align: center"><a class="column_sort" id="register_time" data-order="desc"
                                href="#">Date</a></th>
                    </tr>
                </thead> -->
                <tbody>

                    <!-- <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                          ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row["term_id"]; ?></td>
                        <td style="text-align: center"><?php echo $row["class_term_id"]; ?></td>
                        <td style="text-align: center"><?php echo $row["ordinal_class_term"]; ?></td>
                        <td style="text-align: center"><?php echo $row["quantity_students"]; ?></td>
                        <td style="text-align: center"><?php echo $row["teacher_name"]; ?></td>
                        <td style="text-align: center"><?php echo $row["time_day"]; ?></td>
                        <td style="text-align: center"><?php echo $row["time_lesson"]; ?></td>
                        <td style="text-align: center"><?php echo $row["time_week"]; ?></td>
                        <td style="text-align: center"><?php echo $row["register_time"]; ?></td>
                    </tr>
                    <?php  
                     }  
                     ?> -->
                </tbody>
            </table>
        </div>

        <button class="btn btn-xl btn-success" id="showData">Sort Scheduling Applicants</button>
        <button class="btn btn-xl btn-danger" id="hideData">Hide Sort Scheduling Applicants</button>
        <!-- <h2 align="center">Sorted Scheduling Forms</h2> -->
        <div style="margin-top: 24px" id="table-container">

        </div>

    </div>

</div>

</div>

<script>
$(document).ready(function() {

    $("#showData").click(function(e) {
        $.ajax({
            type: "GET",
            url: "./sort_table.php",
            dataType: "html",
            success: function(data) {
                $("#table-container").html(data);

            },
        });
        e.preventDefault();
    });



    $("#hideData").click(function(e) {
        $.ajax({
            type: "GET",
            url: "./clear_table.php",
            dataType: "html",
            success: function(data) {
                $("#table-container").html(data);

            },
        });
        e.preventDefault();
    });




})


//Sort Column 
$(document).ready(function() {
    $(document).on('click', '.column_sort', function() {
        var column_name = $(this).attr("id");
        var order = $(this).data("order");
        var arrow = '';
        //glyphicon glyphicon-arrow-up  
        //glyphicon glyphicon-arrow-down  
        if (order == 'desc') {
            arrow = '&nbsp;<i class="fa-sharp fa-solid fa-arrow-down"></i>';
        } else {
            arrow = '&nbsp;<span class="fa-solid fa-arrow-up"></span>';
        }
        $.ajax({
            url: "./sort_column.php",
            method: "POST",
            data: {
                column_name: column_name,
                order: order
            },
            success: function(data) {
                $('#register_table').html(data);
                $('#' + column_name + '').append(arrow);
            }
        })
    });
});
</script>