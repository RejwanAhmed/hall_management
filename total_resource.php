<?php include('database_connection.php')?>
<?php include('header.php')?>
<?php include('resource_header.php')?>
<?php include('pagination.php') ?>
<?php
function get_row_count()
{
    include('database_connection.php');
    $sql = "SELECT COUNT(`id`) as total_row FROM `total_incoming_resource`";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res))
    {
        $row = mysqli_fetch_assoc($res);
        return $row['total_row'];
    }
    return 0;
}
function display_content($run,$offset,$total)
{
    include('database_connection.php');
    $total_resource_from_view_qry = "SELECT i.resource_name, (i.number_of_resources - o.number_of_resources) as `total_number_of_resources` FROM `total_incoming_resource` as i, `total_outgoing_resource` as o where i.id = o.id LIMIT $offset, $total";
    $run_total_resource_from_view_qry = mysqli_query($conn, $total_resource_from_view_qry);
    ?>

    <table class = "table table-bordered table-hover text-center table-responsive-lg">
        <tr>
            <thead class ="thead-light">
                <th>Resource Name</th>
                <th>Number of Available Resources</th>
            </thead>
        </tr>
        <?php

        while($row = mysqli_fetch_assoc($run_total_resource_from_view_qry))
        {
            ?>
            <tr>
                <td><?php echo $row['resource_name']?></td>
                <td><?php echo $row['total_number_of_resources']?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>
<div class="container tab-pane"><br>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12" id = "source_div">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-12 col-12">
                            <h3 class ="text-center card_header_color text-uppercase">Total Available Resource <span><i class="fas fa-info-circle"></i></span></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-12">
                        <?php
                        // For this query we have created two views
                        $run = 0;
                        $page_name = 'total_resource';
                        pagination($run,$page_name);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('resource_footer.php')?>
<?php include('footer.php')?>
