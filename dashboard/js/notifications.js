$(document).ready(function () {
    //*************************** notifications **************************//
    /////////////// send ///////////////////////
    //$('.msg-label').css('display','inline-block');

    $('#send').click(function(){
        var f_name = $('#user_first_name').val();
        var l_name = $('#user_last_name').val();
        var email = $('#user_email').val();
        var title = $('#user_title').val();
        var message = $('#user_message').val();
       // alert(f_name  + l_name + email + title+ message);
        $.post('../includes/messages.php',{first_name:f_name, last_name:l_name,
            email:email, title: title, message: message}, function (response) {
           //  alert(response);
            $.ajax({
                type: 'POST',
                url: '../includes/messages.php',
                data: {key: 'msg-notification_menu'},
                success: function (data) {
                    // alert(data);
                    //$('.msg-label').html(data);

                        $('.dropdown-messages').html(data);
                }});
            show_notification();
            $('.sql-error').html(response);
        });
    });
    setInterval(function () {
        $.ajax({
            type: 'POST',
            url: '../includes/messages.php',
            data: {key: 'msg-notification_menu'},
            success: function (data) {
               // alert(data);
                //$('.msg-label').html(data);

                    $('.dropdown-messages').html(data);

            }});
    },1000);


    $('.test-notify-msg').click(function(){
        //alert('works');
        var tes  = parseInt(1);
        $.post('../includes/notifications.php',{initiate: tes}, function (response) {
            //alert(response);
             $('.msg-label').fadeIn();
             $('.msg-label').html(response);
            // alert(response);
            //  $('.notify-message_menu').load(location.href +'.notify-message_menu>*', '');
            // $('.msg-not-num').html(response);
            // $('.msg-not-num').html(response);
            //var  num = response;
            // alert(response);
            //alert(parseInt(num + tes));
            //alert(parseInt(num + tes));
            //$('.msg-not-num').html(parseInt(num));
        });
    });

    /////////////// show messages /////////////
    $.ajax({
        type: 'POST',
        url: '../includes/notifications.php',
        data: {key: 'msg_show'},
        success: function (data) {
        //    msg_controll(data)

        }});
    ///////////// drop down messages //////////////
    $('.msg-dropdown-menu').click(function () {

        $.ajax({
            type: 'POST',
            url: '../includes/notifications.php',
            data: {key: 'unset_session'},
            success: function (data) {
                //$('.msg-not-num').fadeOut();
                $('.msg-label').css('display', 'none');
                // alert(data);
                // $('.msg-not-num').html(data);

            }});
        $.ajax({
            type: 'POST',
            url: '../includes/messages.php',
            data: {update_menu: 'update_menu'},
            success: function (data) {
                //$('.msg-not-num').fadeOut();
                // $('.msg-label').css('display', 'none');
                // alert(data);
                // $('.msg-not-num').html(data);
            }
        });
    });
    function show_notification(){
        $.ajax({
            type: 'POST',
            url: '../includes/notifications.php',
            data: {key: 'msg-notification'},
            success: function (data) {
              //  $('.label-value').css('display', 'inline-block');
//alert();                $('.msg-label').html(data);
                $('.msg-label').html(data);
                //  $('.msg-label').html(data);
               var val = $('.msg-label').html();
               // alert(val);
                if($.trim(val) == 0){
                    $('.msg-label').css('display', 'none');
                }else{
                    $('.msg-label').css('display', 'inline-block');

                }
               // alert('works');
                //$('.badge').css('display', 'inline-block');
                //  alert(data)*/
            }});
    }
setInterval(function () {
    show_notification();
},1000);


});