<?php


include 'database_inc.php';
global $id ;
if(isset($_POST['key_buttons']) || isset($_POST['key_data'])/*|| isset($_POST['id_button'])*/ ){
    @$buttons = $_POST['key_buttons'];
    @$data = $_POST['key_data'];
  // echo @$id = $_POST['id_button'];
}

if(isset($_POST['id_button']))
{
    echo @$id=$_POST['id_button'];
   // $start=($id-1)*$limit;
}else{
    echo' dorry';
    $id=1;
}
if (!@mysql_select_db('f_dashboard')) {
    echo 'The table doesn\'t exist .';
} else {
   /* if(isset($_POST['id_button'])) {
        echo $b_id = $_POST['id_button'];
    }else{
        echo 'Sorry';
    }*/
echo $id;
   // global $id;
    //echo $id;

    $start = 0;
    $limit = 8;
    // $id = '55';
    //echo $id;

  //  global $data;
       // echo $id;
    if ($data == 'data_show') {
        // $id;
        echo '<ul>'.$id.'</ul>';
        global $start, $limit;

        // echo $start .'hello';
        //Fetch from database first 10 items which is its limit. For that when page open you can see first 10 items.
        $sql = "SELECT * FROM `vlast_week` ORDER BY `id` DESC LIMIT $start, $limit";


        //print 10 items
        if ($query_run = mysql_query($sql)) {

            while ($row = mysql_fetch_array($query_run)) {

                // $sql_d ="SELECT `id` FROM `users` where `emaile` = '".$email."'";
                //  echo "<tbody id='new_table'>"

                echo "<tr>";
                echo "<td class='center'>" . $row['id'] . "</td>";
                echo "</tr>";

            }

        } else {
            mysql_error($query_run);
        }
    }


//fetch all the data from database.
    /*$rows=mysqli_num_rows(mysqli_query($dbconfig,"select * from user"));
    //calculate total page number for the given table in the database
    $total=ceil($rows/$limit);*/
    global $buttons;
   // global $id;
   // echo $id;
 //   global $id ;
   /*function return_number(){
       if( isset($_POST['id_button'])){

           @$id = $_POST['id_button'];
            echo $id. ' shit';
       }
   }*/

    if ($buttons == 'show_buttons' ) {
        global $id;
      //  global $b_id;


        $sql = "SELECT COUNT(`ip_address`) FROM `vlast_week`";
        $rs_result = mysql_query($sql);
        $row = mysql_fetch_row($rs_result);
        $count = $row[0];
        $records_per_page = 8;
//$page =
        $total = ceil($count / $records_per_page);
        if ($id  > 1) {
            //Go to previous page to show previous 10 items. If its in page 1 then it is inactive
            echo "<a href='?id=" . ($id  - 1) . "' class='button'>PREVIOUS</a>";
        }
        if ($id  != $total) {
            ////Go to previous page to show next 10 items.
            echo "<a href='?id=" . ($id  + 1) . "' class='button'>NEXT</a>";
            //echo 'this is '. $id;
        }


//show all the page link with page number. When click on these numbers go to particular page.
//echo '<ul class="pagination">';
        for ($i = 1; $i <= $total; $i++) {
            if ($i == $id ) {
                echo "<li class='active'><a>" . $i . "</a></li>";
            } else {
                echo "<li><a href='?id=".$i."' class='btn_try'>" . $i . "</a></li>";
            }
        }
        // echo '</ul>';
    }

}


?>
