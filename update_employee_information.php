<?php include('header.php')?> <!-- To determine whether admin is logged in or not-->
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
    $employee_id_validation_qry = "SELECT * FROM `employee_information` WHERE `id` = '$_GET[id]'";
    $employee_id_validation_qry_run = mysqli_query($conn, $employee_id_validation_qry);
    $employee_id_validation_qry_run_res = mysqli_fetch_assoc($employee_id_validation_qry_run);
    if($employee_id_validation_qry_run_res==false)
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

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-9 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h3 class ="text-center card_header_color text-uppercase">Update <?php echo $employee_id_validation_qry_run_res['name']?>'s Form <span><i class="fas fa-file-alt"></i></span></h3>
                </div>
                <div class="card-body justify-content-center">
                    <div class="col-lg-12 col-12">
                        <form action="" method = "POST" enctype="multipart/form-data">
                            <div class="row m-3">
                                <div class="col-lg-6 col-md-6 col-12 ">
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
                                                echo $employee_id_validation_qry_run_res['name'];
                                            }
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">Hall Designation:</label>
                                        <br>
                                        <input type="text" class = "form-control" name = "hall_desingation" placeholder = "Enter Your Designation" required value = "<?php
                                            if(isset($_POST['hall_desingation']))
                                            {
                                                echo $_POST['hall_desingation'];
                                            }
                                            else
                                            {
                                                echo $employee_id_validation_qry_run_res['hall_designation'];
                                            }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">University Designation:</label>
                                        <br>
                                        <select class = "form-control" name="u_designation" required>
                                            <option value=""> Please Select Designation</option>
                                            <option value="Professor" <?php
                                            if($employee_id_validation_qry_run_res['university_designation']=="Professor")
                                            {
                                                echo "selected";
                                            }
                                             ?>>Professor</option>
                                            <option value="Associate Professor"<?php
                                            if($employee_id_validation_qry_run_res['university_designation']=="Associate Professor")
                                            {
                                                echo "selected";
                                            }
                                             ?> >Associate Professor</option>
                                            <option value="Assistant Professor" <?php
                                            if($employee_id_validation_qry_run_res['university_designation']=="Assistant Professor")
                                            {
                                                echo "selected";
                                            }
                                             ?>>Assistant Professor</option>
                                            <option value="Lecturer" <?php
                                            if($employee_id_validation_qry_run_res['university_designation']=="Lecturer")
                                            {
                                                echo "selected";
                                            }
                                             ?>>Lecturer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
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
                                                echo $employee_id_validation_qry_run_res['contact_no'];
                                            }
                                        ?>">
                                        <p id = "contact_no" class = "text-danger font-weight-bold"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Personal Page Link:</label>
                                        <input type="url" name="p_page_link" class = "form-control" placeholder="Enter Personal Page Link" value = "<?php if(isset($_POST['p_page_link']))
                                        {
                                            echo $_POST['p_page_link'];
                                        }
                                        else {
                                            echo "$employee_id_validation_qry_run_res[personal_page_link]";
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Facebook Link:</label>
                                        <input type="url" name="facebook_link" class = "form-control" placeholder="Enter Facebook Page Link" value = "<?php if(isset($_POST['facebook_link']))
                                        {
                                            echo $_POST['facebook_link'];
                                        }
                                        else {
                                            echo "$employee_id_validation_qry_run_res[facebook_link]";
                                        }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">

                                <div class="col-lg-12 col-md-12 col-12">
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
        $contact_number = $_POST['contact_number'];
        $hall_desingation = $_POST['hall_desingation'];
        $universtiy_designation = $_POST['u_designation'];
        $p_page_link = $_POST['p_page_link'];
        $fb_link = $_POST['facebook_link'];
        if(strlen($contact_number)!=11)
        {
            ?>
            <script>
                window.alert('Your Contact Number must be 11 character');
            </script>
            <?php
            exit();
        }
        // Start To find whether contact number exists or not
        $select_unique_contact_number = "SELECT count(`id`) as total_row FROM `employee_information` WHERE `contact_no` = '$contact_number' AND `id` != '$_GET[id]'";
        $run_select_unique_contact_number = mysqli_query($conn, $select_unique_contact_number);
        $row = mysqli_fetch_assoc($run_select_unique_contact_number);
        if($row['total_row']>=1)
        {
            ?>
            <script>
                document.getElementById('contact_no').innerHTML = "Contact Number Already Exists";
            </script>
            <?php
            exit();
        }
        // End To find whether contact number exists or not
        if(empty($_FILES['upload_image']['name']))
        {
            $update_qry = "UPDATE `employee_information` SET `name`='$name',`hall_designation`='$hall_desingation',`university_designation`='$universtiy_designation',`image`='$employee_id_validation_qry_run_res[image]',`contact_no`='$contact_number',`personal_page_link`='$p_page_link',`facebook_link`='$fb_link' WHERE `id` = '$_GET[id]'";
            $run_update_qry = mysqli_query($conn, $update_qry);
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
                $uploadPath = "./employee_image/";
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

            /// End of Code for image resizing
            $update_qry = "UPDATE `employee_information` SET `name`='$name',`hall_designation`='$hall_desingation',`university_designation`='$universtiy_designation',`image`='$resizeFileName.$fileExt',`contact_no`='$contact_number',`personal_page_link`='$p_page_link',`facebook_link`='$fb_link' WHERE `id` = '$_GET[id]'";
            $run_update_qry = mysqli_query($conn, $update_qry);
        }
        if($run_update_qry)
        {
            ?>
            <script>
                window.alert('Employee Information Updated Successfully');
                window.location = "employee_information.php";
            </script>
            <?php
        }
    }
?>
<!-- Form Submission -->

<?php include('footer.php') ?>
