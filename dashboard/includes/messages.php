<?php
require 'database_inc.php';
//$_SESSION['msg-notify'] = 0;
//session_start();
//@$_SESSION['msg-label'];

//require '../includes/users_action.php';
if (isset($_POST['key']) || isset($_POST['messages']) || isset($_POST['msg_member']) || isset($_POST['expired_msg'])
||  isset($_POST['msg-notification'])) {
    @$expired_delete = $_POST['expired_msg'];
    @$key = $_POST['key'];
    @$key2 = $_POST['messages'];
    @$msg_visitor = $_POST['msg_member'];
    //@$notification = $_POST['msg-notification'];
}


class message
{

    public function __construct()
    {

        $this->initiate();

    }

    public function initiate()
    {
        if (!@mysql_select_db('dashboard')) {
            echo 'The table doesn\'t exist .';
        } else {
            $this->delete_read_msg_fully();
            $this->delete_read_message();
            $this->delete_expired_message();
            $this->delete_to_trash();
            $this->delete_from_trash();
            $this->save_msg();
            $this->dropDownMessage();
            $this->drop_menu_msg();
            $this->get_session();
           // $this->msg_notification();
        }

    }

public function delete_to_trash(){

    if (isset($_POST['delete_key'])){
        $list = $_POST['delete_key'];
        $text_length = strlen($list);
        $updated_list = substr_replace($list, ' ', $text_length - 4, 4);
      //  echo $updated_list;
        $sql = "UPDATE `messages` SET `trash` = '1', `trash_date` =NOW() WHERE ".$updated_list;
        mysql_query($sql);
    }
}
    public function delete_from_trash(){

    if (isset($_POST['delete_fully'])){
        $list = $_POST['delete_fully'];
        $text_length = strlen($list);
        $updated_list = substr_replace($list, ' ', $text_length - 4, 4);
       // echo $updated_list;
        $sql = "DELETE FROM `messages` WHERE ".$updated_list." AND `trash`=1";
        mysql_query($sql);
    }
}
                    //////////////// delete read msg  ///////////////

    public function delete_read_message(){

        if (isset($_POST['delete_read'])){
            $id = $_POST['delete_read'];
            $sql = "UPDATE `messages` SET `trash` = '1', `trash_date` =NOW() WHERE `id`=".$id;
            mysql_query($sql);
        }
    }
               //////////////// delete read msg fully "from trash" ///////////////
    public function delete_read_msg_fully(){
        if (isset($_POST['delete_read_finally'])){
            $id = $_POST['delete_read_finally'];
            $sql2 = "DELETE FROM `messages` WHERE `id` =".$id." AND `trash`=1";
            mysql_query($sql2);
        }
    }            //////////////// delete read msg fully "from trash" ///////////////
    public function MsgReplay(){
        if (isset($_POST['msg_replay'])){
            $id = $_POST['msg_replay'];
           echo $id;
        }
    }
                    //////////////////delete expired messages//////////////
    public function delete_expired_message(){
       // $shit = '33';
        global $expired_delete;
        if ($expired_delete == 'delete-expired') {

        //echo 'shit happened';
                //$expired = time() - 60;
                $sql_delete = "DELETE FROM `messages` WHERE `trash` = 1 AND
                          (`trash_date` < DATE_SUB(NOW(), INTERVAL 15 DAY ))";
                    mysql_query($sql_delete);

        }
    }





