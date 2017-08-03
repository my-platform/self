<?php
require_once '../functions/functions.php';
include'../includes/database_inc.php';

if(!logged_in()) {
    header('Location: ../pages/login.php');
}
get_header();
get_sidebar();
get_bread();
save_visitors();
if (!@mysql_select_db('f_dashboard')) {
    echo 'The table doesn\'t exist .';
} else {
?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
            <div class="col-md-8 col-xs-8 ">
                <p class="sql-error"></p>
                <div class="row">
                    <h1 class="contact-header">Send a Message</h1>
                </div>

                    <div class="row">
                        <B>Name *</B>

                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <input type="text" id="user_first_name" class="form-control" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <input type="text" id="user_last_name" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row field">
                        <label>Email Address *</label>

                        <div class="input-group ">
                            <span class="input-group-addon" id="ex">@</span>
                            <input type="text" id="user_email" class="form-control" placeholder="Email Address@Example.com"
                                   aria-describedby="id"/>
                        </div>
                    </div>
                    <div class="row field">
                        <div class="form-group">
                            <label>Title *</label>
                            <input type="text" id="user_title" class="form-control" placeholder="Subject of your message"/>
                        </div>
                    </div>
                    <div class="row field">
                        <div class="form-group">
                            <label>Your Message *</label>
                            <textarea class="form-control" id="user_message" placeholder="Here you go" rows="5"
                                      id="textarea"></textarea>
                        </div>
                    </div>
                    <div class="row margin-top">

                        <a class="btn btn-default " id="send">SEND</a>

                    </div>

        </div>
    </div>

<?php
}
get_footer();
?>