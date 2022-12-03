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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css\all.min.css">
    <link rel="stylesheet" href="css\style.css">
    <script type="text/javascript"src="js\jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript"src="js\popper.min.js"></script>
    <script type="text/javascript"src="js\bootstrap.min.js"></script>
    <script type="text/javascript"src="js\pdf.js"></script>
    <script type="text/javascript"src="js\html2pdf.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <!-- Start of Static navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top nav_bg_color" >
        <a class="navbar-brand text-warning" href="home.php"><img src="" alt="">DolonChanpa <span></span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home <span><i class="fas fa-home"></i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="total_resource.php">Resources <span><i class="fab fa-buffer"></i></span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="https://bootstrapthemes.co" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Students <span><i class="fas fa-user-graduate"></i></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="student_information.php">Student Information <span><i class="fas fa-bars"></i></span></a></li>
                        <li><a class="dropdown-item" href="student_payment_information.php">Student Payment <span><i class="fas fa-money-check-alt"></i></span></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="daily_account.php">Account <span><i class="fas fa-file-invoice"></i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="employee_information.php">Employee <span><i class="fas fa-user-secret"></i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_department_information.php">Department <span><i class="far fa-building"></i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="total_room.php">Room Allocation <span><i class="fas fa-bed"></i></span></a>
                </li>

            </ul>
            <ul class = "nav navbar-nav ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="https://bootstrapthemes.co" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Settings <span><i class="fas fa-cogs"></i></span>
                    </a>
                    <ul class="dropdown-menu settings_dropdown" aria-labelledby="navbarDropdownMenuLink">
                        <li class="nav-item"><a  class="nav-link" href="logout.php">Logout <span><i class="fas fa-key"></i></span></a></li>
                        <li><a class="dropdown-item" href="change_password.php">Change Password <span><i class="fas fa-users-cog"></i></span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End of Static navbar -->
