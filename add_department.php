<?php include('database_connection.php')?>
<?php include('header.php') ?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-9 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h3 class ="text-center card_header_color text-uppercase">Add Department <span><i class="far fa-building"></i></span></h3>
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
                                        ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3 justify-content-center">
                                <div class=" col-lg-6 col-10">
                                    <div class="form-group">
                                        <input type="submit" name = "submit" class = "form-control btn btn_color_employee" value = "Add">
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
        $insert_qry = "INSERT INTO `department_information`(`department_name`) VALUES ('$dept_name')";
        $insert_qry_run = mysqli_query($conn, $insert_qry);
        if($insert_qry_run)
        {
            ?>
            <script>
                window.alert('Department Added Successfully');
                window.location = "view_department_information.php";
            </script>
            <?php
        }

    }
?>
<!-- Form Submission -->

<?php include('footer.php') ?>
