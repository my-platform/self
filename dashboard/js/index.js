$(document).ready(function(){
    function move_div(){
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
    move_div();
    //alert(box_width);
    $(window).resize(function () {
        move_div();
    });
    // }
    //function active_links(){
    /* if($('.sidebar-menu li').hasClass('active')){
     $('.sidebar-menu li').removeClass('active');

     }
     }*/
    // active_links();

    // active_links();
    /* $.ajax({
         type: 'POST',
         url: '../includes/pages.php',
         data: {key: 'table'},
         success: function (response) {
           //  table_control(response);
         }
     });*/

    /////////////////////////////// Main Page////////////////////////////////
    setInterval(function(){
        ///////////////////online users////////////////
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/users_action.php',
            data: {key: 'user_online'},
            success: function (data) {
                // $('#ie').html(data + '%');
                // alert(data);
                $('#online-users').html(data);
            }
        });
        ///////////////////traffic Now////////////////

        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/get_users.php',
            data: {key: 'get_users'},
            success: function (data) {
                $('#visitor_win').html(data);
                // $('#visitor_win1').html(data);
            }
        });
        ///////////////////all users////////////////

        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/get_users.php',
            data: {key: 'all_users'},
            success: function (data) {
                $('#all_users').html(data);
                //  alert(data1);
            }
        });
        ///////////////////all visits////////////////

        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/get_users.php',
            data: {key: 'MaxVisit'},
            success: function (data) {
                $('#max_visit').html(data);
                //$('#max_visit1').html(data);
                //alert(data);
            }
        });

    },1000);

    //////////////////////////////////////////////////////////get browsers //////////////////////////////////////
    setInterval(function () {
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/pages.php',
            data: {key: 'chrome'},
            success: function (data) {
                $('#chrome').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/pages.php',
            data: {key: 'firefox'},
            success: function (data) {
                $('#firefox').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/pages.php',
            data: {key: 'safari'},
            success: function (data) {
                $('#safari').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/pages.php',
            data: {key: 'opera'},
            success: function (data) {
                $('#opera').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
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
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/pages.php',
            data: {os_key: 'windows'},
            success: function (data) {
                $('#windows').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/pages.php',
            data: {os_key: 'mac'},
            success: function (data) {
                $('#mac').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/pages.php',
            data: {os_key: 'android'},
            success: function (data) {
                $('#android').html(data+ '%');
            }
        });
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/pages.php',
            data: {os_key: 'linux'},
            success: function (data) {
                $('#linux').html(data+ '%');
                //alert('');
            }
        });
        $.ajax({
            type: 'POST',
            timeout:9999,
            async:true,
            cache:false,
            url: '../includes/pages.php',
            data: {os_key: 'others'},
            success: function (data) {
                $('#others').html(data + '%');
            }
        });
    },1000);
});