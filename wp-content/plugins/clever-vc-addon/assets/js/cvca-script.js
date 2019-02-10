(function ($) {
    'use strict';
    jQuery(document).ready(function () {
//Parralax js
        $('.cvca-parallax-box').each(function () {
            var zoo_img_bg = $(this).data('image-src');
            var zoo_offset = $(this).data('offset');
            if (zoo_offset == '') {
                zoo_offset = -40;
            }
            if (zoo_img_bg != '') {
                $(this).css('background-image', 'url("' + zoo_img_bg + '")');
                $(this).parally({offset: zoo_offset});
            }
        });

// Init slick slider (use for data-slick )
        if ($('.slick-init').length) {
            $('.slick-init').each(function () {
                $(this).slick();
            });
        }

        if ($(".cvca-carousel-block").length) {
            $(".cvca-carousel-block").each(function () {

                var data = JSON.parse($(this).attr('data-config'));
                var item = 4;
                var center_mode = false;
                var center_padding = '60px';
                var pag = false;
                var nav = false;
                var autoplay = false;

                if (data['item'] != undefined && data['item'] != '') {
                    item = parseInt(data['item']);
                }

                if (data['center_mode'] != undefined && data['center_mode'] == '1') {
                    center_mode = true;
                }

                if (data['center_mode'] != undefined && data['center_padding'] != undefined && data['center_mode'] == '1') {
                    center_padding = data['center_padding'];
                }

                if (data['pagination'] != undefined && data['pagination'] == '1') {
                    pag = true;
                }

                if (data['navigation'] != undefined && data['navigation'] == '1') {
                    nav = true;
                }
                if (data['autoplay'] != undefined && data['autoplay'] == '1') {
                    autoplay = true;
                }

                var wrap = data['wrap'] != undefined ? data['wrap'] : '';
                var wrapcaroul = wrap != '' ? $(this).find(wrap) : $(this);
                wrapcaroul.slick({
                    slidesToShow: item,
                    centerMode: center_mode,
                    centerPadding: center_padding+'px',
                    arrows: nav,
                    dots: pag,
                    rows: 0,
                    autoplay: autoplay,
                    lazyLoad: 'ondemand',
                    infinite: true,
                    prevArrow: '<span class="cvca-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                    nextArrow: '<span class="cvca-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                    autoplaySpeed: 5000,
                    rtl: $('body.rtl')[0] ? true : false,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: item > 4 ? 4 : item,
                                slidesToScroll: item > 4 ? 2 : 1
                            }
                        }, {
                            breakpoint: 769,
                            settings: {
                                slidesToShow: item > 2 ? 2 : item,
                                slidesToScroll: 1,
                            }
                        }, {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                dots: true,
                            }
                        }
                    ]
                });
            });
        }

        $(".cvca-carousel").each(function () {
            var data = JSON.parse(jQuery(this).attr('data-config'));
            var col_xl = data['col_xl'];
            var col_lg = data['col_lg'];
            var col_md = data['col_md'];
            var col_sm = data['col_sm'];
            var col = data['col'];
            var scroll = data['scroll'];
            var autoplay = data['autoplay'];
            var speed = data['speed'];
            var show_pag = data['show_pag'];
            var show_nav = data['show_nav'];
            var wrap = data['wrap'] != undefined ? data['wrap'] : '';
            var wrapcaroul = wrap != '' ? jQuery(this).find(wrap) : jQuery(this);
            wrapcaroul.slick({
                slidesToShow: col_xl,
                slidesToScroll: scroll > col_xl ? col_xl : scroll,
                arrows: show_nav,
                dots: show_pag,
                prevArrow: '<span class="cvca-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                nextArrow: '<span class="cvca-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                autoplay: autoplay,
                autoplaySpeed: speed,
                rows: 0,
                rtl: $('body.rtl')[0] ? true : false,
                responsive: [
                    
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: col_lg,
                            slidesToScroll: scroll > col_lg ? col_lg : scroll,
                        }
                    }, 
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: col_md,
                            slidesToScroll: scroll > col_md ? col_md : scroll,
                        }
                    }, 
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: col_sm,
                            slidesToScroll: scroll > col_sm ? col_sm : scroll,
                        }
                    }, 
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow:  col,
                            slidesToScroll: scroll > col ? col : scroll,
                        }
                    }
                ]
            });
        });
