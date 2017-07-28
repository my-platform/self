<?php
ob_start();
//counter_start();
require_once '../functions/functions.php';
include '../includes/users_action.php';
$login_class = new login();
$login = $login_class->loggedin();
get_login_header();
//echo $script_path;
if($login){
header('Location: ../pages/index');
}
?>

<section class="content">


        <div class="row">
            <div class="login-box">
                <h4>Login to your account</h4>

                    <!-- /.box-header -->
                    <!-- form start -->
                <hr>
                    <form action="<?php echo $script_path; ?>" method="post">
                        <div class="box-body">
                            <div class="input-group margin-bottom">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="admin_username" type="text" name="username_c" class="form-control" placeholder="User name">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="admin_password" name="password_c" type="password" class="form-control" placeholder="password">

                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>

                            </div>
                            <button id="login_button" type="submit" class="btn btn-primary">Login  <i class="fa fa-toggle-right"></i></button>
                        </div>

                    </form>

                <hr>
                <div>
                    <?php echo $matching?>
                    <?php echo $fields?>
                </div>
                <div>

                    </div>
                <div>
                <h4>Forgot Password?</h4>
                <p>
                 No problem, <a>click here</a> to get a new password.
                </p>
                </div>
            </div><!--/span-->
        </div>

</section>
<?php
get_functional_footer();
?>
