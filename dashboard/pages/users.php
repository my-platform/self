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
if (!@mysql_select_db('f_dashboard')) {
    echo 'The table doesn\'t exist .';
} else {

    function pagination($table, $index, $page_id){
        $start = 0;
        $limit = 8;


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
        $sql1 = "SELECT COUNT(`firstname`) FROM `" . $table . "`";
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

    function table($table, $page_id)
    {
        $start = 0;
        $limit = 8;


        if (isset($_GET[$page_id])) {
            $id = $_GET[$page_id];
            $start = ($id - 1) * $limit;
        } else {
            $id = 1;
        }


        $sql = "SELECT * FROM `" . $table . "` ORDER BY `id` DESC LIMIT $start, $limit";


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
                    "<td class='center'>" . $row['firstname'] .' '. $row['lastname'] . "</td>";
                echo "<td class='center'>" . $row['email'] . "</td>";
                echo "<td class='center'>" . $row['password'] . "</td>";
                echo "<td class='center'>" . $row['Registration Date'] . "</td>";
                echo '<td class="center">';
                echo '<a class="btn btn-info" id="try" href="#"><i class="halflings-icon white edit"></i></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-danger table_remove"><p class="pop">' . $row['id'] . '</p><f id="fname">' . $row['firstname'] .
                    '</f><i class="halflings-icon fa fa-trash-o"></i></a>';
                echo '</td>';
                echo "</tr>";
                //echo "</tr>";

            }

        } else {
            mysql_error($query_run);
        }
        echo '</tbody>';
        echo '</table>';

    }

    ?>

    <div class="row">
        <div class="confirm-msg"><p id="message">Do you really want to delete this user?</p>
            <div class="cont"><a id="delete">Delete </a><a id="cancel">Cancel</a></div>
        </div>
        <div id="notify-msg"><p id="notify_message"></p>
            <p>please wait ...</p>
        </div>
<?php
user_widgets();
?>
        <section class="content">
            <div class="row">
                <!-- members table -->
                <div class="col-lg-12 col-xs-12">
                    <!-- /.box -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title" id="users">User Registrations</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Registration Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="">
                              <?php
                              table('users', 'user_id');
                              ?>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <div class="text-center ">

                                    <?php
                                    pagination('users','index_U', 'user_id')
                                    ?>
                                </div>
                                <!-- /.pull-right -->
                            </div>
                        </div>
                    </div>

                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>


            <!-- /.row -->
        </section>
    </div>
    <?php
}
logout_confirmation();
get_footer();
?>

