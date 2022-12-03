<?php include("database_connection.php");?>
<?php include('header.php')?>
<?php include('account_header.php')?>
<?php include('pagination.php')?>
<?php
    function get_row_count()
    {
        include('database_connection.php');
        $sql = "SELECT COUNT(`id`) as total_row FROM `daily_account_common_date` ";
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
            $select_daily_account_cmn_date = "SELECT * FROM `daily_account_common_date` ORDER BY date DESC LIMIT $offset, $total";
            $run = mysqli_query($conn, $select_daily_account_cmn_date);
        }
        ?>
        <table class = "table table-bordered table-hover text-center table-responsive-sm ">
            <tr>
                <thead class ="thead-light">
                    <th>Date</th>
                    <th>Daily Details</th>
                </thead>
            </tr>
            <?php

            while($row = mysqli_fetch_assoc($run))
            {
                ?>
                <tr>
                    <td><?php echo $row['date'] ?></td>
                    <td>
                        <a class = "btn btn_color" href="daily_details.php?date=<?php echo $row['date']?>"><b><span><i class="fas fa-calendar-week"></i></span> Daily Details</b></a>
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
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Daily Account <span><i class="fas fa-poll-h"></i></span></h3>
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
                            <div class="col-lg-4 col-12 text-center mb-3 ">
                                <input type="submit" name="search" value="Search" class = "form-control btn_color_employee">
                            </div>
                            <div class="col-lg-4  col-12 text-center mb-3 ">
                                <input type="submit" class ="form-control btn_color_employee" name = "show_all" value = "Show All">
                            </div>
                        </div>
                    </form>
                    <!-- End of Design of Search Button -->
                    <!-- Start of Query for Serch button -->
                    <?php
                    if(isset($_POST['search']))
                    {
                        $date = $_POST['search_date_wise'];
                        if($date!=NULL)
                        {
                            $search_qry = "SELECT * FROM `daily_account_common_date` WHERE `date` = '$date'";
                        }
                        else
                        {
                            ?>
                            <script>
                                window.alert("Pleas Select Date");
                                window.location = "daily_account.php";
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
                        // End of qry for Search button
                    }
                    else
                    {
                        ?>
                        <div class="col-lg-12 col-12">
                            <?php
                            $run = 0;
                            $page_name = 'daily_account';
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
<!--End of Nav Tabs -->
<?php include('footer.php')?>