    //drop down message list
    public function dropDownMessage()
    {
        global $key;
        if ($key == 'msg-notification_menu') {
            $sql = "SELECT * FROM `messages` ORDER BY `date` DESC ";

            if ($query_run = mysql_query($sql)) {

                while ($row = mysql_fetch_array($query_run)) {

                    $id = $row['id'];
                    $first = $row['firstname'];
                    $last = $row['lastname'];
                    $title = $row['title'];
                    $email = $row['email'];
                    $date = $row['date'];
                    $time_o = new DateTime($date);
                    $time = $time_o->format('h:i a');
                    $day_o = $time_o->format('M d, Y');
                    // $current_day =date('M d, Y');
                    if ($day_o === date('M d, Y')) {
                        $day = 'Today';
                    } elseif ($day_o === date('M d, Y', strtotime("-1 day"))) {
                        $day = 'Yesterday';
                    }elseif ($day_o === date('M d, Y', strtotime("-2 day"))) {
                        $day = '2 days ago';
                    }elseif ($day_o === date('M d, Y', strtotime("-3 day"))) {
                        $day = '3 days ago';
                    }elseif ($day_o === date('M d, Y', strtotime("-4 day"))) {
                        $day = '4 days ago';
                    }elseif ($day_o === date('M d, Y', strtotime("-5 day"))) {
                        $day = '5 days ago';
                    }else {
                        $day = $day_o;
                    }
                    $text_length = strlen($title);
                    $short_title = '';
                    if ($text_length > 35) {
                        $missed_text = $text_length - 35;
                        $short_title .= substr_replace($title, '...', 35, $missed_text);
                    } else {
                        $short_title .= $title;
                    }
                    echo '<li><!-- start message -->
                    <a href="read-mail.php?msg-id='.$id.'">
                      <div class="pull-left">
                        <img src="../dist/img/mess.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        '.$first.'&nbsp;'.$last.'
                        <small><i class="fa fa-clock-o"></i> &nbsp;'.$day.'</small>
                      </h4>
                      <p>'.$short_title.'</p>
                    </a>
                  </li>';
                }
            }

        }
    }

// saving user message
    public function save_msg()
    {
        //$_SESSION['msg-label'] = 0;
        //@$_SESSION['notification_menu'];
        global $key;
        if (isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['email'])
            || isset($_POST['title']) || isset($_POST['message'])
        ) {

            if(!session_id()){
                session_start();
            }

            echo($first_name =mysql_real_escape_string($_POST['first_name']));
            echo($last_name = mysql_real_escape_string($_POST['last_name']));
            echo($email = mysql_real_escape_string($_POST['email']));
            echo($title = mysql_real_escape_string($_POST['title']));
            echo($message =mysql_real_escape_string($_POST['message']));
            $sql ="INSERT INTO `messages` (`id`, `firstname`, `lastname`, `email`,
                        `title`, `message`, `date`, `trash`, `trash_date`) VALUES 
            (NULL, '" . $first_name . "', '" . $last_name . "', '" . $email . "',
             '" . $title . "', '" . $message . "', now(), 0, NULL)";
            //echo($sql);
            $result = mysql_query($sql);
            if ($result) {
                //echo 'hello';
                @$_SESSION['msg-label'] += 1;
            } else {
                throw new mysqli_sql_exception('Database error: ' . mysql_error());
            }
        } else {
            // echo "please fill all fields";
        }
    }

    public function drop_menu_msg()
    {
        global $key;
        global $key2;
        global $msg_visitor;
        if (isset($_POST['msg_member']) || boolval($key2)) {
            // echo 'woooorks';
            // msg_member;
            // session_start();
            $pag = $key2;

            if ($pag == null) {
                $page = 1;
            } else {
                $page = $pag;
            }
            $start_from = ($page - 1) * 8;
            $sql = "SELECT * FROM `messages` WHERE `id`='" . $msg_visitor . "'ORDER BY `date` DESC LIMIT $start_from, 16";

            if ($query_run = mysql_query($sql)) {

                while ($row = mysql_fetch_array($query_run)) {

                    // $sql_d ="SELECT `id` FROM `users` where `emaile` = '".$email."'";
                    //  echo "<tbody id='new_table'>"
                    $first = $row['firstname'];
                    $last = $row['lastname'];
                    $email = $row['email'];
                    $title = $row['title'];
                    $message = $row['message'];
                    $date = $row['date'];
                    $time_o = new DateTime($date);
                    $time = $time_o->format('h:i a');
                    $day_o = $time_o->format('M d, Y');
                    // $current_day =date('M d, Y');
                    if ($day_o === date('M d, Y')) {
                        $day = 'Today';
                    } elseif ($day_o === date('M d, Y', strtotime("-1 day"))) {
                        $day = 'Yesterday';
                    } else {
                        $day = $day_o;
                    }


                    $text_length = strlen($title);
                    $short_title = '';
                    if ($text_length > 35) {
                        $missed_text = $text_length - 35;
                        $short_title .= substr_replace($title, '...', 35, $missed_text);
                    } else {
                        $short_title .= $title;
                    }


                    /*  @$_SESSION['title'] = $title;
                     * @$_SESSION['first'] = $first;
                     * @$_SESSION['last'] = $last;
                     * @$_SESSION['message'] = $message;
                     * @$_SESSION['time'] = $time;
                     * @$_SESSION['day'] = $day;
                     * @$_SESSION['email'] = $email;*/
                    /*  if($key == 'title' || $key =='get-title'){
                          echo $title;
                      }elseif( $key =='get-first'){
                          echo $first;
                      }elseif($key =='get-last'){
                          echo $last;
                      }elseif( $key =='get-email'){
                          echo $email;
                      }elseif($key =='get-message'){
                          echo $message ;
                      }elseif($key =='get-time'){
                          echo $time;
                      }elseif( $key =='get-day'){
                          echo $day;
                      }*/


                }


            } else {
                mysql_error($query_run);
            }

        }
    }

    public function get_session()
    {
        // session_start();
        global $key;
        if ($key == 'get-title') {
            if (isset($_SESSION['title'])) {
                echo $_SESSION['title'];
            } else {
                echo 'noting';
            }
        }
        if ($key == 'get-first') {
            if (isset($_SESSION['first'])) {
                echo $_SESSION['first'];
            } else {
                echo 'noting';
            }
        }
        if ($key == 'get-last') {
            if (isset($_SESSION['last'])) {
                echo $_SESSION['last'];
            } else {
                echo 'noting';
            }
        }
        if ($key == 'get-message') {
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
        }
        if ($key == 'get-time') {
            if (isset($_SESSION['time'])) {
                echo $_SESSION['time'];
            }
        }
        if ($key == 'get-day') {
            if (isset($_SESSION['day'])) {
                echo $_SESSION['day'];
            }
        }
        if ($key == 'get-email') {
            if (isset($_SESSION['email'])) {
                echo $_SESSION['email'];
            }
            echo 'its mail';
        } else {
            //echo'does not work';
        }
    }

}

new message();

?>