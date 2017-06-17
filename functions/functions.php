<?php
function get_index_header(){
    require_once 'includes/index-header.php';
}
function get_index_content(){
    require_once 'includes/home.php';
}
function get_footer(){
    require_once 'includes/footer.php';
}
function get_portfolio_content(){
    require_once 'includes/portfolio.php';
}
function get_portfolio_header(){
    require_once 'includes/portfolio-header.php';
}
function get_about_header(){
    require_once 'includes/about-header.php';
}
function get_about_content(){
    require_once 'includes/about.php';
}
function get_resume_content(){
    require_once 'includes/resume.php';
}
function get_resume_header(){
    require_once 'includes/resume-header.php';
}
function get_contact_header(){
    require_once 'includes/contact-header.php';
}
function get_contact_content(){
    require_once 'includes/contact.php';
}
function get_ssme_header(){
    require_once 'includes/ssme-header.php';
}
function get_ssme_content(){
    require_once 'includes/ssme.php';
}
function save_visitors(){
    require_once 'dashboard/includes/get_visitors.php';
    save_visitor();
}
?>