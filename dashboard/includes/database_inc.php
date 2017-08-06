<?php 
class Database{
	 public function __construct($host, $user, $pass){
	 	if(!$this->Connect($host, $user, $pass)){
	 		echo 'Connection faild '.$host;
	 	}else if($this->Connect($host, $user, $pass)){
	 		//echo 'Connected Successfully to '.$host;
	 	}
 }

public function Connect($host, $user, $pass){
	if(!@mysql_connect($host, $user, $pass)){
		return false;
	}else{
		return true;
	}
}

}
 new Database('localhost','fouadfawzi','fouad01242451361210');


 ?>