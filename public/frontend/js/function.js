var windowWidth = $(window).width();
$(document).ready(function () {
    $('.grid-nav > ul >li:first-child').before(' <li>close</li>');
    $('.grid-nav > ul >li.menu-item-has-children>a').after('<i class="fa fa-angle-down"></i>');
    $('.grid-nav > ul >li.menu-item-has-children>ul>li:first-child').before('<li><i class="fas fa-arrow-left"></i> Back</li>');

    $(".nav-one .humburger, .grid-nav > ul > li:first-child").on("click", function () {
        windowWidth < 992 && (
            $('.nav-one .grid-nav ul').toggleClass('show_menu'),
                $(".nav-one .humburger").toggleClass("active_humburger"),
                $(".nav-one .grid-nav > ul > li > i").next("ul").removeClass("show_iner_menu"),
                $(".nav-one .grid-nav").toggleClass("overlay")
        )
    }),
        $(".nav-one .grid-nav > ul > li > i, .nav-one .grid-nav > ul > li > ul > li > i").on("click", function () {
            windowWidth < 992 && (
                $(this).next("ul").toggleClass("show_iner_menu"),
                    $(".nav-one .grid-nav ul").toggleClass("overflow")
            )
        }),
        $(".nav-one .grid-nav > ul > li > ul > li:first-child, .nav-one .grid-nav > ul > li > ul > li > ul > li:first-child").on("click", function () {
            windowWidth < 992 &&
            $(this).parent().removeClass("show_iner_menu")
        }),
        $(document).on("mouseup", function (e) {
            var o = $(".grid-nav ul");
            o.is(e.target) || 0 !== o.has(e.target).length || (
                $(".nav-one .grid-nav ul").removeClass("show_menu"),
                    $(".nav-one .humburger").removeClass("active_humburger"),
                    $(".nav-one .grid-nav > ul > li > i").next("ul").removeClass("show_iner_menu"),
                    $(".nav-one .grid-nav").removeClass("overlay"))
        })
});

jQuery(window).scroll(function () {
    var top = jQuery(document).scrollTop();
    var height = 0;

    if (top > height) {
        jQuery('#menufix').addClass('menu-fixed');
    } else {
        jQuery('#menufix').removeClass('menu-fixed');
    }
})

$(document).ready(function () {
    $('.slider-banner').owlCarousel({
        animateOut: 'slideOutDown',
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 8000,
        autoplayHoverPause: false,
        dots: false,
        nav: true,
    });
    $('.slider-image').owlCarousel({
        items: 4,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        dots: false,
        nav: false,
        margin: 15,
        stagePadding: 15,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1024: {
                items: 4
            }
        }
    });
    $('.slider-relate').owlCarousel({
        items: 3,
        loop: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        dots: false,
        nav: false,
        margin: 15,
        stagePadding: 15,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1024: {
                items: 3
            }
        }
    });
})
