<?php include('header.php')?> <!-- To determine whether admin is logged in or not-->
<?php include('database_connection.php')?>
<?php
if(!isset($_GET['id']))
{
    ?>
    <script>
        window.location = "home.php";
    </script>
    <?php
}
else if(isset($_GET['id']))
{
    // Start of Whether an id is valid or not
    $room_id_validation_qry = "SELECT * FROM `room_information` WHERE `id` = '$_GET[id]'";
    $room_id_validation_qry_run = mysqli_query($conn, $room_id_validation_qry);
    $room_id_validation_qry_run_res = mysqli_fetch_assoc($room_id_validation_qry_run);
    if($room_id_validation_qry_run_res==false)
    {
        ?>
        <script>
            window.alert('Invalid Id');
            window.location = "home.php";
        </script>
        <?php
    }
    //End of Whether an id is valid or not
}
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-9 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h3 class ="text-center card_header_color text-uppercase">Update Room Information <span><i class="fas fa-bed"></i></span></h3>
                </div>
                <div class="card-body justify-content-center">
                    <div class="col-lg-12 col-12">
                        <form action="" method = "POST" enctype="multipart/form-data">
                            <div class="row m-3">
                                <div class="col-lg-6 col-md-6 col-12 ">
                                    <div class="form-group">
                                        <label for="">Floor No:</label>
                                        <br>
                                        <input type="number" class = "form-control" name = "floor_no" placeholder = "Enter Floor No" required value = "<?php
                                            if(isset($_POST['floor_no']))
                                            {
                                                echo $_POST['floor_no'];
                                            }
                                            else
                                            {
                                                echo $room_id_validation_qry_run_res['floor_no'];
                                            }
                                        ?>">
                                        <p class = "text-danger font-weight-bold" id= "floor"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">Room No:</label>
                                        <br>
                                        <input type="number" class = "form-control" name = "room_no" placeholder = "Enter Room Number" required value = "<?php
                                            if(isset($_POST['room_no']))
                                            {
                                                echo $_POST['room_no'];
                                            }
                                            else
                                            {
                                                echo $room_id_validation_qry_run_res['room_no'];
                                            }
                                        ?>">
                                        <p class = "text-danger font-weight-bold" id= "room"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="">Number Of Seats:</label>
                                        <br>
                                        <input type="number" class = "form-control" name = "number_of_seats" placeholder = "Enter Number of Seats" required value = "<?php
                                            if(isset($_POST['number_of_seats']))
                                            {
                                                echo $_POST['number_of_seats'];
                                            }
                                            else
                                            {
                                                echo $room_id_validation_qry_run_res['total_seat'];
                                            }
                                        ?>">
                                        <p class = "text-danger font-weight-bold" id= "seat"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="">Number Of Reserved Seats:</label>
                                        <br>
                                        <input type="number" class = "form-control"  value = "<?php
                                            echo $room_id_validation_qry_run_res['reserved_seat'];
                                        ?>" disabled>
                                        <p class = "text-danger font-weight-bold" id= "seat"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3 justify-content-center">
                                <div class=" col-lg-6 col-10">
                                    <div class="form-group">
                                        <input type="submit" name = "submit" class = "form-control btn btn_color_employee" value = "Update">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Form Submission -->
<?php
    if(isset($_POST['submit']))
    {
        $room = $_POST['room_no'];
        $floor = $_POST['floor_no'];
        $seat = $_POST['number_of_seats'];
        $error=0;
        if($room<=0)
        {
            $error=1;
            ?>
            <script>
                document.getElementById('room').innerHTML = "Room number can not be 0 or negative";
            </script>
            <?php
        }
        if($floor<=0)
        {
            $error=1;
            ?>
            <script>
                document.getElementById('floor').innerHTML = "Floor number can not be 0 or negative";
            </script>
            <?php
        }
        if($seat<=0)
        {
            $error=1;
            ?>
            <script>
                document.getElementById('seat').innerHTML = "Seat number can not be 0 or negative";
            </script>
            <?php
        }
        if($room_id_validation_qry_run_res['reserved_seat']>$seat)
        {
            $error=1;
            ?>
            <script>
                document.getElementById('seat').innerHTML = "Number of total seats can not be less than reserved seats. To do so, first reassign students to another room";
            </script>
            <?php
        }
        if($error==0)
        {
            $update_qry = "UPDATE `room_information` SET `floor_no`='$floor',`room_no`='$room',`total_seat`='$seat' WHERE `id` = '$_GET[id]'";
            $run_update_qry = mysqli_query($conn, $update_qry);
            if($run_update_qry)
            {
                ?>
                <script>
                    window.alert("Room Updated Successfully");
                    window.location = "total_room.php?id=<?php echo $_GET['id']?>";
                </script>
                <?php
            }
            else
            {
                ?>
                <script>
                    document.getElementById('room').innerHTML = "Room number already exists";
                </script>
                <?php
            }
        }
        else
        {
            exit();
        }
    }
?>
<!-- Form Submission -->
<?php include('footer.php')?>
