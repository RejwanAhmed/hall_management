<?php include('database_connection.php') ?>
<?php include('header.php') ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-9 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h3 class ="text-center card_header_color text-uppercase">Change Username & Password <span><i class="fas fa-users-cog"></i></span></h3>
                </div>
                <div class="card-body justify-content-center">
                    <div class="col-lg-12 col-12">
                        <form action="" method = "POST" enctype="multipart/form-data">
                            <div class="row m-3">
                                <div class="col-lg-12 col-md-12 col-12 ">
                                    <div class="form-group">
                                        <label for="">Username:</label>
                                        <br>
                                        <input type="text" class = "form-control" name = "username" placeholder = "Enter Username" required value = "<?php
                                            if(isset($_POST['username']))
                                            {
                                                echo $_POST['username'];
                                            }
                                        ?>">
                                        <p class = "text-danger font-weight-bold" id= "floor"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 ">
                                    <div class="form-group">
                                        <label for="">Current Password:</label>
                                        <br>
                                        <input type="password" class = "form-control" name = "current_password" placeholder = "Enter Current Password" required value = "<?php
                                            if(isset($_POST['current_password']))
                                            {
                                                echo $_POST['current_password'];
                                            }
                                        ?>">
                                        <p class = "text-danger font-weight-bold" id= "current_password"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 ">
                                    <div class="form-group">
                                        <label for="">New Password:</label>
                                        <br>
                                        <input type="password" class = "form-control" name = "new_password" placeholder = "Enter New Password" required value = "<?php
                                            if(isset($_POST['new_password']))
                                            {
                                                echo $_POST['new_password'];
                                            }
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 ">
                                    <div class="form-group">
                                        <label for="">Confirm Password:</label>
                                        <br>
                                        <input type="password" class = "form-control" name = "confirm_password" placeholder = "Again Enter New Password" required value = "<?php
                                            if(isset($_POST['confirm_password']))
                                            {
                                                echo $_POST['confirm_password'];
                                            }
                                        ?>">
                                        <p class = "text-danger font-weight-bold" id= "new_password"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-3 justify-content-center">
                                <div class=" col-lg-6 col-10">
                                    <div class="form-group">
                                        <input type="submit" name = "submit" class = "form-control btn btn_color_employee" value = "Change">
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

<!-- Start of form submission -->
<?php
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $current_pass = md5($_POST['current_password']);
        $new_pass = md5( $_POST['new_password']);
        $confirm_pass = md5($_POST['confirm_password']);

        if($current_pass != $_SESSION['password'])
        {
            ?>
            <script>
                document.getElementById("current_password").innerHTML = "Current Password Not Matched!";
            </script>
            <?php
        }
        else if($new_pass!=$confirm_pass)
        {
            ?>
            <script>
                document.getElementById("new_password").innerHTML = "New and Confirm Password Not Matched!";
            </script>
            <?php
        }
        else
        {
            $update_login_info = "UPDATE `admin_login_info` SET `username` = '$username', `password` = '$confirm_pass' WHERE `id` = '$_SESSION[id]'";;
            $run_update_login_info = mysqli_query($conn, $update_login_info);
            ?>
            <script>
                window.alert("Username and Password Successfully Changed");
                window.location = "logout.php";
            </script>
            <?php
        }
    }
?>
<!-- End of form submission -->
<?php include('footer.php') ?>
