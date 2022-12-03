<?php include('header.php') ?> <!-- To determine whether admin is logged in or not-->
<?php include('database_connection.php')?>
<?php
if(!isset($_GET['year']))
{
    ?>
    <script>
        window.location = "home.php";
    </script>
    <?php
}
else if(isset($_GET['year']))
{
    // Start of Whether an id is valid or not
    $year_validation_qry = "SELECT * FROM `donation_information` WHERE `year` = '$_GET[year]' LIMIT 1";
    $year_validation_qry_run = mysqli_query($conn, $year_validation_qry);
    $year_validation_qry_run_res = mysqli_fetch_assoc($year_validation_qry_run);
    if($year_validation_qry_run_res == false)
    {
        ?>
        <script>
            window.alert('Invalid Id');
            window.location = "home.php";
        </script>
        <?php
    }
    //End of Whether an id is valid or not
}
?>
<?php include('account_header.php')?>
<div class="container tab-pane"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12" id = "source_div">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-12 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Year <?php echo $_GET['year']?> Donation Details <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class = "table table-bordered table-hover text-center table-responsive-lg">
                        <tr>
                            <thead class ="thead-light">
                                <th>Source Name</th>
                                <th>Month</th>
                                <th>Amount</th>
                                <th>Entry Date</th>
                            </thead>
                        </tr>
                        <?php
                        $donation_information_qry_month_wise = "SELECT *  FROM `donation_information` WHERE `year` = '$_GET[year]'";
                        $run_donation_information_qry_month_wise = mysqli_query($conn, $donation_information_qry_month_wise);

                        $month_name =   array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

                        while($row = mysqli_fetch_assoc($run_donation_information_qry_month_wise))
                        {
                            ?>
                            <tr>
                                <td><?php echo $row['source_name']; ?></td>
                                <td><?php echo $month_name[$row['month']]; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['entry_date']; ?></td>
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
<?php include('account_footer.php')?>
<?php include('footer.php')?>
