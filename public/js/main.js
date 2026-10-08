$(document).ready(function () {
    //$(document).on("scroll", onScroll);

    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");

        $('a').each(function () {
            $(this).removeClass('navactive');
        })
        $(this).addClass('navactive');

        var target = this.hash;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top + 2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });

    $('.ex_hover').hover(function () {
        $(this).stop().animate({'margin-top': '3px'}, 200);
    },
    function () {
        $(this).stop().animate({'margin-top': '0px'}, 200);
    });
    $('#bo_call').hover(function () {
        $(this).stop().animate({'left': '51%'}, 200);
    },
    function () {
        $(this).stop().animate({'left': '50%'}, 200);
    });
});

function onScroll(event) {
    var scrollPosition = $(document).scrollTop();
    $('.nav li a').each(function () {
        var currentLink = $(this);
        var refElement = $(currentLink.attr("href"));
    });

};