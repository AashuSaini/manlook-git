/**
 * Name: Doma
 * Package: Doma JS
 * Description: Main javascript functions.
 * Version: 1.0.0
 * Last update: 2018/04/14
 * Author: ZooTemplate
 */

( function( $ ) {
    "use strict";
    var clever = {
        go: function() {
            clever.zooHoverCrollEffect();
            clever.zooShopListGridLoad();
            clever.zooVendorMenu();
            clever.zooQuickview();
            clever.zooRemoveQuickview();
            clever.zooSlideToggleCoupon();
            clever.zooAddtocartMess();
            clever.zooSidebarControl();
            clever.zooProductCarousel();
            clever.zooZoom();
            clever.zooCleverUpdateGallery();
            clever.zooQTY();
            clever.zooLoginForm();
            clever.zooProductLightBox();
            clever.zooTab();
            clever.zooStickInParent();
            clever.zooAccordionTab();
            clever.zooShortcodeProductGroup();
            clever.LoadmoreAjax( '.wrap-product-page .products','.product','a.next.page-numbers');
            clever.zoo_reloadShopColumns();
        },

        //For ready
        zoo_reloadShopColumns: function(){
            if($('.layout-control-column')[0]){
                $(document).on('click','.layout-control-column .item', function(e){
                    e.preventDefault();
                    $(this).parents('.layout-control-column').find('.item').removeClass('active');
                    $(this).addClass('active');
                    var column_value = $(this).attr('data-column');
                    $(this).parents('.zoo-woo-page').find('.products').removeClass('layout-3-columns layout-4-columns layout-5-columns');
                    $(this).parents('.zoo-woo-page').find('.products').addClass('layout-'+column_value+'-columns');
                });
                
            }

        },
        zooHoverCrollEffectHerizontal: function(){
            if($('.zoo-wrap-layer-filter')[0]){
                $('.zoo-wrap-layer-filter').each( function() {
                    var height_ul = $(this).find('ul').outerHeight();
                    if(height_ul >= 250){
                        $(this).find('ul').addClass('scroll');
                    }
                });
            }
        },

        zooHoverCrollEffect: function(){
            if($('.woocommerce.widget')[0]){
                $('.woocommerce.widget').each( function() {
                    var height_ul = $(this).find('ul').outerHeight();
                    if(height_ul >= 250){
                        $(this).find('ul').addClass('scroll');
                    }
                });
            }
        },

        

        zooVendorMenu: function() {

            $(document).on('click', '.categories-menu-inner', function () {
                $(this).toggleClass('open');
                $('.categories-menu-content').slideToggle('active');
            });
        },

        zooQvGal: function() {

            if ($('#zoo-quickview-lb .wrap-top-single-product .wrap-single-carousel')[0]) {
                $('#zoo-quickview-lb .wrap-top-single-product .wrap-single-carousel').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rtl: $('body.rtl')[0] ? true : false,
                    swipe: true,
                    prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                    nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                });
            }
        },

        zooQuickview: function() {

            $(document).on('click','.quick-view.btn', function (e) {
                e.preventDefault();
                var load_product_id = $(this).attr('data-product_id');
                var data = {action: 'zoo_quickview', product_id: load_product_id};
                $(this).parents('.wrap-product-img').addClass('loading');
                var $this = $(this);
                $.ajax({
                    url: ajaxurl,
                    data: data,
                    type: "POST",
                    success: function (response) {
                        $('body').append(response);
                        $('.wrap-product-img').removeClass('loading');
                        // Variation Form
                        var form_variation = $(document).find('#zoo-quickview-lb .variations_form');
                        form_variation.wc_variation_form();
                        form_variation.trigger('check_variations');
                        clever.zooQvGal();
                        clever.zooZoom();
                        setTimeout(function () {
                            $('#zoo-quickview-lb,.zoo-quickview-mask').css('opacity', '1');
                        }, 10);
                        setTimeout(function() {
                            var wrap_top = $('.wrap-single-image').outerHeight() - 60;
                            $('.wrap-right-single-product').css('height', wrap_top);
                        }, 500);
                    }
                });
            });
        },

        zooRemoveQuickview: function() {

            $(document).on('click', '.zoo-quickview-mask, .close-quickview', function (e) {
                e.preventDefault();
                $('.zoo-quickview-mask').css('opacity', '0');
                $('#zoo-quickview-lb').css({'top': 'calc(50% + 150px)', 'opacity': '0'});
                setTimeout(function () {
                    $('#zoo-quickview-lb').remove();
                    $('.zoo-quickview-mask').remove();
                }, 500);
            });
        },

        zooSlideToggleCoupon: function() {

            $(document).on('click', '.wrap-cart-coupon .heading-coupon', function () {
                $('.wrap-cart-coupon .custom-coupon').slideToggle();
            });
        },

        zooCartMess: function($zoo_mess) {

            if (!!$zoo_mess) {
               if ($('#zoo-add-to-cart-message')[0]) {
                   $('#zoo-add-to-cart-message').replaceWith($zoo_mess);
               } else {
                   $('body').append($zoo_mess);
               }
               setTimeout(function () {
                   $('#zoo-add-to-cart-message').addClass('active');
               }, 100);setTimeout(function () {
                   $('#zoo-add-to-cart-message').removeClass('active');
               }, 3500);
           }
        },

        zooAddtocartMess: function() {
            $(document).bind('added_to_cart', function (event, fragments, cart_hash, $button) {
               clever.zooCartMess(fragments['zoo_add_to_cart_message']);
            });
        },

        zooSidebarControl: function() {

            $('.mask-sidebar, .close-sidebar').on('click', function (e) {
                e.preventDefault();
                $('.disable-sidebar').removeClass('disable-sidebar');
                $('.sidebar-control>a').removeClass('active');
                $('body').removeClass('sidebar-active');
            });
            if($('.horizontal-sidebar')[0]){
                $('.sidebar-control>a').on('click', function (e) {
                    e.preventDefault();
                    $('.zoo-ln-wrap-col').slideToggle();
                    clever.zooHoverCrollEffectHerizontal();
                });
            }
            if($('.zoo-woo-sidebar')[0]){
                $('.sidebar-control>a').on('click', function (e) {
                    e.preventDefault();
                    $('body').addClass('sidebar-active');
                    clever.zooHoverCrollEffectHerizontal();
                });
            }
            
            $('.widget.woocommerce .widget-title, .zoo-title-filter-block').on('click',function(){
                $(this).toggleClass('on');
                $(this).next().slideToggle();
            });
        },

        zooProductCarousel: function() {

            //Carousel Gallery
            if ($('.zoo-single-product')[0]) {
                $('.zoo-single-product.carousel .wrap-single-carousel').slick({
                    slidesToScroll: 1,
                    slidesToShow: 3,
                    centerMode: true,
                    rtl: $('body.rtl')[0] ? true : false,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                    nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                dots: true
                            }
                        }
                    ]
                });
                //Horizontal gallery
                $('.zoo-single-product.vertical-gallery .wrap-single-carousel,.zoo-single-product.center .wrap-single-carousel, .zoo-single-product.horizontal-gallery .wrap-single-carousel').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    swipe: true,
                    rtl: $('body.rtl')[0] ? true : false,
                    asNavFor: '.wrap-top-single-product .wrap-thumbs-gal',
                    prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                    nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                });
            }
            if ($('.zoo-single-product.vertical-gallery')[0]) {
                if ($('.wrap-top-single-product .wrap-thumbs-gal')[0]) {
                    $('.wrap-top-single-product .wrap-thumbs-gal').slick({
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        vertical: true,
                        verticalSwiping: true,
                        focusOnSelect: true,
                        asNavFor: '.wrap-top-single-product .wrap-single-carousel',
                        prevArrow: '<span class="zoo-carousel-btn vertical-btn prev-item"><i class="cs-font clever-icon-up"></i></span>',
                        nextArrow: '<span class="zoo-carousel-btn  vertical-btn next-item "><i class="cs-font clever-icon-down"></i></span>',
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    vertical: false,
                                    arrows: false,
                                }
                            }
                        ]
                    });
                }
            }
            if ($('.zoo-single-product.horizontal-gallery .wrap-thumbs-gal')[0]||$('.zoo-single-product.center .wrap-thumbs-gal')[0]) {
                $('.zoo-single-product.horizontal-gallery .wrap-thumbs-gal, .zoo-single-product.center .wrap-thumbs-gal').slick({
                    focusOnSelect: true,
                    slidesToScroll: 1,
                    slidesToShow: 4,
                    swipe: true,
                    speed: 300,
                    rtl: $('body.rtl')[0] ? true : false,
                    asNavFor: '.wrap-top-single-product .wrap-single-carousel',
                    prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                    nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                });
            }
            var body_w = $('body').width();
            if(body_w <= 481 && $('.sticky.zoo-single-product')[0]){
                $('.wrap-single-carousel').slick({
                    slidesToScroll: 1,
                    slidesToShow: 1,
                    centerMode: false,
                    rtl: $('body.rtl')[0] ? true : false,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                    nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                dots: true
                            }
                        }
                    ]
                });
            }
        },

        zooZoom: function() {

            if ($('.zoo-product-zoom')[0]) {
                $('.zoo-product-zoom .woocommerce-main-image,#zoo-quickview-lb .woocommerce-main-image').ZooMove();
            }
        },

        zooCleverUpdateGallery: function() {

            $(document).bind('cleverswatch_update_gallery', function (event, response) {
                setTimeout(function () {
                    if (!$('#zoo-quickview-lb')[0]) {
                        if($('.zoo-product-zoom')[0]){
                            $('#product-' + response.product_id + ' .woocommerce-main-image').ZooMove();
                        }
                        clever.zooProductCarousel();
                    }
                    else {
                        clever.zooQvGal();
                        if($('.zoo-product-zoom')[0]){
                            $('#product-' + response.product_id + ' .woocommerce-main-image').ZooMove();
                        }
                    }
                }, 400);
            });
        },

        zooQTY: function() {

            $(document).on("click", '.quantity .qty-nav', function () {
                var parent = $(this).parents('.quantity').find('input.qty');
                var val = parseInt(parent.val());
                if ($(this).hasClass('increase')) {
                    parent.val(val + 1);
                }
                else {
                    if (val > 1) {
                        parent.val(val - 1);
                    }
                }
                parent.trigger('change');
            });
        },

        zooLoginForm: function() {

            $(document).on('click','.icon-user.login > a', function (e) {
                e.preventDefault();
                $('body').addClass('active-login-form');
                $('body').removeClass('active-login-error');
                });
            if($('.woocommerce-error')[0]){
                $('body').addClass('active-login-error');
            }
                
            $(document).on('click','.login-form-popup .close-login,.login-form-popup .overlay', function (e) {
                $('body').removeClass('active-login-form');
                $('body').removeClass('active-login-error');
            });
            $(document).on('click','.btn-show-register,.showlogin', function (e) {
                e.preventDefault();
                $('.login.form').slideUp();
                $('.register.form').slideDown();
               
            });
            $(document).on('click','.btn-show-login,.showlogin', function (e) {
                e.preventDefault();
                $('.login.form').slideDown();
                $('.register.form').slideUp();
                
            });
        },

        zooProductLightBox: function() {

            $(document).on('click', '.zoo-woo-lightbox', function (e) {
                e.preventDefault();
                var pswpElement = $('.pswp')[0],
                    items = $(this).zoogetGalleryItems(),
                    c_index = $(this).parent().index();
                if ($(this).parent().hasClass('slick-slide')) {
                    if ($('.carousel.zoo-single-product')[0]) {
                        var total_sl_active = $('.wrap-single-image .slick-active').length;
                        if (total_sl_active == 0) {
                            c_index = $(this).parent().index();
                        }
                        else {
                            c_index = $(this).parent().index() - total_sl_active - 1;
                        }
                    }
                    else {
                        c_index = $(this).parent().index() - 1;
                    }
                }
                var options = {
                    index: c_index,
                    shareEl: false,
                    closeOnScroll: false,
                    history: false,
                    hideAnimationDuration: 0,
                    showAnimationDuration: 0
                };
                // Initializes and opens PhotoSwipe.
                var photoswipe = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
                photoswipe.init();
            });
        },

        zooTab: function() {

            if ($('.zoo-product-tabs')[0]) {
                var tab_active, first_tab = $('.zoo-product-tabs .zoo-tabs li:first-child');
                first_tab.addClass('active');
                tab_active = first_tab.find('a').attr('href');
                $(tab_active).addClass('active');
            }
            $('.zoo-product-tabs .zoo-tabs a').on('click', function (e) {
                e.preventDefault();
                var tab = $(this).attr('href');
                $('.zoo-product-tabs .zoo-tabs .active').removeClass('active');
                $(this).parent().addClass('active');
                $(this).parents('.zoo-product-tabs').find('.zoo-custom-tab.active').removeClass('active');
                $(tab).addClass('active');
            });
            var tab_body = $('body').outerWidth();
            if(tab_body <= 481){
                $(document).on('click','.zoo-woo-tabs .tab-content .panel .tab-heading',function(){
                    $(this).parent().toggleClass('active');
                    $(this).parent().find(' > *:not(.tab-heading)').slideToggle();
                });
            }
        },

        setCookie: function(cname, cvalue) {

            document.cookie = cname + "=" + cvalue + "; ";
        },

        getCookie: function(cname) {

            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        },

        zooShopListGridLoad: function() {

            if($('.layout-control')[0]){
                $(document).on('click','.layout-control', function (e) {
                    e.preventDefault();
                    $('.layout-control.active').removeClass('active');
                    $(this).addClass('active');
                    if ($(this).hasClass('list-layout')) {
                        $('.products').removeClass('grid-layout').addClass('list-layout');
                    } else {
                        $('.products').removeClass('list-layout').addClass('grid-layout');
                    }
              
                });
            }
        },

        zooStickInParent: function() {

            if ($('.sticky.zoo-single-product')[0]) {
                var offset = 30;
                if ($('#zoo-header .sticky-wrapper')[0]) {
                    offset = $('#zoo-header .sticky-wrapper').height() + 30;
                }
                $('.wrap-right-single-product').stick_in_parent({
                    offset_top: offset,
                });
            }
        },

        zooAccordionTab: function() {

            if ($('.zoo-accordion')[0]) {
                $('.zoo-accordion .tab-content .zoo-group-accordion:first-child').addClass('accordion-active');
                $('.zoo-accordion .tab-content .zoo-group-accordion:not(.accordion-active)').find('.panel').slideUp();
                $('.zoo-accordion .tab-heading').on('click',function () {
                    if($(this).parent().hasClass('accordion-active')){
                        $(this).next().slideUp();
                        $(this).parent().removeClass('accordion-active');
                    }
                    else{
                        $(this).parents('.tab-content').find('.panel').slideUp();
                        $(this).parents('.tab-content').find('.accordion-active').removeClass('accordion-active');
                        $(this).next().slideDown();
                        $(this).parent().addClass('accordion-active');
                    }
                });
            }
        },

        zooShortcodeProductGroup: function() {

            if ($('.shortcode-product-carousel-group')[0]) {
                $('.shortcode-product-carousel-group  .wrap-carousel-products').slick({
                    slidesToShow: $('.shortcode-product-carousel-group').data('config')['columns'],
                    slidesToScroll: 1,
                    rtl: $('body.rtl')[0] ? true : false,
                    swipe: true,
                    prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                    nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                });
            }
        },

        //For resize

        zooSidebarStatusMobile: function() {

            if ($(window).width() < 769) {
                if ($('.zoo-woo-page')[0]) {
                    clever.setCookie('sidebar-status', '');
                    $('.disable-sidebar').removeClass('disable-sidebar');
                    $('.zoo-woo-sidebar').css('margin', '0');
                }
            }
        },

        zooSidebarToggleMobile: function() {

            if ($('.zoo-woo-page')[0]) {
                if ($('#primary').offset().left < 290) {
                    $('.zoo-woo-page.sidebar-onscreen').removeClass('sidebar-onscreen');
                }
                else {
                    $('.zoo-woo-page:not(.sidebar-onscreen)').addClass('sidebar-onscreen');
                }
            }
        },

        zooStickGalleryMobile: function() {

            if ($('.wrap-top-single-product')[0]) {
                if ($(window).width() < 768) {
                    $('.wrap-top-single-product.sticky .wrap-single-carousel:not(.slick-slider), .images-center.zoo-single-product .wrap-single-carousel').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        swipe: true,
                        rtl: $('body.rtl')[0] ? true : false,
                        prevArrow: '<span class="zoo-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                        nextArrow: '<span class="zoo-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                    });
                } else {
                    $('.wrap-top-single-product.sticky .wrap-single-carousel.slick-slider').slick('destroy');
                    $('.images-center.zoo-single-product .wrap-single-carousel.slick-slider').slick('destroy');
                }
            }
        },
        // Ajax load more
        LoadmoreAjax: function(wrap,item,path){
            if($('.zoo-woo-page')[0]){
            
                $(document).on('click','.view-more-button', function(e){
                    e.preventDefault();
                });
                
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
        },
    }

    jQuery.fn.extend({
        zooWooSmartLayout: function () {
            if ($(this)[0]) {
                $(this).each(function () {      
                    if(typeof $.fn.isotope !== 'undefined'){
                        $(this).isotope({
                            layoutMode: 'fitRows',
                        });
                    }              
                })
            }
        },
        zoogetGalleryItems: function () {
            var $slides = this.parents('.wrap-single-image').find('.woocommerce-main-image:not(.slick-cloned)'),
                items = [];
            if ($slides.length > 0) {
                $slides.each(function (i, el) {
                    var img = $(el).find('img'),
                        large_image_src = img.attr('data-large_image'),
                        large_image_w = img.attr('data-large_image_width'),
                        large_image_h = img.attr('data-large_image_height'),
                        item = {
                            src: large_image_src,
                            w: large_image_w,
                            h: large_image_h,
                            title: img.attr('title')
                        };
                    items.push(item);
                });
            }
            return items;
        },
        
    });


    // DOCUMENT READY
    $( document ).ready( function() {
        // Init funtions
        clever.go();
        
    });

    // WINDOWS LOAD
    $(window).load( function() {

    } );

    // WINDOWS RESIZE
    $(window).resize( function() {
        clever.zooSidebarStatusMobile();
        clever.zooSidebarToggleMobile();
        clever.zooStickGalleryMobile();
        
    } );
    
})(jQuery);
