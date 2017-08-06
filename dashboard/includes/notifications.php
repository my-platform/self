<?php
require_once 'database_inc.php';
//session_start();
/*if(!(empty($_SESSION['msg-label']))){
    $_SESSION['msg-label'];
}*/
//$_SESSION['msg-label'] =0;
//ob_start();
  session_start();
@$_SESSION['msg-label'];
if (isset($_POST['key'])) {
    @$key = $_POST['key'];
  //  @$key1 = $_GET['key'];
}
class msg_notifications
{

    public function __construct()
    {

        $this->initiate();

    }

    public function initiate()
    {
        if (!@mysql_select_db('f_dashboard')) {
            echo 'The table doesn\'t exist .';
        } else {
            $this->msg_notification();

        }

    }
    public function msg_notification(){
        global $key;
        if(isset($_POST['initiate'])){
           // global $session;
            //ob_start();
            if(!session_id()){
                session_start();
            }
           // session_start();

          //  session_start();
            $number = $_POST['initiate'];
            @$_SESSION['msg-label'] += $number;
            echo $_SESSION['msg-label'];


        }
        if($key == 'msg-notification_menu'){
           // echo 'hey';
          //  echo'hello';
            if(isset($_SESSION['notification_menu'])) {
                echo $_SESSION['notification_menu'];
               // echo 'hello';
               // echo 'hey';
            }
        }
        $row_nums = null;
        if ($key == 'msg-notification') {
            if(isset($_SESSION['msg-label'])) {
                echo $_SESSION['msg-label'];
                //echo $_SESSION['notification_menu'];
            }else{
                echo '';
            }
          //  }else{
              //  echo 'shit';
            //}
        }
        if ($key =='unset_session'){
            if (isset($_SESSION['msg-label'])) {
                unset($_SESSION['msg-label']);
                //unset($_SESSION['notification_menu']);
                echo '';
            }
        }


    }
}
new msg_notifications();
?>

