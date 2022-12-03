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
        // Start of Whether an id is valid or not and Student Query by joining with department_information and room_information

        $id_validation_qry = "SELECT s.id, s.name, s.father_name, s.mother_name, s.image, s.date_of_birth, s.district, s.contact_number, d.department_name, s.session, s.roll_number, r.room_no as room_id_number, s.entry_date FROM student_information as s INNER JOIN department_information as d ON s.department_id_number = d.id INNER JOIN room_information as r ON s.room_id_number=r.id WHERE s.id = '$_GET[id]'";
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

        // End of Whether an id is valid or not and Student Query by joining with department_information and room_information
    }
?>
<!-- Start of Nav Tabs -->
<div class="container mt-5">
    <div class="row justify-content-center ">
        <div class="col-lg-12 shadow-lg">
            <ul class="nav nav-tabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link" href="student_monthly_due.php?id=<?php echo $_GET['id'] ?>"><?php echo $id_validation_qry_run_res['name']?> Monthly Due</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="student_payment_details.php?id=<?php echo $_GET['id'] ?>"><?php echo $id_validation_qry_run_res['name']?> Payment Details</a>
                </li>
                <!-- <li class="nav-item ">
                    <a class="nav-link " data-toggle="tab" href="#profile"><?php echo $id_validation_qry_run_res['name']?> Profile</a>
                </li> -->
            </ul>
