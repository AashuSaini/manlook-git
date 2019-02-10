/**
 * Name: Product Ajax
 * Package: Clever VC Addon
 * Description: Main Product Ajax functions.
 * Version: 1.0.3
 * Author: ZooTemplate
 */

(function ($) {
    "use strict";
    var clever = {
        init: function () {
            var wrap = $('.cvca-products-wrap:not(.advanced-filter)');
            clever.zooWooFilterCatShortCode(wrap);
            clever.zooWooFilterAssetShortCode(wrap);
            clever.zooWooAdvancedFilterFunction();
            clever.zooWooToggleFilterFunction();
        },

        // Carousel
        zooCarousel: function (wrap_config, wrap_slider) {
            $(wrap_config).each(function () {
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
                if (wrap_slider) {
                    var wrapcaroul = wrap_slider;
                } else {
                    var wrapcaroul = $(wrap_config).find($(wrap).not('.ajax-loaded'));
                }

                wrapcaroul.slick({
                    slidesToShow: col_xl,
                    slidesToScroll: scroll > col_xl ? col_xl : scroll,
                    arrows: show_nav,
                    dots: show_pag,
                    prevArrow: '<span class="cvca-carousel-btn prev-item"><i class="cs-font clever-icon-arrow-left-1"></i></span>',
                    nextArrow: '<span class="cvca-carousel-btn next-item "><i class="cs-font clever-icon-arrow-right-1"></i></span>',
                    autoplay: autoplay,
                    autoplaySpeed: speed,
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
        },

        // Filter Categories
        zooWooFilterCatShortCode: function (wrap) {
            wrap.find('.cvca-list-product-category a').on('click', function (e) {
                e.preventDefault();
                wrap.find('.cat-selected').html($(this).text() + '<i class="cs-font clever-icon-down"></i>');
            });
            wrap.find('.cvca-ajax-load.filter-cate a').on('click', function (e) {
                e.preventDefault();
                var $this = $(this);
                wrap = $this.parents('.cvca-products-wrap');

                if ($this.hasClass('active')) {
                    return;
                }
                $this.parents('.cvca-ajax-load ').find('a').removeClass('active');
                $this.addClass('active');
                if ($this.hasClass('opened')) {
                    var cate = $this.data('value');
                    $this.parents('.cvca-products-wrap').find('.products').hide();
                    $this.parents('.cvca-products-wrap').find('.ajax-loaded').each(function () {
                        if ($(this).hasClass(cate)) {
                            $(this).show();
                            if (wrap.find('.cvca-wrap-products-sc').hasClass('cvca-carousel')) {
                                var wrap_slider = wrap.find('.cvca-carousel');
                                if ($(this).hasClass('slick-slider')) {
                                    $(this).slick('destroy');
                                    clever.zooCarousel(wrap_slider, $(this));
                                }
                                else {
                                    clever.zooCarousel(wrap_slider, $(this));
                                }
                            }
                        }
                    });
                    return;
                }

                $this.addClass('opened');
                wrap.find('.cvca-wrap-products-sc').addClass('loading');
                var link = $this.attr('href');
                var title = $this.attr('title');
                var data = wrap.data('args');
                data['action'] = 'cvca_ajax_product_filter';
                if ($this.data('type') == 'product_cat') {
                    data['product_attribute'] = [];
                    data['attribute_value'] = [];
                    data['product_tag'] = '';
                    data['filter_categories'] = $this.data('value');
                    data['show'] = '';
                }

                wrap.data('original', data);
                wrap.data('args', data);
                wrap.data($this.data('value'), data);
                $.ajax({
                    url: wrap.data('url'),
                    data: data,
                    type: 'POST',
                }).success(function (response) {
                    $(document.body).trigger('cvca_woo_after_cat_filter', {
                        'response': response,
                        'wrap': wrap,
                        'cate_name': data['filter_categories'],
                    });


                }).error(function (ex) {
                    console.log(ex);
                });
            });
        },
        zooWooFilterAssetShortCode: function (wrap) {

            wrap.find('.cvca-ajax-load.filter-asset a').on('click', function (e) {
                e.preventDefault();
                var $this = $(this);
                if ($this.hasClass('active')) {
                    return;
                }
                wrap = $this.parents('.cvca-products-wrap');
                $this.parents('.cvca-ajax-load ').find('a').removeClass('active');
                $this.addClass('active');

                if ($this.hasClass('opened')) {
                    var asset_type = $this.data('value');
                    $this.parents('.cvca-products-wrap').find('.products').hide();
                    $this.parents('.cvca-products-wrap').find('.ajax-loaded').each(function () {
                        if ($(this).hasClass(asset_type)) {
                            $(this).show();
                            if (wrap.find('.cvca-wrap-products-sc').hasClass('cvca-carousel')) {
                                var wrap_slider = wrap.find('.cvca-carousel');
                                if ($(this).hasClass('slick-slider')) {
                                    $(this).slick('destroy');
                                    clever.zooCarousel(wrap_slider, $(this));
                                }
                                else {
                                    clever.zooCarousel(wrap_slider, $(this));
                                }

                            }
                        }
                    });
                    return;
                }
                $this.parents('.cvca-products-wrap').find('.cvca-wrap-products-sc').addClass('loading');
                $this.addClass('opened');
                var asset_type = $this.attr('data-value');
                var data;
                var data_args = $.parseJSON(wrap.attr('data-args'));
                data = {
                    action: 'cvca_ajax_product_filter',
                    asset_type: asset_type,
                    col_width: data_args['col_width'],
                    col_width_medium: data_args['col_width_medium'],
                    col_width_small: data_args['col_width_small'],
                    filter: data_args['filter'],
                    filter_categories: data_args['filter_categories'],
                    posts_per_page: data_args['posts_per_page'],
                    pagination: data_args['pagination'],
                    orderby: data_args['orderby'],
                };
                $.ajax({
                    url: ajaxurl,
                    data: data,
                    type: "POST",
                }).success(function (response) {
                    $(document.body).trigger('cvca_woo_after_filter_asset_type', {
                        'response': response,
                        'wrap': wrap,
                        'asset_type': data['asset_type'],
                    });
                }).error(function (ex) {
                    console.log(ex);
                });
            });
        },
        zooWooAdvancedFilterFunction: function () {
            var wrap = $('.cvca-products-wrap.advanced-filter');
            //Search Function
            $(document).on('click', '.cvca-products-wrap.advanced-filter .cvca_search_button', function () {
                var search = $(this).prev().val();
                var search_button = $(this);
                $.ajax({
                    url: wrap.data('url'),
                    data: {action: 'cvca_ajax_product_filter', cvca_search: search},
                    type: 'POST',
                }).success(function (response) {
                    search_button.parent().next().html(response);
                });
            });
            wrap.find('.cvca-list-product-category a').on('click', function (e) {
                e.preventDefault();
                wrap.find('.cat-selected').html($(this).text() + '<i class="cs-font clever-icon-down"></i>');
            });
            wrap.find('.cvca-ajax-load a, .cvca-remove-attribute').on('click', function (e) {
                e.preventDefault();
                var $this = $(this);
                wrap = $this.parents('.cvca-products-wrap');
                wrap.addClass('loading');
                var link = $this.attr('href');
                var title = $this.attr('title');
                var data = wrap.data('args');
                data['action'] = 'cvca_ajax_product_filter';
                if ($this.hasClass('cvca-product-attribute')) {
                    if (typeof data['product_attribute'] == 'object' && !$this.hasClass('active')) {
                        data['product_attribute'].push($this.data('value'));
                        data['attribute_value'].push($this.data('attribute_value'));
                    } else {
                        data['product_attribute'] = [];
                        data['attribute_value'] = [];
                    }
                } else {
                    data[$this.data('type')] = $this.data('value');
                }
                data['paged'] = 1;
                if ($this.data('type') == 'product_cat') {
                    data['product_attribute'] = [];
                    data['attribute_value'] = [];
                    data['product_tag'] = '';
                    data['filter_categories'] = $this.data('value');
                    data['show'] = '';
                }
                if ($this.data('type') == 'cvca-reset-filter') {
                    data['product_attribute'] = [];
                    data['attribute_value'] = [];
                    data['product_tag'] = '';
                    data['filter_categories'] = wrap.data('categories');
                    data['show'] = '';
                    data['price_filter'] = 0;
                    $('.wrap-content-product-filter ').find('.active').removeClass('active');
                }

                if ($this.data('type') == 'cvca-remove-attr') {
                    var product_attribute = $this.next().data('value');
                    var attribute_value = $this.next().data('attribute_value');
                    var index = data['attribute_value'].indexOf(attribute_value);
                    if (index > -1) {
                        data['attribute_value'].splice(index, 1);
                        data['product_attribute'].splice(index, 1);
                    }
                }

                if ($this.data('type') == 'cvca-remove-price') {
                    data['price_filter'] = 0;
                }
                var keyword = $('input[name="s"]').val();
                if (keyword != '') {
                    data['s'] = keyword;
                }
                if ($this.hasClass('active') && $this.data('type') != 'cvca-reset-filter') {
                    if ($this.data('type') == 'product_cat') {
                        data['filter_categories'] = wrap.data('categories');
                        $this.parents('.cvca-list-product-category').find('li:first-child a').addClass('active');
                    } else {
                        data[$this.data('type')] = '';
                    }
                    $this.removeClass('active');
                } else {
                    $this.parents('.cvca-ajax-load ').find('.active').removeClass('active');
                    $this.addClass('active');
                }
                wrap.data('original', data);
                wrap.data('args', data);
                $.ajax({
                    url: wrap.data('url'),
                    data: data,
                    type: 'POST',
                }).success(function (response) {
                    $(document.body).trigger('cvca_woo_after_filter', {
                        "response": response,
                        "wrap": wrap,
                        "max_page": $(response).find('.cvca_ajax_load_more_button').data('maxpage'),
                        'current_page': data['paged']
                    });
                }).error(function (ex) {
                    console.log(ex);
                });
            });
            //Ajax loadmore
            $(document).on('click', '.cvca-products-wrap.advanced-filter .cvca_ajax_load_more_button', function (e) {
                e.preventDefault();
                if (!$(this).hasClass('disable')) {
                    var base = $(this).parents('.cvca-products-wrap');
                    var wrap = base;
                    var data = base.data('args');
                    $(this).addClass('cvca-loading');
                    var max_page = $(this).data('maxpage');
                    if (data['paged'] < max_page) {
                        data['action'] = 'cvca_ajax_product_filter';
                        data['paged'] = parseInt(data['paged']) + parseInt(1);
                        $.ajax({
                            url: $(this).attr('href'),
                            data: data,
                            type: 'POST',
                        }).success(function (response) {
                            $(document.body).trigger('cvca_woo_after_loadmore', {
                                "response": $(response).find('.products').html(),
                                "wrap": wrap,
                                "max_page": max_page,
                                'current_page': data['paged']
                            });
                        }).error(function (ex) {
                            console.log(ex);
                        });
                    }
                }
            });
        },
        zooWooToggleFilterFunction: function () {
            $('.wrap-head-product-filter .cvca-toogle-filter').on('click', function () {
                $(this).toggleClass('active');
                $('.cvca-wrap-adv-filter').slideToggle();
            })
            //Mobile control
            $('.cvca-title-filter-item').on('click', function (e) {
                e.preventDefault();
                if ($(window).width() < 769) {
                    $(this).next().slideToggle();
                }
            });
            $('.cvca-ajax-load').parent().addClass('tab');
            $('.wrap-head-product-filter-inner.tab').on('click', function () {
                if ($(window).width() < 769 ) {
                    $(this).toggleClass('active');
                    $(this).find('.cvca-ajax-load').slideToggle();
                }
            });
        }

    }

    // DOCUMENT READY
    $(document).ready(function () {
        // Init funtions
        clever.init();

    });

    // WINDOWS LOAD
    $(window).load(function () {

    });

    // WINDOWS RESIZE
    $(window).resize(function () {

    });

    // Binding ajax filter by simple category.
    $(document.body).bind('cvca_woo_after_cat_filter', function (event, data) {

        var wrap = data.wrap,
            cate_name = data.cate_name;
        wrap.find('.cvca-wrap-products-sc').removeClass('loading');
        wrap.find('.products:not(.ajax-loaded)').show();
        wrap.find('.products.all').hide();
        wrap.find('.products.ajax-loaded').hide();
        wrap.find('.products').not('.ajax-loaded').remove();
        var append_class = 'products grid-layout';
        if (wrap.find('.cvca-wrap-products-sc').hasClass('cvca-carousel')) {
            append_class += ' carousel middle-nav ';
            wrap.find('.append-class').append('<ul class=" ' + append_class + ' ' + '">' + $(data.response).html() + '</ul>');
            var wrap_slick = wrap.find('.cvca-carousel');
            clever.zooCarousel(wrap_slick, null);
        }
        else {
            wrap.find('.append-class').append('<ul class=" ' + append_class + ' ' + '">' + $(data.response).html() + '</ul>');
        }
        append_class += ' ajax-loaded ';
        wrap.find('.products').parents('.append-class').append('<ul class=" ' + append_class + cate_name + '" style="display: none">' + $(data.response).html() + '</ul>');
        
    });
    // Binding ajax filter by asset type.
    $(document.body).bind('cvca_woo_after_filter_asset_type', function (event, data) {
        var wrap = data.wrap,
            asset_type = data.asset_type;

        wrap.find('.cvca-wrap-products-sc').removeClass('loading');
        wrap.find('.products:not(.ajax-loaded)').show();
        wrap.find('.products.ajax-loaded').hide();
        wrap.find('.products').not('.ajax-loaded,.deal').remove();
        var append_class = 'products grid-layout';
        if (wrap.find('.cvca-wrap-products-sc').hasClass('cvca-carousel')) {
            append_class += ' carousel middle-nav ';
            wrap.find('.append-class').append('<ul class=" ' + append_class + ' ' + '">' + $(data.response).html() + '</ul>');
            var wrap_slick = wrap.find('.cvca-carousel');
            clever.zooCarousel(wrap_slick, null);
        }
        else {
            wrap.find('.append-class').append('<ul class=" ' + append_class + ' ' + '">' + $(data.response).html() + '</ul>');
        }
        append_class += ' ajax-loaded ';
        wrap.find('.products').parents('.append-class').append('<ul class=" ' + append_class + asset_type + '" style="display: none">' + $(data.response).html() + '</ul>');
        
    });
    //Add new item after click loadmore
    $(document.body).bind('cvca_woo_after_loadmore', function (event, data) {
        var wrap = data.wrap;
        var max_page = data.max_page;
        var $products = $(data.response);
        if (!!wrap.find('.products').data('zoo-config')['highlight_featured']) {

            wrap.find('.products').append($products).isotope('appended', $products);
        } else {
            wrap.find('.products').append($products);
        }
        if (wrap.find('.lazy-img.wp-post-image:not(.loaded)')[0]) {
            wrap.find('.lazy-img.wp-post-image:not(.loaded)').lazyload({
                effect: 'fadeIn',
                threshold: $(window).height(),
                load: function () {
                    $(this).parent().removeClass('loading');
                    $(this).addClass('loaded');
                }
            });
        }
        if (max_page == data.current_page) {
            wrap.find('.cvca_ajax_load_more_button').addClass('disable').html(wrap.find('.cvca_ajax_load_more_button').data('empty'));
        } else {
            wrap.find('.cvca_ajax_load_more_button').show();
        }
        wrap.find('.cvca_ajax_load_more_button').removeClass('cvca-loading');
    });
    //Replace old html by new data after filter
    $(document.body).bind('cvca_woo_after_filter', function (event, data) {
        var wrap = data.wrap;
        var max_page = data.max_page;
        var $products = $(data.response).find('.product');
        if (!$products[0]) {
            wrap.find('.products').html('<h3 class="products-emt">' + wrap.data('empty') + '</h3>');
        } else {
            if (!!wrap.find('.products').data('zoo-config')['highlight_featured']) {
                wrap.find('.products').isotope('remove', wrap.find('.product')).append($products).isotope('appended', $products).isotope('layout');
            } else {
                wrap.find('.products').html($products);
            }
            if (wrap.find('.lazy-img.wp-post-image:not(.loaded)')[0]) {
                wrap.find('.lazy-img.wp-post-image:not(.loaded)').lazyload({
                    effect: 'fadeIn',
                    threshold: $(window).height(),
                    load: function () {
                        $(this).parent().removeClass('loading');
                        $(this).addClass('loaded');
                    }
                });
            }
        }
        //Update button loadmore
        if (wrap.find('.cvca_ajax_load_more_button')[0]) {
            if (max_page == data.current_page || !(!!max_page)) {
                wrap.find('.cvca_ajax_load_more_button').addClass('disable').html(wrap.find('.cvca_ajax_load_more_button').data('empty'));
            } else {
                wrap.find('.cvca_ajax_load_more_button').data('maxpage', max_page);
            }
        }
        wrap.removeClass('loading');
    });
})(jQuery);