// Pagination
        function zooPaginationAjax(wrap,item,path){
            $(document).on('click','.view-more-button', function(e){
                e.preventDefault();
            });
            if(typeof $.fn.isotope !== 'undefined'){
                if($('.pagination-ajax')[0]){
                    
                    if($(path)[0]){
                        var button = false;
                        var scrollThreshold = true;
                        if($('.view-more-button')[0]){
                            button = '.view-more-button';
                            scrollThreshold = false;
                            $(document).on('click','.view-more-button', function(){
                                $(this).hide();
                            });
                        }
                        var infScroll = new InfiniteScroll( wrap, {
                            path: path,
                            append: item,
                            status: '.page-load-status',
                            hideNav: '.pagination-ajax',
                            button: button,
                            scrollThreshold: scrollThreshold,
                        });
                        
                        $(wrap).on( 'history.infiniteScroll', function( event, response, path ) {
                            $('.view-more-button').show();
                        });
                        $(wrap).on( 'last.infiniteScroll', function( event, response, path ) {
                            $('.view-more-button').remove();
                        });
                    }
                    else{
                        $('.pagination-ajax,.infinite-scroll-error,.infinite-scroll-request,.view-more-button').remove();
                    }
                }
            }
        }
        zooPaginationAjax( '.wrap-loop-content .row,.products.grid-layout','.post,.product','a.cvca-pagination-next');
//Parallax js
        if ($('.cvca-parallax-box.in-nav')[0]) {
            var cvca_nav = '';
            var i = 0;
            $('.cvca-parallax-box.in-nav').each(function () {
                cvca_nav += '<li><a href="#' + $(this).attr('id') + '" class="cvca-parallax-nav-item" title="' + $(this).data('title') + '"><span>' + $(this).data('title') + '</span></a></li>';
            });
            cvca_nav = '<ul class="cvca-parallax-nav">' + cvca_nav + '</ul>';
            $('.page-content').append(cvca_nav);
            $('.cvca-parallax-nav li:first-child a').addClass('active');
        }
        $('.cvca-parallax-nav a:not(.active)').live('click', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top - $('#cvca-header').outerHeight(true)
            }, 500);
            $('.cvca-parallax-nav a.active').removeClass('active');
            $(this).addClass('active');
        })
//Shortcode video
        $('.cvca-video-button').on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var height = $(this).data('height');
            var width = $(this).data('width');
            var html = '<div class="cvca-video-mask"></div><div class="cvca-wrap-video-popup"><iframe src="' + url + '" height="' + height + '" width="' + width + '" ></iframe></div>';
            $('body').append(html);
        });
        $('.cvca-video-mask').live('click', function () {
            $('.cvca-wrap-video-popup, .cvca-video-mask').fadeOut();
            setTimeout(function () {
                $('.cvca-wrap-video-popup, .cvca-video-mask').remove();
            }, 500)
        });
//Count Up
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '',
        };
        jQuery('.cvca-countup').each(function () {
            var data = JSON.parse($(this).attr('data-config'));
            var item = new CountUp(data['countid'], data['start_number'], data['end_number'], data['decimals'], data['duration'], options);
            jQuery(window).bind("scroll", function () {
                if (jQuery('#' + data['wrapid']).ActiveScreen()) {
                    item.start();
                }
            });
        });
//Auto typing js
        if ($('.cvca-auto-typing')[0]) {
            $('.cvca-auto-typing').each(function () {
                $(this).find(".content-auto-typing").typed({
                    strings: $(this).data('text'),
                    typeSpeed: $(this).data('speed'),
                    startDelay: $(this).data('delay'),
                    showCursor: $(this).data('cursor') != '' ? true : false,
                });
            });
        }

