(function($){
    "use strict";
    jQuery(document).ready(function(){
        $('.wrap-icon-cart, .mask-close, .close').live('click',function (e) {
            e.preventDefault();
            zoo_CartVisible();
        })
        function zoo_CartVisible() {
            $('body').toggleClass('cart-active');
        }
    if ( typeof wc_add_to_cart_params === 'undefined' ) {
        return false;
    }
    //Ajax Remove Cart ===================================
    $(document).on( 'click', '.mini_cart_item .remove', function (event) {
        event.preventDefault();
        $(this).addClass('loading');
        
    });
    //Ajax CW Add Cart ===================================
    $(document).bind('cleverswatch_before_add_to_cart', function () {
           zoo_CartVisible();
           $('.wrap-mini-cart').addClass('loading');
       });
    //Ajax Add to Cart ===================================
    $(document).on('click', '.add_to_cart_button:not(.product_type_variable)', function () {
        zoo_CartVisible();
        $('.wrap-mini-cart').addClass('loading');
    });
    
    
    //Update mini top cart ajax
    $(document).bind('added_to_cart',function (event, fragments, cart_hash, $button ) {
        var $fragments=$(fragments['.top-cart']);
        $fragments=$fragments.find('.top-cart-total');
        $('.mini-top-cart .top-cart-total').replaceWith($fragments);
        $('#top-cart-mobile .top-cart-total').replaceWith($fragments);
    });
    //Ajax Add to Cart Detail ===================================
    $(document).on('click', '.product:not(.product-type-external) button.single_add_to_cart_button', function (event) {
        event.preventDefault();
        zoo_CartVisible();
        $('.wrap-mini-cart').addClass('loading');
        $('.zoo-quickview-mask').css('opacity','0');
        $('#zoo-quickview-lb').css({'top':'calc(50% + 150px)','opacity':'0'});
        setTimeout(function () {
            $('#zoo-quickview-lb').remove();
            $('.zoo-quickview-mask').remove();
        },500);
        var $this = $(this);
        var $productForm = $this.closest('form');
        var data = {
            product_id: $productForm.find("*[name*='add-to-cart']").val(),
            product_variation_data: $productForm.serialize()
        };
        if (!data.product_id) {
            console.log('(Error): No product id found');
            return;
        }
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '?add-to-cart=' + data.product_id + '& ajax-add-to-cart=1',
            data: data.product_variation_data,
            cache: false,
            headers: {'cache-control': 'no-cache'},
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log('AJAX error - SubmitForm() - ' + errorThrown);
            },
            success: function (response) {
                var $response = $(response),
                    $shopNotices = $response.find('.woocommerce-message') // Shop notices
//                    Get replacement elements/values
                var fragments = {
                    '.top-cart .top-cart-total': $response.find('.top-cart .top-cart-total'), // Header menu cart count
                    '#mini-top-cart .top-cart-total': $response.find('#mini-top-cart .top-cart-total'), // Header menu cart count
                    '#top-cart-mobile .top-cart-total': $response.find('#top-cart-mobile .top-cart-total'), // Header menu cart count
                    '.sticky-cart .top-cart-total': $response.find('.sticky-cart .top-cart-total'), // Header menu cart count
                    '.total-cart': $response.find('.total-cart'), // Header menu cart count
                    '.woocommerce-message': $shopNotices,
                    '.wrap-mini-cart': $response.find('.wrap-mini-cart') // Widget panel mini cart
                };
                // Replace elements
                $.each(fragments, function (selector, $element) {
                    if ($element.length) {
                        $(selector).replaceWith($element);
                    }
                });
                $('.wrap-mini-cart').removeClass('loading');
            }
        });
        return false;
    });
})})(jQuery);