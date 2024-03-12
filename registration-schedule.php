<?php 
    session_start();
	include ('./header.php');
    include('./admin/db_connect.php');
?>




<style>
#registrationForm {
    display: inline !important;
}
</style>


<body>
    <div class="content-wrapper">
        <a href="./index.php" style="position: relative; left: 18%; top: 50px">
            <i class="fa fa-home text-green"></i>
            Scheduling Calendar</a>
        <div class="container" style="margin-top: 70px; padding-bottom: 40px">
            <!-- Content Header (Page header) -->
            <section id="registrationForm">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Welcome to Register
                                            Scheduling
                                        </p>

                                        <form action="" method="post" class="mx-1 mx-md-4">



                                            <h4><i class="fa fa-info"></i> Information Group Scheduling</h4>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <i class="fa fa-folder"></i>
                                                    <label style="font-weight: bold;" class="form-label"
                                                        for="form3Example1c">Term ID
                                                    </label>

                                                    <select required name="term_id" class="form-control">
                                                        <?php 
                                                      
                                                      $term = $conn->query("SELECT * from term");
                                                      while($row= $term->fetch_array()):
                                                      ?>
                                                        <option value="<?php echo $row['term_id'] ?>"
                                                            <?php echo isset($term) && $term == $row['term_id'] ? 'selected' : '' ?>>
                                                            <?php echo ucwords($row['term_id']) ?></option>
                                                        <?php endwhile; ?>
                                                    </select>

                                                    <!-- <input type="text" name="term_id" id="form3Example1c"
                                                        class="form-control" /> -->
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <i class="fa fa-users"></i>
                                                    <label style="font-weight: bold;" class="form-label"
                                                        for="form3Example3c">Class Term ID</label>

                                                    <select onchange="fetch_ordinary(this.value)" required
                                                        name="class_term_id" id="class_term_id" class="form-control">
                                                        <?php 
                                                      
                                                      $class_term = $conn->query("SELECT * from class_term");
                                                      while($row= $class_term->fetch_array()):
                                                      ?>
                                                        <option value="<?php echo $row['class_term_name'] ?>"
                                                            <?php echo isset($class_term) && $class_term == $row['class_term_name'] ? 'selected' : '' ?>>
                                                            <?php echo ucwords($row['class_term_name']) ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <i class="fas fa-lock me-3 fa-fw"></i>
                                                    <label style="font-weight: bold;" class="form-label"
                                                        for="form3Example4c">Ordinal Group
                                                        Term</label>
                                                    <input placeholder="Group: M03" required type="text"
                                                        name="ordinal_class_term" id="ordinary" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <i class="fa fa-user-plus"></i>
                                                    <label style="font-weight: bold;" class="form-label"
                                                        for="form3Example4cd">Quantity
                                                        Students</label>
                                                    <input placeholder="40" required type="number"
                                                        name="quantity_students" id="form3Example4cd"
                                                        class="form-control" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">


                                                    <label style="font-weight: bold;" for="teacher_name"
                                                        class="control-label">
                                                        <i class="fa fa-user-tie"></i>
                                                        Faculty </label>
                                                    <select name="teacher_name" required class="custom-select select2">
                                                        <option value="<?php echo $_SESSION['login_name'] ?>" selected>
                                                            <?php echo $_SESSION['login_name'] ?></option>
                                                    </select>
                                                </div>
                                            </div>


                                            <span>--------------------------------------------------------</span>


                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <h4> <i class="fa fa-calendar-check"></i> Information Scheduling
                                                    </h4>

                                                </div>
                                            </div>


                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">

                                                    <label style="font-weight: bold;" class="form-label"
                                                        for="form3Example4cd">
                                                        <i class="fa fa-calendar-week"></i>
                                                        Weeks</label>
                                                    <div class="one">
                                                        <label style="display: block; font-weight: bold"
                                                            class="form-label" for="form3Example4cd"> 1 <i
                                                                class="fa fa-arrow-right"></i> 4
                                                        </label>

                                                        <input type="checkbox" name="time_week[]" value="1" /> 1
                                                        <input type="checkbox" name="time_week[]" value="2" /> 2
                                                        <input type="checkbox" name="time_week[]" value="3" /> 3
                                                        <input type="checkbox" name="time_week[]" value="4" /> 4
                                                    </div>
                                                    <div class="two">
                                                        <label style="display: block; font-weight: bold"
                                                            class="form-label" for="form3Example4cd">5 <i
                                                                class="fa fa-arrow-right"></i>
                                                            8</label>
                                                        <input type="checkbox" name="time_week[]" value="5" /> 5
                                                        <input type="checkbox" name="time_week[]" value="6" /> 6
                                                        <input type="checkbox" name="time_week[]" value="7" /> 7
                                                        <input type="checkbox" name="time_week[]" value="8" /> 8
                                                    </div>

                                                    <div class="three">
                                                        <label style="display: block; font-weight: bold"
                                                            class="form-label" for="form3Example4cd">9 <i
                                                                class="fa fa-arrow-right"></i> 12
                                                        </label>
                                                        <input type="checkbox" name="time_week[]" value="9" /> 9
                                                        <input type="checkbox" name="time_week[]" value="10" /> 10
                                                        <input type="checkbox" name="time_week[]" value="11" /> 11
                                                        <input type="checkbox" name="time_week[]" value="12" /> 12
                                                    </div>

                                                    <div class="four">
                                                        <label style="display: block; font-weight: bold"
                                                            class="form-label" for="form3Example4cd"> 13 <i
                                                                class="fa fa-arrow-right"></i>
                                                            16
                                                        </label>
                                                        <input type="checkbox" name="time_week[]" value="13" /> 13
                                                        <input type="checkbox" name="time_week[]" value="14" /> 14
                                                        <input type="checkbox" name="time_week[]" value="15" /> 15
                                                        <input type="checkbox" name="time_week[]" value="16" /> 16
                                                    </div>

                                                    <div class="five">
                                                        <label style="display: block; font-weight: bold"
                                                            class="form-label" for="form3Example4cd">17 <i
                                                                class="fa fa-arrow-right"></i>
                                                            20</label>
                                                        <input type="checkbox" name="time_week[]" value="17" /> 17
                                                        <input type="checkbox" name="time_week[]" value="18" /> 18
                                                        <input type="checkbox" name="time_week[]" value="19" /> 19
                                                        <input type="checkbox" name="time_week[]" value="20" /> 20

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label style="font-weight: bold;" for="time_day" class="form-label">
                                                        <i class="fa fa-clock"></i> Days
                                                    </label>
                                                    <div class="d-flex flex-wrap">
                                                        <div style="margin-right: 10px;">
                                                            <input type="checkbox" name="time_day[]" id="monday"
                                                                value="2">
                                                            <label for="monday">Monday</label>
                                                        </div>
                                                        <div style="margin-right: 10px;">
                                                            <input type="checkbox" name="time_day[]" id="tuesday"
                                                                value="3">
                                                            <label for="tuesday">Tuesday</label>
                                                        </div>
                                                        <div style="margin-right: 10px;">
                                                            <input type="checkbox" name="time_day[]" id="wednesday"
                                                                value="4">
                                                            <label for="wednesday">Wednesday</label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <div style="margin-right: 10px;">
                                                            <input type="checkbox" name="time_day[]" id="thursday"
                                                                value="5">
                                                            <label for="thursday">Thursday</label>
                                                        </div>
                                                        <div style="margin-right: 10px;">
                                                            <input type="checkbox" name="time_day[]" id="friday"
                                                                value="6">
                                                            <label for="friday">Friday</label>
                                                        </div>
                                                        <div style="margin-right: 10px;">
                                                            <input type="checkbox" name="time_day[]" id="saturday"
                                                                value="7">
                                                            <label for="saturday">Saturday</label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <div style="margin-right: 10px;">
                                                            <input type="checkbox" name="time_day[]" id="sunday"
                                                                value="8">
                                                            <label for="sunday">Sunday</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>










                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">

                                                    <label style="font-weight: bold;" class="form-label"
                                                        for="form3Example4cd">
                                                        <i class="fa fa-hourglass-half"></i>
                                                        Lesson</label>
                                                    <div class="one">
                                                        <label style="display: block; font-weight: bold"
                                                            class="form-label" for="form3Example4cd"> Morning
                                                        </label>

                                                        <input type="checkbox" name="time_lesson[]" value="1" /> 1
                                                        <input type="checkbox" name="time_lesson[]" value="2" /> 2
                                                        <input type="checkbox" name="time_lesson[]" value="3" /> 3
                                                        <input type="checkbox" name="time_lesson[]" value="4" /> 4
                                                        <input type="checkbox" name="time_lesson[]" value="5" /> 5
                                                    </div>
                                                    <div class="two">
                                                        <label style="display: block; font-weight: bold"
                                                            class="form-label" for="form3Example4cd">Afternoon</label>
                                                        <input type="checkbox" name="time_lesson[]" value="6" /> 6
                                                        <input type="checkbox" name="time_lesson[]" value="7" /> 7
                                                        <input type="checkbox" name="time_lesson[]" value="8" /> 8
                                                        <input type="checkbox" name="time_lesson[]" value="9" /> 9
                                                    </div>

                                                    <div class="three">
                                                        <label style="display: block; font-weight: bold"
                                                            class="form-label" for="form3Example4cd">Evening
                                                        </label>
                                                        <input type="checkbox" name="time_lesson[]" value="10" /> 10
                                                        <input type="checkbox" name="time_lesson[]" value="11" /> 11
                                                        <input type="checkbox" name="time_lesson[]" value="12" /> 12
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 ">
                                                <button id="registerBtn" value="register" name="register" type="submit"
                                                    class="btn btn-primary btn-lg">Register</button>
                                            </div>

                                        </form>

                                    </div>
                                    <div
                                        class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                            class="img-fluid" alt="Sample image">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </div>
