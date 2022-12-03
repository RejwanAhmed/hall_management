<?php include('database_connection.php')?>
<?php include('header.php')?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-9 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h3 class ="text-center card_header_color text-uppercase">Add Room <span><i class="fas fa-bed"></i></span></h3>
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
                                        ?>">
                                        <p class = "text-danger font-weight-bold" id= "seat"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3 justify-content-center">
                                <div class=" col-lg-6 col-10">
                                    <div class="form-group">
                                        <input type="submit" name = "submit" class = "form-control btn btn_color_employee" value = "Enter">
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
        // Start of finding existing room number
        if($error==0)
        {
            $insert_qry = "INSERT INTO `room_information` (`floor_no`, `room_no`, `total_seat`, `reserved_seat`) VALUES ('$floor','$room','$seat','0')";
            $run_insert_qry = mysqli_query($conn, $insert_qry);
            if($run_insert_qry)
            {
                ?>
                <script>
                    window.alert("Room Added Successfully");
                    window.location = "total_room.php";
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
