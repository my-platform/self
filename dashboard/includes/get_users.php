<?php
    include 'database_inc.php';
     $key = $_POST['key'];
class Get_user
{
    public function __construct($host, $user, $pass){

        $this->initiate($host, $user, $pass);

     }
    public function initiate($host, $user, $pass)
    {
        $connection = new Database($host, $user, $pass);

        if(!@mysql_select_db('dashboard')){
            echo 'The table doesn\'t exist .' ;
        }else {
            $this->get_users();
            $this->last24();
            $this->max_visit();
            $this->today_users();
            $this->week_users();
            $this->this_month();
            $this->last_year();
            $this->all_users();
            $this->last_week();
            $this->male_members();
            $this->female_members();
            //$this->last_month_visitors();
        }

    }
    public function get_users(){
        global $key;
        if ($key == 'get_users') {
            $sql = 'SELECT COUNT(0) FROM `online_visitors`';
            $query = mysql_query($sql);
            if ($rows = mysql_fetch_array($query)) {
                echo $rows[0];
                $expired = time() - (60 * 5);
                $sql2 = "DELETE FROM `online_visitors` WHERE `Date` < '" . $expired . "'";
                mysql_query($sql2);
            } else {
                echo '0';
            }
            //visitors last24 hours
        }
    }
    public function last24(){
        global $key;
       if ($key == 'last24') {
            $sql1 = 'SELECT COUNT(0) FROM `last24`';
            $query = mysql_query($sql1);
            if ($rows24 = mysql_fetch_array($query)) {
                echo $rows24[0];
                $last24 = time() - (60 * 60 * 24);
                $sql3 = "DELETE FROM `last24` WHERE `Date` < '" . $last24 . "'";
                mysql_query($sql3);
            } else {
                echo '0';
            }


        }
    }
    public function last_week(){
        global $key;
       if ($key == 'this_week') {
            $sql = 'SELECT COUNT(0) FROM `vlast_week`';
            $query = mysql_query($sql);
            if ($rows = mysql_fetch_array($query)) {
                echo $rows[0];
                $last_week = time() - ((60 * 60 * 24) * 7);
                $sql2 = "DELETE FROM `vlast_week` WHERE `Date` < '" . $last_week . "'";
                mysql_query($sql2);
            } else {
                echo '0';
            }


        }
    }
  
    public function max_visit(){
            global $key;
        if ($key == 'MaxVisit') {
           /* $sql_max = "SELECT COUNT(0) FROM `vlast_week` ";
            $query = mysql_query($sql_max);
           // $this->get_users();
            if ($rows = mysql_fetch_array($query)) {
                //echo $rows24[0];
                //Save the max visit to table
                $max_last_week = $rows[0];
            }
            $sql_com = "SELECT MAX(`value`) FROM `max_visit`";
            if ($query = mysql_query($sql_com)) {
                $res_max = mysql_result($query,0);
              // $res_max = $res_com[0];
            }
            if ($res_max < $max_last_week) {
                $sql_save = "INSERT INTO `max_visit` (`id`,`value`,`date`, `time`)
                          VALUES('', '" . $max_last_week . "',now(), now())";
                if (mysql_query($sql_save)) {
                    $sql_delete = "DELETE FROM `max_visit` WHERE `time` < now() - 4 ";
                    mysql_query($sql_delete);
                }
                echo $res_max;
            } else {
                echo $res_max;
            }*/
            $sql1 = 'SELECT * FROM `max_visit`';
            $query = mysql_query($sql1);
            if ($row= mysql_fetch_array($query)) {
                echo $row['value'];
            } else {
                echo '0';
            }



        }
    }
    public function today_users(){
        global $key;
        if ($key == 'today') {
            $sql = "SELECT COUNT(0) FROM `users` WHERE DATE(`Registration Date`) = CURDATE()";
            $query = mysql_query($sql);

            if ($rows = mysql_fetch_array($query)) {
                echo $rows[0];
            }else{
                echo '0';
            }

        }
    }
    public function week_users(){
        global $key;
        if ($key == 'last_week') {
            $sql = "SELECT COUNT(0) FROM `users` WHERE 
                    `Registration Date` BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
            $query = mysql_query($sql);

            if ($rows = mysql_fetch_array($query)) {
                echo $rows[0];
            }else{
                echo '0';
            }

        }
    }
    public function this_month(){
        global $key;
        if ($key == 'this_month') {
            $sql = "SELECT COUNT(0) FROM `users` WHERE 
                    `Registration Date` BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW()";
            $query = mysql_query($sql);

            if ($rows = mysql_fetch_array($query)) {
                echo $rows[0];
            }else{
                echo '0';
            }

        }
    }
    public function last_year(){
        global $key;
        if ($key == 'last_year') {
            $sql = "SELECT COUNT(0) FROM `users` WHERE 
                    `Registration Date` BETWEEN DATE_SUB(NOW(), INTERVAL 1 YEAR) AND NOW()";
            $query = mysql_query($sql);

            if ($rows = mysql_fetch_array($query)) {
                echo $rows[0];
            }else{
                echo '0';
            }

        }
    }
    public function all_users(){
        global $key;
        if ($key == 'all_users') {
            $sql = "SELECT COUNT(0) FROM `users`";
            $query = mysql_query($sql);

            if ($rows = mysql_fetch_array($query)) {
                echo $rows[0];
            }else{
                echo '0';
            }

        }
    }
    public function male_members(){
        global $key;
        if ($key == 'male_members') {
            $sql = "SELECT COUNT(0) FROM `users` WHERE `gender` ='male'";
            $query = mysql_query($sql);

            if ($rows = mysql_fetch_array($query)) {
                echo $rows[0];
            }else{
                echo '0';
            }

        }
    }
    public function female_members(){
        global $key;
        if ($key == 'female_members') {
            $sql = "SELECT COUNT(0) FROM `users` WHERE `gender` ='female'";
            $query = mysql_query($sql);

            if ($rows = mysql_fetch_array($query)) {
                echo $rows[0];
            }else{
                echo '0';
            }

        }
    }

}
    $user = new Get_user('localhost','root', '');
   // $user;
//$connection->close();
?>