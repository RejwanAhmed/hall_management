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
    $department_id_validation_qry = "SELECT * FROM `department_information` WHERE `id` = '$_GET[id]'";
    $department_id_validation_qry_run = mysqli_query($conn, $department_id_validation_qry);
    $department_id_validation_qry_run_res = mysqli_fetch_assoc($department_id_validation_qry_run);
    if($department_id_validation_qry_run_res==false)
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
                    <h3 class ="text-center card_header_color text-uppercase">Update Department <span><i class="far fa-building"></i></span></h3>
                </div>
                <div class="card-body justify-content-center">
                    <div class="col-lg-12 col-12">
                        <form action="" method = "POST">
                            <div class="row m-3 justify-content-center">
                                <div class="col-lg-8 col-md-8 col-12 ">
                                    <div class="form-group">
                                        <label for="">Department Name:</label>
                                        <br>
                                        <input type="text" class = "form-control" name = "department_name" placeholder = "Enter Your Department Name" required value = "<?php
                                            if(isset($_POST['department_name']))
                                            {
                                                echo $_POST['department_name'];
                                            }
                                            else
                                            {
                                                echo $department_id_validation_qry_run_res['department_name'];
                                            }
                                        ?>">
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
    $dept_name = $_POST['department_name'];
    $update_qry = "UPDATE `department_information` SET `department_name` = '$dept_name' WHERE `id` = '$_GET[id]'";
    $update_qry_run = mysqli_query($conn, $update_qry);
    if($update_qry_run)
    {
        ?>
        <script>
            window.alert('Department Information Updated Successfully');
            window.location = "view_department_information.php?id=<?php echo $_GET['id'];?>";
        </script>
        <?php
    }

}
?>
<!-- Form Submission -->

<?php include('footer.php') ?>
