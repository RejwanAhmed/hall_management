<?php include('database_connection.php')?>
<?php include('header.php')?>
<?php include('resource_header.php')?>
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12"></div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Incoming Resource Form<span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 text-center">
                            <a href="add_resource_name.php" class = "btn btn-danger"><b><span><i class="far fa-plus-square"></i></span> Resource Name</b></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method = "POST">
                        <div class="row m-3">
                            <div class="col-lg-6 col-md-6 col-12 ">
                                <div class="form-group">
                                    <label for="">Resource Name:</label>
                                    <br>
                                    <select name="resource_name" class = "form-control" required>
                                        <option value = "" selected>Please Select Resource Name</option>

                                    <?php
                                    $select_resource_name_qry = "SELECT * FROM `resource_name`";
                                    $run_select_resource_name_qry = mysqli_query($conn, $select_resource_name_qry);
                                    while($row = mysqli_fetch_assoc($run_select_resource_name_qry))
                                    {
                                        ?>
                                        <option value="<?php echo $row['id']?>"><?php echo $row['resource_name']?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                                    <small style="color:red">*If resource name not found! Please Add</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Number of Resources:</label>
                                    <br>
                                    <input type="number" name = "resource_number" class = "form-control"required placeholder="Enter Number of Resources" value = "<?php if(isset($_POST['resource_number']))
                                    {
                                        echo $_POST['resource_number'];
                                    }
                                    ?>">
                                    <p id = "resource_alert" class = "text-danger font-weight-bold"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-lg-8 col-md-8 col-12 ">
                                <div class="form-group">
                                    <label for="">Entry Date:</label>
                                    <br>
                                    <input type="date" class = "form-control" name = "entry_date" required value = "<?php
                                        if(isset($_POST['entry_date']))
                                        {
                                            echo $_POST['entry_date'];
                                        }
                                    ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row m-3 justify-content-center">
                            <div class=" col-lg-6 col-10">
                                <div class="form-group">
                                    <input type="submit" name = "entry_form_submit" class = "form-control btn btn_color_employee" value = "Enter">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['entry_form_submit']))
    {
        $resource_name = $_POST['resource_name'];
        $resource_number = $_POST['resource_number'];
        if($resource_number<=0)
        {
            ?>
            <script>
                document.getElementById("resource_alert").innerHTML = "Value can not be 0 or negative";
            </script>
            <?php
            exit();
        }
        $entry_date = $_POST['entry_date'];
        //Start of Get Entry Month and Year
        $entry_year = $entry_date['0'].$entry_date['1'].$entry_date['2'].$entry_date['3'];
        if($entry_date['5']==0)
        {
            $entry_month =$entry_date['6'];
        }
        else
        {
            $entry_month = $entry_date['5'].$entry_date['6'];
        }
        //End of Get Entry Month and Year
        $insert_qry = "INSERT INTO `incoming_resource`(`resource_id`, `number_of_resources`, `month`, `year`, `entry_date`) VALUES ('$resource_name','$resource_number','$entry_month','$entry_year','$entry_date')";
        $run_insert_qry = mysqli_query($conn,$insert_qry);
        if($run_insert_qry)
        {
            ?>
            <script>
                window.alert('Incoming Resource Information Succefully Entered');
                window.location = "incoming_resource_information.php";
            </script>
            <?php
        }

    }
?>
<?php include('resource_footer.php')?>
<?php include('footer.php')?>
