<?php
require 'database_inc.php';


//$pg_num = $_POST['val'];
if( isset($_POST['key'])|| isset($_GET['val'])|| isset($_POST['val24']) || isset($_POST['key']) || isset($_GET['st'])||
    isset($_GET['id']) || isset($_POST['val_week'])|| isset($_POST['key']) || isset($_POST['pg_number'])
    || isset($_POST['os_key'])){
    @$key = $_POST['key'];
    @$key2 = $_GET['val'];
    @$key24= $_POST['val24'];
    @$key_week= $_POST['val_week'];
    @$brow_key= $_POST['key'];
    @$os_key= $_POST['os_key'];
    @$pg_number = $_POST['pg_number'];
    @$new_start = $_GET['st'];
    @$id_page = $_GET['id'];
   // echo 'hello '.$key2;
}


  $var = null;



class paging
{

    public function __construct()
    {

        $this->initiate();

    }

    public function initiate()
    {
        global $var ;
        if (!@mysql_select_db('f_dashboard')) {
            echo 'The table doesn\'t exist .';
        } else {
          $this->pages();
            $this->inter();
            $this->brow_percentage();
            $this->os_percentage();
            $this->Table24();
            $this->TableWeek();
          //  $this->os_percentage();
          //  $this->test();
        }

    }

