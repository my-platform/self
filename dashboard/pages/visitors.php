<?php
require_once '../functions/functions.php';
include '../includes/database_inc.php';

if(!logged_in()) {
    header('Location: ../pages/login');
}
get_header();
get_sidebar();
get_bread();
save_visitors();




//get_visitors();
new Database('localhost','fouadfawzi', 'fouad01242451361210');
if (!@mysql_select_db('f_dashboard')) {
    echo 'The table doesn\'t exist .';
} else {

    function last_month_visitors(){
        $sql = 'SELECT COUNT(0) FROM `month_visitors`';
        $query = mysql_query($sql);
        if ($rows = mysql_fetch_array($query)) {
             $rows[0];
            //echo $rows[0];
            $last_month = time() - ((60 * 60 * 24) * 30);
            $sql2 = "DELETE FROM `month_visitors` WHERE `Date` < '" . $last_month . "'";
            mysql_query($sql2);
        }
    }

    function pagination($table, $index, $page_id){
        $start = 0;
        $limit = 15;


        if (isset($_GET[$index])) {
            $new_st = $_GET[$index];
            $new_end = $new_st + 7;
            $backward_st = $new_st;
            $backward_en = $new_st - 7;
        } else {
            $new_st = 1;
            $new_end = 8;
        }
        if (isset($_GET[$page_id])) {
            $id = $_GET[$page_id];
            $start = ($id - 1) * $limit;
        } else {
            $id = 1;
        }
        echo '<ul class=" pagination">';
        $sql1 = "SELECT COUNT(`ip_address`) FROM `" . $table . "`";
        $rs_result1 = mysql_query($sql1);
        $row1 = mysql_fetch_row($rs_result1);
        $count = $row1[0];
        $records_per_page = $limit;
        //$page =
        $total_pages = ceil($count / $records_per_page);

        if ($id > 8) {
            //Go to previous page to show previous 10 items. If its in page 1 then it is inactive
            echo "<li class='previous_link'><a href='?" . $index . "=" . ($backward_en - 1) . "&" . $page_id . "=" . ($backward_en - 1) . "#" . $table . "' class='button'>PREVIOUS</a></li>";
        }

        //show all the page link with page number. When click on these numbers go to particular page.
        //echo '<ul class="pagination">';

        for ($i = $new_st; $i <= $new_end && $i <= $total_pages; $i++) {
            if ($i == $id) {
                echo "<li class='active'><a>" . $i . "</a></li>";
            } else {
                echo "<li><a class='button_num' href='?" . $index . "=" . $new_st . "&" . $page_id . "=" . $i . "#" . $table . "'>" . $i . "</a></li>";
            }
        }


        if ($new_end < $total_pages) {
            ////Go to previous page to show next 10 items.
            echo "<li class='disable_link'><a href='?" . $index . "=" . ($new_end + 1) . "&" . $page_id . "=" . ($new_end + 1) . "#" . $table . "'  class='Next_link'>NEXT</a></li>";
            //echo 'this is '. $id;
        }
        echo ' </ul>';
        // echo '</div>';
    }


    function table( $table, $page_id ){
        $start = 0;
        $limit = 8;


        if (isset($_GET[$page_id])) {
            $id = $_GET[$page_id];
            $start = ($id - 1) * $limit;
        } else {
            $id = 1;
        }


        $sql = "SELECT * FROM `".$table."` ORDER BY `id` DESC LIMIT $start, $limit";


        //print 10 items
        if ($query_run = mysql_query($sql)) {

            while ($row = mysql_fetch_array($query_run)) {

                // $sql_d ="SELECT `id` FROM `users` where `emaile` = '".$email."'";
                //  echo "<tbody id='new_table'>"

                //   echo "<tr>";
                ?>

                <?php
                echo "<tr>"
                    . "<td class='center'>" . $row['id'] . "</td>" .
                    "<td class='center'>" . $row['ip_address'] . "</td>";
                echo "<td class='center'>" . $row['Browser'] . "</td>";
                echo "<td class='center'>" . $row['Platform(OS)'] . "</td>";
                echo "<td class='center'>" . $row['Day'] .' '. $row['Time']. "</td>";
                echo "</tr>";
                //echo "</tr>";

            }

        } else {
            mysql_error($query_run);
        }
        echo'</tbody>';
                          echo'</table>';

    }
    last_month_visitors();
    ?>


    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 id="visitor_win">0</h3>

                    <p>Online Visitors</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dashboard"></i>
                </div>
                <a href="#online_visitors" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 id="last24">0</h3>

                    <p>visits in last 24 hours</p>
                </div>
                <div class="icon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <a href="#last24" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 id="this_week">0</h3>

                    <p>Visits in last week</p>
                </div>
                <div class="icon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <a href="#vlast_week" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 id="month_visit">0</h3>

                    <p>Last Month</p>
                </div>
                <div class="icon">
                    <i class="fa fa-arrow-circle-up"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green-active">
                <div class="inner">
                    <h3 id="max_visit">0</h3>

                    <p>all visits so far</p>
                </div>
                <div class="icon">
                    <i class="fa fa-arrow-circle-up"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>  <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3 id="unique_visit">0</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="fa fa-arrow-circle-up"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <section class="content">
            <div class="row" id="last24">
                <!-- 24 Hours visitors table -->
                <div class="col-lg-12 col-xs-12">
                    <!-- /.box -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">visitors in last 24 hours</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP Address</th>
                                    <th>Browser</th>
                                    <th>Platform(OS)</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody class="">
                                <?php
                                table('last24', 'id_d');
                                ?>
                                <div class="box-footer no-padding">
                                    <div class="mailbox-controls">
                                        <div class="text-center ">

                                            <?php
                                            pagination('last24', 'index_d', 'id_d')
                                            ?>
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                                </div>
                        </div>
                        <!-- /.box-body -->

                    </div>

                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row" id ="vlast_week">
                <!-- last week visitors table -->
                <div class="col-lg-12 col-xs-12"  >

                    <!-- /.box -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">visitors in last week</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP Address</th>
                                    <th>Browser</th>
                                    <th>Platform(OS)</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody class="">
                                <?php
                                table('vlast_week', 'id_w');
                                ?>
                                <div class="box-footer no-padding">
                                    <div class="mailbox-controls">
                                        <div class="text-center ">

                                            <?php
                                            pagination('vlast_week','index_w', 'id_w')
                                            ?>
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                                </div>
                        </div>
                        <!-- /.box-body -->

                    </div>

                    <!-- /.box -->
                </div>

            </div>
            <div class="row" id ="month_visitors">
                <!-- last week visitors table -->
                <div class="col-lg-12 col-xs-12"  >

                    <!-- /.box -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">visitors in last month</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP Address</th>
                                    <th>Browser</th>
                                    <th>Platform(OS)</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody class="">
                                <?php
                                table('month_visitors', 'id_m');
                                ?>
                                <div class="box-footer no-padding">
                                    <div class="mailbox-controls">
                                        <div class="text-center ">

                                            <?php
                                            pagination('month_visitors','index_m', 'id_m')
                                            ?>
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                                </div>
                        </div>
                        <!-- /.box-body -->

                    </div>

                    <!-- /.box -->
                </div>

            </div>
            <div class="row">
                <!-- last week visitors table -->
                <div class="col-lg-12 col-xs-12"  >

                    <!-- /.box -->
                    <div class="box box-success" id="online_visitors">
                        <div class="box-header">
                            <i class="fa fa-circle text-success"></i> <h3 class="box-title">Online Visitors</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP Address</th>
                                    <th>Browser</th>
                                    <th>Platform(OS)</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody class="">
                                <?php
                                table('online_visitors', 'id_o');
                                ?>
                                <div class="box-footer no-padding">
                                    <div class="mailbox-controls">
                                        <div class="text-center ">

                                            <?php
                                            pagination('online_visitors','index_o', 'id_o')
                                            ?>
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                                </div>
                        </div>
                        <!-- /.box-body -->

                    </div>

                    <!-- /.box -->
                </div>

            </div>
            <!-- /.row -->
        </section>
    </div>

    <?php
}
logout_confirmation();
get_footer();
?>
<script src="../js/visitors.js"></script>


