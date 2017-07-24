$(document).ready(function () {
//$('.feedback').css('display', 'none');

        $('#send-message').click(function(){
            $('.feedback').fadeOut();
            var first = $('.first').children('#first').val();
            var last = $('.last').children('#last').val();
            var email = $('.email').children('#email').val();
            var title = $('.title_f').children('#title').val();
            var message = $('.message').children('#message').val();
           // alert(first + ' ' +last+' '+email+' '+title+' '+message);
            if(first === '' & last ==='' & email ==='' & title ==='' & message ===''){
                alert('please fill all fields');

            } else if(first !== '' || last !=='' || email !=='' || title !=='' || message !==''){
                 if(first === '' ){
                    $('.first').children('.feedback').fadeIn();

                    // alert('first');
                } if(last === ''){
                    $('.last').children('.feedback').fadeIn();

                }if(email === ''){
                    $('.email').children('.feedback').fadeIn();

                } if(title === ''){
                    $('.title_f').children('.feedback').fadeIn();
                }if(message === ''){
                    $('.message').children('.feedback').fadeIn();

                }
                if(first !== '' & last !=='' & email !=='' & title !=='' & message !==''){
                    //$('.message').attr('disabled', true);
                    $(this).addClass('submit_button').html('SENDING ...').delay(3000);
                  //  alert('works');
                    $.ajax({
                        type: 'POST',
                        url: 'dashboard/includes/messages.php',
                        //  dataType: 'text',
                        data: {first_name: first, last_name: last, email: email, title:title, message: message },
                        success: function (response) {
                            //$('.Table_week').html(response);
                            // $.post('includes/pages.php', 'pg_number=' + p_number, function (response) {
                            // alert(response);
                            alert( response);
                        }
                    });
                }
            }

        });

    $('.msg-input').keyup(function () {
        if($(this).val() !== 0) {
            $(this).next().fadeOut();
        }else{
            $(this).next().fadeIn();
        }
    });
});