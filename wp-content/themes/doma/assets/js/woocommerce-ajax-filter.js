(function($) {
    'use strict';
    var clever = clever || {};
    clever.init = function() {
        clever.$body = $(document.body),
        clever.ajaxXHR = null,
        this.paginationAjax();
        this.filterAjax();
    };

    clever.setCookie = function(cname, cvalue) {

        document.cookie = cname + "=" + cvalue + "; ";
    },

    clever.getCookie = function(cname) {

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
    // Ajax load more
    clever.LoadmoreAjax = function(wrap,item,path){
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
    };
    // Get price js slider
    clever.priceSlider = function() {
        // woocommerce_price_slider_params is required to continue, ensure the object exists
        if ( typeof woocommerce_price_slider_params === 'undefined' ) {
            return false;
        }

        if ( $('.catalog-sidebar').find('.widget_price_filter').length <= 0 ) {
            return false;
        }

        // Get markup ready for slider
        $('input#min_price, input#max_price').hide();
        $('.price_slider, .price_label').show();

        // Price slider uses jquery ui
        var min_price = $('.price_slider_amount #min_price').data('min'),
            max_price = $('.price_slider_amount #max_price').data('max'),
            current_min_price = parseInt(min_price, 10),
            current_max_price = parseInt(max_price, 10);

        if ( $('.price_slider_amount #min_price').val() != '' ) {
            current_min_price = parseInt($('.price_slider_amount #min_price').val(), 10);
        }
        if ( $('.price_slider_amount #max_price').val() != '' ) {
            current_max_price = parseInt($('.price_slider_amount #max_price').val(), 10);
        }

        $(document.body).bind('price_slider_create price_slider_slide', function(event, min, max) {
            if ( woocommerce_price_slider_params.currency_pos === 'left' ) {

                $('.price_slider_amount span.from').html(woocommerce_price_slider_params.currency_symbol + min);
                $('.price_slider_amount span.to').html(woocommerce_price_slider_params.currency_symbol + max);

            } else if ( woocommerce_price_slider_params.currency_pos === 'left_space' ) {

                $('.price_slider_amount span.from').html(woocommerce_price_slider_params.currency_symbol + ' ' + min);
                $('.price_slider_amount span.to').html(woocommerce_price_slider_params.currency_symbol + ' ' + max);

            } else if ( woocommerce_price_slider_params.currency_pos === 'right' ) {

                $('.price_slider_amount span.from').html(min + woocommerce_price_slider_params.currency_symbol);
                $('.price_slider_amount span.to').html(max + woocommerce_price_slider_params.currency_symbol);

            } else if ( woocommerce_price_slider_params.currency_pos === 'right_space' ) {

                $('.price_slider_amount span.from').html(min + ' ' + woocommerce_price_slider_params.currency_symbol);
                $('.price_slider_amount span.to').html(max + ' ' + woocommerce_price_slider_params.currency_symbol);

            }

            $(document.body).trigger('price_slider_updated', [min, max]);
        });
        if ( typeof $.fn.slider !== 'undefined' ) {
            $('.price_slider').slider({
                range  : true,
                animate: true,
                min    : min_price,
                max    : max_price,
                values : [current_min_price, current_max_price],
                create : function() {

                    $('.price_slider_amount #min_price').val(current_min_price);
                    $('.price_slider_amount #max_price').val(current_max_price);

                    $(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
                },
                slide  : function(event, ui) {

                    $('input#min_price').val(ui.values[0]);
                    $('input#max_price').val(ui.values[1]);

                    $(document.body).trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
                },
                change : function(event, ui) {

                    $(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
                }
            });
        }
    };
    // Loading Ajax
    clever.paginationAjax = function() {
        // Shop Page
        clever.$body.on('click', '.woocommerce-pagination a', function(e) {
            e.preventDefault();
            if ( $(this).data('requestRunning') ) {
                return;
            }
            $('#content-product').addClass('loading');
            $('html, body').animate({
                scrollTop: $("#main-page").offset().top
            }, 1000);
            $(this).data('requestRunning', true);
            var $products = $(this).closest('.woocommerce-pagination').prev('.products'),
                $pagination = $(this).closest('.woocommerce-pagination');
            $.get(
                $(this).attr('href'),
                function(response) {
                    
                    $('#content-product .products').replaceWith($(response).find('#content-product .products'));
                    var $pagination_html = $(response).find('.woocommerce-pagination').html();
                    $('.woocommerce-result-count').html($(response).find('.woocommerce-result-count').html());
                    $pagination.html($pagination_html);
                    $(document.body).trigger('clever_shop_ajax_loading_success');
                    $('#content-product').removeClass('loading');
                }
            );
        });
    };
    // Filter Ajax
    clever.filterAjax = function() {

        if ( !$('.zoo-woo-sidebar').hasClass('catalog-sidebar') ) {
            return;
        }
        $(document.body).on('price_slider_change', function(event, ui) {
            $('#content-product').addClass('loading');
            $('body').removeClass('sidebar-active');
            $('html, body').animate({
                scrollTop: $("#main-page").offset().top
            }, 1000);     
            var form = $('.price_slider').closest('form').get(0),
                $form = $(form),
                url = $form.attr('action') + '?' + $form.serialize();
            $(document.body).trigger('clever_widget_ajax_filter', url, $(this));
        });
        clever.$body.find('.catalog-sidebar').on('click', 'li:not(.current-cat) a,li:not(.chosen) a', function(e) {
            e.preventDefault();
            $('.catalog-sidebar a').removeClass('active');
            $('#content-product').addClass('loading');
            $('body').removeClass('sidebar-active'); 
            $('html, body').animate({
                scrollTop: $("#main-page").offset().top
            }, 1000);
            var url = $(this).attr('href');
            $(document.body).trigger('clever_widget_ajax_filter', url, $(this));
        });
        clever.$body.find('.catalog-sidebar').on('click', 'li.current-cat a', function(e) {
            e.preventDefault();
            $('#content-product').addClass('loading');
            $('body').removeClass('sidebar-active');
            $('html, body').animate({
                scrollTop: $("#main-page").offset().top
            }, 1000);       
            var url = $('.products').data('shoplink');
            $(document.body).trigger('clever_widget_ajax_filter', url, $(this));
        });
        $(document.body).on('clever_widget_ajax_filter', function(e, url, element) {
            var $container_replace = $('#content-product'),
                $container_catalog = $('.catalog-sidebar'),
                $container_result_count = $('.woocommerce-result-count');
            if ( '?' == url.slice(-1) ) {
                url = url.slice(0, -1);
            }
            url = url.replace(/%2C/g, ',');
            history.pushState(null, null, url);
            $(document.body).trigger('clever_ajax_filter_before_send_request', [url, element]);
            if ( clever.ajaxXHR ) {
                clever.ajaxXHR.abort();
            }
            clever.ajaxXHR = $.get(url, function(res) {
                $container_replace.replaceWith($(res).find('#content-product'));
                $container_catalog.html($(res).find('.catalog-sidebar').html());
                $container_result_count.html($(res).find('.woocommerce-result-count').html());

                var layout = clever.getCookie('product-layout');
                if (layout == 'list') {
                    $('.products').removeClass('grid').addClass('list');
                } 
                else {
                    $('.products').removeClass('list').addClass('grid');
                }
                clever.setCookie('product-layout', layout);
                // Sidebar title toggle
                $('.widget.woocommerce .widget-title').on('click',function(){
                    $(this).toggleClass('on');
                    $(this).next().slideToggle();
                });
                $('#content-product').removeClass('loading');
                if($('.woocommerce.widget')[0]){
                    $('.woocommerce.widget').each( function() {
                        var height_ul = $(this).find('ul').outerHeight();
                        if(height_ul >= 250){
                            $(this).find('ul').addClass('scroll');
                        }
                    });
                }
                clever.priceSlider();
                clever.LoadmoreAjax('.wrap-product-page .products','.product','a.next.page-numbers');
                $(document.body).trigger('clever_ajax_filter_request_success', [res, url]);
            }, 'html');
        });

    };
    $(function() {
        clever.init();
    });

})(jQuery);