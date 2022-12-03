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
    $employee_id_validation_qry = "SELECT * FROM `employee_information` WHERE `id` = '$_GET[id]'";
    $employee_id_validation_qry_run = mysqli_query($conn, $employee_id_validation_qry);
    $employee_id_validation_qry_run_res = mysqli_fetch_assoc($employee_id_validation_qry_run);
    if($employee_id_validation_qry_run_res==false)
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
        <div class="col-lg-12 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-sm-8">
                            <h3 class ="text-center card_header_color text-uppercase"><?php echo $employee_id_validation_qry_run_res['name']?>'s Profile <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-12">
                        <div class="row m-3">
                            <div class="col-lg-4 col-12 mt-3">
                                <div class="form-group text-center">
                                    <img class = 'employee_img' src="employee_image/<?php echo $employee_id_validation_qry_run_res['image']?>" onerror=this.onerror=null;this.src="employee_image/no_image.jpg"; width = "200px;" height ="200px">
                                </div>

                                <h5 class = "text-center"><b><?php echo $employee_id_validation_qry_run_res['name']?></b></h5>

                                <h6 class = "text-center"><i><?php echo $employee_id_validation_qry_run_res['university_designation']?></i></h6>
                            </div>
                            <div class="col-lg-8 col-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="">Name:</label>
                                            <input type="text" class = "form-control" value = "<?php echo $employee_id_validation_qry_run_res['name']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="">Hall Designation:</label>
                                            <input type="text" class = "form-control" value = "<?php echo $employee_id_validation_qry_run_res['hall_designation']?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="">University Designation:</label>
                                            <input type="text" class = "form-control" value = "<?php echo $employee_id_validation_qry_run_res['university_designation']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="">Contact No:</label>
                                            <input type="text" class = "form-control" value = "<?php echo $employee_id_validation_qry_run_res['contact_no']?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group employee_page_link">
                                            <label for="">Personal Page Link:</label>
                                            <br>
                                            <div class = "link">
                                                <a href="<?php echo $employee_id_validation_qry_run_res['personal_page_link']?>" target="_blank">
                                                    <?php echo $employee_id_validation_qry_run_res['personal_page_link']?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group employee_page_link">
                                            <label for="">Facebook Link:</label>
                                            <br>
                                            <div class = "link">
                                                <a  href="<?php echo $employee_id_validation_qry_run_res['facebook_link']?>" target="_blank">
                                                    <?php echo $employee_id_validation_qry_run_res['facebook_link']?>
                                                </a>
                                            </div>
                                    </div>
                                </div>
                                <div class="row ml-4 mt-3">
                                    <a class = "btn btn_color_employee mr-3" href="update_employee_information.php?id=<?php echo $employee_id_validation_qry_run_res['id']?>"><b><span><i class="far fa-edit"></i></span> Edit</b></a>

                                    <button class = "btn btn_color_employee" onclick = "deleteConfirmation(<?php echo $employee_id_validation_qry_run_res['id'];?>)"><b><span><i class="fas fa-eraser"></i></span> Remove</b></button>
                                </div>
                            </div>
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
        var del = window.confirm('Are You Sure Want To Delete?');
        if(del == true)
        {
            window.location='delete_employee_information.php?id='+id;
        }
    }
</script>
<?php include('footer.php')?>
