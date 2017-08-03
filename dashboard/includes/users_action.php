<?php
require_once 'database_inc.php';
$matching = '';
$script_path ='';
$fields ='';
$http_refer = '';
if(isset($_POST['key'])){
    @$key = $_POST['key'];
}
class login
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
            $this->time_session();
            $this->get_script_name();
            $this->login_validation();
            $this->online();
            $this->create_user();
        }
    }
    public function get_script_name(){
      //  ob_start();
        global $script_path, $http_refer;
        $script_path = $_SERVER['SCRIPT_NAME'];
        if( isset($_SERVER['HTTP_REFERER']) || !empty($_SERVER['HTTP_REFERER'])) {
            $http_refer = $_SERVER['HTTP_REFERER'];
        }
    }


    function login_validation()
    {
        ob_start();
        if(!session_id()){
            session_start();
        }

        global $matching, $fields;
       /* if (isset($_POST['username']) || isset($_POST['password'])) {


            @$username = $_POST['username'];
            @$hash_pass = md5($_POST['password']);
            @$password = $hash_pass;
            //  echo 'hello '.$username;
            if (!empty($username) && !empty($password)) {
                $sql_update = "UPDATE `users` SET `firstname` ='".$username."' , `password` = '".$password."' WHERE `id` = 1";
                mysql_query($sql_update);

            } else {
                $fields = "<p style='color:red'>* please fill all fields </p>";
            }
        }*/
        if (isset($_POST['username']) || isset($_POST['password'])) {


            @$username = $_POST['username'];
            @$hash_pass = md5($_POST['password']);
            @$password = $hash_pass;
            //  echo 'hello '.$username;
            if (!empty($username) && !empty($password)) {
                $sql = "SELECT `id` FROM `users` WHERE `email` ='" .mysql_real_escape_string($username) . "'
	 		 AND `password` ='" .mysql_real_escape_string($password)."'";

                if ($sql_run = mysql_query($sql)) {
                    if (mysql_num_rows($sql_run) == 0) {
                        $matching = "<p style='color:red'>* invalid username/password combination </p>";
                    } else if (mysql_num_rows($sql_run) == 1) {
                        $user_id = mysql_result($sql_run, 0, 'id');
                        $_SESSION['login_id'] = $user_id;
                       /* $sql_update = "UPDATE `users` SET `status` = 1 WHERE `id` = '".$_SESSION['login_id']."'";
                        mysql_query($sql_update);*/
                        $_SESSION['counter'] += 1;
                        header("Location: index.php");
                    }
                } else {
                    echo mysql_error();
                }
            } else {
                  $fields = "<p style='color:red'>* please fill all fields </p>";
            }
         }
    }
                //////////////////////////////// set time session //////////////////////////////
    function time_session(){
        $_SESSION['time'] = time();
    }
    public function GetUserData($field){
        $sql = "SELECT `$field` FROM `users` WHERE `id`='".$_SESSION['login_id']."'";
        if($query_run = mysql_query($sql)){
            if($QueryResult = mysql_result($query_run, 0, $field)){
                return $QueryResult;
            }
        }
    }
    public function loggedin(){

        if(isset($_SESSION['login_id'])&&!empty($_SESSION['login_id'])){
            return true;
        }else{
            return false;
        }
    }
    /////////////////////////////////show online users//////////////////////////////////
    function online(){
        global $key;
        if($key == 'user_online'){
            if(isset($_SESSION['time']) && !empty($_SESSION['time']) && isset($_SESSION['login_id'])){
                $sql_update = "UPDATE `users` SET `status` = 1 WHERE `id` = '".$_SESSION['login_id']."'";
                mysql_query($sql_update);
                $time = $_SESSION['time'];
                $minuets_5 = time() - (60 * 5);
                if($time <= $minuets_5){
                    $sql_update = "UPDATE `users` SET `status` = 0  WHERE `id` = '".$_SESSION['login_id']."'";
                    mysql_query($sql_update);
                    unset($_SESSION['time']);
                }

            }
            $sql = "SELECT COUNT(`firstname`) FROM `users` WHERE `status` = 1 ";
            $rs_result = mysql_query($sql);
            if($row = mysql_fetch_row($rs_result)){
                echo $row[0];
                //echo $_SESSION['time'];


            }else{
                echo '0';
            }
        }

    }
    public function create_user(){
        if (isset($_POST['username_c']) || isset($_POST['password_c'])) {


            @$username = $_POST['username_c'];
            @$hash_pass = md5($_POST['password_c']);
            @$password = $hash_pass;
            //  echo 'hello '.$username;
            if (!empty($username) && !empty($password)) {
                 $sql_update = "UPDATE `users` SET `first` ='".$username."' `password` = '".$password."' WHERE `id` = 1";
                           mysql_query($sql_update);

            } else {
                $fields = "<p style='color:red'>* please fill all fields </p>";
            }
        }
    }

    
}
new login();
?>