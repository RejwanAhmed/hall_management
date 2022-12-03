<?php include('database_connection.php')?>
<?php include('header.php')?>
<?php include('resource_header.php')?>
<?php include('pagination.php') ?>
<?php
    function get_row_count()
    {
        include('database_connection.php');
        $sql = "SELECT COUNT(`id`) as total_row FROM `outgoing_resource` WHERE `number_of_resources`!='0'";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res))
        {
            $row = mysqli_fetch_assoc($res);
            return $row['total_row'];
        }
        return 0;
    }
    function display_content($run,$offset,$total)
    {
        include('database_connection.php');
        if(empty($run))
        {
            $select_outgoing_resource_qry = "SELECT r.resource_name, o.id, o.number_of_resources,o.departure_date FROM resource_name as r INNER JOIN outgoing_resource as o ON r.id = o.resource_id WHERE `number_of_resources`!=0 LIMIT $offset, $total";
            $run = mysqli_query($conn, $select_outgoing_resource_qry);
        }
        ?>
        <table class = "table table-bordered table-hover text-center table-responsive-lg">
            <tr>
                <thead class ="thead-light">
                    <th>Resource Name</th>
                    <th>Number of Resources</th>
                    <th>Departure Date</th>
                    <th>Modify</th>
                    <th>Remove</th>
                </thead>
            </tr>
            <?php

            while($row = mysqli_fetch_assoc($run))
            {
                ?>
                <tr>
                    <td><?php echo $row['resource_name']?></td>
                    <td><?php echo $row['number_of_resources']?></td>
                    <td><?php echo $row['departure_date']?></td>
                    <td>
                        <a class = "btn btn_color" href="update_outgoing_resource_information.php?id=<?php echo $row['id']?>"><b><span><i class="fas fa-edit"></i></span> Modify</b></a>
                    </td>
                    <td>
                        <button class = "btn btn_color" onclick = "deleteConfirmation(<?php echo $row['id'];?>)"><b><span><i class="fas fa-eraser"></i></span> Remove</b></button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
?>
<div class="container tab-pane"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12" id = "source_div">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12"></div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Outgoing Resource <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 text-center">
                            <a href="add_outgoing_resource.php" class = "btn btn-danger"><b><span><i class="far fa-minus-square"></i></span> Resource</b></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Start of Design of Search Button -->
                    <form action="" method = "POST">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <select name="search_resource_wise" class = "form-control">
                                        <option value = "">Please Select Resource Name</option>

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
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <?php
                                    $months = array("1"=>'January',"2"=>'February',"3"=>'March',"4"=>'April',"5"=>'May',"6"=>'June',"7"=>'July',"8"=>'August',"9"=>'September',"10"=>'October',"11"=>'November',"12"=>'December');

                                    ?>
                                    <select name="search_month_wise" class = "form-control" >
                                        <option value = "">Please Select Month Name</option>
                                        <?php
                                        foreach ($months as $month => $value)
                                        {
                                            ?>
                                            <option value="<?php echo $month; ?>"><?php echo $value; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class = "form-control" name = "search_year_wise" placeholder="Search By Year....." value = "<?php if(isset($_POST['show_all']))
                                    {
                                        echo "";
                                    }
                                    else if(isset($_POST['search_year_wise']))
                                    {
                                        echo "$_POST[search_year_wise]";
                                    }?>">
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 text-center mb-3 ">
                                <input type="submit" name="search" value="Search" class = "form-control btn_color_employee">
                            </div>
                            <div class="col-lg-4 col-12 text-center mb-3 ">
                                <input type="submit" class ="form-control btn_color_employee" name = "show_all" value = "Show All">
                            </div>
                        </div>
                    </form>
                    <!-- End of Design of Search Button -->

                    <!-- Start of qry for search Button -->
                    <?php
                    if(isset($_POST['search']))
                    {
                        $resource = $_POST['search_resource_wise'];
                        $month = $_POST['search_month_wise'];
                        $year = $_POST['search_year_wise'];

                        $search_qry = "SELECT r.resource_name, o.id, o.number_of_resources,o.departure_date FROM resource_name as r INNER JOIN outgoing_resource as o ON r.id = o.resource_id WHERE ";
                        $count=1;
                        if($resource!=NULL)
                        {
                            $count++;
                            $search_qry.="`resource_id` = '$resource'";
                        }
                        if($month!=NULL)
                        {
                            if($count>1)
                            {
                                $search_qry.= " && ";
                            }
                            $search_qry.="`month` = '$month'";
                            $count++;
                        }
                        if($year!=NULL)
                        {
                            if($count>1)
                            {
                                $search_qry.= " && ";
                            }
                            $search_qry.="`year` = '$year'";
                            $count++;
                        }
                        if($count==1)
                        {
                            ?>
                            <script>
                                window.alert("Please Select At least 1 field");
                                window.location = "outgoing_resource_information.php";
                            </script>
                            <?php
                        }
                        else
                        {
                            $search_qry.=" && `number_of_resources` != '0'";
                        }
                        $run_search_qry = mysqli_query($conn, $search_qry);
                        ?>
                        <div class="col-lg-12 col-12">
                            <!-- Call display_content function -->
                            <?php display_content($run_search_qry,0,0); ?>
                            <!-- Offset and $total_data has been sent as 0 0 -->
                            <!-- Here no pagination applied -->
                        </div>
                        <?php
                        // End of qry for search Button
                    }
                    else
                    {
                        ?>
                        <div class="col-lg-12 col-12">
                            <?php
                            $run = 0;
                            $page_name = 'outgoing_resource_information';
                            pagination($run,$page_name);
                            ?>

                        </div>
                        <?php
                    }
                    ?>
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
            window.location='delete_outgoing_resource_information.php?id='+id;
        }
    }
</script>
<?php include('resource_footer.php')?>
<?php include('footer.php')?>
