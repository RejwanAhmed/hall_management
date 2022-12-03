<?php
    // Code for solving the problem of documentation expired
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    // End of Code for solving the problem of documentation expired
    session_start();
    if(isset($_SESSION['admin_login']))
    {
        ?>
        <script>
            window.location = "home.php";
        </script>
        <?php
    }
?>
<?php include('database_connection.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css\all.min.css">
    <link rel="stylesheet" href="css\login.css">
    <script type="text/javascript"src="js\jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript"src="js\popper.min.js"></script>
    <script type="text/javascript"src="js\bootstrap.min.js"></script>
    <script type="text/javascript"src="js\pdf.js"></script>
    <script type="text/javascript"src="js\html2pdf.bundle.min.js"></script>
    <title>login</title>
</head>
<body>
<div class = "container">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-12 col-12">
            <div class="card shadow-lg ">
                <div class = " card-header card_header_color text-center ">
                    <h3 class="text-center">Admin Login  <span><i class="fas fa-user-shield"></i></span></h3>
                </div>
                <div class = "card-body">
                    <form action="" method = "POST">
                        <div class="form-group">
                            <label for=""><b>Username <span><i class = "fas fa-user"></i></span>:</b></label>
                            <br>
                            <input type="text" class="form-control" name="username" value="" placeholder="Enter username"required>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Password <span><i class="fas fa-unlock-alt"></i></span>:</b></label>
                            <br>
                            <input type=Password class="form-control" name="password" value="" placeholder="Enter password"required>
                        </div>
                        <div class="form-group">
                            <input type=submit class="btn btn_color btn-block" name="submit" value="Login">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start of Form Submission -->
<?php
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $pass = md5($_POST['password']);

        $select = "SELECT * FROM `admin_login_info` WHERE `username` = '$username' AND `password` = '$pass'";
        $run = mysqli_query($conn, $select);
        $res = mysqli_fetch_assoc($run);
        $row = mysqli_num_rows($run);
        if($row==1)
        {
            $_SESSION['admin_login'] = 1;
            $_SESSION['id'] = $res['id'];
            $_SESSION['password'] = $res['password'];
                ?>
                    <script>
                        window.alert("Login Successfully Done!");
                        window.location = "home.php";
                    </script>
                <?php
        }
        else
        {
            ?>
            <script>
                window.alert('Wrong Username Or Passeord');
                window.location = 'login.php';
            </script>
            <?php
        }
    }
?>
<!-- End of Form Submission -->
</body>
</html>
