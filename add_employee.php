<?php include('database_connection.php')?>
<?php include('header.php') ?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-9 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h3 class ="text-center card_header_color text-uppercase">Employee Registration Form <span><i class="fas fa-file-alt"></i></span></h3>
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
                                            <option value="Professor">Professor</option>
                                            <option value="Associate Professor">Associate Professor</option>
                                            <option value="Assistant Professor">Assistant Professor</option>
                                            <option value="Lecturer">Lecturer</option>
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
                                        <input type="submit" name = "submit" class = "form-control btn btn_color_employee" value = "Register">
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
        $select_unique_contact_number = "SELECT count(`id`) as total_row FROM `employee_information` WHERE `contact_no` = '$contact_number'";
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
            $insert_qry = "INSERT INTO `employee_information`(`name`, `hall_designation`, `university_designation`, `image`, `contact_no`, `personal_page_link`, `facebook_link`) VALUES ('$name','$hall_desingation', '$universtiy_designation','no_image.JPG','$contact_number','$p_page_link','$fb_link')";
            $run_insert_qry = mysqli_query($conn, $insert_qry);
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
            $insert_qry = "INSERT INTO `employee_information`(`name`, `hall_designation`, `university_designation`, `image`, `contact_no`, `personal_page_link`, `facebook_link`) VALUES ('$name','$hall_desingation','$universtiy_designation','$resizeFileName.$fileExt','$contact_number','$p_page_link','$fb_link')";
            $run_insert_qry = mysqli_query($conn, $insert_qry);
        }
        if($run_insert_qry)
        {
            ?>
            <script>
                window.alert('Employee Successfully Registered');
                window.location = "employee_information.php";
            </script>
            <?php
        }
    }
?>
<!-- Form Submission -->

<?php include('footer.php') ?>
