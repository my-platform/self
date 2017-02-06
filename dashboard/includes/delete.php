<?php
require 'database_inc.php';

//new Database('localhost', 'root', '');

$key = $_POST['key'];
if(isset($_POST['pag'])){
   // $key = $_POST['key'];
    $key2 = $_POST['pag'];
}

//$page_num = $_GET['table'];
//echo $key;

class ajax_data
{
    public function __construct()
    {

        $this->initiate();

    }

    public function initiate()
    {
        $connection = new Database('localhost', 'root', '');

        if (!@mysql_select_db('dashboard')) {
            echo 'The table doesn\'t exist .';
        } else {
             $this->id();
            $this->first();
            $this->email();
            $this->pass();
            $this->delete();
           // $this->inter();
        }

    }


    public function id()
    {

        global $key;
        if ($key == 'id') {
            $sql = "SELECT * FROM `users`";
            if ($query_run = mysql_query($sql)) {
                while ($row = mysql_fetch_array($query_run)) {
                    echo  $row['id'] ;

                }
            }
        }

    }

    public function first()
    {

        global $key;
        if ($key == 'first') {
            $sql = "SELECT * FROM `users`";
            if ($query_run = mysql_query($sql)) {
                while ($row = mysql_fetch_array($query_run)) {

                    echo $row['firstname'];

                }
            }
        }

    }

    public function email()
    {

        global $key;
        if ($key == 'email') {
            $sql = "SELECT * FROM `users`";
            if ($query_run = mysql_query($sql)) {
                while ($row = mysql_fetch_array($query_run)) {
                    echo  $row['email'];
                }
            }
        }

    }

    public function pass()
    {
        global $key;
        if ($key == 'pass') {
            $sql = "SELECT * FROM `users`";
            if ($query_run = mysql_query($sql)) {
                while ($row = mysql_fetch_array($query_run)) {
                    echo  $row['password'];
                }
            }
        }

    }
    public function delete(){
    global $key;
        
            $sql = "DELETE FROM `users` WHERE `id`='" . $key . "'";
            mysql_query($sql);

    }

   

}
new ajax_data();


?>

