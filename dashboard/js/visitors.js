
$(document).ready(function() {
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
                    $('.pag_week').click(function () {
                        var p_number = $(this).text();
                        $.get('../includes/pages.php', {'pg_number=': +p_number}, function (response) {
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

                                $.get('../includes/pages.php', {'pg_number=': +p_number}, function (response) {
                                    //alert(response);
                                });
                                //  $(this).addClass('ul-block');
                            }


                        });
                    });

                }
            });
        }
    });
    $('.pag_week').click(function () {
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
            timeout: 9999,
            async: true,
            cache: false,
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
            timeout: 9999,
            async: true,
            cache: false,
            url: '../includes/get_users.php',
            data: {key: 'last24'},
            success: function (data) {
                $('#last24').html(data);
                // $('#last241').html(data);
            }
        });
        $.ajax({
            type: 'POST',
            timeout: 9999,
            async: true,
            cache: false,
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
            timeout: 9999,
            async: true,
            cache: false,
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
            timeout: 9999,
            async: true,
            cache: false,
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
            timeout: 9999,
            async: true,
            cache: false,
            url: '../includes/get_users.php',
            data: {key: 'unique_visitors'},
            success: function (data) {
                $('#unique_visit').html(data);
                //$('#max_visit1').html(data);
                //alert(data);
            }
        });
    }, 1000);
});