   public function pages()
    {
        global $key;
        if ($key == 'pages') {

            $sql = "SELECT COUNT(`firstname`) FROM `users`";
            $rs_result = mysql_query($sql);
            $row = mysql_fetch_row($rs_result);
            $total_records = $row[0];
            $total_pages = ceil($total_records / 8);
           // echo'<form method="get" action="">';
            for ($i = 1; $i <= $total_pages; $i++) {
               //     echo '<input type="text" name = "pp" value= "'.$i.'"/>';
                //echo "<li><input type='submit'  name='p_n' value='".$i."'/></li>";
                echo "<li><a class='pag'><f>".$i."</f></a></li>";

            };
            //echo '</form>';

        }
        if ($key == '24pages') {

            $sql = "SELECT COUNT(`IP_Address`) FROM `last24`";
            $rs_result = mysql_query($sql);
            $row = mysql_fetch_row($rs_result);
            $total_records = $row[0];
            $total_pages = ceil($total_records / 8);
            // echo'<form method="get" action="">';
            for ($i = 1; $i <= $total_pages; $i++) {
                //     echo '<input type="text" name = "pp" value= "'.$i.'"/>';
                //echo "<li><input type='submit'  name='p_n' value='".$i."'/></li>";
                echo "<li><a class='pag24'><f>".$i."</f></a></li>";

            };
            //echo '</form>';

        }
        if ($key == 'pages_week') {
            global $id_page,$new_start;
            $start = 0;
            $limit = 8;
            if($new_start != null) {
                $new_st = $new_start;
                $new_end = $new_st + 7;
                $backward_st = $new_st;
                $backward_en = $new_st -7;
            }else{
                $new_st = 1;
                $new_end =8;
            }
            if($id_page != null) {
                $id = $id_page;
                $start=($id-1)*$limit;
            }else{
                $id = 1;
            }


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

        }

    }
    ////////////////////////////////////////////////// Get Browsers///////////////////////////////////////////////////
    public function brow_percentage()
    {
        global $brow_key;


            $sql = "SELECT COUNT(`ip_address`) FROM `month_visitors`";
           if($rs_result = mysql_query($sql)) {
               $row = mysql_fetch_row($rs_result);
               $total_records = $row[0];
               if ($brow_key == 'chrome') {
                   $select_chrome = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Browser` = 'chrome'";
                  if($result1 = mysql_query($select_chrome)) {
                      $c_row = mysql_fetch_row($result1);
                      $chrome = $c_row[0];
                      if($chrome == 0){
                          echo '0';
                      }else {
                          $chrome_per = (($chrome / $total_records) * 100);
                          echo round($chrome_per, 1);
                      }
                  }else{
                      echo '0';
                  }
               }else if ($brow_key == 'firefox') {
                   $select_fire = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Browser` = 'firefox'";
                   if ($result2 = mysql_query($select_fire)) {
                       $f_row = mysql_fetch_row($result2);
                       $firefox = $f_row[0];
                     //  if($firefox == 0){
                         //  echo '0';
                     //  }else {
                           $fire_per = (($firefox / $total_records) * 100);
                           echo round($fire_per, 1);
                      // }
                   }else{
                       echo '0';
                   }
               }else if ($brow_key == 'ie') {
                   $select_ie = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Browser` = 'ie' OR `Browser` = 'edge'";
                   if($result3 = mysql_query($select_ie)) {
                       $f_row = mysql_fetch_row($result3);
                       $ie = $f_row[0];
                       if($ie == 0){
                           echo '0';
                       }else {
                           $ie_per = (($ie / $total_records) * 100);
                           echo round($ie_per, 1);
                       }
                   }else{
                       echo '0';
                   }
               }else if ($brow_key == 'safari') {
                   $select_Safari = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Browser` = 'Safari'";
                   if($result4 = mysql_query($select_Safari)) {
                       $Safari_row = mysql_fetch_row($result4);
                       $Safari = $Safari_row[0];
                       if($Safari == 0){
                           echo '0';
                       }else {
                           $Safari_per = (($Safari / $total_records) * 100);
                           echo round($Safari_per, 1);
                       }
                   }else{
                       echo '0';
                   }
               }else if ($brow_key == 'opera') {
                   $select_opera = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Browser` = 'opera'";
                   if($result5 = mysql_query($select_opera)) {
                       $opera_row = mysql_fetch_row($result5);
                       $opera = $opera_row[0];
                       $opera_per = (($opera / $total_records) * 100);
                       echo round($opera_per,1);
                   }else{
                       echo'0';
                   }
               }
           }

    }
    ////////////////////////////////////////////////// Get Platforms///////////////////////////////////////////////////
    public function os_percentage()
    {
        global $os_key;

        $sql = "SELECT COUNT(`ip_address`) FROM `month_visitors`";
        if($rs_result = mysql_query($sql)) {
            $row = mysql_fetch_row($rs_result);
            $total_records = $row[0];
            if ($os_key == 'windows') {
                $select_win = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Platform(OS)` = 'Windows 10'
                    OR `Platform(OS)` = 'Windows 8.1' OR `Platform(OS)` = 'Windows 8' OR `Platform(OS)` = 'Windows 7'
                    OR `Platform(OS)` = 'Windows vista' OR `Platform(OS)` = 'Windows Server 2003/XP x64' 
                    OR `Platform(OS)` = 'Windows Server 2003/XP x64' OR `Platform(OS)` = 'Windows XP' 
                    OR `Platform(OS)` = 'Windows 2000' OR `Platform(OS)` = 'Windows ME' OR `Platform(OS)` = 'Windows 98'
                    OR `Platform(OS)` = 'Windows 95' OR `Platform(OS)` = 'Windows 3.11'";
                if($result1 = mysql_query($select_win)) {
                    $c_row = mysql_fetch_row($result1);
                    $win = $c_row[0];
                    if($win == 0){
                        echo '0';
                    }else {
                        $win_per = (($win / $total_records) * 100);
                    }
                    echo round($win_per,1);
                }else{
                    echo '0';
                }
            }else if ($os_key == 'mac') {
                $select_mac = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Platform(OS)` = 'Mac OS X' 
                    OR `Platform(OS)` = 'Mac OS 9' OR `Platform(OS)` = 'iPhone' OR `Platform(OS)` = 'iPod'
                    OR `Platform(OS)` = 'iPad'";
                if ($result2 = mysql_query($select_mac)) {
                    $mac_row = mysql_fetch_row($result2);
                    $mac= $mac_row[0];
                    $mac_per = (($mac / $total_records) * 100);
                    if($mac == 0){
                        echo '0';
                    }else{
                        echo round($mac_per, 1);
                    }

                }else{
                    echo '0';
                }
            }else if ($os_key == 'linux') {
                $select_linux = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Platform(OS)` = 'Linux'
                      OR `Platform(OS)` = 'Ubuntu'";
                if($result3 = mysql_query($select_linux)) {
                    $linux_row = mysql_fetch_row($result3);
                    $linux = $linux_row[0];
                    $linux_per = (($linux / $total_records) * 100);
                    if($linux == 0){
                        echo '0';
                    }else {
                        echo round($linux_per, 1);
                    }
                }else{
                    echo '0';
                }
            }else if ($os_key == 'android') {
                $select_android = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Platform(OS)` = 'Android'";
                if($result3 = mysql_query($select_android)) {
                    $android_row = mysql_fetch_row($result3);
                    $android = $android_row[0];
                    $android_per = (($android / $total_records) * 100);
                    if($android == 0){
                        echo '0';
                    }else {
                        echo round($android_per, 1);
                    }
                }else{
                    echo '0';
                }
            }else if ($os_key == 'others') {
                $select_other = "SELECT COUNT(`ip_address`) FROM `month_visitors` WHERE `Platform(OS)` = 'BlackBerry'
                          OR `Platform(OS)` = 'Mobile'";
                if($result4 = mysql_query($select_other)) {
                    $other_row = mysql_fetch_row($result4);
                    $other = $other_row[0];
                    $other_per = (($other / $total_records) * 100);
                    echo round($other_per,1);
                }else{
                    echo '0';
                }
            }
        }

    }
//////////////////////////////////////////////////////// Tables////////////////////////////////////////////////////

    public function inter()
    {
       global $key;
        global $key2;
        if ($key == 'table' || boolval($key2)) {

           echo  $pag = $key2;
            // if($number !=null){$page=$number;}else{$page=1;}
            if ($pag == null) {
                $page = 1;
            } else {
                $page = $pag;
            }
            $start_from = ($page - 1) * 8;
            $sql = "SELECT * FROM `users` ORDER BY `id` ASC LIMIT $start_from, 8";

            if ($query_run = mysql_query($sql)) {

                while ($row = mysql_fetch_array($query_run)) {

                    // $sql_d ="SELECT `id` FROM `users` where `emaile` = '".$email."'";
                    //  echo "<tbody id='new_table'>"

                    echo "<tr>"
                        . "<td class='center'>" . $row['id'] . "</td>" .
                        "<td class='center'>" . $row['firstname'] . "</td>";
                    echo "<td class='center'>" . $row['email'] . "</td>";
                    echo "<td class='center'>" . $row['password'] . "</td>";
                    echo "<td class='center'>" . $row['Registration Date'] . "</td>";
                    echo '<td class="center">';
                    echo '<a class="btn btn-info" id="try" href="#"><i class="halflings-icon white edit"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-danger table_remove"><p class="pop">' . $row['id'] . '</p><f id="fname">' . $row['firstname'] .
                        '</f><i class="halflings-icon white trash"></i></a>';
                    echo '</td>';
                    echo "</tr>";

                }


            } else {
                mysql_error($query_run);
            }

        }
    }
    /////////////////////////// Visitors tables/////////////////////////
    public function Table24()
    {
       global $key;
        global $key24;
        if ($key == 'last24_t' || boolval($key24)) {

           echo  $pag = $key24;
            // if($number !=null){$page=$number;}else{$page=1;}
            if ($pag == null) {
                $page = 1;
            } else {
                $page = $pag;
            }
            $start_from = ($page - 1) * 8;
            $sql = "SELECT * FROM `last24` ORDER BY `id` DESC LIMIT $start_from, 8";

            if ($query_run = mysql_query($sql)) {

                while ($row = mysql_fetch_array($query_run)) {

                    // $sql_d ="SELECT `id` FROM `users` where `emaile` = '".$email."'";
                    //  echo "<tbody id='new_table'>"

                    echo "<tr>"
                        . "<td class='center'>" . $row['id'] . "</td>" .
                        "<td class='center'>" . $row['IP_Address'] . "</td>";
                    echo "<td class='center'>" . $row['Browser'] . "</td>";
                    echo "<td class='center'>" . $row['Platform(OS)'] . "</td>";
                    echo '</td>';
                    echo "</tr>";

                }


            } else {
                mysql_error($query_run);
            }

        }
    }
    public function TableWeek()
    {
        global $pg_number;
       global $key;
        global $key_week;
       // $pag = '';
        if ($key == 'last_week_t') {

            $start = 0;
            $limit = 8;



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


        }



    }






}
new paging();
?>