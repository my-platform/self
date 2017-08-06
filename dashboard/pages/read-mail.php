<?php
require_once '../functions/functions.php';
include'../includes/database_inc.php';

if(!logged_in()) {
    header('Location: ../pages/login');
}
get_header();
get_sidebar();
get_bread();
save_visitors();
if (!@mysql_select_db('f_dashboard')) {
    echo 'The table doesn\'t exist .';
} else {
    if(isset($_GET['msg-id'])){
        @$id = $_GET['msg-id'];
    }
      function messageData ($target)
      {
       global $id;
          $sql = "SELECT * FROM `messages` WHERE `id`=".$id;
         if($query_run = mysql_query($sql)) {
             if ($row = mysql_fetch_array($query_run)) {
                 $trash = $row['trash'];
                 $first = $row['firstname'];
                 $last = $row['lastname'];
                 $subject = $row['title'];
                 $email = $row['email'];
                 $message = $row['message'];
                 $date = $row['date'];

                 if ($target == 'subject') {
                     echo $subject;
                 } else if ($target == 'email') {
                     echo $email;
                 }else if ($target == 'name') {
                     echo $first.' '.$last;
                 } else if ($target == 'message') {
                     echo $message;
                 } else if ($target == 'trash') {
                     echo $trash;
                 } else if ($target == 'id') {
                     echo $id;
                 } else if ($target == 'date') {
                     $time_o = new DateTime($date);

                     if ($time_o === date('h:i a', strtotime('-10 minute'))) {// not working
                         $time = '1 hour ago';
                     } else {
                         $time = $time_o->format('h:i a');
                     }
                     $day_o = $time_o->format('M d, Y');
                     // $current_day =date('M d, Y');
                     if ($day_o === date('M d, Y')) {
                         $day = 'Today';
                     } elseif ($day_o === date('M d, Y', strtotime("-1 day"))) {
                         $day = 'Yesterday';
                     } elseif ($day_o === date('M d, Y', strtotime("-2 day"))) {
                         $day = '2 days ago';
                     } elseif ($day_o === date('M d, Y', strtotime("-3 day"))) {
                         $day = '3 days ago';
                     } elseif ($day_o === date('M d, Y', strtotime("-4 day"))) {
                         $day = '4 days ago';
                     } elseif ($day_o === date('M d, Y', strtotime("-4 day"))) {
                         $day = '5 days ago';
                     } else {
                         $day = $day_o;
                     }
                     echo $day . '&nbsp;' . '&nbsp;' . $time;
                 }

             }
         }else{
             
         }
      }
    ?>
    <section class="content">

        <div class="row">

            <div class="col-md-3">
                <a href="compose" class="btn btn-primary btn-block margin-bottom">Compose</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked mail-links">
                            <li  id="inbox-link"><a href="mailbox"><i class="fa fa-inbox"></i> Inbox
                                    <span class="label label-primary pull-right">12</span></a></li>
                            <li id="sent-link"><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                            <li id="drafts-link"><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                            <li id="junk-link"><a href="#"><i class="fa fa-filter"></i> Junk <span
                                        class="label label-warning pull-right">65</span></a>
                            </li>
                            <li id="trash-link"><a id="mail-trash" href="mail-trash"><i class="fa fa-trash-o"></i> Trash</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <div id="notify-msg3"><p id="notify_message3"></p>
                <p>please wait ...</p>
            </div>
            <!-- /.col -->
            <!-- <p id="paragraph2">There you go:</p>-->
            <div class="col-md-9">
                <!--redirection message-->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Read Mail</h3>
                        
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h4><b><?php messageData('name')?></b></h4>
                            <h3><?php messageData('subject')?></h3>
                            <h5><?php messageData('email')?>
                                <span class="mailbox-read-time pull-right"><?php messageData('date')?> <i class="fa fa-clock-o"></i></span></h5>
                        </div>

                        <!-- /.mailbox-read-info -->
                        <div class="mailbox-controls with-border text-center">
                            <div class="btn-group">
                                <button type="button" data-target="#readPopUpWindow" data-toggle="modal"
                                        class="btn btn-default btn-sm" data-container="body" title="Delete">
                                    <i class="fa fa-trash-o"></i></button>
                                <a href="compose?rep-id=<?php global $id; echo $id;?>" type="button" class="btn btn-default btn-sm msg-replay" value="" data-toggle="tooltip" data-container="body" title="Reply">
                                    <i class="fa fa-reply"></i></a>
                                <a href="compose?for-id=<?php global $id; echo $id;?>" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                                    <i class="fa fa-share"></i></a>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                                <i class="fa fa-print"></i></button>
                        </div>
                        <div class="modal fade" id="readPopUpWindow">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <p class="modal-title center-block"><h4><b><span class="fa fa-warning"></span> confirmation message</b></h4></p>
                                    </div>
                                    <div class="modal-body">

                                        <div role="form">
                                            <div class="form-group">
                                            </div>
                                            <div class="form-group">
                                                <b>Are you sure you wanna delete this message?</b>
                                            </div>
                                            <div class="form-group">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="cancel-delete" class="btn btn-primary btn-md" data-dismiss="modal">No</button>
                                        <button id="read-msg-delete" val="<?php messageData('trash') ?>" value="<?php global $id; echo $id;?>" class="btn btn-primary btn-md" data-dismiss="modal">Yes</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <br>
                            <?php messageData('message')?>
                            <br>
                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <ul class="mailbox-attachments clearfix">
                            <li>
                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Sep2014-report.pdf</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                                </div>
                            </li>
                            <li>
                                <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>

                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> App Description.docx</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                                </div>
                            </li>
                            <li>
                                <span class="mailbox-attachment-icon has-img"><img src="../dist/img/photo1.png" alt="Attachment"></span>

                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo1.png</a>
                        <span class="mailbox-attachment-size">
                          2.67 MB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                                </div>
                            </li>
                            <li>
                                <span class="mailbox-attachment-icon has-img"><img src="../dist/img/photo2.png" alt="Attachment"></span>

                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo2.png</a>
                        <span class="mailbox-attachment-size">
                          1.9 MB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-footer -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="compose?rep-id=<?php global $id; echo $id;?>"  type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</a>
                            <a href="compose?for-id=<?php global $id; echo $id;?>" type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</a>
                        </div>
                        <button data-target="#readPopUpWindow" data-toggle="modal" type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                        <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <?php
}
logout_confirmation();
get_footer();
?>

