//**All config js of theme
(function ($) {
    'use strict';
    jQuery(document).ready(function ($) {
        // Check isotop exists
        function is_isotop() {
            if (typeof $.fn.isotope !== 'undefined') {
                return true;
            }
            return false;
        }
        function zooLoadmoreAjax(wrap,item,path,layout){
            if(is_isotop()){
                if($('.infinity-post-pagination')[0]){
                    // init Infinte Scroll
                    var iso = new Isotope( wrap, {
                      layoutMode: layout,
                      itemSelector: item, 
                    });
                    if($('a.next.page-numbers')[0]){
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
                            outlayer: iso,
                            status: '.page-load-status',
                            hideNav: '.woocommerce-pagination',
                            button: button,
                            scrollThreshold: scrollThreshold,
                        });
                        
                        $('#content-product .products').on( 'history.infiniteScroll', function( event, response, path ) {
                            $('.view-more-button').show();
                        });
                    }
                    else{
                        $('.woocommerce-pagination,.infinite-scroll-error,.infinite-scroll-request').hide();
                    }
                }
            }
            
        }
        zooLoadmoreAjax('.zoo-container','.post','a.next.page-numbers','masonry');
        /* Blog grid mansonry*/
        $(window).resize(function () {
            if(is_isotop()){
                if($('.zoo-container')[0]){
                    $('.zoo-container').isotope({
                        itemSelector: '.post',
                        layoutMode: 'masonry'
                    });
                }
            }
        }).resize();
        $('.post-image').each(function () {
           var zoo_img_bg = $(this).attr('data-image-src');
           if (zoo_img_bg != '') {
               $(this).css('background-image', 'url("' + zoo_img_bg + '")');
               $(this).parally({
                speed: 0.1,
                mode: 'background',
                xpos: '60%',
                offset: -30,

            });
           }
        });
        if($('.sticky-footer')[0]){
            $('.sticky-footer').css('margin-bottom',$('#zoo-footer').height());
        }
        /**/
        if($('#top-footer .null-instagram-feed')[0]){
            $('#top-footer .null-instagram-feed .instagram-pics').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                autoplay: true,
                prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                autoplaySpeed: 5000,
                rtl: $('body.rtl')[0] ? true : false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    }, {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        }
        $('#commentform label input,#commentform label textarea').focus('#commentform label', function(){
            $(this).parent().addClass('focus');
        });
        $('#commentform label input,#commentform label textarea').focusout('#commentform label', function(){
            $('#commentform label').removeClass('focus');
            $( "#commentform label input,#commentform label textarea" ).each(function(){
                var theOutputText = $(this).val();
                if(theOutputText == ''){
                    $(this).parent().removeClass('show-text');
                }
            });
        });
        $( "#commentform label input,#commentform label textarea" ).keypress(function() {
            $(this).parent().addClass('show-text');
        });
        $("#commentform label input,#commentform label textarea" ).each(function(){
                var theOutputText = $(this).val();
                if(theOutputText != ''){
                    $(this).parent().addClass('show-text');
                }
            });
        $(document).on('click','.canvas-sidebar-trigger',function (e) {
            e.preventDefault();
            if($('#wpadminbar')[0]){
                $('#canvas-sidebar').css('margin-top',$('#wpadminbar').height());
            }
            $('body').addClass('canvas-sidebar-active');
        });
        $(document).on('click','.mask-canvas-sidebar, .close-canvas',function (e) {
            e.preventDefault();
            $('body').removeClass('canvas-sidebar-active');
        });
        $('.search-trigger').on('click', function (e) {
            e.preventDefault();
            $('.header-search-block').toggleClass('active');
            $('.search-trigger').hide();
            setTimeout(function () {
                $('.header-search-block.active input.ipt').focus();
            }, 100);
        });
        $(document).on('click', '.close-topbar', function () {
            $(this).parent().hide();
        });
        $(document).on('click', '.close-search', function () {
            $('.header-search-block').removeClass('active');
            $('.search-trigger').show();
        });
        $(".zoo-carousel").each(function () {
            var data = JSON.parse($(this).attr('data-config'));
            var item = data['item'];
            var pag = false;
            if (data['pagination'] != undefined && data['pagination'] == 'true') {
                pag = true;
            }
            var nav = false;
            if (data['navigation'] != undefined && data['navigation'] == 'true') {
                nav = true;
            }
            var wrap = data['wrap'] != undefined ? data['wrap'] : '';
            var wrapcaroul = wrap != '' ? $(this).find(wrap) : $(this);
            wrapcaroul.slick({
                slidesToShow: item,
                slidesToScroll: item > 5 ? Math.round(item / 2) : 1,
                arrows: nav,
                dots: pag,
                autoplay: true,
                prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
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
                            slidesToScroll: 1
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        });
        
        if ($(window).width() >= 993) {
            if($('.sticker')[0]){
                if ($('.sticky-wrapper')[0]) {
                    $('.wrap-header-block').unstick();
                }
                if ($('#wpadminbar')[0]) {
                    $(".sticker").sticky({zIndex: '4', topSpacing: $('#wpadminbar').height()});
                } else {
                    $(".sticker").sticky({zIndex: '4'});
                }
            }
        }
        if ($(window).width() < 993) {
            if($('#main-header-mobile')[0]){
                var mb_header_h = $('#main-header-mobile').outerHeight();
                console.log(mb_header_h);
                if(mb_header_h){
                    $('#main-header-mobile').css({'position':'fixed','top':'0','left':'0','width':'100%','z-index':'1'});
                    $('#zoo-header').css('height',mb_header_h);
                }
            }
        }
        
        $('.wrap-mobile-nav').zoo_MobileNav();

        //Lazy img
        $('.clever_wrap_lazy_img').each(function () {
            if ($(this).find('.lazy-img')[0]) {
                var res = $(this).data('resolution');
                var w = $(this).width();
                $(this).outerWidth(w).height(w / res);
                $(this).find('.lazy-img').not('.loaded').parent().addClass('loading');
                $(this).find('.lazy-img').not('.loaded').lazyload({
                    effect: 'fadeIn',
                    threshold: $(window).height(),
                    load: function () {
                        $(this).parent().removeClass('loading');
                        $(this).addClass('loaded');
                    }
                });
            }
        });
        //Toggle nav sidebar
        var zoo_sidebar_nav = $('.sidebar .widget_nav_menu, .sidebar .widget_categories, .sidebar .widget_pages');
        zoo_sidebar_nav.find('li>ul').slideUp();
        zoo_sidebar_nav.find('li:has(ul)').append('<span class="zoo-nav-toggle"><i class="cs-font clever-icon-down"></i></span>');
        $(document).on('click', '.zoo-nav-toggle', function () {
            $(this).parent().children('ul').slideToggle();
            $(this).toggleClass('active');
        });

        function zoo_fix_vc_full_width_row(){
            var $elements = jQuery('[data-vc-full-width="true"]');
            jQuery.each($elements, function () {
                var $el = jQuery(this);
                $el.css('right', $el.css('left')).css('left', '');
            });
        }

        // Fixes rows in RTL
        jQuery(document).on('vc-full-width-row', function () {
            if($('body.rtl')[0]) {
                zoo_fix_vc_full_width_row();
            }
        });

        // Run one time because it was not firing in Mac/Firefox and Windows/Edge some times
        zoo_fix_vc_full_width_row();
        //Full width embed
        $(window).resize(function () {
            VideoFullWidth($(".post-media iframe"));
        }).resize();
        function VideoFullWidth(allVideos) {
           var newWidth = jQuery(".post-media").width();
           // Resize all videos according to their own aspect ratio
           allVideos.each(function () {
               var el = jQuery(this);
               el.width(newWidth).height(newWidth * el.data('aspectRatio'));
           });
       }
        var allVideos = $(".post-media iframe");
        allVideos.each(function () {
           $(this).data('aspectRatio', this.height / this.width)
               .removeAttr('height')
               .removeAttr('width');
        });
        if($('.post-slider')[0]) {
            $('.post-slider').slick({
                autoplay: true,
                prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                autoplaySpeed: 3000,
            });
        }
    });
    $(window).on('load', function () {
        $('#page-load').addClass('deactive');
        $(window).resize(function () {
            //Fix position menu
            var window_w = $(window).width();
            $('.pos-left').removeClass('pos-left');
            $('#main-navigation .children, #main-navigation .sub-menu, .top-head-widget .sub-menu, .bottom-main-footer-block .sub-menu').each(function () {
                if (window_w < parseInt($(this).offset()['left'] + $(this).width())) {
                    $(this).addClass('pos-left');
                }
            });
        }).resize();
    });
    jQuery.fn.extend({
        zoo_MobileNav: function () {
            $(this).find('li:has("ul")>a').after('<span class="triggernav"><i class="cs-font clever-icon-plus"></i></span>');
            $('.triggernav').zoo_toggleMobileNav();
            $(document).on('click', '#menu-mobile-trigger', function (e) {
                e.preventDefault();
                $(this).toggleClass('active');
                $('.wrap-mobile-nav').toggleClass('active');
                $('body').toggleClass('menu-active');

                if($('#wpadminbar')[0]){
                    $('.wrap-mobile-nav').css('margin-top',$('#wpadminbar').height());
                }
            });
            $(document).on('click', '.menu-active .close-nav, .menu-active .mask-nav', function (e) {
                e.preventDefault();
                $('.wrap-mobile-nav,#menu-mobile-trigger').toggleClass('active');
                $('body.menu-active').toggleClass('menu-active');
            })
        },
        zoo_toggleMobileNav: function () {
            $('.wrap-mobile-nav li ul').slideUp();
            $(this).on("click", function () {
                $(this).toggleClass('active');
                $(this).next().slideToggle();
                if (!$(this).hasClass('active')) {
                    $(this).next().find('ul').slideUp();
                    $(this).next().find('.triggernav').removeClass('active');
                }
            });
        },
        ActiveScreen: function () {
            var itemtop, windowH, scrolltop;
            itemtop = $(this).offset().top;
            windowH = $(window).height();
            scrolltop = $(window).scrollTop();
            if (itemtop < scrolltop + windowH * 2 / 3) {
                return true;
            }
            else {
                return false;
            }
        }
    });
    window.onbeforeunload = function () {
        $('#page-load').removeClass('deactive');
        return null;
    }
    $('.svg-icon').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });
    if($('.style-landing')[0]){
        $("#demos").click(function (){
            $('html, body').animate({
                scrollTop: $("#demo").offset().top
            }, 1000);
        });
        $("#features").click(function (){
            $('html, body').animate({
                scrollTop: $("#feature").offset().top
            }, 1000);
        });
    }
})(jQuery);