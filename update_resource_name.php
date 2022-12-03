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
    $resource_name_id_validation_qry = "SELECT * FROM `resource_name` WHERE `id` = '$_GET[id]'";
    $resource_name_id_validation_qry_run = mysqli_query($conn, $resource_name_id_validation_qry);
    $resource_name_id_validation_qry_run_res = mysqli_fetch_assoc($resource_name_id_validation_qry_run);
    if($resource_name_id_validation_qry_run_res==false)
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
            <div class="card ">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Update Resource Name <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method = "POST">
                        <div class="row m-3 text-center">
                            <div class="col-lg-4 col-md-4 col-12">
                                <label for="" class = "form-control"><b>Resource Name:</b></label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <input type="text" name = "resource_name" placeholder="Enter Resource Name" class = "form-control" value = "<?php
                                    if(isset($_POST['resource_name']))
                                    {
                                        echo $_POST['resource_name'];
                                    }
                                    else
                                    {
                                        echo $resource_name_id_validation_qry_run_res['resource_name'];
                                    }?>"required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <input type="submit" name = "resource_name_submit" class = "form-control btn btn_color_employee" value = "Update ">
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
    if(isset($_POST['resource_name_submit']))
    {
        $resource_name = $_POST['resource_name'];
        $update_qry = "UPDATE `resource_name` SET `resource_name` = '$resource_name' WHERE `id` = '$_GET[id]'";
        $update_qry_run = mysqli_query($conn, $update_qry);
        if($update_qry_run)
        {
            ?>
            <script>
                window.alert('Resource Name Updated Successfully');
                window.location = "add_resource_name.php?id=<?php echo $_GET['id'];?>";
            </script>
            <?php
        }
    }
?>
<?php include('resource_footer.php')?>
<?php include('footer.php')?>