</body>

<?php

error_reporting(0);
include '../db_connect.php';
$sql = "SELECT * FROM room WHERE status IS NULL";
$query = $conn->query($sql);

$run = "SELECT * FROM register_scheduling";
$query_2 = $conn->query($run);

$sum_of_avairoom = $query->num_rows;
$sum_of_register = $query_2->num_rows;



date_default_timezone_set('Asia/Ho_Chi_Minh');
$date = date('d-m-y h:i:s');
//echo $date;




if($sum_of_register < $sum_of_avairoom){
    echo "<script>
    registrationForm.style.display = 'block';
    </script>";
}
else if($sum_of_register > $sum_of_avairoom){
    echo "<script>
    window.alert('We are out of rooms,please coming soon for another time');
    window.location.href = '/School Faculty Scheduling/scheduling/index.php';
    </script>";
}





?>
<?php 
  include('./admin/db_connect.php');
 if(isset($_POST['register'])){
    $term_id = $_POST['term_id'];
    $class_term_id = $_POST['class_term_id'];
    $ordinal_class_term = $_POST['ordinal_class_term'];
    $quantity_students = $_POST['quantity_students'];
    $teacher_name = $_POST['teacher_name'];
    // $time_day = implode(", ",$_POST['time_day']);
    $time_day = $_POST['time_day'];
    $time_lesson = $_POST['time_lesson'];
    $time_week = $_POST['time_week'];
    // $time_session = $_POST['time_session'];
    $register_time = date("y-m-d H:i:s");


    //Implode
    $time_day_implode = implode(",",$time_day);
    $time_lesson_implode = implode(",",$time_lesson);
    $time_week_implode = implode(",",$time_week);
    
         
        $sql = "INSERT INTO register_scheduling(term_id,class_term_id,ordinal_class_term,quantity_students,
    teacher_name,time_day,time_lesson,time_week,register_time)
    values('$term_id', '$class_term_id', '$ordinal_class_term', '$quantity_students', '$teacher_name', '$time_day_implode',
    '$time_lesson_implode','$time_week_implode','$register_time')";
   $run = mysqli_query($conn,$sql);
   if($run == true){
        
    echo "<script> 
        alert('Successfully to register scheduling');
        window.location.href = './scheduling_form.php'
        </script>";
   }else{
    echo "<script> 
    alert('Failed To Register');
    </script>";
   }

}
?>


