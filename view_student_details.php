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
    // Start of Whether an id is valid or not and Student Query by joining with department_information and room_information

    $student_id_validation_qry = "SELECT s.id, s.name, s.father_name, s.image, s.mother_name, s.date_of_birth, s.district, s.contact_number, d.department_name, s.session, s.roll_number, r.room_no as room_id_number, s.entry_date FROM student_information as s INNER JOIN department_information as d ON s.department_id_number = d.id INNER JOIN room_information as r ON s.room_id_number=r.id WHERE s.id = '$_GET[id]'";

    $student_id_validation_qry_run = mysqli_query($conn, $student_id_validation_qry);
    $student_id_validation_qry_run_res = mysqli_fetch_assoc($student_id_validation_qry_run);
    if($student_id_validation_qry_run_res==false)
    {
        ?>
        <script>
            window.alert('Invalid Id');
            window.location = "home.php";
        </script>
        <?php
    }
    // Start of Whether an id is valid or not and Student Query by joining with department_information and room_information
}
?>
<?php include('student_header.php')?>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-12 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-2 col-sm-2"></div>
                        <div class="col-lg-8 col-sm-8">
                            <h3 class ="text-center card_header_color text-uppercase"><?php echo $student_id_validation_qry_run_res['name']?> Information <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <a class = "btn btn-danger"href="student_monthly_due.php?id=<?php echo $student_id_validation_qry_run_res['id']?>"><b><span><i class="fas fa-file-invoice-dollar"></i></span> Payment</b></a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-12">
                        <div class="row justify-content-center m-3">
                            <div class="form-group text-center">
                                <img class = 'employee_img' src="student_image/<?php echo $student_id_validation_qry_run_res['image']?>" onerror=this.onerror=null;this.src="student_image/no_image.jpg"; width = "150px;" height ="150px" style = "border-radius: 50%;">
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-lg-4 col-md-4 col-12 ">
                                <div class="form-group">
                                    <label for="">Name:</label>
                                    <br>
                                    <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['name']?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="">Father Name:</label>
                                    <br>
                                    <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['father_name'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="">Mother Name:</label>
                                    <br>
                                    <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['mother_name'];?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="">Date of Birth:</label>
                                    <br>
                                    <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['date_of_birth'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="">District:</label>
                                    <br>
                                    <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['district'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
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
                            <div class="col-lg-6 col-md-6 col-12 ">
                                <div class="form-group">
                                    <label for="">Room Number:</label>
                                    <br>
                                    <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['room_id_number'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Entry Date:</label>
                                    <br>
                                    <input type="text" class = "form-control" value = "<?php echo $student_id_validation_qry_run_res['entry_date'];?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 ml-4">
                            <a class = "btn btn_color_employee mr-3" href="update_student_information.php?id=<?php echo $student_id_validation_qry_run_res['id']?>"><b><span><i class="far fa-edit"></i></span> Edit</b></a>

                            <button class = "btn btn_color_employee" onclick = "deleteConfirmation(<?php echo $student_id_validation_qry_run_res['id'];?>)"><b><span><i class="fas fa-eraser"></i></span> Remove</b></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteConfirmation(id)
    {
        var del = window.confirm('All Payment Information Related To This Student Will Be Deleted! Are You Sure Want To Delete?');
        if(del == true)
        {
            window.location='delete_student_information.php?id='+id;
        }
    }
</script>
<?php include('student_footer.php')?>
<?php include('footer.php')?>
