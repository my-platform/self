<?php
require_once '../functions/functions.php';
include '../includes/database_inc.php';

if(!logged_in()) {
    header('Location: ../pages/login');
}
get_header();
get_sidebar();
get_bread();
save_visitors();
if (!@mysql_select_db('dashboard')) {
    echo 'The table doesn\'t exist .';
} else {
    if(isset($_GET['for-id'])){
        @$id = $_GET['for-id'];
    }else if(isset($_GET['rep-id'])){
        @$id = $_GET['rep-id'];
    }
    function messageData ($target)
    {
        global $id;
        $sql = "SELECT * FROM `messages` WHERE `id`=".$id;
        if($query_run = mysql_query($sql)){
        if ($row = mysql_fetch_array($query_run)) {
            $trash = $row['trash'];
            $subject = $row['title'];
            $email = $row['email'];
            $message = $row['message'];
            $date = $row['date'];

            if ($target == 'subject') {
                echo $subject;
            } elseif($target == 'rep-subject') {
                echo 'Rep- '.$subject;
            } else if ($target == 'email') {
                echo $email;
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
            echo '';
        }
    }
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="mailbox" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="mailbox"><i class="fa fa-inbox"></i> Inbox
                                    <span class="label label-primary pull-right">12</span></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                            <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                            <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                            </li>
                            <li><a href="mail-trash"><i class="fa fa-trash-o"></i> Trash</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->

                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Compose New Message</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <input class="form-control" placeholder="To:" value="<?php if(isset($_GET['for-id'])){echo'';}elseif(isset($_GET['rep-id'])){messageData('email');}?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Subject:" value="<?php if(isset($_GET['for-id'])){messageData('subject');}elseif(isset($_GET['rep-id'])){ messageData('rep-subject');}?>">
                        </div>
                        <div class="form-group">
                            <ul class="wysihtml5-toolbar"><li class="dropdown">
                                    <a class="btn btn-default dropdown-toggle " data-toggle="dropdown">

                                        <span class="glyphicon glyphicon-font"></span>

                                        <span class="current-font">Normal text</span>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p" tabindex="-1" href="javascript:;" unselectable="on">Normal text</a></li>
                                        <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" tabindex="-1" href="javascript:;" unselectable="on">Heading 1</a></li>
                                        <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" tabindex="-1" href="javascript:;" unselectable="on">Heading 2</a></li>
                                        <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" tabindex="-1" href="javascript:;" unselectable="on">Heading 3</a></li>
                                        <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" tabindex="-1" href="javascript:;" unselectable="on">Heading 4</a></li>
                                        <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h5" tabindex="-1" href="javascript:;" unselectable="on">Heading 5</a></li>
                                        <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h6" tabindex="-1" href="javascript:;" unselectable="on">Heading 6</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="btn-group">
                                        <a class="btn  btn-default" data-wysihtml5-command="bold" title="CTRL+B" tabindex="-1" href="javascript:;" unselectable="on">Bold</a>
                                        <a class="btn  btn-default" data-wysihtml5-command="italic" title="CTRL+I" tabindex="-1" href="javascript:;" unselectable="on">Italic</a>
                                        <a class="btn  btn-default" data-wysihtml5-command="underline" title="CTRL+U" tabindex="-1" href="javascript:;" unselectable="on">Underline</a>

                                        <a class="btn  btn-default" data-wysihtml5-command="small" title="CTRL+S" tabindex="-1" href="javascript:;" unselectable="on">Small</a>

                                    </div>
                                </li>
                                <li>
                                    <a class="btn  btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="blockquote" data-wysihtml5-display-format-name="false" tabindex="-1" href="javascript:;" unselectable="on">

                                        <span class="glyphicon glyphicon-quote"></span>

                                    </a>
                                </li>
                                <li>
                                    <div class="btn-group">
                                        <a class="btn  btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered list" tabindex="-1" href="javascript:;" unselectable="on">

                                            <span class="glyphicon glyphicon-list"></span>

                                        </a>
                                        <a class="btn  btn-default" data-wysihtml5-command="insertOrderedList" title="Ordered list" tabindex="-1" href="javascript:;" unselectable="on">

                                            <span class="glyphicon glyphicon-th-list"></span>

                                        </a>
                                        <a class="btn  btn-default" data-wysihtml5-command="Outdent" title="Outdent" tabindex="-1" href="javascript:;" unselectable="on">

                                            <span class="glyphicon glyphicon-indent-right"></span>

                                        </a>
                                        <a class="btn  btn-default" data-wysihtml5-command="Indent" title="Indent" tabindex="-1" href="javascript:;" unselectable="on">

                                            <span class="glyphicon glyphicon-indent-left"></span>

                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="bootstrap-wysihtml5-insert-link-modal modal fade" data-wysihtml5-dialog="createLink">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <a class="close" data-dismiss="modal">×</a>
                                                    <h3>Insert link</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input value="http://" class="bootstrap-wysihtml5-insert-link-url form-control" data-wysihtml5-dialog-field="href">
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="bootstrap-wysihtml5-insert-link-target" checked="">Open link in new window
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-default" data-dismiss="modal" data-wysihtml5-dialog-action="cancel" href="#">Cancel</a>
                                                    <a href="#" class="btn btn-primary" data-dismiss="modal" data-wysihtml5-dialog-action="save">Insert link</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn  btn-default" data-wysihtml5-command="createLink" title="Insert link" tabindex="-1" href="javascript:;" unselectable="on">

                                        <span class="glyphicon glyphicon-share"></span>

                                    </a>
                                </li>
                                <li>
                                    <div class="bootstrap-wysihtml5-insert-image-modal modal fade" data-wysihtml5-dialog="insertImage">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <a class="close" data-dismiss="modal">×</a>
                                                    <h3>Insert image</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input value="http://" class="bootstrap-wysihtml5-insert-image-url form-control" data-wysihtml5-dialog-field="src">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-default" data-dismiss="modal" data-wysihtml5-dialog-action="cancel" href="#">Cancel</a>
                                                    <a class="btn btn-primary" data-dismiss="modal" data-wysihtml5-dialog-action="save" href="#">Insert image</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn  btn-default" data-wysihtml5-command="insertImage" title="Insert image" tabindex="-1" href="javascript:;" unselectable="on">

                                        <span class="glyphicon glyphicon-picture"></span>

                                    </a>
                                </li>
                            </ul>
                    <textarea id="compose-textarea" class="form-control" style="height: 300px">
                            <?php if(isset($_GET['for-id'])){messageData('message');}elseif(isset($_GET['rep-id'])){echo'';} ?>
                    </textarea>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Attachment
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">Max. 32MB</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                        </div>
                        <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
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
get_footer();
?>

