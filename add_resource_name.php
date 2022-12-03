<?php include('database_connection.php')?>
<?php include('header.php')?>
<?php include('resource_header.php')?>
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Resource Name <span><i class="fas fa-info-circle"></i></span></h3>
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
                                    <input type="text" name = "resource_name" placeholder="Enter Resource Name" class = "form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <input type="submit" name = "resource_name_submit" class = "form-control btn btn_color_employee" value = "Enter ">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row m-3">
                        <table class = "table table-bordered table-hover text-center table-responsive-lg">
                            <tr>
                                <thead class ="thead-light">
                                    <th>Resource Name</th>
                                    <th>Modify</th>
                                    <th>Remove</th>
                                </thead>
                            </tr>
                            <?php
                            $select_resource_name_qry = "SELECT * FROM `resource_name`";
                            $run_select_resource_name_qry = mysqli_query($conn, $select_resource_name_qry);
                            while($row = mysqli_fetch_assoc($run_select_resource_name_qry))
                            {
                                ?>
                                <tr>
                                    <td ><input type="text" value = "<?php echo $row['resource_name']?>" class = "form-control text-center" readonly></td>
                                    <td>
                                        <a class = "btn btn_color" href="update_resource_name.php?id=<?php echo $row['id']?>"><b><span><i class="fas fa-edit"></i></span> Modify</b></a>
                                    </td>

                                    <td>
                                        <button class = "btn btn_color" onclick = "deleteConfirmation(<?php echo $row['id'];?>)"><b><span><i class="fas fa-eraser"></i></span> Remove</b></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['resource_name_submit']))
    {
        $resource_name = $_POST['resource_name'];

        $insert_qry = "INSERT INTO `resource_name`( `resource_name`) VALUES ('$resource_name')";
        $run_insert_qry = mysqli_query($conn,$insert_qry);

        if($run_insert_qry)
        {
            // Start of Fetching the current id which is entered into resource_name table
            $fetch_qry = "SELECT `id` FROM `resource_name` ORDER BY `id` DESC LIMIT 1";
            $run_fetch_qry = mysqli_query($conn,$fetch_qry);
            $row = mysqli_fetch_assoc($run_fetch_qry);
            $entry_date = date('Y-m-d');
            // End of Fetching the current id which is entered into resource name table

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

            // Start of Inserting into incoming_resource table with value 0 to number_of_resources column
            $insert_incoming_resource = "INSERT INTO `incoming_resource` (`resource_id`,`number_of_resources`,`month`,`year`,`entry_date`) VALUES('$row[id]','0','$entry_month','$entry_year','$entry_date')";
            $run_insert_incoming_resource = mysqli_query($conn, $insert_incoming_resource);
            // End of Inserting into incoming_resource table with value 0 to number_of_resources column

            // Start of Outgoing into outgoing_resource table with value 0 to number_of_resources column
            $insert_outgoing_resource = "INSERT INTO `outgoing_resource` (`resource_id`,`number_of_resources`,`month`,`year`,`departure_date`) VALUES('$row[id]','0','$entry_month','$entry_year','$entry_date')";
            $run_insert_outgoing_resource = mysqli_query($conn, $insert_outgoing_resource);
            // End of Outgoing into outgoing_resource table with value 0 to number_of_resources column

            ?>
            <script>
                window.alert('Resource Name Entered Successfully');
                window.location = "add_incoming_resource.php";
            </script>
            <?php
        }

    }
?>
<script>
    function deleteConfirmation(id)
    {
        var del = window.confirm('All Information related to this resource will be deleted. Are You Sure Want To Delete?');
        if(del == true)
        {
            window.location='delete_resource_name.php?id='+id;
        }
    }
</script>
<?php include('resource_footer.php')?>
<?php include('footer.php')?>
