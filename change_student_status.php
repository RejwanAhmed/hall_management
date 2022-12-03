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

<?php
    include("database_connection.php");
    if(!isset($_GET['id']))
    {
        ?>
        <script>
            window.location = "home.php";
        </script>
        <?php
    }
    else if(isset($_GET['id']))
    {
        // Start of Whether an id is valid or not
        $id_validation_qry = "SELECT * FROM `student_information` WHERE `id` = '$_GET[id]'";
        $id_validation_qry_run = mysqli_query($conn, $id_validation_qry);
        $id_validation_qry_run_res = mysqli_fetch_assoc($id_validation_qry_run);
        if($id_validation_qry_run_res==false)
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

    // Status Changing
    if($id_validation_qry_run_res['status']==1)
    {
        $change_student_status_qry = "UPDATE `student_information` SET `status` = '0' WHERE `id` = '$_GET[id]'";
        $update_room_details_qry = "UPDATE `room_information` SET `reserved_seat` = `reserved_seat` - '1' WHERE `id` = '$id_validation_qry_run_res[room_id_number]'";
        $update_room_details_qry_run = mysqli_query($conn, $update_room_details_qry);
    }
    else if($id_validation_qry_run_res['status']==0)
    {
        $select_room_details_qry = "SELECT * FROM `room_information` WHERE `id` = '$id_validation_qry_run_res[room_id_number]'";
        $run_select_room_details_qry = mysqli_query($conn, $select_room_details_qry);
        $row = mysqli_fetch_assoc($run_select_room_details_qry);
        if($row['reserved_seat']==4)
        {
            ?>
            <script>
                window.alert('To Active This Student Please Make Available A Seat In Room Number '+ <?php echo $row['room_no'] ?>+' Or Assign This Student To Another Room');
                window.location = "passed_out_student.php";
            </script>
            <?php
        }
        else
        {
            $update_room_details_qry = "UPDATE `room_information` SET `reserved_seat` = `reserved_seat` + '1' WHERE `id` = '$id_validation_qry_run_res[room_id_number]'";
            $update_room_details_qry_run = mysqli_query($conn, $update_room_details_qry);
            $change_student_status_qry = "UPDATE `student_information` SET `status` = '1' WHERE `id` = '$_GET[id]'";
        }


    }
    $run_change_student_status_qry = mysqli_query($conn, $change_student_status_qry);
    if($run_change_student_status_qry)
    {
        ?>
        <script>
            window.alert('Status Changed Successfully');
            window.location = "student_information.php";
        </script>
        <?php
    }
?>
