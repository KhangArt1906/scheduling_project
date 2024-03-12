<?php 
	include ('./header.php');
    include('./db_connect.php');
?>




<style>
#registrationForm {
    display: inline !important;
}
</style>


<body>
    <div class="content-wrapper">
        <div class="container">
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
                                                    <!-- <input placeholder="DI20V7F3" required type="text"
                                                        name="class_term_id" id="form3Example3c" class="form-control" /> -->
                                                    <select required name="class_term_id" class="form-control">
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
                                                        name="ordinal_class_term" id="form3Example4c"
                                                        class="form-control" />
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
                                                    <!-- <i class="fa fa-user-tie"></i>
                                                    <label class="form-label" for="form3Example4cd">Giang
                                                        Vien</label>
                                                    <input placeholder="" required type="text" name="teacher_name" id="form3Example4cd"
                                                        class="form-control" />
                                                    
                                                    -->

                                                    <label style="font-weight: bold;" for="teacher_name"
                                                        class="control-label">
                                                        <i class="fa fa-user-tie"></i>
                                                        Faculty </label>
                                                    <select name="teacher_name" id="" class="custom-select select2">
                                                        <option value="0" disabled selected>All</option>
                                                        <?php 
							               $faculty = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM faculty order by concat(lastname,', ',firstname,' ',middlename) asc");
                                           while($row= $faculty->fetch_array()):
						                    ?>
                                                        <option value="<?php echo $row['name'] ?>"
                                                            <?php echo isset($faculty_id) && $faculty_id == $row['name'] ? 'selected' : '' ?>>
                                                            <?php echo ucwords($row['name']) ?></option>
                                                        <?php endwhile; ?>
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

                                                    <label style="font-weight: bold;" for="time_day" class="form-label"
                                                        for="form3Example4cd">
                                                        <i class="fa fa-clock"></i>

                                                        Days</label>
                                                    <!-- <select multiple name="time_day[]" class="custom-select select2"
                                                        required>
                                                        <option>Monday</option>
                                                        <option>Tuesday</option>
                                                        <option>Wednesday</option>
                                                        <option>Thursday</option>
                                                        <option>Friday</option>
                                                        <option>Saturday</option>
                                                        <option>Sunday</option>
                                                    </select> -->
                                                    <input placeholder="Monday, Tuesday, Wednesday,..." required
                                                        type="text" name="time_day" id="form3Example4cd"
                                                        class="form-control" />
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

                                                    <label style="font-weight: bold;" class="form-label"
                                                        for="form3Example4cd">
                                                        <i class="fa fa-cloud"></i>
                                                        Session</label>
                                                    <!-- <textarea required name="time_register"
                                                        style="margin-bottom: 10px; display: block; width: 260px"
                                                        placeholder="Buổi Sáng/Chiều/Tối"></textarea> -->
                                                    <select name="time_session" id="time_session">
                                                        <option value="Morning">Morning</option>
                                                        <option value="Afternoon">Afternoon</option>
                                                        <option value="Evening">Evening</option>
                                                    </select>
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
 include('./db_connect.php');
 if(isset($_POST['register'])){
    $term_id = $_POST['term_id'];
    $class_term_id = $_POST['class_term_id'];
    $ordinal_class_term = $_POST['ordinal_class_term'];
    $quantity_students = $_POST['quantity_students'];
    $teacher_name = $_POST['teacher_name'];
    $time_day = implode(", ",$_POST['time_day']);
    $time_lesson = $_POST['time_lesson'];
    $time_week = $_POST['time_week'];
    $time_session = $_POST['time_session'];
    $register_time = date("y-m-d H:i:s");


    //Implode
    $time_lesson_implode = implode(",",$time_lesson);
    $time_week_implode = implode(",",$time_week);
    
         
        $sql = "INSERT INTO register_scheduling(term_id,class_term_id,ordinal_class_term,quantity_students,
    teacher_name,time_day,time_lesson,time_week,time_session,register_time)
    values('$term_id', '$class_term_id', '$ordinal_class_term', '$quantity_students', '$teacher_name', '$time_day',
    '$time_lesson_implode','$time_week_implode','$time_session','$register_time')";
   $run = mysqli_query($conn,$sql);
   if($run == true){
        
    echo "<script> 
        alert('Leave Requested, Please wait for approval status');
        window.location.href = 'index.php?page=registration-schedule'
        </script>";
   }else{
    echo "<script> 
    alert('Failed To Apply');
    </script>";
   }

}
?>


</html>
<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/tether.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>