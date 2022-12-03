<?php include('database_connection.php')?>
<?php include('header.php')?>
<?php include('account_header.php')?>
<?php include('pagination.php')?>
<?php
    function get_row_count()
    {
        include('database_connection.php');
        $sql = "SELECT COUNT(`id`) as total_row FROM `donation_information` ";
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
            $donation_information_qry = "SELECT *  FROM `donation_information` ORDER BY `entry_date` DESC LIMIT $offset, $total";
            $run = mysqli_query($conn, $donation_information_qry);
        }
        ?>
        <table class = "table table-bordered table-hover text-center table-responsive-lg">
            <tr>
                <thead class ="thead-light">
                    <th>Source Name</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Amount</th>
                    <th>Entry Date</th>
                    <th>Modify</th>
                    <th>Remove</th>
                </thead>
            </tr>
            <?php
            $month_name =   array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

            while($row = mysqli_fetch_assoc($run))
            {
                ?>
                <tr>
                    <td><?php echo $row['source_name']; ?></td>
                    <td><?php echo $month_name[$row['month']]; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['entry_date']; ?></td>
                    <td>
                        <a class = "btn btn_color" href="update_donation_information.php?id=<?php echo $row['id']?>"><b><span><i class="fas fa-edit"></i></span> Modify</b></a>
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
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-3 col-12"></div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">All Donation Information <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 text-center">
                            <a href="add_donation.php" class = "btn btn-danger"><b><span><i class="far fa-plus-square"></i></span> donation</b></a>
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
                            <div class="col-lg-4 col-md-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <input type="date" class = "form-control" name = "search_date_wise" value = "<?php if(isset($_POST['show_all']))
                                    {
                                        echo "";
                                    }
                                    else if(isset($_POST['search_date_wise']))
                                    {
                                        echo "$_POST[search_date_wise]";
                                    }?>">
                                </div>
                            </div>
                            <div class="col-lg-3 col-12 text-center mb-3 ">
                                <input type="submit" name="search" value="Search" class = "form-control btn_color_employee">
                            </div>
                            <div class="col-lg-3  col-12 text-center mb-3 ">
                                <input type="submit" class ="form-control btn_color_employee" name = "show_all" value = "Show All">
                            </div>
                        </div>
                    </form>
                    <!-- End of Design of Search Button -->

                    <!-- Start of Query For Search Button -->
                    <?php
                        if(isset($_POST['search']))
                        {
                            $year = $_POST['search_year_wise'];
                            $month = $_POST['search_month_wise'];
                            $date = $_POST['search_date_wise'];
                            $search_qry = "SELECT * FROM `donation_information` WHERE ";
                            $count=1;
                            if($year!=NULL)
                            {
                                $count++;
                                $search_qry .= " `year` = '$year'";
                            }
                            if($month!=NULL)
                            {
                                if($count>1)
                                {
                                    $search_qry.= " && ";
                                }
                                $search_qry .= "`month` = '$month'";
                                $count++;
                            }
                            if($date!=NULL)
                            {
                                if($count>1)
                                {
                                    $search_qry.= " && ";
                                }
                                $search_qry .= "`entry_date` = '$date'";
                                $count++;
                            }
                            if($count==1)
                            {
                                ?>
                                <script>
                                    window.alert("Please Select At least 1 field");
                                    window.location = "donation_information.php";
                                </script>
                                <?php
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
                        }
                        // End of qry for Search Button
                        else
                        {
                            ?>
                            <div class="col-lg-12 col-12">
                                <?php
                                $run = 0;
                                $page_name = 'donation_information';
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
<script>
    function deleteConfirmation(id)
    {
        var del = window.confirm('Are You Sure Want To Delete?');
        if(del == true)
        {
            window.location='delete_donation_information.php?id='+id;
        }
    }
</script>
<?php include('account_footer.php')?>
<?php include('footer.php')?>
