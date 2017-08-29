$(document).ready(function() {
    // table_control();
    $('.table_remove').click(function () {
        //alert('بسم الله');
        var id_val = $(this).text();
        var F_name = $(this).children('#fname').text();
        //  alert(F_name);
        $('#message').text('Are you sure you wanna delete "' + F_name + '\'s" account?');
        $('.confirm-msg').slideDown();
        var needed_top = $(window).height() / 2;
        // alert(needed_top);
        $('.confirm-msg').css('top', needed_top);

        //  var current_bottom = parseInt($('.confirm-msg').css('bottom'));
        $('.confirm-msg').slideDown();
        var current_top = parseInt($('.confirm-msg').css('top'));
        $(window).scroll(function () {
            var Stop = $(window).scrollTop();

            // var bottom = $(window).scrollTop() + $(window).height();
            $('.confirm-msg').css('top', Stop + current_top);
            //  $('.confirm-msg').css('bottom',  bottom + current_bottom);
        });
        $('#delete').click(function () {

            $.ajax({
                type: 'POST',
                url: '../includes/delete.php',
                //  dataType: 'text',
                data: {key: id_val},
                success: function () {
                    //alert('well');
                }

            }).abort(function () {
                id_val = null;
            }).fail(function () {
                id_val = null;
            }).success(function () {
                // alert('well');
            });
            $('.confirm-msg').slideUp(function () {
                var n_top = $(window).height() / 2;
                $('#notify-msg').css('top', n_top);
                var c_top = parseInt($('#notify-msg').css('top'));
                $(window).scroll(function () {
                    var top = $(window).scrollTop();
                    $('#notify-msg').css('top', top + c_top);
                });
                $('#notify_message').text(F_name + '\'s account has been deleted.');
                $('#notify-msg').fadeIn();
                setInterval(function () {
                    window.location = 'users.php';
                }, 2000);
            });

        });
        $('#cancel').click(function () {
            id_val = null;
            F_name = null;
            $('.confirm-msg').slideUp();
            //  window.location = "index.php";
        });
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: 'pages'},
        success: function (data) {
            //  alert(data);
            $('.page_number').html(data);
            /* $.get('includes/pages.php', 'val=' + p_number, function (response) {
             alert(response);
             });*/
            $('.pag').click(function () {

                // alert(data)
                var p_number = $(this).text();
                $.ajax({
                    type: 'POST',
                    url: '../includes/pages.php',
                    //  dataType: 'text',
                    data: {val: p_number},
                    success: function (response) {
                        //  table_control(response);

                    }

                });
            });


        }
    });
    setInterval(function () {
        ///////////// users ////////////////
        $.ajax({
            type: 'POST',
            timeout: 9999,
            async: true,
            cache: false,
            url: '../includes/get_users.php',
            data: {key: 'this_month'},
            success: function (data) {
                $('#this_month').html(data);
                //  alert(data1);
            }
        });
        $.ajax({
            type: 'POST',
            timeout: 9999,
            async: true,
            cache: false,
            url: '../includes/get_users.php',
            data: {key: 'last_week'},
            success: function (data) {
                $('#last_week').html(data);
                //  alert(data1);
            }
        });
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            timeout: 9999,
            async: true,
            cache: false,
            data: {key: 'last_year'},
            success: function (data) {
                $('#last_year').html(data);
                //  alert(data1);
            }
        });
        $.ajax({
            type: 'POST',
            timeout: 9999,
            async: true,
            cache: false,
            url: '../includes/get_users.php',
            data: {key: 'all_users'},
            success: function (data) {
                $('#all_users').html(data);
                //  alert(data1);
            }
        });
        $.ajax({
            type: 'POST',
            timeout: 9999,
            async: true,
            cache: false,
            url: '../includes/get_users.php',
            data: {key: 'male_members'},
            success: function (data) {
                $('#male_members').html(data);
                //   alert(data);
            }
        });
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            data: {key: 'female_members'},
            success: function (data) {
                $('#female_members').html(data);
                //  alert(data1);
            }
        });
    }, 1000);
});