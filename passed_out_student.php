<?php include('database_connection.php')?>
<?php include('header.php')?>
<?php include('student_header.php')?>
<?php include('pagination.php')?>
<?php
    function get_row_count()
    {
        include('database_connection.php');
        $sql = "SELECT COUNT(`id`) as total_row FROM `student_information` WHERE `status` = 0";
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
            $all_student_details_qry = "SELECT s.id, s.name, s.contact_number, d.department_name, s.session, s.roll_number, r.room_no as room_id_number FROM student_information as s INNER JOIN department_information as d ON s.department_id_number = d.id INNER JOIN room_information as r ON s.room_id_number=r.id WHERE `status` = '0' LIMIT $offset, $total";
            $run = mysqli_query($conn,$all_student_details_qry);
        }
        ?>
        <table class = "table table-bordered table-hover text-center table-lg-responsive">
            <tr>
                <thead class ="thead-light">
                    <th>Name</th>
                    <th>Department</th>
                    <th>Session</th>
                    <th>Roll No</th>
                    <th>Contact No</th>
                    <th>Room</th>
                    <th>Status</th>
                    <th>View</th>
                </thead>
            </tr>
            <?php
            while($row = mysqli_fetch_assoc($run))
            {
                ?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['department_name'];?></td>
                    <td><?php echo $row['session'];?></td>
                    <td><?php echo $row['roll_number'];?></td>
                    <td><?php echo $row['contact_number'];?></td>
                    <td><?php echo $row['room_id_number'];?></td>
                    <td><a class = "btn btn_color" href="change_student_status.php?id=<?php echo $row['id']?>"><b><span><i class="fas fa-check"></i></span> Active</b>
                    </a></td>
                    <td>    <a class = "btn btn_color" href="view_student_details.php?id=<?php echo $row['id']?>"><b><span><i class="fas fa-eye "></i></span> View</b></a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
?>
<!-- Start of Passed Out Student Div -->
<div class="container tab-pane"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Passed Out Student <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Start of Search Button Design -->
                    <form action="" method = "POST">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class = "form-control" name = "search_name_wise" id = "search_name_wise" placeholder="Search By Name....." value = "<?php
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

                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class = "form-control" name = "search_contact_wise" id = "search_contact_wise" placeholder="Search By Contact....." value = "<?php if(isset($_POST['show_all']))
                                    {
                                        echo "";
                                    }
                                    else if(isset($_POST['search_contact_wise']))
                                    {
                                        echo "$_POST[search_contact_wise]";
                                    }?>">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <select name="search_department_wise"  class = "form-control">
                                        <option value="">Select Department</option>
                                        <!-- Start of Query tp get all the department_name in drop down -->
                                        <?php
                                            $qry = "SELECT * FROM `department_information`";
                                            $res = mysqli_query($conn, $qry);
                                            while($row = mysqli_fetch_assoc($res))
                                            {
                                                ?>
                                                    <option value = "<?php echo $row['id'] ?>"><?php echo $row['department_name'];?></option>
                                                <?php
                                            }
                                        ?>
                                        <!-- End of Query tp get all the department_name in drop down -->
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <select class = "form-control" name="search_session_wise">
                                        <option value="" >Please Select Session</option>
                                        <?php
    											 $c = 2006;
    											$today = date("Y");

    											 for($i=$c; $i<$today; $i++)
    											 {
    												 $r = $i + 1;
                                                     $session= $i."-".$r;
    												 echo "<option value='$session'>";
                                                     echo $session;
                                                     echo "</option>";
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
                                    <input type="text" class = "form-control" name = "search_roll_wise" id = "search_roll_wise" placeholder="Search By Roll Number....." value = "<?php if(isset($_POST['show_all']))
                                    {
                                        echo "";
                                    }
                                    else if(isset($_POST['search_roll_wise']))
                                    {
                                        echo "$_POST[search_roll_wise]";
                                    }?>">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <select name="search_room_wise" class = "form-control" >
                                        <option value="">Select Room Number</option>
                                        <!-- Start of Query to get all available the room_name in drop down -->
                                        <?php
                                            $qry = "SELECT * FROM `room_information` ORDER BY `room_no` ASC ";
                                            $res = mysqli_query($conn, $qry);
                                            while($row = mysqli_fetch_assoc($res))
                                            {
                                                ?>
                                                    <option value = "<?php echo $row['id'] ?>"><?php echo $row['room_no'];?></option>
                                                <?php
                                            }
                                        ?>
                                        <!-- End of Query to get all available the room_name in drop down -->
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class = "form-control" name = "search_district_wise" placeholder="Search By District....." value = "<?php if(isset($_POST['show_all']))
                                    {
                                        echo "";
                                    }
                                    else if(isset($_POST['search_district_wise']))
                                    {
                                        echo "$_POST[search_district_wise]";
                                    }?>">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 text-center mb-3 ">
                                <input type="submit" name="search" value="Search" class = "form-control btn_color_employee">
                            </div>
                            <div class="col-lg-4 col-md-4  col-12 text-center mb-3 ">
                                <input type="submit" class ="form-control btn_color_employee" name = "show_all" value = "Show All">
                            </div>
                        </div>
                    </form>
                    <!-- End of Search Button Design -->

                    <!-- Start of qry for search button -->
                    <?php
                    if(isset($_POST['search']))
                    {
                        $name = $_POST['search_name_wise'];
                        $contact = $_POST['search_contact_wise'];
                        $department = $_POST['search_department_wise'];
                        $session = $_POST['search_session_wise'];
                        $roll = $_POST['search_roll_wise'];
                        $room = $_POST['search_room_wise'];
                        $district = $_POST['search_district_wise'];

                        $search_qry = "SELECT s.id, s.name, s.contact_number, d.department_name, s.session, s.roll_number, r.room_no as room_id_number FROM student_information as s INNER JOIN department_information as d ON s.department_id_number = d.id INNER JOIN room_information as r ON s.room_id_number=r.id WHERE ";
                        $count=1;
                        if($name!=NULL)
                        {
                            $count++;
                            $search_qry.= "`name` like '%$name%'";
                        }
                        if($contact!=NULL)
                        {
                            if($count>1)
                            {
                                $search_qry.=" && ";
                            }
                            $search_qry.="`contact_number` = '$contact'";
                            $count++;
                        }
                        if($department!=NULL)
                        {
                            if($count>1)
                            {
                                $search_qry.=" && ";
                            }
                            $search_qry.="`department_id_number` = '$department'";
                            $count++;
                        }
                        if($session!=NULL)
                        {
                            if($count>1)
                            {
                                $search_qry.=" && ";
                            }
                            $search_qry.="`session` = '$session'";
                            $count++;
                        }
                        if($roll!=NULL)
                        {
                            if($count>1)
                            {
                                $search_qry.=" && ";
                            }
                            $search_qry.="`roll_number` = '$roll'";
                            $count++;
                        }
                        if($room!=NULL)
                        {
                            if($count>1)
                            {
                                $search_qry.=" && ";
                            }
                            $search_qry.="`room_id_number` = '$room'";
                            $count++;
                        }
                        if($district!=NULL)
                        {
                            if($count>1)
                            {
                                $search_qry.=" && ";
                            }
                            $search_qry.="`district` like '%$district%'";
                            $count++;
                        }
                        if($count==1)
                        {
                            ?>
                            <script>
                                window.alert("Please Select At least 1 field");
                                window.location = "passed_out_student.php";
                            </script>
                            <?php
                        }
                        else
                        {
                            $search_qry.=" && `status` = '0'";
                        }
                        $run_search_qry = mysqli_query($conn, $search_qry);
                        ?>
                        <div class="col-lg-12 col-12">
                            <!-- Call display_content Function -->
                            <?php display_content($run_search_qry,0,0); ?>
                            <!-- Offset and $total_data has been sent as 0 0 -->
                            <!-- Here no pagination applied -->
                        </div>
                        <?php
                    }
                    // End of qry for search button
                    else
                    {
                        ?>
                        <div class="col-lg-12 col-12">
                            <?php
                            $run =0;
                            $page_name = 'passed_out_student';
                            pagination($run, $page_name);
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
<!-- End of Passed Out Student Div -->
<?php include('student_footer.php')?>
<?php include('footer.php')?>
