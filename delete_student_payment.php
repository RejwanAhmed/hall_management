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
<?php include('database_connection.php')?>
<?php
    if(!isset($_GET['student_id']) && !isset($_GET['payment_id']))
    {
        ?>
        <script>
            window.location = "home.php";
        </script>
        <?php
    }
    else if(isset($_GET['student_id']) && isset($_GET['payment_id']))
    {
        // Start of Whether an id is valid or not
        $student_payment_qry = "SELECT * FROM `student_payment_information` WHERE `id` = '$_GET[payment_id]'";
        $student_payment_qry_run = mysqli_query($conn, $student_payment_qry);
        $student_payment_qry_run_res = mysqli_fetch_assoc($student_payment_qry_run);
        if($student_payment_qry_run_res==false)
        {
            ?>
            <script>
                window.alert('Invalid Id');
                window.location = "home.php";
            </script>
            <?php
            exit();
        }
        //End of Whether an id is valid or not
    }

    $delete_qry = "DELETE FROM `student_payment_information` WHERE `id` = '$_GET[payment_id]'";
    $delete_qry_run = mysqli_query($conn,$delete_qry);
    if($delete_qry_run)
    {
        ?>
        <script>
            window.location = "student_payment_details.php?id=<?php echo $_GET['student_id'] ?>";
        </script>
        <?php
    }

?>
