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
    $incoming_resource_id_validation_qry = "SELECT * FROM `incoming_resource` WHERE `id` = '$_GET[id]'";
    $incoming_resource_id_validation_qry_run = mysqli_query($conn, $incoming_resource_id_validation_qry);
    $incoming_resource_id_validation_qry_run_res = mysqli_fetch_assoc($incoming_resource_id_validation_qry_run);
    if($incoming_resource_id_validation_qry_run_res==false)
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
<?php include('resource_header.php')?>
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Update Incoming Resource Form<span><i class="fas fa-info-circle"></i></span></h3>
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
                                        <option value = "">Please Select Resource Name</option>
                                        <?php
                                        $select_resource_name_qry = "SELECT * FROM `resource_name`";
                                        $run_select_resource_name_qry = mysqli_query($conn, $select_resource_name_qry);
                                        while($row = mysqli_fetch_assoc($run_select_resource_name_qry))
                                        {
                                            ?>
                                            <option value="<?php echo $row['id']?>" <?php if($row['id'] ==$incoming_resource_id_validation_qry_run_res['resource_id'])
                                            {
                                                echo "selected";
                                            }?>><?php echo $row['resource_name']?></option>
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
                                    else
                                    {
                                        echo $incoming_resource_id_validation_qry_run_res['number_of_resources'];
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
                                        else
                                        {
                                            echo $incoming_resource_id_validation_qry_run_res['entry_date'];
                                        }
                                    ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row m-3 justify-content-center">
                            <div class=" col-lg-6 col-10">
                                <div class="form-group">
                                    <input type="submit" name = "entry_form_submit" class = "form-control btn btn_color_employee" value = "Update">
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
        $entry_date = $_POST['entry_date'];
        if($resource_number<=0)
        {
            ?>
            <script>
                document.getElementById("resource_alert").innerHTML = "Value can not be 0 or negative";
            </script>
            <?php
            exit();
        }

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

        $update_qry = "UPDATE `incoming_resource` SET `resource_id`='$resource_name',`number_of_resources`='$resource_number',`month`= '$entry_month',`year`='$entry_year',`entry_date`='$entry_date' WHERE `id` = '$_GET[id]'";
        $run_update_qry = mysqli_query($conn,$update_qry);
        if($run_update_qry)
        {
            ?>
            <script>
                window.alert('Incoming Resource Information Succefully Updated');
                window.location = "incoming_resource_information.php";
            </script>
            <?php
        }

    }
?>
<?php include('resource_footer.php')?>
<?php include('footer.php')?>
