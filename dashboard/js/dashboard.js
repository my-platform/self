$(document).ready(function () {
      var url  = window.location.pathname,
          UrlRegExp = new RegExp(url == '/' ? window.location.origin + '/?$' : url.replace(/\/$/,''));
   // alert(url +"   "+UrlRegExp);
    //the next if statement its another way to do that as well
    if(url == '/dashboard/pages/mail-trash.php'){
        $('.messages').addClass('active');
    }else if(url == '/dashboard/pages/read-mail.php'){
        $('.messages').addClass('active');
    }
    $('.sidebar-menu li a').each(function () {
        if(UrlRegExp.test(this.href.replace(/\/$/, ''))){
            $(this).parent().addClass('active');
            if(url == '/dashboard/pages/mail-trash.php'){
                $('.messages').addClass('active');
            }
        }
    });
    function move_dive(){
        var box_width = $('#box-size').width();
       // var window_width = $(window).width();
        var window_current =$(window).width(); //1366
        var percentage =  ((window_current/1366)*100);
        $('#size-feed').html(percentage);
        if(percentage < 55 && percentage > 39){
            $('.fire-icon').css('font-size', (box_width * (30/100)));
        }else if(percentage < 71.37 && percentage > 55) {
            $('.fire-icon').css('font-size', (box_width * (25 / 100)));
        }else if( percentage < 39){
            $('.fire-icon').css('font-size', (box_width * (30 / 100)));

        }else if(percentage > 71.37){
            $('.fire-icon').css('font-size', (box_width * (11 / 100)));

        }
    }
    move_dive();
    //alert(box_width);
    $(window).resize(function () {
        move_dive();
    });
   // }
      //function active_links(){
    /* if($('.sidebar-menu li').hasClass('active')){
     $('.sidebar-menu li').removeClass('active');

     }
     }*/
     // active_links();

   // active_links();
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: 'table'},
        success: function (response) {
          //  table_control(response);
        }
    });
  // table_control();
    $('.table_remove').click(function(){
        //alert('بسم الله');
        var id_val = $(this).text();
        var F_name = $(this).children('#fname').text();
        //  alert(F_name);
        $('#message').text('Are you sure you wanna delete "' + F_name + '\'s" account?');
        $('.confirm-msg').slideDown();
        var needed_top = $(window).height()/2;
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
                success: function(){
                    //alert('well');
                }

            }).abort(function () {
                id_val = null;
            }).fail(function () {
                id_val = null;
            }).success(function () {
                // alert('well');
            });
            $('.confirm-msg').slideUp(function(){
                var n_top = $(window).height()/2;
                $('#notify-msg').css('top', n_top);
                var c_top = parseInt($('#notify-msg').css('top'));
                $(window).scroll(function () {
                    var top = $(window).scrollTop();
                    $('#notify-msg').css('top', top + c_top);
                });
                $('#notify_message').text( F_name+'\'s account has been deleted.');
                $('#notify-msg').fadeIn();
                setInterval(function () {
                    window.location='users.php';
                },2000);
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
                        table_control(response);

                    }

                });
            });


        }
    });
    ///////////////////////////////////////////////////////visitors///////////////////////////////////////////////////////////
    ////////////24 visitors table////////////
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: '24pages'},
        success: function (data) {
            //  alert(data);
            $('.page_number24').html(data);
            
            $('.pag24').click(function () {

                // alert(data)
                var p_number = $(this).text();
                $.ajax({
                    type: 'POST',
                    url: '../includes/pages.php',
                    //  dataType: 'text',
                    data: {val24: p_number},
                    success: function (response) {
                        $('.Table24').html(response);
                       // alert(response);

                    }

                });
            });
            //alert(data);


        }
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: 'last24_t'},
        success: function (response) {
            $('.Table24').html(response);
        }
    });

    ////////////Week visitors pagination////////////
    


    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: 'last_week_t'},
        success: function (response) {
            $('.Table_week').html(response);
            $.ajax({
                type: 'POST',
                url: '../includes/pages.php',
                data: {key: 'pages_week'},
                success: function (data) {
                    //  alert(data);
                    $('.page_number_week').html(data);
                    //  $('.pag_week').addClass('ul-block');
                    $('.pag_week').click(function(){
                        var p_number = $(this).text();
                        $.get('../includes/pages.php', {'pg_number=': + p_number}, function (response) {
                            //alert(response);
                        });
                        $.ajax({
                            type: 'POST',
                            url: '../includes/pages.php',
                            //  dataType: 'text',
                            data: {val_week: p_number},
                            success: function (response) {
                                $('.Table_week').html(response);
                               // $.post('includes/pages.php', 'pg_number=' + p_number, function (response) {

                                         $.get('../includes/pages.php', {'pg_number=': + p_number}, function (response) {
                                        //alert(response);
                                         });
                                        //  $(this).addClass('ul-block');
                                    }


                        });
                    });
                    $('.pag_week').mouse(function () {
                        // $(this).removeClass('ul-block');
                    });
                }
            });
        }
    });
    $('.pag_week').click(function(){
        var p_number = $(this).text();

        $.ajax({
            type: 'POST',
            url: '../includes/pages.php',
            //  dataType: 'text',
            data: {pg_week: p_number},
            success: function (response) {
                //$('.Table_week').html(response);
                // $.post('includes/pages.php', 'pg_number=' + p_number, function (response) {
                // alert(response);
                // });
                //  $(this).addClass('ul-block');
            }
        });
    });

    setInterval(function () {

////////////////////////////////// visitors ///////////////////////////////////////
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            data: {key: 'get_users'},
            success: function (data) {
                $('#visitor_win').html(data);
               // $('#visitor_win1').html(data);
            }
        });
        //last 24 hours
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            data: {key: 'last24'},
            success: function (data) {
                $('#last24').html(data);
               // $('#last241').html(data);
            }
        });
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            data: {key: 'this_week'},
            success: function (data) {
                $('#this_week').html(data);
               // $('#this_week1').html(data);
            }
        });
        // Max Visit
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            data: {key: 'MaxVisit'},
            success: function (data) {
                $('#max_visit').html(data);
                //$('#max_visit1').html(data);
                //alert(data);
            }
        });
        // Last month
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            data: {key: 'last_month'},
            success: function (data) {
                $('#month_visit').html(data);
                //$('#max_visit1').html(data);
                //alert(data);
            }
        }); // unique_visitors
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            data: {key: 'unique_visitors'},
            success: function (data) {
                $('#unique_visit').html(data);
                //$('#max_visit1').html(data);
                //alert(data);
            }
        });
        ///////////// users ////////////////
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            data: {key: 'this_month'},
            success: function (data) {
                $('#this_month').html(data);
                //  alert(data1);
            }
        });
        $.ajax({
            type: 'POST',
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
            data: {key: 'last_year'},
            success: function (data) {
                $('#last_year').html(data);
                //  alert(data1);
            }
        });
        $.ajax({
            type: 'POST',
            url: '../includes/get_users.php',
            data: {key: 'all_users'},
            success: function (data) {
                $('#all_users').html(data);
                //  alert(data1);
            }
        });
        $.ajax({
            type: 'POST',
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
        ////////////////////////////////////////////////////////////get browsers //////////////////////////////////////
        $.ajax({
            type: 'POST',
            url: '../includes/pages.php',
            data: {key: 'chrome'},
            success: function (data) {
                $('#chrome').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            url: '../includes/pages.php',
            data: {key: 'firefox'},
            success: function (data) {
                $('#firefox').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            url: '../includes/pages.php',
            data: {key: 'safari'},
            success: function (data) {
                $('#safari').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            url: '../includes/pages.php',
            data: {key: 'opera'},
            success: function (data) {
                $('#opera').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            url: '../includes/pages.php',
            data: {key: 'ie'},
            success: function (data) {
                $('#ie').html(data + '%');
            }
        });

    }, 1000);
    ///////////////////////////////online users////////////////////////////////
    setInterval(function(){
        $.ajax({
            type: 'POST',
            url: '../includes/users_action.php',
            data: {key: 'user_online'},
            success: function (data) {
                // $('#ie').html(data + '%');
                // alert(data);
                $('#online-users').html(data);
            }
        });
    },1000);

    //////////////////////////////////////////////////////////get browsers //////////////////////////////////////
    setInterval(function () {
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: 'chrome'},
        success: function (data) {
            $('#chrome').html(data+ '%');
        }
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: 'firefox'},
        success: function (data) {
            $('#firefox').html(data+ '%');
        }
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: 'safari'},
        success: function (data) {
            $('#safari').html(data+ '%');
        }
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: 'opera'},
        success: function (data) {
            $('#opera').html(data+ '%');
        }
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {key: 'ie'},
        success: function (data) {
            $('#ie').html(data + '%');
        }
    });
    },1000);

    /////////////////////////////////////////////////////////get platforms (OS) //////////////////////////////////////
    setInterval(function () {
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {os_key: 'windows'},
        success: function (data) {
            $('#windows').html(data+ '%');
        }
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {os_key: 'mac'},
        success: function (data) {
            $('#mac').html(data+ '%');
        }
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {os_key: 'android'},
        success: function (data) {
            $('#android').html(data+ '%');
        }
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {os_key: 'linux'},
        success: function (data) {
            $('#linux').html(data+ '%');
            //alert('');
        }
    });
    $.ajax({
        type: 'POST',
        url: '../includes/pages.php',
        data: {os_key: 'others'},
        success: function (data) {
            $('#others').html(data + '%');
        }
    });
    },1000);
   
});







