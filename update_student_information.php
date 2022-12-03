<?php include('header.php') ?> <!-- Header is first included so that it can verify whether admin is logged in or not -->
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
    $student_id_validation_qry = "SELECT * FROM `student_information` WHERE `id` = '$_GET[id]'";
    $student_id_validation_qry_run = mysqli_query($conn, $student_id_validation_qry);
    $student_id_validation_qry_run_res = mysqli_fetch_assoc($student_id_validation_qry_run);
    if($student_id_validation_qry_run_res==false)
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

<?php include('student_header.php') ?>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-12 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h3 class ="text-center card_header_color text-uppercase">Update <?php echo $student_id_validation_qry_run_res['name']?> Information<span class = "ml-2"><i class="fas fa-file-alt"></i></span></h3>
                </div>
                <div class="card-body justify-content-center">
                    <div class="col-lg-12 col-12">
                        <form action="" method = "POST" enctype="multipart/form-data">
                            <div class="row m-3">
                                <div class="col-lg-4 col-md-4 col-12 ">
                                    <div class="form-group">
                                        <label for="">Name:</label>
                                        <br>
                                        <input type="text" class = "form-control" name = "name" placeholder = "Enter Your Name" required value = "<?php
                                            if(isset($_POST['name']))
                                            {
                                                echo $_POST['name'];
                                            }
                                            else
                                            {
                                                echo $student_id_validation_qry_run_res['name'];
                                            }
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="">Father Name:</label>
                                        <br>
                                        <input type="text" class = "form-control" name = "father_name" placeholder = "Enter Your Father Name" required value = "<?php
                                            if(isset($_POST['father_name']))
                                            {
                                                echo $_POST['father_name'];
                                            }
                                            else
                                            {
                                                echo $student_id_validation_qry_run_res['father_name'];
                                            }
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="">Mother Name:</label>
                                        <br>
                                        <input type="text" class = "form-control" name = "mother_name" placeholder = "Enter Your Mother Name" required value = "<?php
                                            if(isset($_POST['mother_name']))
                                            {
                                                echo $_POST['mother_name'];
                                            }
                                            else
                                            {
                                                echo $student_id_validation_qry_run_res['mother_name'];
                                            }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="">Date of Birth:</label>
                                        <br>
                                        <input type="date" class = "form-control" name = "date_of_birth" required value = "<?php
                                            if(isset($_POST['date_of_birth']))
                                            {
                                                echo $_POST['date_of_birth'];
                                            }
                                            else
                                            {
                                                echo $student_id_validation_qry_run_res['date_of_birth'];
                                            }
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="">District:</label>
                                        <br>
                                        <input type="text" class = "form-control" name = "district" placeholder = "Enter Your District" required value = "<?php
                                            if(isset($_POST['district']))
                                            {
                                                echo $_POST['district'];
                                            }
                                            else
                                            {
                                                echo $student_id_validation_qry_run_res['district'];
                                            }
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="">Contact Number:</label>
                                        <br>
                                        <input type="number" class = "form-control" name = "contact_number" placeholder = "Enter Your Phone Number" required value = "<?php
                                            if(isset($_POST['contact_number']))
                                            {
                                                echo $_POST['contact_number'];
                                            }
                                            else
                                            {
                                                echo $student_id_validation_qry_run_res['contact_number'];
                                            }
                                        ?>">
                                        <p id = "contact_number" class = "text-danger font-weight-bold"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-lg-4 col-md-4 col-12 ">
                                    <div class="form-group">
                                        <label for="">Department Name:</label>
                                        <br>
                                        <select name="department_name" id="department_name" class = "form-control" required>
                                            <option value="">Select Department</option>
                                            <!-- Start of Query tp get all the department_name in drop down -->
                                            <?php
                                                $qry = "SELECT * FROM `department_information`";
                                                $res = mysqli_query($conn, $qry);
                                                while($row = mysqli_fetch_assoc($res))
                                                {
                                                    ?>
                                                        <option value = "<?php echo $row['id'] ?>"
                                                            <?php
                                                            if($row['id'] == $student_id_validation_qry_run_res['department_id_number'])
                                                            {
                                                                echo "selected";
                                                            }
                                                            ?>><?php echo $row['department_name'];?></option>
                                                    <?php
                                                }
                                            ?>
                                            <!-- End of Query tp get all the department_name in drop down -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="">Session:</label>
                                        <br>
                                        <select class = "form-control" name="session" required>
                                            <option value="" >Please Select Session</option>
                                            <?php
        											 $c = 2006;
        											$today = date("Y");

        											 for($i=$c; $i<$today; $i++)
        											 {
        												 $r = $i + 1;
                                                         $session= $i."-".$r;
                                                         ?>
                                                         <option value="<?php echo "$session";?>" <?php
                                                         if($student_id_validation_qry_run_res['session']==$session)
                                                         {
                                                             echo "selected";
                                                         }
                                                         ?>><?php echo $session; ?>
                                                         </option>
                                                         <?php
        											 }
        										?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="">Roll Number:</label>
                                        <br>
                                        <input type="number" class = "form-control" name = "roll_number" placeholder = "Roll Number" required value = "<?php
                                            if(isset($_POST['roll_number']))
                                            {
                                                echo $_POST['roll_number'];
                                            }
                                            else
                                            {
                                                echo $student_id_validation_qry_run_res['roll_number'];
                                            }
                                        ?>">
                                        <p id = "roll_number" class = "text-danger font-weight-bold"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-lg-6 col-md-6 col-12 ">
                                    <div class="form-group">
                                        <label for="">Room Number:</label>
                                        <br>
                                        <select name="room_number" id="room_number" class = "form-control" required>
                                            <option value="">Select Room Number</option>
                                            <!-- Start of Query to get all available the room_name in drop down -->
                                            <?php
                                                $qry = "SELECT * FROM `room_information` WHERE `total_seat` != `reserved_seat` OR `id` = '$student_id_validation_qry_run_res[room_id_number]' ORDER BY `room_no` ASC ";
                                                $res = mysqli_query($conn, $qry);
                                                while($row = mysqli_fetch_assoc($res))
                                                {
                                                    ?>
                                                        <option value = "<?php echo $row['id'] ?>"
                                                            <?php if($row['id']==
                                                            $student_id_validation_qry_run_res['room_id_number']){
                                                                echo "selected";
                                                            }
                                                            ?>><?php echo $row['room_no'];?></option>
                                                    <?php
                                                }
                                            ?>
                                            <!-- End of Query to get all available the room_name in drop down -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">Entry Date:</label>
                                        <br>
                                        <input type="date" class = "form-control" name = "entry_date" required value = "<?php
                                            if(isset($_POST['entry_date']))
                                            {
                                                echo $_POST['entry_date'];
                                            }
                                            else
                                            {
                                                echo $student_id_validation_qry_run_res['entry_date'];
                                            }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">Upload Image:</label>
                                        <br>
                                        <input class = "form-control"type="file" name="upload_image"  />
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3 justify-content-center">
                                <div class=" col-lg-6 col-10">
                                    <div class="form-group">
                                        <input type="submit" name = "submit" class = "form-control btn btn_color_employee" value = "Update">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Submission -->
