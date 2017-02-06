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


?>
<input type="text" id="feedback"/>
<b id="paragraph"> My favorite food is: </b>
<div class="toggle-div">
<p><label id="lbl"><input type="checkbox" id="toggle-check">
        <span class="sp fa "></span></label> Toggle </p>
</div>
<div class="mailbox-msg" xmlns="http://www.w3.org/1999/html">

    <p><label id="lbl"><input type="checkbox" id="target-check" value="fish"><span  class="sp fa"></span></label>fish</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="pizza"><span class="sp fa"></span></label>pizza</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="coffee"><span class="sp fa"></span></label>coffee</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="cheese"><span class="sp fa"></span></label>cheese</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="fish"><span class="sp fa"></span></label>fish</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="pizza"><span class="sp fa"></span></label>pizza</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="coffee"><span class="sp fa"></span></label>coffee</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="cheese"><span class="sp fa"></span></label>cheese</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="fish"><span class="sp fa"></span></label>fish</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="pizza"><span class="sp fa"></span></label>pizza</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="coffee"><span class="sp fa"></span></label>coffee</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="cheese"><span class="sp fa"></span></label>cheese</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="fish"><span class="sp fa"></span></label>fish</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="pizza"><span class="sp fa"></span></label>pizza</p>
    <p><label id="lbl"><input type="checkbox" id="target-check" value="coffee"><span class="sp fa"></span></label>coffee</p>
    <!-- /.table -->
</div>

<?php
get_footer();
?>
