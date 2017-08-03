
<?php
require_once('../functions/functions.php');
get_header();
get_sidebar();
get_bread();
include 'database_inc.php';

//get_visitors();
if (!@mysql_select_db('f_dashboard')) {
    echo 'The table doesn\'t exist .';
} else {
    ?>
    <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>IP Address</th>
            <th>Browser</th>
            <th>Platform(OS)</th>
        </tr>
        </thead>
        <tbody class="">
    <?php
    $start = 0;
    $limit = 8;


    if(isset($_GET['st'])) {
        $new_st = $_GET['st'];
        $new_end = $new_st + 7;
        $backward_st = $new_st;
        $backward_en = $new_st -7;
    }else{
        $new_st = 1;
        $new_end =8;
    }
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $start=($id-1)*$limit;
    }else{
        $id = 1;
    }


    $sql = "SELECT * FROM `vlast_week` ORDER BY `id` DESC LIMIT $start, $limit";


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
            echo "</tr>";
            //echo "</tr>";

        }

    } else {
        mysql_error($query_run);
    }
    ?>
    </tbody>
    </table>




    <ul class='page_page pagination'>
        <?php


       /* $sql = "SELECT * FROM `vlast_week` ORDER BY `id` LIMIT $new_st, $new_end ";
        $rs_result = mysql_query($sql);
        while($row = mysql_fetch_row($rs_result)){
            $count = $row[0];
        }
        //$count = $row[0];
       // $records_per_page = 8;
        //$page =


        $total = ceil($count / 8);*/
        $sql1 = "SELECT COUNT(`ip_address`) FROM `vlast_week`";
        $rs_result1 = mysql_query($sql1);
        $row1 = mysql_fetch_row($rs_result1);
        $count = $row1[0];
        $records_per_page = 8;
        //$page =
        $total_pages = ceil($count / $records_per_page);

        if ($id  > 8) {
            //Go to previous page to show previous 10 items. If its in page 1 then it is inactive
            echo "<li class='previous_link'><a href='?st=" . ($backward_en-1) . "&id=".($backward_en-1)."' class='button'>PREVIOUS</a></li>";
        }

        //show all the page link with page number. When click on these numbers go to particular page.
        //echo '<ul class="pagination">';

            for ($i = $new_st; $i <= $new_end && $i<= $total_pages; $i++) {
                if ($i == $id) {
                    echo "<li class='active'><a>" . $i . "</a></li>";
                } else {
                    echo "<li><a class='button_num' href='?st=" . $new_st . "&id=" . $i . "'>" . $i . "</a></li>";
                }
            }


        if ($new_end  < $total_pages) {
            ////Go to previous page to show next 10 items.
            echo "<li class='disable_link'><a href='?st=" . ($new_end+1) . "&id=".($new_end+1)."'  class='Next_link'>NEXT</a></li>";
            //echo 'this is '. $id;
        }

        ?>
    </ul>

    <?php
}
get_footer();
?>