// Map Shortcode
        $(".cvca-shortcode-maps").each(function () {
            function init() {
                var mapOptions = {
                    scrollwheel: s,
                    zoom: c,
                    center: new google.maps.LatLng(d, e),
                    styles: f
                }
                    , i = document.getElementById(b)
                    , j = new google.maps.Map(i, mapOptions);
                new google.maps.Marker({
                    position: new google.maps.LatLng(d, e),
                    map: j,
                    title: g,
                    icon: h
                })
            }

            var $image = '';

            if ($(this).data("marker") != '') {
                $image = $(this).data("marker");
            } else {
                $image = {
                    url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(20, 32),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 32)
                };
            }

            var b = $(this).data("id"),
                c = $(this).data("zoom"),
                d = $(this).data("latitude1"),
                e = $(this).data("latitude2"),
                f = $(this).data("style"),
                g = $(this).data("title"),
                h = $image,
                s = $(this).data("scroll");
            google.maps.event.addDomListener(window, "load", init)
        });

        jQuery.fn.extend({
            ActiveScreen: function () {
                var itemtop, windowH, scrolltop, itembottom;
                itemtop = $(this).offset().top;
                itembottom = itemtop + $(this).outerHeight(true);
                windowH = $(window).height();
                scrolltop = $(window).scrollTop();
                if ((itemtop < scrolltop + windowH * 2 / 3) && (scrolltop < itembottom)) {
                    return true;
                }
                else {
                    return false;
                }
            }
        });
//Onpage Js
        if ($('.cvca-one-page')[0]) {
            var html = '<div id="cvca-control-one-page" class="cvca-control-one-page-block"><ul class="cvca-wrap-control"></ul></div>'
            $('body').append(html);
        }
        $('.cvca-one-page').each(function () {
            var html = '<li class="cvca-control-item" data-preset="' + $(this).data("preset") + '"><a href="#' + $(this).attr("id") + '"><i class="' + $(this).data("icon") + '"></i><span>' + $(this).data("title") + '</span></li>';
            $('.cvca-wrap-control').append(html);
        });
        $(document).on('click', '.cvca-control-item:not(.active)', function (e) {
            e.preventDefault();
            $(document.body).trigger('cvca_one_page_scroll', {
                "target": $(this)
            });
            $('.cvca-control-item.active').removeClass('active');
            $(this).addClass('active');
        });

        if ($('#cvca-control-one-page')[0]) {
            jQuery(window).bind("scroll", function () {
                $('.cvca-one-page').each(function () {
                    if ($(this).ActiveScreen()) {
                        $('.cvca-one-page.active').removeClass('active');
                        $('.cvca-control-item.active').removeClass('active');
                        $('#cvca-control-one-page .cvca-control-item').css('background', '');
                        $(this).addClass('active');
                        $('#cvca-control-one-page .cvca-control-item a[href="#' + $(this).attr('id') + '"]').parents('.cvca-control-item').addClass('active').css('background', $(this).data('preset'));
                    } else {
                        $(this).removeClass('active');
                    }
                });
                if ($('.cvca-one-page.active')[0]) {
                    $('#cvca-control-one-page:not(.active)').addClass('active');
                } else {
                    $('#cvca-control-one-page.active').removeClass('active');
                }
            });
        }
        $(document.body).bind('cvca_one_page_scroll', function (event, data) {
            var $this = data.target;
            $('html, body').animate({
                scrollTop: $($this.find('a').attr('href')).offset().top - $('#zoo-header').outerHeight(true)
            }, 500);
        });
        $(document).on('mouseover', '.cvca-one-page-control .cvca-control-item', function () {
            $(this).css('background', $(this).data('preset'));
        });
        $(document).on('mouseout', '.cvca-one-page-control .cvca-control-item', function () {
            $(this).css('background', '');
        });
        $(document).on('mouseover', '#cvca-control-one-page .cvca-control-item:not(.active)', function () {
            $(this).css('background', $(this).data('preset'));
        });
        $(document).on('mouseout', '#cvca-control-one-page .cvca-control-item:not(.active)', function () {
            $(this).css('background', '');
        });
//Masonry Group
        $(window).load(function () {
            $('.cvca-masonry-group>.vc_row>.wpb_column').unwrap();
            $('.cvca-masonry-group').each(function () {
                var horizontalOrder = !!$(this).data('horizontalorder') ? true : false;
                var gutter = !!$(this).data('gutter') ? $(this).data('gutter') : 0;
                $(this).children().css('padding', gutter / 2);
                $(this).isotope({
                    percentPosition: true,
                    masonry: {
                        horizontalOrder: horizontalOrder,
                    }
                })
            });
            //Banner isotope
        if ($('.cvca-shortcode-multi-banner')[0]) {
            var layout = $('.cvca-shortcode-multi-banner').data('layout');
            $('.cvca-shortcode-multi-banner .wrap-content-multi-banner').isotope({layoutMode: layout})
        }
        });
    })
})(jQuery)
