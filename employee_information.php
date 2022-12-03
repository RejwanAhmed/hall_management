<?php include('database_connection.php') ?>
<?php include('header.php') ?>
<?php
    function show($run)
    {
        ?>
        <div class="row text-center justify-content-center">
            <?php
            while($row = mysqli_fetch_assoc($run))
            {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-7 mt-3">
                    <a href="view_employee_details.php?id=<?php echo $row['id']?>"><?php echo "<img class = 'employee_img' src='employee_image/$row[image]' width='150px' height:250px; onerror=this.onerror=null;this.src='employee_image/no_image.jpg'; >"; ?></a>

                    <h6 class = "m-1"><b class = "text-uppercase"><?php echo $row['name']?></b></h6>

                    <h6 class = "m-1"><i><?php echo $row['hall_designation']?></i></h6>

                    <a class = " employee_view" href="view_employee_details.php?id=<?php echo $row['id']?>" ><h5>View Profile</h5></a>
                </div>

                <?php
            }
            ?>
        </div>
        <?php
    }
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-3 col-12"></div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">All Employee Information <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 text-center">
                            <a class = "btn btn-danger" href="add_employee.php"><b><span><i class="far fa-plus-square"></i></span> Employee</b></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Start of Search Button Design -->
                    <form action="" method = "POST">
                        <div class="col-lg-12 col-12">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                        </div>
                                        <input type="text" class = "form-control" name = "search_name_wise" placeholder="Search By Name....." value = "<?php
                                        if(isset($_POST['show_all']))
                                        {
                                            echo "";
                                        }
                                        else if(isset($_POST['search_name_wise']))
                                        {
                                            echo "$_POST[search_name_wise]";
                                        }?>">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                        </div>
                                        <input type="text" class = "form-control" name = "search_designation_wise" placeholder="Search By Hall Designation....." value = "<?php
                                        if(isset($_POST['show_all']))
                                        {
                                            echo "";
                                        }
                                        else if(isset($_POST['search_designation_wise']))
                                        {
                                            echo "$_POST[search_designation_wise]";
                                        }?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12 text-center mb-3 ">
                                    <input type="submit" name="search" value="Search" class = "form-control btn_color_employee">
                                </div>
                                <div class="col-lg-2 col-12 text-center mb-3 ">
                                    <input type="submit" class ="form-control btn_color_employee" name = "show_all" value = "Show All">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End of Search Button Design -->

                    <!-- Start of qry for search button -->
                    <?php
                    if(isset($_POST['search']))
                    {
                        $name = $_POST['search_name_wise'];
                        $designation = $_POST['search_designation_wise'];

                        $search_qry = "SELECT * FROM `employee_information` WHERE ";
                        $count=1;
                        if($name!=NULL)
                        {
                            $count++;
                            $search_qry.= "`name` like '%$name%'";
                        }
                        if($designation!=NULL)
                        {
                            if($count>1)
                            {
                                $search_qry.=" && ";
                            }
                            $search_qry.="`hall_designation` like '%$designation%'";
                            $count++;
                        }
                        if($count==1)
                        {
                            ?>
                            <script>
                                window.alert("Please Select At least 1 field");
                                window.location = "employee_information.php";
                            </script>
                            <?php
                        }
                        $run_search_qry = mysqli_query($conn, $search_qry);
                        ?>
                        <div class="col-lg-12 col-12">
                            <!-- call show function -->
                            <?php show($run_search_qry); ?>
                        </div>
                        <?php
                    }
                    // End of qry for search button
                    else
                    {
                        ?>
                        <div class="col-lg-12 col-12">
                            <?php
                            $all_employee_details_qry = "SELECT * FROM `employee_information`";
                            $all_employee_details_qry_run = mysqli_query($conn,$all_employee_details_qry);
                            // call show function
                            show($all_employee_details_qry_run);
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
<?php include('footer.php') ?>
