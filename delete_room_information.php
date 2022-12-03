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
        $room_id_validation_qry = "SELECT * FROM `room_information` WHERE `id` = '$_GET[id]'";
        $room_id_validation_qry_run = mysqli_query($conn, $room_id_validation_qry);
        $room_id_validation_qry_run_res = mysqli_fetch_assoc($room_id_validation_qry_run);
        if($room_id_validation_qry_run_res==false)
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
    if($room_id_validation_qry_run_res['reserved_seat']!=0)
    {
        ?>
        <script>
            window.alert('Some students are assigned to this room. Before Deleting room please reassign the students to other room!');
            window.location = "total_room.php";
        </script>
        <?php
    }
    else
    {
        $delete_qry = "DELETE FROM `room_information` WHERE `id` = '$_GET[id]'";
        $delete_qry_run = mysqli_query($conn,$delete_qry);
        if($delete_qry_run)
        {
            ?>
            <script>
                window.location = "total_room.php";
            </script>
            <?php
        }
    }

?>
