<?php
require 'users_action.php';
 $_SESSION['counter'] -= 1;
$sql_update = "UPDATE `users` SET `status` = 0 WHERE `id` = '".$_SESSION['login_id']."'";
mysql_query($sql_update);
    unset($_SESSION['login_id']);

header('Location: ../pages/login.php');
?>
