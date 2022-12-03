<?php include('header.php') ?> <!-- To determine whether admin is logged in or not-->
<?php include('database_connection.php')?>
<?php
if(!isset($_GET['date']))
{
    ?>
    <script>
        window.location = "home.php";
    </script>
    <?php
}
else if(isset($_GET['date']))
{
    // Start of Whether an id is valid or not
    $date_validation_qry = "SELECT * FROM `daily_account_common_date` WHERE `date` = '$_GET[date]' LIMIT 1";
    $date_validation_qry_run = mysqli_query($conn, $date_validation_qry);
    $date_validation_qry_run_res = mysqli_fetch_assoc($date_validation_qry_run);
    if($date_validation_qry_run_res == false)
    {
        ?>
        <script>
            window.alert('Invalid date');
            window.location = "home.php";
        </script>
        <?php
    }
    //End of Whether an id is valid or not
}
?>
<?php include('account_header.php') ?>
<div class="container tab-pane"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12" id = "source_div">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Date: <?php echo $_GET['date'] ?> <span><i class="fas fa-poll-h"></i></span></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-12 col-12" >
                            <div class="card">
                                <div class="card-header">
                                    <h4 class = "text-center text-uppercase card_header_color">Student Fees</h4>
                                </div>
                                <div class="card-body">
                                    <table class = "table table-bordered table-hover text-center table-responsive-sm">

                                        <tr>
                                            <thead class ="thead-light">
                                                <th>Paid Student Number</th>
                                                <th>Total Amount</th>
                                            </thead>
                                        </tr>
                                        <?php
                                        $select_student_payment = "SELECT COUNT(`id`) as total_student, SUM(`amount`) as total_amount FROM `student_payment_information` WHERE `payment_date` = '$_GET[date]'";
                                        $run_select_student_payment = mysqli_query($conn, $select_student_payment);
                                        $row_select_student_payment = mysqli_num_rows($run_select_student_payment);
                                        $student_count = 0;
                                        while($row = mysqli_fetch_assoc($run_select_student_payment))
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                        if($row['total_student']!=0)
                                                        {
                                                            echo $row['total_student'];
                                                            $student_count=1;
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $row['total_amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12" >
                            <div class="card">
                                <div class="card-header">
                                    <h4 class = "text-center text-uppercase card_header_color">Donation</h4>
                                </div>
                                <div class="card-body">
                                    <table class = "table table-bordered table-hover text-center table-responsive-sm">

                                        <tr>
                                            <thead class ="thead-light">
                                                <th>Source Name</th>
                                                <th>Amount</th>
                                            </thead>
                                        </tr>
                                        <?php
                                        $select_donation = "SELECT `source_name` , `amount` FROM `donation_information` WHERE `entry_date` = '$_GET[date]'";
                                        $run_select_donation = mysqli_query($conn, $select_donation);
                                        $row_select_donation = mysqli_num_rows($run_select_donation);
                                        while($row = mysqli_fetch_assoc($run_select_donation))
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['source_name']; ?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12" >
                            <div class="card">
                                <div class="card-header">
                                    <h4 class = "text-center text-uppercase card_header_color">Expense</h4>
                                </div>
                                <div class="card-body">
                                    <table class = "table table-bordered table-hover text-center table-responsive-sm">
                                        <tr>
                                            <thead class ="thead-light">
                                                <th>Expense Name</th>
                                                <th>Amount</th>
                                            </thead>
                                        </tr>
                                        <?php
                                        $select_expense = "SELECT `expense_name` , `amount` FROM `expense_information` WHERE `expense_date` = '$_GET[date]'";
                                        $run_select_expense = mysqli_query($conn, $select_expense);
                                        $row_select_expense = mysqli_num_rows($run_select_expense);
                                        while($row = mysqli_fetch_assoc($run_select_expense))
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['expense_name']; ?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- If all data of this date has been deleted then show a delete button to delete this date -->
                        <?php
                            if($student_count==0 && $row_select_donation==0 && $row_select_expense==0)
                            {
                                ?>

                                <div class="col-lg-4 col-md-4">
                                    <h4 class = "alert-danger text-center">All Data Related To This Date Has Been Deleted.</h4>
                                    <form action="" method = "POST">
                                        <input type="submit" class = "form-control btn btn_color_employee" value = "Delete This Date" name = "delete_date">
                                    </form>
                                </div>
                                <?php
                            }

                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start of Delete Date -->
<?php
    if(isset($_POST['delete_date']))
    {
        $delete_date_qry = "DELETE FROM `daily_account_common_date` WHERE `date` = '$_GET[date]'";
        $run_delete_date_qry = mysqli_query($conn,$delete_date_qry);
        if($run_delete_date_qry)
        {
            ?>
            <script>
                window.alert("Date Has Been Deleted");
                window.location = "daily_account.php";
            </script>
            <?php
        }
    }
?>
<!-- End of Delete Date -->
<?php include('account_footer.php') ?>
<?php include('footer.php') ?>