<?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $father_name = $_POST['father_name'];
        $mother_name = $_POST['mother_name'];
        $date_of_birth = $_POST['date_of_birth'];
        $district = $_POST['district'];
        $contact_number = $_POST['contact_number'];
        $dept_name = $_POST['department_name'];
        $session = $_POST['session'];
        $roll_number = $_POST['roll_number'];
        $room_number = $_POST['room_number'];
        $entry_date = $_POST['entry_date'];
        $error = 0;
        if(strlen($contact_number)!=11)
        {
            $error = 1;
            ?>
            <script>
                document.getElementById('contact_number').innerHTML = "Phone number must be 11 digit";
            </script>
            <?php
        }
        if($roll_number<=0)
        {
            $error = 1;
            ?>
            <script>
                document.getElementById('roll_number').innerHTML = "Your roll number can not be 0 or negative";
            </script>
            <?php
        }
        if($error==0)
        {
            // Start To find whether contact number exists or not
            $select_unique_contact_number = "SELECT count(`id`) as total_row FROM `student_information` WHERE `contact_number` = '$contact_number' AND `id` != '$_GET[id]'";
            $run_select_unique_contact_number = mysqli_query($conn, $select_unique_contact_number);
            $row = mysqli_fetch_assoc($run_select_unique_contact_number);
            if($row['total_row']>=1)
            {
                ?>
                <script>
                    document.getElementById('contact_number').innerHTML = "Contact Number Already Exists";
                </script>
                <?php
                exit();
            }
            // End To find whether contact number exists or not

            if(empty($_FILES['upload_image']['name']))
            {
                $update_qry = "UPDATE `student_information` SET `name`='$name',`father_name`='$father_name',`mother_name`='$mother_name',`date_of_birth`='$date_of_birth',`district`='$district',`contact_number`='$contact_number',`department_id_number`='$dept_name',`session`='$session',`roll_number`='$roll_number',`room_id_number`='$room_number',`entry_date`='$entry_date' WHERE `id` = '$_GET[id]'";
                $update_qry_run = mysqli_query($conn, $update_qry);
            }
            else
            {
                /// Code for image resizing
                function resizeImage($resourceType,$image_width,$image_height)
                {
                    $resizeWidth = 300;
                    $resizeHeight = 300;
                    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
                    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
                    return $imageLayer;
                }

                $imageProcess = 0;
                if(is_array($_FILES))
                {
                    $fileName = $_FILES['upload_image']['tmp_name'];
                    $sourceProperties = getimagesize($fileName);
                    $resizeFileName = time();
                    $uploadPath = "./student_image/";
                    $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
                    $uploadImageType = $sourceProperties[2];
                    $sourceImageWidth = $sourceProperties[0];
                    $sourceImageHeight = $sourceProperties[1];
                    switch ($uploadImageType)
                    {
                        case IMAGETYPE_JPEG:
                            $resourceType = imagecreatefromjpeg($fileName);
                            $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                            imagejpeg($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                            break;

                        case IMAGETYPE_GIF:
                            $resourceType = imagecreatefromgif($fileName);
                            $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                            imagegif($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                            break;

                        case IMAGETYPE_PNG:
                            $resourceType = imagecreatefrompng($fileName);
                            $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                            imagepng($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                            break;

                        default:
                            $imageProcess = 0;
                            break;
                    }
                    move_uploaded_file($resizeFileName,$uploadPath.  ".". $fileExt);
                    $imageProcess = 1;
                }
                // End of Code for image resizing

                $update_qry = "UPDATE `student_information` SET `name`='$name',`father_name`='$father_name',`mother_name`='$mother_name',`image` = '$resizeFileName.$fileExt',`date_of_birth`='$date_of_birth',`district`='$district',`contact_number`='$contact_number',`department_id_number`='$dept_name',`session`='$session',`roll_number`='$roll_number',`room_id_number`='$room_number',`entry_date`='$entry_date' WHERE `id` = '$_GET[id]'";
                $update_qry_run = mysqli_query($conn, $update_qry);
            }

            if($update_qry_run)
            {
                // If current room number does not match with after updating of form room number
                if($room_number!=$student_id_validation_qry_run_res['room_id_number'])
                {

                    // Start of decreasing the previous reserved seat value by 1
                    $update_previous_room_number_qry = "UPDATE `room_information` SET `reserved_seat` = `reserved_seat` - '1' WHERE `id` = '$student_id_validation_qry_run_res[room_id_number]'";
                    $run_update_previous_room_number_qry = mysqli_query($conn, $update_previous_room_number_qry);
                    // End of decreasing the previous reserved seat value by 1

                    // Start of increasing the current reserved seat value by 1
                    $update_current_room_number_qry = "UPDATE `room_information` SET `reserved_seat` = `reserved_seat` + '1' WHERE `id` = '$room_number'";
                    $run_update_current_room_number_qry = mysqli_query($conn, $update_current_room_number_qry);
                    // End of increasing the current reserved seat value by 1
                }
                // End of If current room number does not match with after updating of form room number
                ?>
                <script>
                    window.alert('Student Updated Successfully');
                    window.location = "view_student_details.php?id=<?php echo $_GET['id']?>";
                </script>
                <?php
            }
        }
    }
?>
<!-- Form Submission -->

<?php include('student_footer.php') ?>
<?php include('footer.php') ?>
