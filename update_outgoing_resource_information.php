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
    $outgoing_resource_id_validation_qry = "SELECT * FROM `outgoing_resource` WHERE `id` = '$_GET[id]'";
    $outgoing_resource_id_validation_qry_run = mysqli_query($conn, $outgoing_resource_id_validation_qry);
    $outgoing_resource_id_validation_qry_run_res = mysqli_fetch_assoc($outgoing_resource_id_validation_qry_run);
    if($outgoing_resource_id_validation_qry_run_res==false)
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
                        <div class="col-lg-12 col-md-12 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Update Outgoing Resource Form<span><i class="fas fa-info-circle"></i></span></h3>
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
                                    <select name="resource_name" id ="outgoing_select" class = "form-control" onchange = "myFunction()" required>
                                        <option value = "" >Please Select Resource Name</option>

                                    <?php
                                    $select_resource_name_qry = "SELECT * FROM `resource_name`";
                                    $run_select_resource_name_qry = mysqli_query($conn, $select_resource_name_qry);
                                    while($row = mysqli_fetch_assoc($run_select_resource_name_qry))
                                    {
                                        ?>
                                        <option value="<?php echo $row['id']?>" <?php if($row['id'] ==$outgoing_resource_id_validation_qry_run_res['resource_id'])
                                        {
                                            echo "selected";
                                        }?>><?php echo $row['resource_name']?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group" >
                                    <label for="">Number of Resources:</label>
                                    <br>
                                    <input type="number" name = "resource_number" class = "form-control"required placeholder="Enter Number of Resources" value = "<?php if(isset($_POST['resource_number']))
                                    {
                                        echo $_POST['resource_number'];
                                    }
                                    else
                                    {
                                        echo $outgoing_resource_id_validation_qry_run_res['number_of_resources'];
                                    }
                                    ?>">
                                    <p id = "resource_alert" class = "text-danger font-weight-bold"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-lg-8 col-md-8 col-12 ">
                                <div class="form-group">
                                    <label for="">Departure Date:</label>
                                    <br>
                                    <input type="date" class = "form-control" name = "departure_date" required value = "<?php
                                        if(isset($_POST['departure_date']))
                                        {
                                            echo $_POST['departure_date'];
                                        }
                                        else
                                        {
                                            echo $outgoing_resource_id_validation_qry_run_res['departure_date'];
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
        $departure_date = $_POST['departure_date'];

        //Start of Get Departure Month and Year
        $departure_year = $departure_date['0'].$departure_date['1'].$departure_date['2'].$departure_date['3'];
        if($departure_date['5']==0)
        {
            $departure_month =$departure_date['6'];
        }
        else
        {
            $departure_month = $departure_date['5'].$departure_date['6'];
        }
        //End of Get Departure Month and Year

        // Total resource number of a particula incoming resource
        $select_incoming_resource = "SELECT SUM(`number_of_resources`) FROM `incoming_resource` WHERE `resource_id` = '$resource_name'";
        $run_select_incoming_resource = mysqli_query($conn, $select_incoming_resource);
        $res_select_incoming_resource = mysqli_fetch_assoc($run_select_incoming_resource);
        $total_incoming_resource = $res_select_incoming_resource['SUM(`number_of_resources`)'];

        // Total resource number of a particula outgoin resource
        $select_outgoing_resource = "SELECT SUM(`number_of_resources`) FROM `outgoing_resource` WHERE `resource_id` = '$resource_name'";
        $run_select_outgoing_resource = mysqli_query($conn, $select_outgoing_resource);
        $res_select_outgoing_resource = mysqli_fetch_assoc($run_select_outgoing_resource);

        $total_outgoing_resource = $res_select_outgoing_resource['SUM(`number_of_resources`)'];
        $total_resource = $total_incoming_resource - $total_outgoing_resource +  $outgoing_resource_id_validation_qry_run_res['number_of_resources'];

        if($resource_number<=0)
        {
            ?>
            <script>
                document.getElementById("resource_alert").innerHTML = "Value can not be 0 or negative";
            </script>
            <?php
            exit();
        }
        else if($total_resource<=0)
        {
            ?>
            <script>
                document.getElementById("resource_alert").innerHTML = "No resource available";
            </script>
            <?php
            exit();
        }
        else if($resource_number>$total_resource)
        {
            ?>
            <script>
                document.getElementById("resource_alert").innerHTML = "Value must be equal or less than <?php echo $total_resource;?>";
            </script>
            <?php
            exit();
        }
        else
        {
            $update_qry = "UPDATE `outgoing_resource` SET `resource_id`='$resource_name',`number_of_resources`='$resource_number',`month`='$departure_month',`year`='$departure_year',`departure_date`='$departure_date' WHERE `id` = '$_GET[id]'";
            $run_update_qry = mysqli_query($conn,$update_qry);
            if($run_update_qry)
            {
                ?>
                <script>
                    window.alert('Outgoing Resource Information Succefully Updated');
                    window.location = "outgoing_resource_information.php";
                </script>
                <?php
            }
        }
    }
?>

<?php include('resource_footer.php')?>
<?php include('footer.php')?>
