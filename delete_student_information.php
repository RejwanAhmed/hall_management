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
<?php include("database_connection.php")?>

<?php
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
    $delete_qry = "DELETE FROM `student_information` WHERE `id` = '$_GET[id]'";
    $delete_qry_run = mysqli_query($conn,$delete_qry);
    $delete_student_payment_qry = "DELETE FROM `student_payment_information` WHERE `student_id` = '$_GET[id]'";
    $run_delete_student_payment_qry = mysqli_query($conn, $delete_student_payment_qry);
    if($delete_qry_run && $run_delete_student_payment_qry)
    {
        // Decrease the value of reserved seat by 1 for deleted student
        $update_room_infomration_qry = "UPDATE `room_information` SET `reserved_seat` = `reserved_seat` - '1' WHERE `id` = '$id_validation_qry_run_res[room_id_number]'";
        $run_update_room_information_qry = mysqli_query($conn, $update_room_infomration_qry);

        ?>
        <script>
            window.location = "student_information.php";
        </script>
        <?php
    }
?>
