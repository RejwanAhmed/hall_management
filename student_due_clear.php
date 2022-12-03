<?php
    // Code for solving the problem of documentation expired
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    // End of Code for solving the problem of documentation expired
    session_start();
    if(!isset($_SESSION['admin_login']))
    {
        ?>
        <script>
            window.location = "login.php";
        </script>
        <?php
    }
?>

<!-- Start of Student Clear Due -->
<?php
include('database_connection.php');
if(isset($_POST['clear_due']) && isset($_GET['id']) )
{
    $payment_date = date('Y-m-d');
    $amount = $_POST['amount'];
    $month = $_GET['month'];
    $year = $_GET['year'];

    if($amount<=0)
    {
        ?>
        <script>
            window.alert("Amount Can Not Be Negative or 0");
            window.location = "student_payment_profile.php?id=<?php echo $_GET['id'] ?>";
        </script>
        <?php
        exit();
    }

    $payment_clear_button_qry = "INSERT INTO `student_payment_information`(`student_id`, `month`, `year`, `amount`, `payment_status`, `payment_date`) VALUES ('$_GET[id]','$month','$year','$amount','1','$payment_date')";
    $payment_clear_button_qry_run = mysqli_query($conn,$payment_clear_button_qry);

    // Find whether a date similar to payment_date exists or not
    $find_cmn_date = "SELECT `date` FROM `daily_account_common_date` WHERE `date` = '$payment_date'";
    $res = mysqli_query($conn, $find_cmn_date);
    if( mysqli_num_rows($res)==0)
    {
        // Start of insert into daily_account_common_date for daily account
        $insert_daily_account_cmn_date_qry = "INSERT INTO `daily_account_common_date` (`date`) VALUES('$payment_date')";
        $run_insert_daily_account_cmn_date_qry = mysqli_query($conn, $insert_daily_account_cmn_date_qry);
        // End of insert into daily_account_common_date for daily account
    }

    ?>

    <script>
        window.alert("Due Cleared Successfully");
        window.location = "student_monthly_due.php?id=<?php echo $_GET['id']?>";
    </script>

    <?php

}
else
{
    ?>
    <script>
        window.location = "home.php";
    </script>
    <?php
}
?>
<!-- Start of Student Clear Due -->
