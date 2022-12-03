<?php include('database_connection.php')?>
<?php include('header.php')?>
<?php include('account_header.php')?>
<?php include('pagination.php') ?>
<?php
    function get_row_count()
    {
        include('database_connection.php');
        $sql = "SELECT COUNT(DISTINCT(`year`)) as total_row FROM `student_payment_information` ";
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
            $student_payment_details_qry = "SELECT * , SUM(`amount`) FROM `student_payment_information` GROUP BY `year` ORDER BY `year` DESC LIMIT $offset, $total";
            $run = mysqli_query($conn, $student_payment_details_qry);
        }
        ?>
        <table class = "table table-bordered table-hover text-center table-responsive-lg">
            <tr>
                <thead class ="thead-light">
                    <th>Year</th>
                    <th>Total Amount</th>
                    <th>Monthly Details</th>
                </thead>
            </tr>
            <?php
            while($row = mysqli_fetch_assoc($run))
            {
                ?>
                <tr>
                    <td><?php echo $row['year']?></td>
                    <td><?php echo $row['SUM(`amount`)']?></td>
                    <td>
                        <a class = "btn btn_color" href="student_fees_monthly_details.php?year=<?php echo $row['year']?>"><b><span><i class="fas fa-calendar-week"></i></span> Monthly Details</b></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
?>
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12" id = "source_div">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Student Fees <span><i class="fas fa-info-circle"></i></span></h3>
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
                    <?php
                    if(isset($_POST['search']))
                    {
                        $year = $_POST['search_year_wise'];
                        if($year!=NULL)
                        {
                            $search_qry = "SELECT * , SUM(`amount`) FROM `student_payment_information` WHERE `year` = '$year' GROUP BY `year` ORDER BY `year` DESC ";
                        }
                        else
                        {
                            ?>
                            <script>
                                window.alert("Please Fill Search Field");
                                window.location = "student_fees.php";
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
                    else
                    {
                        ?>
                        <div class="col-lg-12 col-12">
                            <?php
                            $run =0;
                            $page_name = 'student_fees';
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
<?php include('account_footer.php')?>
<?php include('footer.php')?>