</html>

<script>
function fetch_ordinary(val) {
    $.ajax({
        type: "post",
        url: "./fetch.php",
        data: {
            class_term_id: val,
            ordinary: "",
        },
        success: function(response) {
            $("#ordinary").html(response);
        },
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('form3Example4cd');
    var selectedDays = [];

    select.addEventListener('change', function(event) {
        var option = event.target.selectedOptions[0];
        var optionValue = option.value;
        var optionText = option.text;

        if (selectedDays.length < 2 && !selectedDays.includes(optionValue)) {
            selectedDays.push(optionValue);
            renderSelectedDays();
        }
    });

    function renderSelectedDays() {
        var selectedDaysContainer = document.getElementById('selectedDays');
        selectedDaysContainer.innerHTML = '';

        selectedDays.forEach(function(day) {
            var dayName;
            switch (parseInt(day)) {
                case 1:
                    dayName = 'Sunday';
                    break;
                case 2:
                    dayName = 'Monday';
                    break;
                case 3:
                    dayName = 'Tuesday';
                    break;
                case 4:
                    dayName = 'Wednesday';
                    break;
                case 5:
                    dayName = 'Thursday';
                    break;
                case 6:
                    dayName = 'Friday';
                    break;
                case 7:
                    dayName = 'Saturday';
                    break;
                default:
                    dayName = '';
                    break;
            }

            var removeButton = document.createElement('button');
            removeButton.innerHTML = '&times;';
            removeButton.className = 'remove-day';
            removeButton.addEventListener('click', function() {
                var index = selectedDays.indexOf(day);
                selectedDays.splice(index, 1);
                renderSelectedDays();
            });

            var dayElement = document.createElement('div');
            dayElement.textContent = dayName;
            dayElement.appendChild(removeButton);

            selectedDaysContainer.appendChild(dayElement);
        });
    }
});
</script>