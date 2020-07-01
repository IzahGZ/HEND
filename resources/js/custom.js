jQuery(document).ready(function($) {
    "use strict";

$(window).load(function(){
     $('.preloader').fadeOut();
});

    /* SCROLLL SMOOTH */
    $("html").niceScroll({
        cursorcolor: '#4b4b4b',
        cursorwidth: 8,
        cursorborder: 0,
        cursorborderradius: 0,
        zindex: 999999,
        autohidemode: false,
        scrollspeed: 80,
        mousescrollstep: 50
    });

    /* slide down navigation */
    var navigation = $('.main-header').clone();
    $('.main-header').addClass('old');
    if ($('#wpadminbar').css('position') == 'fixed') {
        var topOffset = $('#wpadminbar').outerHeight(true);
    } else {
        var topOffset = 0;
    }
    navigation.css({
        display: 'none',
        position: 'fixed',
        left: '0px',
        top: topOffset + 'px',
        width: '100%',
        zIndex: 1040,
        backgroundColor: '#ffffff',
        padding: '20px 0px 10px 0px'
    });
    navigation.addClass('fixed-nav');
    $('body').append(navigation);

    $(window).scroll(function() {
        if ($(document).scrollTop() >= $('.main-header.old').outerHeight()) {
            navigation.slideDown();
        } else {
            navigation.fadeOut();
        }
    });

    $(window).resize(function() {
        if ($('#wpadminbar').css('position') == 'fixed') {
            var topOffset = $('#wpadminbar').outerHeight(true);
        } else {
            var topOffset = 0;
        }

        $('#abs').css({
            top: topOffset + 'px'
        });

        if ($(window).width > 768) {
            navigation.find('.nav.navbar-nav > li').css('padding', '0px 3px');
        } else {
            navigation.find('.nav.navbar-nav > li').css('padding', '0px');
        }
    });

    /* NAV */
    function handle_navigation() {
        if ($(window).width() > 769) {
            /* SHOW THE NAVIGATION */
            $('.pt-nav ul').show();
            /* HIDE THE KIDS */
            $('.pt-nav ul li').children('ul').hide();
            /* REMOVE THE VENET ON CLICK FROM THE SCREEN SIZES SMALLER THAN 767 */
            $('.pt-nav ul li').unbind('click');
            $('.pt-nav-trigger button').unbind('click');

            $('.pt-nav li > a').hover(
                function() {
                    $(this).parent().children('ul').stop().css('height', 'auto').slideDown(300);
                }
            );
            $('.pt-nav li').hover(
                null,
                function(e) {
                    $(this).children('ul').stop().slideUp(100);
                }
            );

        } else {
            $('.pt-nav ul li').unbind('click');
            $('.pt-nav-trigger button').unbind('click');
            /* REMOVE HOVER ACTIONS WHIC IS USED ON SCREENS LARGER THAN 767 */
            $('.pt-nav li > a').unbind('mouseenter mouseleave');
            $('.pt-nav li').unbind('mouseenter mouseleave');
            /* HIDE THE KIDS */
            $('.pt-nav ul li').children('ul').hide();
            /* trigger on click */
            $('.pt-nav ul li').click(function() {
                $(this).children('ul').slideToggle(200);
            });
            /* HIDE THE NAVIGATION */
            $('.pt-nav ul').hide();
            /* OPEN NAVIGATION ON TRIGGER BUTTON */
            $('.pt-nav-trigger button').click(function(e) {
                e.preventDefault();
                $(this).parents('.nav-root').find('.pt-nav ul').slideToggle(200);
            });
        }
    }

    handle_navigation();
    $(window).resize(function() {
        handle_navigation();
    });

    /* COUNT DOWN */
    $('.countdown').downCount({
        date: '09/09/2014 12:00:00',
        offset: +10
    }, function() {

    });

    /* RISED BARS */
    $('.rised').slider();
    $('.rised-range-funds').slider();
    $('.rised-range-age').slider();
    $(".rised-range-funds").on('slide', function(slideEvt) {
        var val = slideEvt.value;
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        $("#begin-value").text('$' + val);

    });
    $(".rised-range-age").on('slide', function(slideEvt) {
        $("#begin-value-age").text(slideEvt.value + ' days');

    });

    /* MAIN SLIDER */
    $('#myCarousel').on('slide.bs.carousel', function(e) {
        $(e.relatedTarget).find('img').css('opacity', '0');
        $(e.relatedTarget).find('img').animate({
            opacity: 0.5
        }, 500);
        $(e.relatedTarget).find('.slide-content').hide();
    });
    $('#myCarousel').on('slid.bs.carousel', function(e) {
        $('#myCarousel .item.active').find('.slide-content').fadeIn(500);
    });

    /* SHARE */
    $(document).on('click', function(e) {
        if ($(e.target).closest('.overlay-wrapper').length == 0) {
            if (!$(e.target).closest('a.share-trigger').length) {
                $('.overlay-wrapper').delay(400).fadeOut();
                $('.content-hidden').fadeOut();
            }
        }
    });
    $('a[data-toggle="dropdown"]').click(function(e) {
        if (!$(e.target).closest('a.share-trigger').length) {
            $('.overlay-wrapper').delay(400).fadeOut();
            $('.content-hidden').fadeOut();
        }
    });

    $('a.share-trigger').click(function() {
        var parent = $(this).closest('.urgent-box');
        if (parent.length == 0) {
            parent = $(this).closest('.latest-box');
        }

        $('.overlay-wrapper').attr('data-wrapper', 'close');
        $('.content-hidden').attr('data-content', 'close');

        parent.find('.overlay-wrapper').attr('data-wrapper', 'open').fadeToggle(400);
        parent.find('.content-hidden').attr('data-content', 'open').delay(400).fadeIn();


        $('div[data-wrapper="close"]').fadeOut(400);
        $('div[data-content="close"]').delay(400).fadeOut();
    });

    /* TOOLTIPS */
    $(document).ready(function() {
        $("[data-rel]").tooltip({
            placement: 'left'
        });
    });

    /* DROPDWON */
    // Add slideup & fadein animation to dropdown
    $('.dropdown').on('show.bs.dropdown', function(e) {
        var $dropdown = $(this).find('.dropdown-menu');
        var orig_margin_top = parseInt($dropdown.css('margin-top'));
        $dropdown.css({
            'margin-top': (orig_margin_top + 10) + 'px',
            opacity: 0
        }).animate({
            'margin-top': orig_margin_top + 'px',
            opacity: 1
        }, 300, function() {
            $(this).css({
                'margin-top': ''
            });
        });
    });
    // Add slidedown & fadeout animation to dropdown
    $('.dropdown').on('hide.bs.dropdown', function(e) {
        var $dropdown = $(this).find('.dropdown-menu');
        var orig_margin_top = parseInt($dropdown.css('margin-top'));
        $dropdown.css({
            'margin-top': orig_margin_top + 'px',
            opacity: 1,
            display: 'block'
        }).animate({
            'margin-top': (orig_margin_top + 10) + 'px',
            opacity: 0
        }, 300, function() {
            $(this).css({
                'margin-top': '',
                display: ''
            });
        });
    });

    /* MAPS CAROUSEL */
    $('#eventsCarousel').on('slid.bs.carousel', function(e) {
        $('#eventsCarousel .item.active iframe').attr('src', $('#eventsCarousel .item.active iframe').attr('src'));
    });
    /* disable scroll on map iframes on smaller screens */
    if ($(window).width() < 767) {
        $('iframe.map').css({
            'pointer-events': 'none'
        });
    }

    /* input shop increment */
    $('.increment a.minus').on('click', function() {
        $('.increment input').val(parseInt($('.increment input').val(), 10) - 1);
    });
    $('.increment a.plus').on('click', function() {
        $('.increment input').val(parseInt($('.increment input').val(), 10) + 1);
    });

    /* CALENDAR */
    $("#my-calendar").zabuto_calendar({
        cell_border: true,
        today: true,
        show_days: true,
        weekstartson: 0,
        nav_icon: {
            prev: '<i class="fa fa-angle-left"></i>',
            next: '<i class="fa fa-angle-right"></i>'
        },
        language: "en",
        ajax: {
            url: "php/show_data.php",
            modal: true
        }
    });

    /* LIGHTBOX */
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        return $(this).ekkoLightbox({
            always_show_close: true,
            gallery: 'data-gallery="multiimages'
        });
    });


});
