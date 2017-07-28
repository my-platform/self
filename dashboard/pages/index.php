<?php
//session_start();
ob_start();
require_once '../functions/functions.php';
//require_once '../includes/users_action';

if(!logged_in()) {
    header('Location: ../pages/login');
}
    get_header();
    get_sidebar();
    get_bread();
    save_visitors();
       // echo "welcome: ".$login_class->GetUserData('firstname');
    ?>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 id="visitor_win">0</h3>

                    <p>Traffic Now</p>
                </div>
                <div class="icon">
                    <i class="fa  fa-line-chart"></i>
                </div>
                <a href="visitors#online_visitors" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 id="online-users">0</h3>

                    <p>Online Members</p>
                </div>
                <div class="icon">
                    <i class="fa fa-globe"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 id="all_users">0</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-plus"></i>
                </div>
                <a href="users#users" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 id="max_visit">0</h3>

                    <p>All visits so far</p>
                </div>
                <div class="icon">
                    <i class="fa fa-pie-chart"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

    </div>
       <!-- <div class="row divider-row">
            <div class="col-lg-12 col-xs-12">
                <h3>Statistics</h3> <div class="divider"></div>
            </div>
        </div>-->
            <!-- get browsers percentage-->
    <div class="row">
        <!--<p id="size-feed"></p>-->
        <div class="col-lg-6 col-sm-6 col-xs-6" id="box-size">
            <div class="box bg-black box-success">
                <div class="custom-box">
                    <h4 class="box-title">Browsers (most usage)</h4>
                </div>
                <hr>
                <!-- /.box-header -->
                <div class="box-body no-padding ">
                    <div class="users-list clearfix row">
                        <div class="col-md-3 col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-chrome icon-size"></span>
                            <p class="text-center"><b id="chrome">0 %</b></p>
                        </div>
                        <div class="col-md-3  col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-firefox icon-size"></span>
                            <p class="text-center"><b id="firefox">0 %</b></p>
                        </div>
                        <div class="col-md-3  col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-safari icon-size"></span>

                            <p class="text-center"><b id="safari">0 %</b></p>
                        </div>
                        <div class="col-md-3  col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-opera icon-size"></span>
                            <p class="text-center"><b id="opera">0 %</b></p>
                        </div>
                        <div class="col-md-3  col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-internet-explorer icon-size"></span>
                            <p class="text-center"><b id="ie">0 %</b></p>
                        </div>
                    </div>
                    <!-- /.users-list -->
                </div>

                <!-- /.box-footer -->
            </div>
        </div>

        <!-- get OS percentage-->
        <div class="col-lg-6 col-sm-6 col-xs-6" id="box-size">
            <div class="box bg-black box-success">
                <div class="custom-box">
                    <h4 class="box-title">OS (most usage)</h4>
                </div>
                <hr>
                <!-- /.box-header -->
                <div class="box-body no-padding ">
                    <div class="users-list clearfix row">
                        <div class="col-md-3 col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-windows icon-size"></span>
                            <p class="text-center"><b id="windows">0 %</b></p>
                        </div>
                        <div class="col-md-3  col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-apple icon-size"></span>
                            <p class="text-center"><b id="mac">0 %</b></p>
                        </div>
                        <div class="col-md-3  col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-android icon-size"></span>

                            <p class="text-center"><b id="android">0 %</b></p>
                        </div>
                        <div class="col-md-3  col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-linux icon-size"></span>
                            <p class="text-center"><b id="linux">0 %</b></p>
                        </div>
                        <div class="col-md-3  col-sm-4 col-xs-6 text-center">
                            <span class="fa fa-question-circle icon-size"></span>
                            <p class="text-center"><b id="others">0 %</b></p>
                        </div>
                    </div>
                    <!-- /.users-list -->
                </div>

                <!-- /.box-footer -->
            </div>
        </div>

    </div>
    <?php
logout_confirmation();
get_footer();
?>

