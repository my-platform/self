$(document).ready(function(){
    //alert($('.ind-sec1').width());
    //$('.description').hide();
    $('.div-animation').fadeTo(1300,1);
    var d = new Date();
    var year = d.getFullYear();
    $('.current_year').html(year);

//////////////////////////////////fade////////////////////////////////////////////
    AOS.init({
        easing: 'ease-in-out-sine'
    });
});

