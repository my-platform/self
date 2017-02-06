$(document).ready(function(){
  /*  function active_links(){
        if($('.mail-links li').hasClass('active')){
            $('.mail-links li').removeClass('active');
        }
    }
   // active_links();
    $('.mail-links a').click(function () {
       // $(this).parent().addClass('active');
       active_links();
        $(this).parent().addClass('active');

    });*/


    //***************************************** main mail page **************************************************//
    $('.delete-to-trash').attr('disabled', true);
                         ///////////////////delete message to trash////////////////////
        $('#delete-message').click(function () {
            var value = [];
            var list = '';
            $('.mailbox-msg input:checked').each(function () {
                var val =$(this).attr('value') ; // another variable to get the value and push it later in the array
                value.push(val);  // store values in an array
            });
            for(var i = 0; i< value.length; i++){
                list += (" `id`='"+ value[i] +"' OR ");
            }
            $.ajax({
                type: 'POST',
                url: '../includes/messages.php',
                data: {delete_key: list},
                success: function () {
               // alert(data);
                    //msg_delete(list);
                  //  $('#paragraph2').text(data);
                    var n_top = $(window).height() / 2;
                    $('#notify-msg2').css('top', n_top);
                    var c_top = parseInt($('#notify-msg2').css('top'));
                    $(window).scroll(function () {
                        var top = $(window).scrollTop();
                        $('#notify-msg2').css('top', top + c_top);
                    });
                    $('#notify_message2').text('Selected message/messages have been deleted.');
                    $('#notify-msg2').fadeIn();
                    setInterval(function () {
                        window.location = 'mailbox.php';
                        $('#notify-msg2').fadeOut();
                    }, 2000);
                }
            });
        });
                        /////////////////delete message fully/////////////////
    $('#delete-from-trash').click(function () {
        var value = [];
        var list = '';
        $('.mailbox-msg input:checked').each(function () {
            var val =$(this).attr('value') ; // another variable to get the value and push it later in the array
            value.push(val);  // store values in an array
        });
        for(var i = 0; i< value.length; i++){
            list += (" `id`='"+ value[i] +"' OR ");
        }
        $.ajax({
            type: 'POST',
            url: '../includes/messages.php',
            data: {delete_fully: list},
            success: function () {
                //alert(data);
                //msg_delete(list);
                //  $('#paragraph2').text(data);
                var n_top = $(window).height() / 2;
                $('#notify-msg2').css('top', n_top);
                var c_top = parseInt($('#notify-msg2').css('top'));
                $(window).scroll(function () {
                    var top = $(window).scrollTop();
                    $('#notify-msg2').css('top', top + c_top);
                });
                $('#notify_message2').text('Selected message/messages have been deleted.');
                $('#notify-msg2').fadeIn();
                setInterval(function () {
                    window.location = 'mail-trash.php';
                    $('#notify-msg2').fadeOut();
                }, 2000);
            }
        });
    });
    $('#read-msg-delete').click(function () {
        var id = $(this).attr('value');
        var trash = $(this).attr('val');
        if(trash ==0) {
             $.ajax({
             type: 'POST',
             url: '../includes/messages.php',
             data: {delete_read: id},
             success: function (data) {
           //  alert(data);
             //msg_delete(list);
             //  $('#paragraph2').text(data);
             var n_top = $(window).height() / 2;
             $('#notify-msg3').css('top', n_top);
             var c_top = parseInt($('#notify-msg3').css('top'));
             $(window).scroll(function () {
             var top = $(window).scrollTop();
             $('#notify-msg3').css('top', top + c_top);
             });
             $('#notify_message3').text('This message have been deleted.');
             $('#notify-msg3').fadeIn();
             setInterval(function () {
             window.location = 'mailbox.php';
             $('#notify-msg3').fadeOut();
             }, 2000);
             }
             });
        }else if(trash == 1){
            $.ajax({
                type: 'POST',
                url: '../includes/messages.php',
                data: {delete_read_finally: id},
                success: function (data) {
                    //alert(data);
                    //msg_delete(list);
                    //  $('#paragraph2').text(data);
                    var n_top = $(window).height() / 2;
                    $('#notify-msg3').css('top', n_top);
                    var c_top = parseInt($('#notify-msg3').css('top'));
                    $(window).scroll(function () {
                        var top = $(window).scrollTop();
                        $('#notify-msg3').css('top', top + c_top);
                    });
                    $('#notify_message3').text('This message have been deleted.');
                    $('#notify-msg3').fadeIn();
                    setInterval(function () {
                        window.location = 'mail-trash.php';
                        $('#notify-msg3').fadeOut();
                    }, 2000);
                }
            });
        }
    });

    

                            //////////// checked\unchecked all lines //////////////////
    $('.toggle-check').change(function () {
        // check all /uncheck all
        $(".mailbox-msg input[type='checkbox']").prop('checked',$(this).prop('checked'));
        var checked = $(this).prop('checked');
        $('.toggle-check').click();
        if (checked) {
            $('.delete-to-trash').attr('disabled', false);
            $('.sp').addClass('fa-check');
        } else if(!checked){
            $('.delete-to-trash').attr('disabled', true);
            $('.sp').removeClass('fa-check');
        }

    });
                            ///////////////check separate\current  line //////////////
    $('.mailbox-msg .target-check').change(function () {
        // check individual
        var checked = $(this).prop('checked');
        var current = $(this).attr('value');
        var value = [];
        if (checked) {
            $(this).next().addClass('fa-check');
            $('.delete-to-trash').attr('disabled', false);
        }
        if(!checked) {
            $(this).next().removeClass('fa-check');
            $('.mailbox-msg input:checked').each(function () {
                var checked_elements = $(this).attr('value');
                value.push(checked_elements);
            });
            var index = value.indexOf(current);
            if (index > -1) {
                value.splice(index, 1);
            }
            if(value.length == 0){
                 $('.delete-to-trash').attr('disabled', true);
            }
        }

    });
                        ///////////// delete trash automatically in 15 days//////////
    setInterval(function () {
        $.ajax({
            type: 'POST',
            url: '../includes/messages.php',
            data: {expired_msg: 'delete-expired'},
            success: function (data) {
               // alert(data);
               // window.location = 'mail-trash.php';
            }

        });
       /* $.post('../includes/messages.php',{expired_key:'delete-expired'}, function (response) {
            alert('hello '+response);

        });*/
    },2000);
                        ///////////////////// Star check ///////////////////
    $('.star-check').click(function () {
        $(this).children().toggleClass('fa-star').toggleClass('fa-star-o');
    });
  

});

