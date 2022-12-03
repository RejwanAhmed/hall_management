<?php include('header.php')?> <!-- To determine whether admin is logged in or not-->
<?php
    include('database_connection.php');
    if(!isset($_GET['payment_id']))
    {
        ?>
        <script>
            window.location = "home.php";
        </script>
        <?php
    }
    else if(isset($_GET['payment_id']))
    {
        // Start of Whether an id is valid or not
        $payment_id_validation_qry = "SELECT * FROM `student_payment_information` WHERE `id` = '$_GET[payment_id]'";
        $payment_id_validation_qry_run = mysqli_query($conn, $payment_id_validation_qry);
        $payment_id_validation_qry_run_res = mysqli_fetch_assoc($payment_id_validation_qry_run);
        if($payment_id_validation_qry_run_res==false)
        {
            ?>
            <script>
                window.alert('Invalid Id');
                window.location = "home.php";
            </script>
            <?php
        }
        else
        {
            $student_id = $payment_id_validation_qry_run_res['student_id'];
            $student_id_validation_qry = "SELECT s.id, s.name, s.image, s.contact_number, d.department_name, s.session, s.roll_number, r.room_no as room_id_number FROM student_information as s INNER JOIN department_information as d ON s.department_id_number = d.id INNER JOIN room_information as r ON s.room_id_number=r.id WHERE s.id = '$student_id'";
            $student_id_validation_qry_run = mysqli_query($conn, $student_id_validation_qry);
            $student_id_validation_qry_run_res = mysqli_fetch_assoc($student_id_validation_qry_run);
        }
        //End of Whether an id is valid or not
    }
    // Just for showing month name to table
    $month_name =   array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");
?>
<div class = "container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-sm-2"></div>
                        <div class="col-lg-8 col-sm-8 col-12">
                            <h3 class = "text-center card_header_color text-uppercase"><?php echo $month_name[$payment_id_validation_qry_run_res['month']]." ".$payment_id_validation_qry_run_res['year']?> Infromation <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-12">
                            <button type = "button" class = "btn btn-danger font-weight-bold" id = "download"><b><span><i class="fas fa-download"></i></span> Download</b></button>
                        </div>
                    </div>
                </div>
                <div class="card-body" id = "payment_details">
                    <h3 id = "jkkniu" class = "text-center"></h3>
                    <h4 id = "dch" class = "text-center"></h4>
                    <div class="row justify-content-center m-3">
                        <div class="form-group text-center">
                            <img id = "img" class = 'employee_img' src="student_image/<?php echo $student_id_validation_qry_run_res['image']?>" onerror=this.onerror=null;this.src="student_image/no_image.jpg"; width = "150px;" height ="150px" style = "border-radius: 50%;">
                        </div>
                    </div>
                    <div class="row m-3">
                        <div class="col-lg-6 col-md-6 col-12 ">
                            <div class="form-group">
                                <label for="">Name:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['name']?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Contact Number:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['contact_number'];?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-4 col-md-4 col-12 ">
                            <div class="form-group">
                                <label for="">Department Name:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['department_name'];?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="">Session:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['session'];?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="">Roll Number:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['roll_number'];?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row m-3">
                        <div class="col-lg-4 col-md-4 col-12 ">
                            <div class="form-group">
                                <label for="">Room Number:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['room_id_number'];?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 ">
                            <div class="form-group">
                                <label for="">Billing Month:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $month_name[$payment_id_validation_qry_run_res['month']];?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 ">
                            <div class="form-group">
                                <label for="">Billing Year:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $payment_id_validation_qry_run_res['year'];?>" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row m-3">
                        <div class="col-lg-4 col-md-4 col-12 ">
                            <div class="form-group">
                                <label for="">Amount:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $payment_id_validation_qry_run_res['amount'];?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 ">
                            <div class="form-group">
                                <label for="">Payment Status:</label>
                                <br>
                                <input type="text" class = "form-control" value = "Clear" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 ">
                            <div class="form-group">
                                <label for="">Payment Date:</label>
                                <br>
                                <input type="text" class = "form-control" value = "<?php echo $payment_id_validation_qry_run_res['payment_date'];?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4" id = "as">

                        </div>
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-4" id = "ss">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php')?>
