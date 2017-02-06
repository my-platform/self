<?php
function get_header(){
    require_once '../includes/header.php';
}
function get_login_header(){
    require_once '../includes/style_header.php';
}
function get_sidebar(){
    require_once '../includes/sidebar.php';
}
function get_bread(){
    require_once '../includes/bread.php';
}
function get_content(){
    require_once '../includes/content.php';
}
function get_footer(){
    require_once '../includes/footer.php';
}
function get_functional_footer(){
    require_once '../includes/functional_footer.php';
}
function save_visitors(){
    require_once '../includes/get_visitors.php';
    save_visitor();
}
function user_widgets(){
    require_once '../includes/user widgets.php';
}
function logout_confirmation(){
    require_once '../includes/logout_confirmation.php';
}
function paging(){
    require_once '../includes/pages.php';
    $page = new paging();
    $page->pages();
}
function logged_in(){
    require_once '../includes/users_action.php';
    $login_class = new login();
   return $login_class->loggedin();
}
?>