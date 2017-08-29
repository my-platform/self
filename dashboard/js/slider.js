$(document).ready(function () {
    ////////////////////////////slider////////////////////////
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
    ////////////////////////////// slider end //////////////////////
   
   
});







