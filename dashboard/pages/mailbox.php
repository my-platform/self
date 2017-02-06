<?php
require_once '../functions/functions.php';
include '../includes/database_inc.php';

if(!logged_in()) {
    header('Location: ../pages/login.php');
}
get_header();
get_sidebar();
get_bread();
save_visitors();
if (!@mysql_select_db('dashboard')) {
    echo 'The table doesn\'t exist .';
} else {

    function pagination($table, $index, $page_id){
        $start = 0;
        $limit = 13;


        if (isset($_GET[$index])) {
            $new_st = $_GET[$index];
            $new_end = $new_st + 7;
            $backward_st = $new_st;
            $backward_en = $new_st - 7;
        } else {
            $new_st = 1;
            $new_end = 8;
        }
        if (isset($_GET[$page_id])) {
            $id = $_GET[$page_id];
            $start = ($id - 1) * $limit;
        } else {
            $id = 1;
        }
        echo '<ul class=" pagination">';
        $sql1 = "SELECT COUNT(`firstname`) FROM `" . $table . "`  WHERE `trash`=0";
       if($rs_result1 = mysql_query($sql1)) {
           $row1 = mysql_fetch_row($rs_result1);
           $count = $row1[0];
           $records_per_page = $limit;
           //$page =
           $total_pages = ceil($count / $records_per_page);

           if ($id > 8) {
               //Go to previous page to show previous 10 items. If its in page 1 then it is inactive
               echo "<li class='previous_link'><a href='?" . $index . "=" . ($backward_en - 1) . "&" . $page_id . "=" . ($backward_en - 1) . "#" . $table . "' class='button'>PREVIOUS</a></li>";
           }

           //show all the page link with page number. When click on these numbers go to particular page.
           //echo '<ul class="pagination">';

           for ($i = $new_st; $i <= $new_end && $i <= $total_pages; $i++) {
               if ($i == $id) {
                   echo "<li class='active'><a>" . $i . "</a></li>";
               } else {
                   echo "<li><a class='button_num' href='?" . $index . "=" . $new_st . "&" . $page_id . "=" . $i . "#" . $table . "'>" . $i . "</a></li>";
               }
           }


           if ($new_end < $total_pages) {
               ////Go to previous page to show next 10 items.
               echo "<li class='disable_link'><a href='?" . $index . "=" . ($new_end + 1) . "&" . $page_id . "=" . ($new_end + 1) . "#" . $table . "'  class='Next_link'>NEXT</a></li>";
               //echo 'this is '. $id;
           }
           echo ' </ul>';
           // echo '</div>';
       }
    }


    function table($table, $page_id)
    {
        $start = 0;
        $limit = 13;
        if (isset($_GET[$page_id])) {
            $id = $_GET[$page_id];
            $start = ($id - 1) * $limit;
        } else {
            $id = 1;
        }


        $sql = "SELECT * FROM `" . $table . "` WHERE `trash`=0 ORDER BY `id` DESC LIMIT $start, $limit";


        //print 10 items
        if ($query_run = mysql_query($sql)) {

            while ($row = mysql_fetch_array($query_run)) {
                $id = $row['id'];
                $first = $row['firstname'];
                $last = $row['lastname'];
                $email = $row['email'];
                $title = $row['title'];
                $message = $row['message'];
                $date = $row['date'];
                $time_o = new DateTime($date);
                $time = $time_o->format('h:i a');
                $day_o = $time_o->format('M d, Y');
                // $current_day =date('M d, Y');
               
                if ($day_o === date('M d, Y')) {
                    $day = 'Today';
                } elseif ($day_o === date('M d, Y', strtotime("-1 day"))) {
                    $day = 'Yesterday';
                }elseif ($day_o === date('M d, Y', strtotime("-2 day"))) {
                    $day = '2 days ago';
                }elseif ($day_o === date('M d, Y', strtotime("-3 day"))) {
                    $day = '3 days ago';
                }elseif ($day_o === date('M d, Y', strtotime("-4 day"))) {
                    $day = '4 days ago';
                }elseif ($day_o === date('M d, Y', strtotime("-5 day"))) {
                    $day = '5 days ago';
                }else {
                    $day = $day_o;
                }


                $text_length = strlen($title);
                $short_title = '';
                if ($text_length > 35) {
                    $missed_text = $text_length - 35;
                    $short_title .= substr_replace($title, '...', 35, $missed_text);
                } else {
                    $short_title .= $title;
                }
                ?>

                <?php
                echo "<tr>"
                    .'<td><label class="lbl"><input type="checkbox" class="target-check" value="'.$id.'">
                    <span class="sp fa"></span></label></td>'
                    . '<td class="mailbox-star sta"><a class="star-check" href="#"><i class="fa fa-star-o text-yellow"></i></a></td>' .
                    "<td class='mailbox-name'><a href='read-mail.php?msg-id=".$id."' class='name_click'>".$first."&nbsp;".$last."</a></td>";
                echo '<td class="mailbox-subject"><b>'.$short_title.'</b> </td>';
                echo ' <td class="mailbox-attachment"></td>';
                echo ' <td class="mailbox-date">'.$day.'</td>';
                echo "</tr>";
                //echo "</tr>";

            }

        } else {
           // mysql_error($query_run);
            echo'<div class="text-center">';
            echo '<p class="italic"><b>There\'s no messages</b></p>';
            echo'<i class="fa fa-envelope-o large-icon"></i>';
            echo '</div>';
        }
        //echo '<div class="">';


    }

    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-default btn-lg test-notify-msg"><i class="fa fa-envelope-o"></i>
                </button>
                <a href="compose.php" class="btn btn-primary btn-block margin-bottom">Compose</a>

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
                            <li class="active" id="inbox-link"><a href="mailbox.php"><i class="fa fa-inbox"></i> Inbox
                                    <span class="label label-primary pull-right">12</span></a></li>
                            <li id="sent-link"><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                            <li id="drafts-link"><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                            <li id="junk-link"><a href="#"><i class="fa fa-filter"></i> Junk <span
                                        class="label label-warning pull-right">65</span></a>
                            </li>
                            <li id="trash-link"><a id="mail-trash" href="mail-trash.php"><i class="fa fa-trash-o"></i> Trash</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
          <!--  <p id="paragraph2">There you go:</p>-->
            <div id="notify-msg2"><p id="notify_message2"></p>
                <p>please wait ...</p>
            </div>
            <div class="col-md-9">
                <div class="box box-primary" id="messages">
                    <div class="box-header with-border">
                        <h3 class="box-title">Inbox</h3>

                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">

                        <div class="mailbox-controls toggle-div">

                           <!-- <button type="button" id="toggle-check" class="btn btn-default btn-sm "><i
                                    class="fa fa-square-o"></i>
                            </button>-->
                            <div class="row">
                            <div class="col-md-1 col-sm-6">
                                <label class="lbl-toggle"><input type="checkbox" class="toggle-check" >
                                    <i class="sp fa fa-square-o"></i></label>
                            </div>
                            <div class="btn-group col-md-11 col-sm-6">

                                <button type="button" data-toggle="modal" data-target="#popUpWindow" class="btn btn-default btn-sm delete-to-trash"><i class="fa fa-trash-o"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i>
                                </button>
                            </div>
                            </div>
                            <!-- /.btn-group -->

                        </div>
                        <div class="modal fade" id="popUpWindow">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><span class="fa fa-warning"></span> <b>confirmation message</b></h4>
                                    </div>
                                    <div class="modal-body">

                                        <div role="form">
                                            <div class="form-group">
                                            </div>
                                            <div class="form-group">
                                                <b>The selected message/messages is going to trash, are you sure you wanna do that?</b>
                                            </div>
                                            <div class="form-group">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="cancel-delete" class="btn btn-primary btn-md" data-dismiss="modal">No</button>
                                        <button  id="delete-message" class="btn btn-primary btn-md" data-dismiss="modal">Yes</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="table-responsive mailbox-messages mailbox-msg">
                            <table class="table table-hover table-striped">
                                <tbody>
                                <?php
                                table('messages', 'p_id');
                                ?>
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <div class="box-footer no-padding ">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <div class="row .toggle-div">
                                <div class="col-md-1 col-sm-6">
                                    <label class="lbl-toggle"><input type="checkbox" class="toggle-check" >
                                        <i class="sp fa fa-square-o"></i></label>
                                </div>
                                <div class="btn-group col-md-11 col-sm-6">

                                    <button type="button" data-toggle="modal" data-target="#popUpWindow" class="btn btn-default btn-sm delete-to-trash"><i class="fa fa-trash-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.pull-right -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class= "box-footer no-padding">
                        <div class="mailbox-controls">
                            <div class="text-center ">

                                <?php
                                pagination('messages', 'm_index', 'p_id')
                                ?>
                            </div>
                            <!-- /.pull-right -->
                        </div>
                    </div>
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

