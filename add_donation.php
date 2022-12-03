<?php include("database_connection.php");?>
<?php include('header.php')?>
<?php include('account_header.php')?>
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class = "text-center card_header_color text-uppercase">Donation Source Form <span><i class="fas fa-file-alt"></i></span></h3>
                </div>
                <div class="card-body">
                    <form action="" method = "POST">
                        <div class="row m-3 justify-content-center">
                            <div class="col-lg-8 col-md-12 col-12 ">
                                <div class="form-group">
                                    <label for="">Source Name:</label>
                                    <br>
                                    <input type="text" class = "form-control" name = "source_name" required placeholder="Enter Income Source Name" value = "<?php
                                    if(isset($_POST['source_name']))
                                    {
                                        echo $_POST['source_name'];
                                    }
                                    ?>">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12 col-12">
                                <div class="form-group">
                                    <label for="">Amount:</label>
                                    <br>
                                    <input type="number" name = "amount" class = "form-control"required placeholder="Enter Amount" value = "<?php if(isset($_POST['amount']))
                                    {
                                        echo $_POST['amount'];
                                    }
                                    ?>">
                                    <p id = "amount" class = "text-danger font-weight-bold"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-3 justify-content-center">
                            <div class=" col-lg-6 col-10">
                                <div class="form-group">
                                    <input type="submit" name = "donation_form_submit" class = "form-control btn btn_color_employee" value = "Enter">
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
    if(isset($_POST['donation_form_submit']))
    {
        $source_name = $_POST['source_name'];
        $amount = $_POST['amount'];
        $entry_date = date('Y-m-d');

        if($amount<=0)
        {
            ?>
            <script>
                document.getElementById('amount').innerHTML = "Amount Can Not Be 0 Or Negative";
            </script>
            <?php
            exit();
        }

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

        $insert_qry = "INSERT INTO `donation_information`(`source_name`, `amount`, `month`, `year`, `entry_date`) VALUES ('$source_name','$amount','$entry_month','$entry_year','$entry_date')";
        $run_insert_qry = mysqli_query($conn,$insert_qry);
        if($run_insert_qry)
        {

            // Find whether a date similar to entry_date exists or not
            $find_cmn_date = "SELECT `date` FROM `daily_account_common_date` WHERE `date` = '$entry_date'";
            $res = mysqli_query($conn, $find_cmn_date);
            if( mysqli_num_rows($res)==0)
            {
                // Start of insert into daily_account_common_date for daily account
                $insert_daily_account_cmn_date_qry = "INSERT INTO `daily_account_common_date` (`date`) VALUES('$entry_date')";
                $run_insert_daily_account_cmn_date_qry = mysqli_query($conn, $insert_daily_account_cmn_date_qry);
                // End of insert into daily_account_common_date for daily account
            }
            ?>
            <script>
                window.alert('Donation Process Completed');
                window.location = "donation_information.php";
            </script>
            <?php
        }

    }
?>
<?php include('account_footer.php')?>
<?php include('footer.php')?>
