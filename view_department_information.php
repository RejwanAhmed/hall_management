<?php include('database_connection.php') ?>
<?php include('header.php') ?>
<?php include('pagination.php')?>
<?php
function get_row_count()
{
    include('database_connection.php');
    $sql = "SELECT COUNT(`id`) as total_row FROM `department_information`";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res))
    {
        $row = mysqli_fetch_assoc($res);
        return $row['total_row'];
    }
    return 0;
}
function display_content($run,$offset, $total)
{
    include('database_connection.php');
    $select_from_department = "SELECT * FROM `department_information` ORDER BY `department_name` ASC LIMIT $offset, $total";
    $run_select_from_department = mysqli_query($conn, $select_from_department);
    ?>
    <table class = "table table-bordered table-hover text-center">
        <tr>
            <thead class ="thead-light">
                <th>Department Name</th>
                <th>Modify</th>
                <th>Remove</th>
            </thead>
        </tr>
        <?php
        while($row = mysqli_fetch_assoc($run_select_from_department))
        {
            ?>
            <tr>
                <td><?php echo $row['department_name'];?></td>

                <td>
                    <a class = "btn btn_color" href="update_department_information.php?id=<?php echo $row['id']?>"><b><span><i class="fas fa-edit"></i></span> Modify</b></a>
                </td>

                <td>
                    <button class = "btn btn_color" onclick = "deleteConfirmation(<?php echo $row['id'];?>)"><b><span><i class="fas fa-eraser"></i></span> Remove</b></button>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12 col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12"></div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Department Information <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 text-center">
                            <a class = "btn btn-danger" href="add_department.php"><b><span><i class="far fa-plus-square"></i></span> Department</b></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-12">
                        <?php
                        $run = 0;
                        $page_name = 'view_department_information';
                        pagination($run,$page_name);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteConfirmation(id)
    {
        var del = window.confirm('Are You Sure Want To Delete?');
        if(del == true)
        {
            window.location='delete_department_information.php?id='+id;
        }
    }
</script>
<?php include('footer.php') ?>
