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
    $_SESSION['admin_login'] = 0;
    session_unset();
    session_destroy();
    ?>
    <script>
        window.location = "login.php";
    </script>
    <?php
?>
