<?php include('db_connect.php');
include('./header.php');
error_reporting(0);
?>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row">


            <!-- Table Panel -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <b>Room Type List</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Room Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$i = 1;
								$room_type = $conn->query("SELECT * FROM room_type order by room_type_id asc");
								while($row=$room_type->fetch_assoc()):
								?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                        <p>Room Type: <b><?php echo $row['room_type'] ?>
                                                / ID:
                                                <?php echo $row['room_type_id'] ?>
                                            </b></p>
                                        <p>Description: <small><b>
                                                    Prioprity: <?php echo $row['room_type_prioprity'] ?>
                                                    <br>
                                                    Screen: <?php echo $row['room_type_screen'] ?>
                                                    <br>
                                                    RAM: <?php echo $row['room_type_ram'] ?>
                                                    <br>
                                                    CPU: <?php echo $row['room_type_cpu'] ?>
                                                    <br>
                                                    HDD: <?php echo $row['room_type_hdd'] ?>
                                                    <br>
                                                    Max Person: <?php echo $row['max_person'] ?>
                                                </b></small></p>

                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary edit_subject" id='click' href='room_type.php?id=<?php echo $row['room_type_id']?>
                                                    &room_type=<?php echo $row['room_type'] ?>
                                                    &room_type_prioprity=<?php echo $row['room_type_prioprity'] ?>
                                                    &room_type_screen=<?php echo $row['room_type_screen'] ?>
                                                    &room_type_ram=<?php echo $row['room_type_ram'] ?>
                                                    &room_type_cpu=<?php echo $row['room_type_cpu'] ?>
                                                    &room_type_hdd=<?php echo $row['room_type_hdd']?>
                                                    &max_person=<?php echo $row['max_person'] ?>'>Edit</a>
                                        <button class="btn btn-sm btn-danger delete_subject" type="button"
                                            data-id="<?php echo $row['room_type_id'] ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->


            <!-- FORM Panel -->
            <div class="col-md-4">
                <form method="post" action="hardware_update.php">
                    <div class="card">
                        <div class="card-header">
                            Room Type
                        </div>
                        <div class="card-body">

                            <label for="date">Update Configuration</label><br>
                            <input type="hidden" class="form-control" id="id" name="id"
                                value="<?php echo $_REQUEST['id'];?>" placeholder="Room ID" readonly>
                            <input type="text" class="form-control" id="room_type_name" name="room_type"
                                value="<?php echo $_REQUEST['room_type'];?>" placeholder="Room Type" required>
                            <input type="text" class="form-control" id="room_type_name" name="room_type_prioprity"
                                value="<?php echo $_REQUEST['room_type_prioprity'];?>" placeholder="Room Type Prioprity"
                                required>
                            <input type="text" class="form-control" id="room_type_screen" name="room_type_screen"
                                value="<?php echo $_REQUEST['room_type_screen'];?>" placeholder="Room Type Screen"
                                required>
                            <input type="text" class="form-control" id="room_type_ram" name="room_type_ram"
                                value="<?php echo $_REQUEST['room_type_ram'];?>" placeholder="Room Type Ram" required>
                            <input type="text" class="form-control" id="room_type_cpu" name="room_type_cpu"
                                value="<?php echo $_REQUEST['room_type_cpu'];?>" placeholder="Room Type CPU" required>
                            <input type="text" class="form-control" id="room_type_hdd" name="room_type_hdd"
                                value="<?php echo $_REQUEST['room_type_hdd'];?>" placeholder="Room Type HDD" required>
                            <input type="text" class="form-control" id="max_person" name="max_person"
                                value="<?php echo $_REQUEST['max_person'];?>" placeholder="Room Type Quantity" required>


                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-xl btn-block btn-primary" id="daterange-btn" name="save"
                                        type="submit">
                                        Update
                                    </button>
                                    <a class="btn btn-xl btn-block btn-warning" href="index.php">
                                        Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->
        </div>
    </div>

</div>
<style>
td {
    vertical-align: middle !important;
}
</style>
<script>
$('table').dataTable()
</script>