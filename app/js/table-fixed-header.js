(function($) {

    $.fn.resizeHeader = function () {
        var o = $(this);
        var ww = [];
        o.find('thead.header > tr.sortable > th').each(function (i, h){
            ww.push($(h).width());
        });
        $.each(ww, function (i, w){
            o.find('thead.header > tr.sortable > th:eq('+i+'), thead.header-copy > tr.sortable > th:eq('+i+')').css({width: w});
        });
    };

    $.fn.fixedHeader = function (options) {
        var config = {
            topOffset: 40,
            bgColor: '#EEEEEE'
        };
        if (options){ $.extend(config, options); }

        return this.each( function() {
            var o = $(this);

            var $win = $(window)
                , $head = $('thead.header', o)
                , isFixed = 0;
            var headTop = $head.length && $head.offset().top - config.topOffset;

            function processScroll() {
                if (!o.is(':visible')) return;
                $('thead.header-copy', o).css('left', o.offset().left - $win.scrollLeft());
                var scrollTop = $win.scrollTop();
                var t = $head.length && $head.offset().top - config.topOffset;
                if (!isFixed && headTop != t) { headTop = t; }
                if      (scrollTop >= headTop && !isFixed) { isFixed = 1; }
                else if (scrollTop <= headTop && isFixed) { isFixed = 0; }
                isFixed ? $('thead.header-copy', o).removeClass('hide')
                    : $('thead.header-copy', o).addClass('hide');
            }
            $win.on('scroll', processScroll);

            // hack sad times - holdover until rewrite for 2.1
            $head.on('click', function () {
                if (!isFixed) setTimeout(function () {  $win.scrollTop($win.scrollTop() - 47) }, 10);
            });

            // hack for GridView filters
            var copy = $head.clone().removeClass('header').addClass('header-copy header-fixed');
            copy.find('.filters').remove();
            copy.appendTo(o);

            o.resizeHeader();

            o.find('thead.header-copy').css({ margin:'0 auto',
                width: o.width(),
                'background-color':config.bgColor });
            processScroll();
        });
    };

})(jQuery);