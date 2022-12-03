<?php include('database_connection.php')?>
<?php include('header.php')?>
<?php include('pagination.php') ?>
<?php
    function get_row_count()
    {
        include('database_connection.php');
        $sql = "SELECT COUNT(`id`) as total_row FROM `room_information`";
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
            $select_room_informtion_qry = "SELECT * FROM `room_information` ORDER BY `room_no` ASC LIMIT $offset, $total";
            $run = mysqli_query($conn, $select_room_informtion_qry);
        }
        ?>
        <table class = "table table-bordered table-hover text-center table-responsive-lg">
            <tr>
                <thead class ="thead-light">
                    <th>Floor No</th>
                    <th>Room No</th>
                    <th>Total Seat</th>
                    <th>Available Seat</th>
                    <th>Modify</th>
                    <th>Remove</th>
                </thead>
            </tr>
            <?php
            while($row = mysqli_fetch_assoc($run))
            {
                ?>
                <tr>
                    <td><?php echo $row['floor_no']; ?></td>
                    <td><?php echo $row['room_no']; ?></td>
                    <td><?php echo $row['total_seat']; ?></td>
                    <td><?php echo $row['total_seat']-$row['reserved_seat']; ?></td>
                    <td>
                        <a class = "btn btn_color" href="update_room_information.php?id=<?php echo $row['id']?>"><b><span><i class="fas fa-edit"></i></span> Modify</b></a>
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
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12 col-12" id = "source_div">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-sm-3"></div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Room & Seat Information <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 text-center">
                            <a class = "btn btn-danger" href="add_room.php"><b><span><i class="far fa-plus-square"></i></span> Room</b></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Start of Search Button Design -->
                    <form action="" method = "POST">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-12 text-center mb-3">
                                <input type="submit" name = "available_seat" class = "form-control btn_color_employee" value = "Click To See Available Seats">
                            </div>
                            <div class="col-lg-4 col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class = "input-group-text"><i class = "fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class = "form-control" name = "search_room_wise" placeholder="Search By Room....." value = "<?php
                                    if(isset($_POST['show_all']))
                                    {
                                        echo "";
                                    }
                                    else if(isset($_POST['search_room_wise']))
                                    {
                                        echo "$_POST[search_room_wise]";
                                    }?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-12 text-center mb-3 ">
                                <input type="submit" name="search" value="Search" class = "form-control btn_color_employee">
                            </div>
                            <div class="col-lg-2 col-12 text-center mb-3 ">
                                <input type="submit" class ="form-control btn_color_employee" name = "show_all" value = "Show All">
                            </div>
                        </div>
                    </form>
                    <!-- End of Search Button Design -->

                    <!-- Start of qry for search button -->
                    <?php
                    if(isset($_POST['search']))
                    {
                        $room = $_POST['search_room_wise'];
                        $search_qry = "SELECT * FROM `room_information` WHERE `room_no` = '$room'";
                        $run_search_qry = mysqli_query($conn, $search_qry);
                        ?>
                        <div class="col-lg-12 col-12">
                            <!-- call display_content function -->
                            <?php display_content($run_search_qry,0,0); ?>
                            <!-- Offset and $total_data has been sent as 0 0 -->
                            <!-- Here no pagination applied -->
                        </div>
                        <?php
                    }
                    // End of qry for search button

                    // Start of Qry to see available seats
                    else if(isset($_POST['available_seat']))
                    {
                        $search_qry = "SELECT * FROM `room_information` WHERE `total_seat` != `reserved_seat` ORDER BY `room_no` ASC";
                        $run_search_qry = mysqli_query($conn, $search_qry);
                        ?>
                        <div class="col-lg-12 col-12">
                            <!-- call show function -->
                            <?php display_content($run_search_qry,0,0); ?>
                            <!-- Offset and $total_data has been sent as 0 0 -->
                            <!-- Here no pagination applied -->
                        </div>
                        <?php
                    }
                    // End of Qry to see available seats
                    else
                    {
                        ?>
                        <div class="col-lg-12 col-12">
                            <?php
                            $run = 0;
                            $page_name = 'total_room';
                            pagination($run,$page_name); // Here pagination is applied
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
            window.location='delete_room_information.php?id='+id;
        }
    }
</script>
<?php include('footer.php')?>
