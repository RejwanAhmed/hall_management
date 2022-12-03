<?php include('database_connection.php')?>
<?php include('header.php') ?> <!-- Header is first included so that it can verify whether admin is logged in or not -->
<?php include('student_payment_header.php') ?>
<!-- Start of Payment Due Div -->
<div class="container tab-pane active "><br>
    <?php
    $payment_qry = "SELECT * FROM `student_payment_information` WHERE `student_id` = '$_GET[id]'";
    $payment_qry_run = mysqli_query($conn,$payment_qry);
    $entry_date = $id_validation_qry_run_res['entry_date'];

    // Get Entry Month & Year and Current Month & Year
    $entry_year = $entry_date['0'].$entry_date['1'].$entry_date['2'].$entry_date['3'];

    if($entry_date['5']==0)
    {
        $entry_month =$entry_date['6'];
    }
    else
    {
        $entry_month = $entry_date['5'].$entry_date['6'];
    }


    $current_month = date('m');
    $current_year = date('Y');
    // Get Entry Month & Year and Current Month & Year

    // Just for showing month name to table
    $month_name =   array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

    // Start of push all payment month and year details in array
    $payment_clr_month = array();
    $payment_clr_year = array();
    while($row=mysqli_fetch_assoc($payment_qry_run))
    {
        array_push($payment_clr_month,$row['month']);
        array_push($payment_clr_year,$row['year']);
    }
    // End of push all payment month and year details in array

    $total_data = count($payment_clr_month);
    // Start of bubble_Sort according to year
    for($i=0;$i<$total_data-1;$i++)
    {
        for($j=0;$j<$total_data-$i-1;$j++)
        {
            if($payment_clr_year[$j]>$payment_clr_year[$j+1])
            {
                $swap1 = $payment_clr_year[$j];
                $payment_clr_year[$j] = $payment_clr_year[$j+1];
                $payment_clr_year[$j+1] = $swap1;

                $swap2 = $payment_clr_month[$j];
                $payment_clr_month[$j] = $payment_clr_month[$j+1];
                $payment_clr_month[$j+1] = $swap2;
            }
        }
    }
    // End of bubble sort according to Year

    // Start of bubble sort according to month
    for($i=0;$i<$total_data-1;$i++)
    {
        for($j=0;$j<$total_data-$i-1;$j++)
        {
            if($payment_clr_month[$j]>$payment_clr_month[$j+1] && $payment_clr_year[$j]==$payment_clr_year[$j+1])
            {
                $swap1 = $payment_clr_month[$j];
                $payment_clr_month[$j] = $payment_clr_month[$j+1];
                $payment_clr_month[$j+1] = $swap1;

                $swap2 = $payment_clr_year[$j];
                $payment_clr_year[$j] = $payment_clr_year[$j+1];
                $payment_clr_year[$j+1] = $swap2;
            }
        }
    }
    // End of bubble_sort according to month
    ?>
    <div class="col-lg-12 col-12">
        <table class = "table table-bordered table-hover text-center ">
            <tr>
                <thead class ="thead-light">
                    <th>Month</th>
                    <th>Year</th>
                    <th>Amount</th>
                    <th>Payment</th>
                </thead>
            </tr>
            <?php
            $pcm = 0;   // payment clear month
            $pcy = 0;   // payment clear year
            $no_due_remaining =0;
            for($i=$entry_month,$j=$entry_year;$j<=$current_year;$i++)
            {

                if($total_data!=0 && $payment_clr_month[$pcm]==$i && $payment_clr_year[$pcy]==$j)
                {
                    $pcm++;
                    $pcy++;
                    if($total_data==$pcm || $total_data==$pcy)
                    {
                        $pcm--;
                        $pcy--;
                    }
                }
                else
                {
                    $no_due_remaining =1;
                    ?>
                    <tr>
                        <td><?php echo $month_name[$i];?></td>
                        <td><?php echo $j;?></td>
                        <!-- Start of Due Clear Code is in another page -->
                        <form action = "student_due_clear.php?id=<?php echo $_GET['id']?>&month=<?php echo $i?>&year=<?php echo $j?>" method = "post" >
                            <td>
                                <input type="number" name = "amount" placeholder="Enter Amount" class = "form-control" required>
                            </td>
                            <td>
                                <input type="submit" name = "clear_due" class = "btn btn_color font-weight-bold" value = "Clear Due">
                            </td>
                        </form>
                        <!-- End of Due Clear Code is in another page -->
                    </tr>
                    <?php
                }
                if($i==12)
                {
                    $i=0;
                    $j++;
                }
                if($j==$current_year && $i==$current_month)
                {
                    break;
                }
            }
            ?>

        </table>
    </div>
    <?php
    if($no_due_remaining==0)
    {
        echo "<p class = 'alert alert-danger'>Nothing To Show<p>";
    }
    ?>
</div>
<!-- End of Payment Due Div -->
<?php include('student_payment_footer.php') ?>
<?php include('footer.php') ?>
