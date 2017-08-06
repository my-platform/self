(function ($) {
    $(document).on('add.cards change.cards', function (event) {
        if (typeof $.fn.masonry !== 'undefined') {
            $(event.target).outerFind('.mbr-gallery').each(function () {
                var $msnr = $(this).find('.mbr-gallery-row').masonry({
                    itemSelector: '.mbr-gallery-item',
                    percentPosition: true
                });
                $msnr.masonry('reloadItems');
                $msnr.imagesLoaded().progress(function () {
                    $msnr.masonry('layout');
                });
            });
        }
    });
    var timeout;

    function fitLBtimeout() {
        clearTimeout(timeout);
        timeout = setTimeout(fitLightbox, 50);
    }

    function fitLightbox() {
        var $lightbox = $('.mbr-gallery .modal');
        if (!$lightbox.length) {
            return;
        }
        var bottomPadding = 30;
        var wndW = $(window).width();
        var wndH = $(window).height();
        $lightbox.each(function () {
            var setWidth, setTop;
            var isShown = $(this).hasClass('in');
            var $modalDialog = $(this).find('.modal-dialog');
            var $currentImg = $modalDialog.find('.item.active > img');
            if ($modalDialog.find('.item.prev > img, .item.next > img').length) {
                $currentImg = $modalDialog.find('.item.prev > img, .item.next > img').eq(0);
            }
            var lbW = $currentImg[0].naturalWidth;
            var lbH = $currentImg[0].naturalHeight;
            if (wndW / wndH > lbW / lbH) {
                var needH = wndH - bottomPadding * 2;
                setWidth = needH * lbW / lbH;
            }
            else {
                setWidth = wndW - bottomPadding * 2;
            }
            setWidth = setWidth >= lbW ? lbW : setWidth;
            setTop = (wndH - bottomPadding * 2 - setWidth * lbH / lbW) / 2;
            $modalDialog.css({width: parseInt(setWidth), top: setTop});
        });
    }

    $(window).on('resize load', fitLBtimeout);
    $(window).on('show.bs.modal', fitLBtimeout);
    $(window).on('slid.bs.carousel', fitLBtimeout);
}(jQuery));