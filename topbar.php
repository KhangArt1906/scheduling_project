<style>
.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>



<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0;min-height: 3.5rem">
    <div class="container-fluid mt-2 mb-2">
        <div class="col-lg-12">
            <div class="col-md-1 float-left" style="display: flex;">

            </div>
            <div class="col-md-4 float-left text-white">
                <large><b>School Faculty Scheduling System</b>
                </large>
            </div>

            <div class="col-md-4 float-left text-white">
                <large>

                    <li class="dropdown notifications-menu">
                        <a style="color: #fff" href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user text-orange"></i>
                            Scheduling
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <!-- Menu Toggle Button -->
                                <ul class="menu">
                                    <li>
                                        <!-- start notification -->
                                        <a href="./faculty_cancel_scheduling.php">
                                            <i class="glyphicon glyphicon-user text-green"></i> Cancel Scheduling
                                        </a>
                                    </li><!-- end notification -->
                                    <li>
                                        <!-- start notification -->
                                        <a href="./registration-schedule.php">
                                            <i class="glyphicon glyphicon-user text-green"></i> Register Scheduling
                                        </a>
                                    </li><!-- end notification -->
                                </ul>
                            </li>

                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="./report_problem.php">
                                            <i class="glyphicon glyphicon-user text-green"></i> Report Problems
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="./scheduling_form.php">
                                            <i class="glyphicon glyphicon-user text-green"></i>
                                            Scheduling Forms</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="./index.php">
                                            <i class="glyphicon glyphicon-user text-green"></i>
                                            Scheduling Calendar</a>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </li>

                </large>
            </div>
            <div class="float-right">
                <div class=" dropdown mr-4">
                    <a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
                    <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                        <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i>
                            Logout</a>
                    </div>
                </div>
            </div>
        </div>

</nav>

<script>
$('#manage_my_account').click(function() {
    uni_modal("Manage Account", "manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
})
</script>