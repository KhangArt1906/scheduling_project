<style>
.collapse a {
    text-indent: 10px;
}

nav#sidebar {
    background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important
}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark'>

    <div class="sidebar-list">
        <?php if($_SESSION['login_type'] == 1): ?>
        <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i
                    class="fa fa-home"></i></span> Home</a>
        <a href="index.php?page=room_type" class="nav-item nav-room_type"><span class='icon-field'><i
                    class="fa fa-toolbox"></i></span> Room Configuration</a>
        <a href="./room_mang_reserve/room_mang.php" class="nav-item nav-room-management"><span class='icon-field'><i
                    class="fa fa-door-open"></i></span>
            Room Management</a>
        <a href="./room_mang_reserve/reservation.php" class="nav-item nav-reservation"><span class='icon-field'><i
                    class="fa fa-address-book"></i></span>
            Reservation</a>
        <a href="index.php?page=software" class="nav-item nav-software"><span class='icon-field'><i
                    class="fa fa-gamepad"></i></span> Subjects Software</a>
        <a href="index.php?page=hardware-software" class="nav-item nav-hardware-software"><span class='icon-field'><i
                    class="fa fa-laptop-code"></i></span> Hardware Software</a>
        <a href="index.php?page=room_software" class="nav-item nav-room-software"><span class='icon-field'><i
                    class="fa fa-sd-card"></i></span> Room Software</a>
        <!-- <a href="index.php?page=registration-schedule" class="nav-item nav-cancel-scheduling"><span
                class='icon-field'><i class="fa fa-registered"></i></span> Register Scheduling</a> -->
        <a href="index.php?page=register_scheduling_main" class="nav-item nav-cancel-scheduling"><span
                class='icon-field'><i class="fa fa-sort"></i></span> Scheduling Forms</a>
        <a href="index.php?page=form_cancel_scheduling" class="nav-item nav-cancel-scheduling"><span
                class='icon-field'><i class="fa fa-clock"></i></span> Cancel Scheduling</a>
        <a href="index.php?page=duyet_thong_tin" class="nav-item nav-checked"><span class='icon-field'><i
                    class="fa fa-check"></i></span> Checked Scheduling</a>
        <a href="index.php?page=schedule" class="nav-item nav-schedule"><span class='icon-field'><i
                    class="fa fa-calendar-day"></i></span> Schedule</a>
        <a href="index.php?page=faculty" class="nav-item nav-faculty"><span class='icon-field'><i
                    class="fa fa-user-tie"></i></span> Faculty</a>
        <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i
                    class="fa fa-users"></i></span> Users</a>
        <a href="index.php?page=subjects" class="nav-item nav-subjects"><span class='icon-field'><i
                    class="fa fa-book"></i></span> Subjects</a>

        <!-- <a href="index.php?page=courses" class="nav-item nav-courses"><span class='icon-field'><i
                    class="fa fa-list"></i></span> Courses</a> -->

        <?php endif; ?>
        <?php if($_SESSION['login_type'] != 3): ?>
        <a href="index.php?page=report_problem"
            class="nav-item <?= in_array($_GET['page'], ['report_problem', 'report_problem_add', 'report_problem_edit']) ? 'active' : '' ?>"><span
                class='icon-field'><i class="fa fa-bug"></i></span> Report Problem</a>
        <?php endif ?>
    </div>

</nav>
<script>
$('.nav_collapse').click(function() {
    console.log($(this).attr('href'))
    $($(this).attr('href')).collapse()
})
$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>