<?php include('database_connection.php') ?>
<?php include('header.php') ?>
<?php include('student_payment_header.php') ?>
<?php
    function show($run)
    {
        $month_name =   array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");
        ?>
        <table class = "table table-bordered table-hover text-center">
            <tr>
                <thead class ="thead-light">
                    <th>Month</th>
                    <th>Year</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Payment Date</th>
                    <th>View</th>
                    <th>Remove</th>
                </thead>
            </tr>
            <?php
            while($row = mysqli_fetch_assoc($run))
            {
                ?>
                <tr>
                    <td><?php echo $month_name[$row['month']];?></td>
                    <td><?php echo $row['year'];?></td>
                    <td><?php echo $row['amount'];?></td>
                    <td>Clear</td>
                    <td><?php echo $row['payment_date'];?></td>
                    <td>
                        <a  class = "btn btn_color" href="view_payment_details.php?payment_id=<?php echo $row['id']?>"><b><span><i class="fas fa-eye "></i></span> View</b></a>
                    </td>
                    <td>
                        <button class = "btn btn_color" onclick = "deleteConfirmation(<?php echo $_GET['id']; ?>,<?php echo $row['id'];?>)"><b><span><i class="fas fa-eraser"></i></span> Remove</b></button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
?>
<!-- Start of Payment Div -->
<div id="payment" class="container tab-pane"><br>
    <div class="col-lg-12 col-12">
        <!-- Start of Design of Search Button -->
        <form action="" method = "POST">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-3 col-12 mb-3">
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
                <div class="col-lg-3 col-md-3 col-12 mb-3">
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
                $search_qry = "SELECT * FROM `student_payment_information` WHERE ";
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
                if($count==1)
                {
                    ?>
                    <script>
                        window.alert("Please Select At least 1 field");
                        window.location = "student_payment_details.php?id=<?php echo $_GET['id'] ?>";
                    </script>
                    <?php
                }
                else
                {
                    $search_qry .= " && `student_id` = '$_GET[id]'";
                }
                $run_search_qry = mysqli_query($conn, $search_qry);
                ?>
                <div class="col-lg-12 col-12">
                    <!-- Call show function -->
                    <?php show($run_search_qry); ?>
                </div>
                <?php
            }
            // End of qry for Search Button
            else
            {
                ?>
                <div class="col-lg-12 col-12">
                    <?php
                    $clear_payment_qry = "SELECT * FROM `student_payment_information` WHERE `student_id` = '$_GET[id]'";
                    $clear_payment_qry_run = mysqli_query($conn,$clear_payment_qry);
                    show($clear_payment_qry_run);
                    ?>
                </div>
                <?php
            }
        ?>
    </div>
</div>

<script>
    function deleteConfirmation(student_id, payment_id)
    {
        var del = window.confirm('Are You Sure Want To Delete?');
        if(del == true)
        {
            window.location='delete_student_payment.php?student_id='+student_id+'&payment_id='+payment_id;
        }
    }
</script>
<!-- End of Payment Div -->
<?php include('student_payment_footer.php') ?>
<?php include('footer.php') ?>
