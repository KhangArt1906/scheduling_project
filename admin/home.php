<?php include 'db_connect.php' ?>
<link rel="stylesheet" href="./assets/css/dashboard.css">
<style>
span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    color: #ffffff96;
}

.imgs {
    margin: .5em;
    max-width: calc(100%);
    max-height: calc(100%);
}

.imgs img {
    max-width: calc(100%);
    max-height: calc(100%);
    cursor: pointer;
}

#imagesCarousel,
#imagesCarousel .carousel-inner,
#imagesCarousel .carousel-item {
    height: 60vh !important;
    background: black;
}

#imagesCarousel .carousel-item.active {
    display: flex !important;
}

#imagesCarousel .carousel-item-next {
    display: flex !important;
}

#imagesCarousel .carousel-item img {
    margin: auto;
}

#imagesCarousel img {
    width: auto !important;
    height: auto !important;
    max-height: calc(100%) !important;
    max-width: calc(100%) !important;
}
</style>

<div class="containe-fluid">
    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php echo "Welcome back ". $_SESSION['login_name']."!"  ?>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <?php if($_SESSION['login_type'] == 1): ?>

    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <ol class="breadcrumb">
                        <li><a href="#">
                                <em class="fa fa-home"></em>
                            </a></li>
                        <li class="active"><b>Dashboard</b></li>
                    </ol>
                </div>

                <div class="card-body" id="container_dashboard">

                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-teal panel-widget">
                            <div class="row total_room border-right border-left">
                                <em class="fa fa-door-closed total_room_icon"></em>
                                <div class="large"><?php include 'counters/room-count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="total_room_heading"><b>Total Rooms</b></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-blue panel-widget">
                            <div class="row reservation border-right">
                                <em class="fa fa-xl fa-bookmark color-orange reservation_icon"></em>
                                <div class="large"><?php include 'counters/reserve-count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="reservation_heading"><b>Reservations</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-blue panel-widget">
                            <div class="row room_type border-right">
                                <em class="fa fa-door-open room_type_icon"></em>
                                <div class="large"><?php include 'counters/room-type.php'?></div>
                                <div class="text-muted">
                                    <h5 class="room_type_heading"><b>Room Type</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-teal panel-widget">
                            <div class="row booked_room border-right">
                                <em class="fa fa-xl fa-user booked_room_icon"></em>
                                <div class="large"><?php include 'counters/bookedroom-count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="booked_room_heading"><b>Booked Rooms</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-blue panel-widget">
                            <div class="row available_room border-right border-left">
                                <em class="fa fa-xl fa-check-circle color-green available_room_icon"></em>
                                <div class="large"><?php include 'counters/avrooms-count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="available_room_heading"><b>Available Rooms</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-orange panel-widget">
                            <div class="row checkin_room border-right border-left">
                                <em class="fa fa-xl fa-check-square color-magg checkin_room_icon"></em>
                                <div class="large"><?php include 'counters/checkedin-count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="checkin_room_heading"><b>Checked In</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-orange panel-widget">
                            <div class="row faculty  border-right ">
                                <em class="fa fa-user-tie faculty_icon"></em>
                                <div class="large"><?php include 'counters/faculty-count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="faculty_heading"><b>Faculty</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-orange panel-widget">
                            <div class="row technical_staff  border-right ">
                                <em class="fa fa-user-shield technical_staff_icon"></em>
                                <div class="large"><?php include 'counters/staff-count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="technical_staff_heading"><b>Technical Staffs</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-orange panel-widget">
                            <div class="row register  border-right ">
                                <em class="fa fa-file register_icon"></em>
                                <div class="large"><?php include 'counters/register-scheduling-count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="register_heading"><b>Register Forms</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-orange panel-widget">
                            <div class="row cancel_scheduling  border-right ">
                                <i class="fa fa-eject cancel_scheduling_icon"></i>
                                <div class="large"><?php include 'counters/cancel_scheduling_count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="cancel_scheduling_heading"><b>Cancelled Room</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-orange panel-widget">
                            <div class="row report_problem  border-right ">
                                <i class="fa fa-bug report_problem_icon"></i>
                                <div class="large"><?php include 'counters/report_problem_count.php'?></div>
                                <div class="text-muted">
                                    <h5 class="report_problem_heading"><b>Report Problem</h5></b>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>

            </div>
        </div>

    </div>

    <?php endif; ?>




    <script>
    $('#manage-records').submit(function(e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                resp = JSON.parse(resp)
                if (resp.status == 1) {
                    alert_toast("Data successfully saved", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 800)

                }

            }
        })
    })
    $('#tracking_id').on('keypress', function(e) {
        if (e.which == 13) {
            get_person()
        }
    })
    $('#check').on('click', function(e) {
        get_person()
    })

    function get_person() {
        start_load()
        $.ajax({
            url: 'ajax.php?action=get_pdetails',
            method: "POST",
            data: {
                tracking_id: $('#tracking_id').val()
            },
            success: function(resp) {
                if (resp) {
                    resp = JSON.parse(resp)
                    if (resp.status == 1) {
                        $('#name').html(resp.name)
                        $('#address').html(resp.address)
                        $('[name="person_id"]').val(resp.id)
                        $('#details').show()
                        end_load()

                    } else if (resp.status == 2) {
                        alert_toast("Unknow tracking id.", 'danger');
                        end_load();
                    }
                }
            }
        })
    }
    </script>