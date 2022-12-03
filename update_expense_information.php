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
    $expense_id_validation_qry = "SELECT * FROM `expense_information` WHERE `id` = '$_GET[id]'";
    $expense_id_validation_qry_run = mysqli_query($conn, $expense_id_validation_qry);
    $expense_id_validation_qry_run_res = mysqli_fetch_assoc($expense_id_validation_qry_run);
    if($expense_id_validation_qry_run_res==false)
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
<?php include('account_header.php')?>
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class = "text-center card_header_color text-uppercase">Update Expense Form <span><i class="fas fa-file-alt"></i></span></h3>
                </div>
                <div class="card-body">
                    <form action="" method = "POST">
                        <div class="row m-3 justify-content-center">
                            <div class="col-lg-8 col-md-12 col-12 ">
                                <div class="form-group">
                                    <label for="">Expense Name:</label>
                                    <br>
                                    <input type="text" class = "form-control" name = "expense_name" required placeholder="Enter Expense Name" value = "<?php
                                    if(isset($_POST['expense_name']))
                                    {
                                        echo $_POST['expense_name'];
                                    }
                                    else
                                    {
                                        echo $expense_id_validation_qry_run_res['expense_name'];
                                    }
                                    ?>">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12 col-12">
                                <div class="form-group">
                                    <label for="">Amount:</label>
                                    <br>
                                    <input type="number" name = "amount" class = "form-control"required placeholder="Enter Amount" value = "<?php
                                    if(isset($_POST['amount']))
                                    {
                                        echo $_POST['amount'];
                                    }
                                    else
                                    {
                                        echo $expense_id_validation_qry_run_res['amount'];
                                    }
                                    ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row m-3 justify-content-center">
                            <div class=" col-lg-6 col-10">
                                <div class="form-group">
                                    <input type="submit" name = "expense_form_submit" class = "form-control btn btn_color_employee" value = "Update">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['expense_form_submit']))
    {
        $expense_name = $_POST['expense_name'];
        $amount = $_POST['amount'];

        $insert_qry = "UPDATE `expense_information` SET `expense_name`='$expense_name',`amount`='$amount' WHERE `id` = '$_GET[id]'";
        $run_insert_qry = mysqli_query($conn,$insert_qry);
        if($run_insert_qry)
        {
            ?>
            <script>
                window.alert('Expense Form Updated Successfully');
                window.location = "expense_information.php";
            </script>
            <?php
        }

    }
?>
<?php include('account_footer.php')?>
<?php include('footer.php')?>
