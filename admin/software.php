<div class="content-wrapper">
    <div class="container">

        <?php  
        
        include('./db_connect.php');
        $sql = "Select distinct sy_deadlinedate from semester_year;";
        $res = mysqli_query($conn, $sql);
       ?>
        <!-- Full Width Column -->
        <div class="software-content">

            <div class="header__software-content">

                <h4 style="padding: 1.125rem">List of Software Following Semester</h4>
                <span style="display: flex; justify-content: flex-end; gap: 10px; margin: 10px">
                    Semester - Year
                    <select id="year" onchange="selectYear()">

                        <option value="choose" selected="true">Choose</option>
                        <?php while($rows = mysqli_fetch_assoc($res)){
                           
                           ?>
                        <option value="<?php echo $rows['sy_deadlinedate']; ?>"><?php

                   echo $rows['sy_deadlinedate'];

                       ?>
                            <?php
                       }
                       ?>
                        </option>
                    </select>
                </span>

            </div>


            <table id="example1" class="table table-bordered table-striped" style="margin-right:-10px">
                <thead>
                    <tr>
                        <th style="text-align: center;">Mã Học Phần</th>
                        <th style="text-align: center;">Mã Phần Mềm</th>
                        <th style="text-align: center;">Tên Phần Mềm</th>
                        <th style="text-align: center;">Phiên Bản</th>
                        <th style="text-align: center;">Tên Học Phần</th>
                        <th style="text-align: center;">Tín Chỉ</th>
                        <th style="text-align: center;">Semester</th>
                    </tr>
                </thead>
                <tbody id="ans">

                    <?php 
                         include('./db_connect.php');
                       $run = "SELECT distinct
                       software_id, software_name, sy_deadlinedate, software_version, term.term_id, term_title,
                       term_credit, sy_deadlinedate  from software 
                           inner join semester_year inner join term
                   where software.term_id = term.term_id and term.sy_stt = semester_year.sy_stt order by term.term_id;
                       ";

                       $result = mysqli_query($conn, $run);

                       while($row = mysqli_fetch_assoc($result)){

                       ?>

                    <tr align="center">
                        <td><?php echo $row['term_id']; ?></td>
                        <td><?php echo $row['software_id']; ?></td>
                        <td><?php echo $row['software_name']; ?></td>
                        <td><?php echo $row['software_version']; ?></td>
                        <td><?php echo $row['term_title']; ?></td>
                        <td><?php echo $row['term_credit']; ?></td>
                        <td><?php echo $row['sy_deadlinedate']; ?></td>
                    </tr>


                    <?php 
                       }
                       ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
function onchange(e) {
    if (e.currentTarget.value === 'choose') {
        window.location.reload();
    }
}

document.getElementById('year').addEventListener('change', onchange);

function selectYear() {
    var x = document.getElementById("year").value;


    $.ajax({
        url: "showYear.php",
        method: "POST",
        data: {
            id: x
        },
        success: function(data) {
            $("#ans").html(data);
        }
    })
}
</script>