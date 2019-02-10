<?php
/**
 * Import customize style
 *
 * @return Css inline at header.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
// Render css customize
add_action('wp_enqueue_scripts', 'zoo_enqueue_render', 1000);
// Enqueue scripts for theme.
if (!function_exists('zoo_enqueue_render')) {
    function zoo_enqueue_render()
    {
        // Load custom style
        wp_add_inline_style('doma', zoo_customize_style());
        if (get_theme_mod('zoo_custom_js') != '') {
            wp_add_inline_script('doma', zoo_customize_js());
        }
    }
}
if (!function_exists('zoo_customize_js')) {
    function zoo_customize_js()
    {
        $zoo_script = '';
        if (get_theme_mod('zoo_custom_js') != '') {
            $zoo_script = get_theme_mod('zoo_custom_js');
        }
        return $zoo_script;
    }
}
if (!function_exists('wpb_add_google_fonts')) {
    function wpb_add_google_fonts() {

        $zoo_fonts = array();

        if(get_post_meta(get_the_ID(),'zoo_typo_body_font',true) != 'Inherit'){
            $zoo_fonts[] = get_post_meta(get_the_ID(),'zoo_typo_body_font',true);
        }
        else{
            $zoo_fonts[] = get_theme_mod('zoo_typo_body_font',array('font-family' => 'Roboto'));
        }
        if(get_post_meta(get_the_ID(),'zoo_typo_heading_font',true) != 'Inherit'){
            $zoo_fonts[] = get_post_meta(get_the_ID(),'zoo_typo_heading_font',true);
        }
        else{
            $zoo_fonts[] = get_theme_mod('zoo_typo_heading_font',array('font-family' => 'Exo'));
        }
        $zoo_fonts[] = get_theme_mod('zoo_typo_main_menu',array('font-family' => 'Exo'));
        $zoo_fonts[] = get_theme_mod('zoo_typo_sub_menu',array('font-family' => 'Exo'));
        $zoo_fonts[] = get_theme_mod('zoo_typo_footer_title',array('font-family' => 'Exo'));
        $zoo_fonts[] = get_theme_mod('zoo_typo_blog_archive_title',array('font-family' => 'Exo'));
        $zoo_fonts[] = get_theme_mod('zoo_typo_blog_single_title',array('font-family' => 'Exo'));
        $zoo_fonts[] = get_theme_mod('zoo_typo_blog_sidebar_title',array('font-family' => 'Exo'));
        $zoo_fonts[] = get_theme_mod('zoo_typo_woo_price',array('font-family' => 'Exo'));
        $zoo_fonts[] = get_theme_mod('zoo_typo_woo_shop_title',array('font-family' => 'Roboto'));
        $zoo_fonts[] = get_theme_mod('zoo_typo_woo_single_title',array('font-family' => 'Exo'));

        wp_enqueue_style( 'theme-google-fonts', 
            zoo_import_fonts($zoo_fonts), 
            false ); 
    }
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

function zoo_customize_style()
{
    /* ----------------------------------------------------------
                                Typography
                        All typography must add here
    ---------------------------------------------------------- */  
    $navigation_font = get_theme_mod('zoo_typo_main_menu', array('font-family' => 'Exo', 'variant' => '600','subsets' => array(),'text-transform' => 'uppercase', 'font-size' => '14','line-height' => '1.5','letter-spacing' => '0','color' => '#282828'));
    $sub_nav_font = get_theme_mod('zoo_typo_sub_menu', array('font-family' => 'Exo','subsets' => array(),'text-transform' => 'none', 'font-size' => '14','line-height' => '1.5','letter-spacing' => '0'));
    $footer_title = get_theme_mod('zoo_typo_footer_title', array('font-family' => 'Exo', 'variant' => '600','subsets' => array(),'text-transform' => 'uppercase','line-height' => '1.5','font-size' => '15','letter-spacing' => '0','color' => '#111111'));
    $archive_title = get_theme_mod('zoo_typo_blog_archive_title', array('font-family' => 'Exo', 'variant' => '600','subsets' => array(),'text-transform' => 'none', 'font-size' => '30','line-height' => '1.5','letter-spacing' => '0','color' => '#111111'));
    $sidebar_title = get_theme_mod('zoo_typo_blog_sidebar_title', array('font-family' => 'Exo', 'variant' => '600','subsets' => array(),'text-transform' => 'none', 'font-size' => '24','line-height' => '1.5','letter-spacing' => '0','color' => '#111111'));
    $woo_price = get_theme_mod('zoo_typo_woo_price', array('font-family' => 'Exo', 'variant' => '400','subsets' => array(),'text-transform' => 'none', 'font-size' => '16','line-height' => '1.5','letter-spacing' => '0','color' => '#959595'));
    $woo_title = get_theme_mod('zoo_typo_woo_shop_title', array('font-family' => 'Roboto', 'variant' => '400','subsets' => array(),'text-transform' => 'none', 'font-size' => '14','line-height' => '1.5','letter-spacing' => '0','color' => '#111111'));
    $woo_single_title = get_theme_mod('zoo_typo_woo_single_title', array('font-family' => 'Exo', 'variant' => '900','subsets' => array(),'text-transform' => 'none', 'font-size' => '34','line-height' => '1.5','letter-spacing' => '0','color' => '#252525'));
    $zoo_opt_typo_body_font = get_post_meta(get_the_ID(),'zoo_typo_body_font',true);

    if( $zoo_opt_typo_body_font != 'Inherit' && $zoo_opt_typo_body_font != null ){
        $body_font['font-family'] = $sub_nav_font['font-family'] = get_post_meta(get_the_ID(),'zoo_typo_body_font',true);
    }
    else{
        $body_font = get_theme_mod('zoo_typo_body_font', array('font-family' => 'Roboto', 'variant' => '400','subsets' => array(),'text-transform' => 'none', 'font-size' => '16','line-height' => '1.5','letter-spacing' => '0','color' => '#7d7d7d'));
    }
    $zoo_opt_typo_heading_font = get_post_meta(get_the_ID(),'zoo_typo_heading_font',true);
    if( $zoo_opt_typo_heading_font != 'Inherit' && $zoo_opt_typo_heading_font != null ){
        $heading_font['font-family'] = $woo_price['font-family'] = $navigation_font['font-family'] = $woo_title['font-family'] = $woo_single_title['font-family'] = $footer_title = get_post_meta(get_the_ID(),'zoo_typo_heading_font',true);

    }
    else{
        $heading_font = get_theme_mod('zoo_typo_heading_font', array('font-family' => 'Exo', 'variant' => '600','subsets' => array(),'text-transform' => 'none','line-height' => '1.5','letter-spacing' => '0','color' => '#111111'));
    }

    $css = '';

    /* ----------------------------------------------------------
                           Load Font
    ---------------------------------------------------------- */
    $css .= "html{";
    if (isset($body_font['font-size'])) {
        $css .= "font-size: {$body_font['font-size']}px;";
    }
    else{
        $css .= "font-size: 16px;";
    }
    $css .= "}";
    /*Site width*/
    $zoo_site_width = get_theme_mod('zoo_site_width', '1200');
    if (is_page() && get_post_meta(get_the_ID(), 'zoo_site_width', true) != '') {
        $zoo_site_width = get_post_meta(get_the_ID(), 'zoo_site_width', true);
    }
    $css .= '@media(min-width:1200px){.container{max-width:' . $zoo_site_width . 'px;width:100%}}';
    /*Logo Padding*/
    $zoo_main_header_padding_top = get_theme_mod('zoo_main_header_padding_top', '15');
    $zoo_main_header_padding_bottom = get_theme_mod('zoo_main_header_padding_bottom', '15');
    
    $zoo_main_header_padding_top = get_post_meta(get_the_ID(), 'zoo_main_header_padding_top', true) != '' ? get_post_meta(get_the_ID(), 'zoo_main_header_padding_top', true) : $zoo_main_header_padding_top;
    $zoo_main_header_padding_bottom = get_post_meta(get_the_ID(), 'zoo_main_header_padding_bottom', true) != '' ? get_post_meta(get_the_ID(), 'zoo_main_header_padding_bottom', true) : $zoo_main_header_padding_bottom;
    
    $css .= " #site-branding{padding-top:" . $zoo_main_header_padding_top . "px;padding-bottom:" . $zoo_main_header_padding_bottom . "px;}";
    if(get_theme_mod('zoo_logo_height','')!='') {
        $css .= "#logo img{height:" . get_theme_mod('zoo_logo_height', '') . "px}";
    }
    /*Site bg*/
    $zoo_bg = get_theme_mod('zoo_site_background_color', '');
    $zoo_bg_img = get_theme_mod('zoo_site_background_image', '');
    if (is_single() || is_page()) {
        if (get_post_meta(get_the_ID(), 'zoo_page_bg_color', true) != '') {
            $zoo_bg = get_post_meta(get_the_ID(), 'zoo_page_bg_color', true);
        }
        if (get_post_meta(get_the_ID(), 'zoo_page_bg', true) != '') {
            $zoo_bg_img = get_post_meta(get_the_ID(), 'zoo_page_bg', true);
            $zoo_bg_img = wp_get_attachment_url($zoo_bg_img);
        }
    }
    if ($zoo_bg_img != '') {
        $zoo_bg .= ' url("' . $zoo_bg_img . '") ' . get_theme_mod('zoo_site_background_position', 'bottom center') . '/' . get_theme_mod('zoo_site_background_size', 'contain') . ';';
        $zoo_bg .= ' background-repeat:' . get_theme_mod('zoo_site_background_repeat', 'no-repeat') . ';';
        $zoo_bg .= ' background-attachment:' . get_theme_mod('zoo_site_background_attachment', 'inherit') . ';';
    }
    if($zoo_bg){
        $css .= 'body, body.boxes-page{background:' . $zoo_bg . '}';
    }
    
    /*Typography generate Css*/
    $css .= zoo_generate_font("#top-header,.cvca-shortcode-banner.style-1 .banner-content .banner-media-link,.cvca-shortcode-banner.style-4 .banner-media-link,.cvca-shortcode-banner.style-2 .banner-content .banner-media-link", $heading_font);
    $css .= zoo_generate_font('body', $body_font);
    /* Heading font */
    $css .= zoo_generate_font("h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6,.heading-font", $heading_font);
    $css .= zoo_generate_font_size('h1, .h1', get_theme_mod('zoo_typo_heading_size_h1', '34'));
    $css .= zoo_generate_font_size('h2, .h2', get_theme_mod('zoo_typo_heading_size_h2', '30'));
    $css .= zoo_generate_font_size('h3, .h3', get_theme_mod('zoo_typo_heading_size_h3', '24'));
    $css .= zoo_generate_font_size('h4, .h4', get_theme_mod('zoo_typo_heading_size_h4', '21'));
    $css .= zoo_generate_font_size('h5, .h5', get_theme_mod('zoo_typo_heading_size_h5', '18'));
    $css .= zoo_generate_font_size('h6, .h6', get_theme_mod('zoo_typo_heading_size_h6', '16'));
    /*Primary font*/
    /* Quote font*/
    if($heading_font){
        $css .= 'blockquote, .blockquote{font-family:'.$heading_font['font-family'].', sans-serif;}';
    }
    /*End Typography generate Css*/
    /*Color*/
    $css .= zoo_generate_color("body", get_theme_mod('zoo_color_body', ''));
    $css .= zoo_generate_color("h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6", get_theme_mod('zoo_color_heading', ''));
    $css .= zoo_generate_color("a", get_theme_mod('zoo_color_link', ''));
    $css .= zoo_generate_color("a:hover, a:focus, a:active", get_theme_mod('zoo_color_link_hover', ''));

    /*Page font */
    if(get_post_meta(get_the_ID(),'zoo_typo_page_font',true) != 'inherit' && get_post_meta(get_the_ID(),'zoo_typo_page_font',true) != ''){
        $css .= '#main ul.products li.product .price span{font-size: 18px;}';
    }
    /*Accent color*/
    $accent_color = get_theme_mod('zoo_color_accent', '#FB6622');
    if (is_page() && get_post_meta(get_the_ID(), 'zoo_accent_color', true) != '') {
        $accent_color = get_post_meta(get_the_ID(), 'zoo_accent_color', true);
    }
    //Accent color
    $accent_class = '#main .cvca-products-wrap .wrap-head-product-filter-inner ul.cvca-ajax-load li a.active,.gdpr-consent p label a,.gdpr-cookies a,.login label a, .register label a,#top-right-header .multi-language select,#top-right-header .alg_widget_currency_switcher select,body .woocommerce ul.products li.product .price,body .woocommerce ul.products li.product .price ins,.products .zoo-custom-wishlist-btn.yith-wcwl-wishlistexistsbrowse a,.bottom-cart .total .amount,.zoo-mini-cart .mini_cart_item .right-mini-cart-item .amount,.layout-control-block li a.active, .layout-control-block li a.disable-sidebar,body.woocommerce ul.products li.product .price,body.woocommerce ul.products li.product .price ins,.woocommerce .zoo-single-product .wrap-price .price, .woocommerce .zoo-single-product .woocommerce-variation-price .price,#top-footer .zoo-carousel-btn,.zoo-blog-shortcode .zoo-blog-item .readmore,.woocommerce-checkout .woocommerce-info a,.zoo-blog-item .readmore,.post-content a,.calendar_wrap tfoot td a,.tags-link-wrap a,#main .tagcloud a,.icon-header .icon-user .wrap-login-form > p label.click,.chosen > a,.current-cat > a,body .products.list .product .wrap-product-item .list-style .right-bottom .quick-view';
    //Accent color hover
     $accent_class_hover = '#main .cvca-products-wrap .wrap-head-product-filter-inner ul.cvca-ajax-load li a:hover,a:hover,.top-cart-icon:hover,.icon-header .search a:hover,.top-wl-url a:hover,#copyright a:hover,.menu-mini-cart .mini-top-cart a:hover,.products .zoo-custom-wishlist-btn:hover a,.zoo-mini-cart .mini_cart_item .product-name a:hover,#woo-cover-page .wrap-breadcrumb .woocommerce-breadcrumb a:hover,.layout-control-block li a:hover,.woocommerce .zoo-single-product .entry-summary .zoo-custom-wishlist-block.yith-wcwl-add-to-wishlist .zoo-custom-wishlist-btn a:hover,.woocommerce .zoo-content-single .compare:hover,.wrap-right-single-product .zoo-custom-wishlist-block:hover, .wrap-right-single-product .control-share:hover,.woocommerce .zoo-single-product .zoo-woo-tabs .zoo-tabs li a:hover,.woocommerce .zoo-single-product .wrap-thumbs-gal .zoo-carousel-btn:hover,.woocommerce .widget_product_categories .cat-item a:hover,.single-product .zoo-woo-lightbox:hover,.icon-user a:hover,.zoo-blog-item .title-post a:hover,.wrap-style-2-layout .zoo-widget-social-icon i:hover,.wrap-style-3-layout .zoo-widget-social-icon.icon li a i:hover,.canvas-sidebar-control a:hover,.canvas-widget.widget_nav_menu .menu li a:hover,.zoo-posts-widget .title-post:hover,.zoo-blog-item .readmore:hover,.widget a:hover,.post-info .list-cat a:hover,.post-author .wrap-author-social.social-icons li a:hover,.wrap-breadcrumb .zoo-breadcrumb-container a:hover,body .products.grid .product.style-4 .wrap-after-shop-title .add_to_cart_button:hover,body .products.grid .product.style-4 .wrap-after-shop-title .added_to_cart:hover,.header-search-block.popup .close-search:hover,.header-search-block.popup.active form button:hover i,.header-transparent .style-6 .wpdreams_asl_container .probox .proclose:hover:before,.is-sticky #main-navigation .cmm-container .cmm > li > a:hover,#main .cvca-shortcode-banner .banner-content .banner-media-link:hover,#sidebar-shop .zoo-woo-sidebar .close-sidebar:hover,.product-with-banner .cvca-wrapper-products-shortcode .wrap-products-banner .products-banner .content-banner span a:hover';
    //Accent background
    $accent_bg_class = '.gdpr-cookies a:after,.gdpr-consent p label a:after,.login label a:after, .register label a:after,body .products.list .product .wrap-product-item .list-style .right-bottom .quick-view:hover,.zoo-woo-sidebar .zoo-ln-slider-range.ui-widget.ui-widget-content .ui-slider-handle,.woocommerce .zoo-single-product .entry-summary .cart .button:after,.widget.woocommerce ul li:hover > a:before,.widget.woocommerce ul li.current-cat > a:before,.widget.woocommerce ul li.chosen >a:before,.chosen > .count,.current-cat > .count,.widget.woocommerce ul li:hover > .count,.widget.woocommerce ul li:hover >.count,.top-cart-total,#main .cvca-shortcode-banner .banner-content .banner-media-link:after,.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range,#main .tagcloud a:hover,body .products.grid .product.default:hover .quick-view:hover,.readmore:after,.form-submit .btn-submit:hover,.post-content a:after,blockquote:before, .blockquote:before,.tags-link-wrap a:hover,#commentform label.focus:after,input[type="submit"]:hover,.wrap-share-post span.share,.format-quote-inner.page:before,.single-post .format-quote-inner,.zoo-blog-item .wrap-media .icon-media,body .products.grid-layout .product.style-1 .wrap-product-item .wrap-product-img .wrap-product-button > * > *,.single-post .post-image .header-post .list-cat a:hover,#main .cvca-shortcode-banner.style-1 .banner-content .banner-media-link,.tnp-widget-minimal input.tnp-submit,#zoo-header .header-cart,.zoo-blog-shortcode.grid-layout.style-2 .zoo-post-inner .wrap-content .readmore:before,.probox .proloading .asl_loader .asl_simple-circle,#top-header-2,body .products.list .style-1 .wrap-product-item .wrap-product-img .wrap-product-button > * > *';
    $accent_bg_class_hover = '.top-cart-total:hover,.zoo-widget-social-icon i:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle:hover,.post-label li.sticky-post-label';

    if ($accent_color != '') {
        $css .= zoo_generate_color($accent_class, $accent_color);
        $css .= zoo_generate_color($accent_class_hover, $accent_color);
        $css .= $accent_bg_class . '{background:' . $accent_color . '}';
        $css .= $accent_bg_class_hover . '{background:' . $accent_color . '}';
        $css .= '.single-post .post-image .header-post .list-cat a:hover,.chosen > .count,.current-cat > .count,.widget.woocommerce ul li:hover > .count,.widget.woocommerce ul li:hover > .count,.widget.woocommerce ul li.current-cat > a:before,.widget.woocommerce ul li.chosen > a:before,.widget.woocommerce ul li:hover > a:before,.page-load-status .infinite-scroll-request, .page-load-status .infinite-scroll-last, .page-load-status .infinite-scroll-error,.ias-trigger > span, .ias-trigger .pagination-loading, .ias-trigger > a{border-color:' . $accent_color . ' !important}';
    }
    $css .= 'body .products.list .product .wrap-product-item .list-style .right-top .cp-wl > * i:hover,body .products.list .product .wrap-product-item .list-style .right-top .cp-wl > * i:hover,body .products.list .product .wrap-product-item .list-style .right-bottom .added_to_cart:after, body .products.list .product .wrap-product-item .list-style .right-bottom .add_to_cart_button:hover:after,body .products.list .product .wrap-product-item .list-style .right-bottom .quick-view{border-color:'.$accent_color.'}';
    /* Button color*/
    $zoo_button_color = get_theme_mod('zoo_button_color', '#fff');
    $zoo_button_color_hover = get_theme_mod('zoo_button_color_hover', '#fff');
    $zoo_button_color_bg = get_theme_mod('zoo_button_color_bg', '#FB6622');
    $zoo_button_color_bg_hover = get_theme_mod('zoo_button_color_bg_hover', '#f75d17');

    $zoo_button_class = '.woocommerce ul.products li.product.default .add_to_cart_button,.woocommerce ul.products li.product .product_type_grouped,.woocommerce .zoo-single-product .entry-summary .cart .button,.woocommerce #respond input#submit, .woocommerce button.button, .woocommerce input.button,.woocommerce ul.products li.product .product_type_external,#main .cvca-shortcode-banner.style-2 .banner-content .banner-media-link,#main .cvca-shortcode-banner.style-4 .banner-media-link,#main .cvca-shortcode-banner.style-5 .banner-media-link,.zoo-image-hover .image-info a,.wpcf7-form-control.wpcf7-submit,.form-submit .btn-submit,td.product-add-to-cart a.button,.zoo-form-login input[type="submit"],.about-action span,.banner-button,.btn.btn-light,.woocommerce table.my_account_orders .button,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce-account .woocommerce .woocommerce-MyAccount-content .woocommerce-Button';
    $zoo_button_hover_class = 'body .products.list .product .wrap-product-item .list-style .right-bottom .quick-view:hover,.woocommerce ul.products li.product.default .add_to_cart_button:hover,.woocommerce ul.products li.product .product_type_grouped:hover,.tnp-widget-minimal input.tnp-submit:hover,.bottom-cart .buttons .button:not(.checkout):hover,.bottom-cart .buttons .button.checkout:hover,.woocommerce .wrap-cart-coupon .button:hover, .woocommerce .shipping-cal .button, .woocommerce ul.zoo-table-total-cart .button:hover,.woocommerce-cart .woocommerce .wc-proceed-to-checkout .checkout-button.button:hover, .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .checkout-button.button:hover,.woocommerce .bottom-table-cart .btn:hover, .woocommerce .bottom-table-cart .added_to_cart:hover,.woocommerce .bottom-table-cart .btn:hover,.woocommerce-checkout #payment.woocommerce-checkout-payment #place_order:hover,.woocommerce .widget_price_filter .price_slider_amount .button:hover,.woocommerce .zoo-single-product .entry-summary .cart .button:hover,.woocommerce #review_form input#submit:hover, .woocommerce #respond input#submit:hover,#main .cvca-shortcode-banner.style-1 .banner-content .banner-media-link:hover,.woocommerce ul.products li.product .product_type_external:hover,#main .cvca-shortcode-banner.style-2 .banner-content .banner-media-link:hover,#main .cvca-shortcode-banner.style-4 .banner-media-link:hover,#main .cvca-shortcode-banner.style-5 .banner-media-link:hover,#canvas-sidebar .close-canvas:hover,.zoo-image-hover .image-info a:hover,.btn:hover, .added_to_cart:hover button:not(.vc_general):not(.pswp__button):not([type="button"]):hover, .button:hover,.wpcf7-form-control.wpcf7-submit:hover,.comment-reply-link:hover, .comment-edit-link:hover,.zoo-blog-item .wrap-media:hover .icon-media,body .products.grid .product.style-1:hover .wrap-product-item .wrap-product-img .wrap-product-button > * > *:hover,.form-submit .btn-submit:hover,.banner-button:hover,td.product-add-to-cart a.button:hover,.woocommerce .login.form input.button:hover, .woocommerce .register.form input.button:hover,.about-action span:hover,.wpcf7-form-control.wpcf7-submit:hover,.zoo-form-login input[type="submit"]:hover,.btn.btn-light:hover,.woocommerce table.my_account_orders .button:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce-account .woocommerce-Addresses .edit:hover';

    if($zoo_button_color){
        $css .= zoo_generate_color($zoo_button_class, $zoo_button_color);
    }
    if($zoo_button_color_hover){
        $css .= zoo_generate_color($zoo_button_hover_class, $zoo_button_color_hover);
    }
    if($zoo_button_color_bg){
        $css .= $zoo_button_class . '{background:' . $zoo_button_color_bg . '}';
    }
    if($zoo_button_color_bg_hover){
        $css .= $zoo_button_hover_class . '{background:' . $zoo_button_color_bg_hover . '}';
        $css .= '.woocommerce .bottom-table-cart .btn:hover{border-color:' . $zoo_button_color_bg_hover . '}';
    }

    /*Header css*/
    if (get_header_image() != '') {
        $css .= '#zoo-header{background: url("' . get_header_image() . '") center center/cover no-repeat;}';
    }
    /*Top Header css*/
    $zoo_top_header_bg = get_theme_mod('zoo_header_top_bg_color', '');
    $zoo_top_header_color = get_theme_mod('zoo_header_top_color', '');
    $zoo_top_header_link = get_theme_mod('zoo_header_top_link_color', '');
    $zoo_top_header_link_hover = get_theme_mod('zoo_header_top_link_color_hover', '');
    $zoo_header_color = get_theme_mod('zoo_header_main_color', '');
    $zoo_header_link_color = get_theme_mod('zoo_header_main_link_color', '#252525');
    $zoo_header_link_color_hv = get_theme_mod('zoo_header_main_link_color_hover', '#fb6622');
    $zoo_header_bg = get_theme_mod('zoo_header_main_background_color', '');
    $zoo_header_border = get_theme_mod('zoo_header_border_color', '');
    if (is_page() && get_post_meta(get_the_ID(), 'zoo_enable_header_color', true) == 1) {
        $zoo_top_header_bg = zoo_hex2rgba(get_post_meta(get_the_ID(), 'zoo_top_header_bg', true), get_post_meta(get_the_ID(), 'zoo_top_header_bg_opc', true));
        $zoo_top_header_link = $zoo_top_header_color = get_post_meta(get_the_ID(), 'zoo_top_header_color', true);
        $zoo_top_header_link_hover = get_post_meta(get_the_ID(), 'zoo_top_header_color_hover', true);
        $css .= zoo_generate_color('#top-header .zoo-icon-field .wrap-icon-item i', $zoo_top_header_link);
        $zoo_header_link_color = $zoo_header_color = get_post_meta(get_the_ID(), 'zoo_header_color', true);
        $zoo_header_link_color_hv = get_post_meta(get_the_ID(), 'zoo_header_color_hover', true);
        if(get_post_meta(get_the_ID(), 'zoo_custom_bg_header', true)){
            $zoo_header_bg = zoo_hex2rgba(get_post_meta(get_the_ID(), 'zoo_custom_bg_header', true), get_post_meta(get_the_ID(), 'zoo_custom_bg_header_opc', true));
        }
        if(get_post_meta(get_the_ID(), 'zoo_bg_sticky_header', true)){
            $css .= '#main-header .is-sticky #main-navigation,.is-sticky #site-branding{background:' . zoo_hex2rgba(get_post_meta(get_the_ID(), 'zoo_bg_sticky_header', true), get_post_meta(get_the_ID(), 'zoo_bg_sticky_header_opc', true)) . '}';
        }
        
        
        $css .= '#main-header .is-sticky #main-navigation .cmm-container:not(#cmm-categories) .cmm > li > a,.style-vendor .main-navigation-inner .categories-menu-inner .categories-label,#main-header .is-sticky .menu-mini-cart .mini-top-cart a,.is-sticky .icon-header a{color:'.get_post_meta(get_the_ID(), 'zoo_color_sticky_header', true) . '}';
        $css .= '#main-header .is-sticky #main-navigation .cmm-container:not(#cmm-categories) .cmm > li > a:hover span,#main-header .is-sticky #main-navigation .cmm-container .cmm > li > a:hover,#main-header #main-navigation .cmm-container:not(#cmm-categories) .cmm > li > a:hover span,#main-header #main-navigation .cmm-container:not(#cmm-categories) .cmm > li > a:hover,#main-header .is-sticky .menu-mini-cart .mini-top-cart a:hover,.is-sticky .icon-header a:hover{color:'.get_post_meta(get_the_ID(), 'zoo_color_hv_sticky_header', true) . '}';
        $zoo_header_border = zoo_hex2rgba(get_post_meta(get_the_ID(), 'zoo_header_border_color', true), get_post_meta(get_the_ID(), 'zoo_header_border_color_opc', true));
    } else {
        if (get_theme_mod('zoo_header_main_bg_sticky', '') != '') {
            $css .= '.is-sticky .sticker{background:' . get_theme_mod('zoo_header_main_bg_sticky', '') . '}';
        }
        if (get_theme_mod('zoo_header_main_color_sticky', '') != '') {
            $css .= '#main-header .is-sticky #main-navigation .cmm-container:not(#cmm-categories) .cmm > li > a, .style-vendor .main-navigation-inner .categories-menu-inner .categories-label, #main-header .is-sticky .menu-mini-cart .mini-top-cart a, .is-sticky .icon-header a{color:' . get_theme_mod('zoo_header_main_color_sticky', '') . '}';
        }
        if (get_theme_mod('zoo_header_main_color_hv_sticky', '') != '') {
            $css .= '#main-header .is-sticky #main-navigation .cmm-container:not(#cmm-categories) .cmm > li > a:hover, #main-header .is-sticky .menu-mini-cart .mini-top-cart a:hover, .is-sticky .icon-header a:hover{color:' . get_theme_mod('zoo_header_main_color_hv_sticky', '') . '}';
        }
    }
    if ($zoo_top_header_bg != '') {
        $css .= '.top-header{background:' . $zoo_top_header_bg . ';}';
    }
    if ($zoo_header_border != '') {
        $css .= '.stack-center-layout.style-1 .wrap-logo,.header-two-lines-2 #main-navigation{border-bottom-color:' . $zoo_header_border . '}';
    }
    $css .= zoo_generate_color('.top-header', $zoo_top_header_color);
    $css .= zoo_generate_color('.top-header a, #top-header #icon-header .search-trigger', $zoo_top_header_link);
    $css .= zoo_generate_color('.top-header a:hover', $zoo_top_header_link_hover);
    /*End Top Header css*/
    /*Main Header*/
    if($zoo_header_bg){
        $css .= '#main-header{background:' . $zoo_header_bg . ';}';
    }
    $css .= zoo_generate_color('#main-header', $zoo_header_color);
    $css .= zoo_generate_color('.menu-center-layout #icon-header .search a, .menu-center-layout #icon-header .top-wl-url a, .menu-center-layout #icon-header .top-ajax-cart .top-cart-icon, #main-navigation .cmm-container .cmm > li > a, .menu-mini-cart .mini-top-cart a,.icon-header a', $zoo_header_link_color);
    $css .= zoo_generate_color('.menu-center-layout #icon-header .search a:hover, .menu-center-layout #icon-header .top-wl-url a:hover, .menu-center-layout #icon-header .top-ajax-cart .top-cart-icon:hover, #main-header #site-branding a:hover span,#main-header #site-branding a:hover', $zoo_header_link_color_hv);
    /*End Header css*/
    /*Main Menu*/
    $zoo_main_menu_bg = get_theme_mod('zoo_header_menu_bg', '');
    $zoo_main_menu_color = '';
    $zoo_main_menu_color_hv = get_theme_mod('zoo_main_menu_color_hover', '');
    if (is_page() && get_post_meta(get_the_ID(), 'zoo_enable_header_color', true) == 1 && get_post_meta(get_the_ID(), 'zoo_custom_bg_header_menu', true)) {
        $zoo_main_menu_bg = zoo_hex2rgba(get_post_meta(get_the_ID(), 'zoo_custom_bg_header_menu', true), get_post_meta(get_the_ID(), 'zoo_custom_bg_header_menu_opc', true));
        $zoo_main_menu_color = get_post_meta(get_the_ID(), 'zoo_custom_color_header_menu', true);
        $zoo_main_menu_color_hv = get_post_meta(get_the_ID(), 'zoo_custom_color_header_menu_hover', true);
    }
    if ($zoo_main_menu_bg != '') {
        $css .= '.primary-nav{background:' . $zoo_main_menu_bg . '}';
    }
    if ($zoo_main_menu_color == '') {
        $css .= zoo_generate_color('#main-navigation .cmm-container:not(#cmm-categories) .cmm > li > a', get_theme_mod('zoo_header_menu_color', ''));
        $css .= zoo_generate_color('#main-navigation .cmm-container .cmm > li > a:hover,#main-navigation .cmm-container .cmm > li > a:hover span', get_theme_mod('zoo_main_menu_color_hover', ''));
    } else {
        $css .= zoo_generate_color('#main-navigation .cmm-container:not(#cmm-categories) .cmm > li > a', $zoo_main_menu_color);
        $css .= zoo_generate_color('#main-navigation .cmm-container .cmm > li > a:hover,#main-header a:hover span,#main-header a:hover', $zoo_main_menu_color_hv);
    }
    /* Main Navigation font */
    $css .= zoo_generate_font('.primary-nav, #cmm-primary', $navigation_font);
    $css .= zoo_generate_color('.primary-nav nav>ul>li:hover>a,.primary-nav nav>ul>li:hover:after,  #mini-top-cart .wrap-icon-cart:hover i', $zoo_main_menu_color_hv);
    if (get_theme_mod('zoo_main_menu_bg', '')) {
        $css .= '.primary-nav nav>ul>li{background:' . get_theme_mod('zoo_main_menu_bg', 'transparent') . ';}';
    }
    $css .= '.primary-nav nav>ul>li:hover{background:' . get_theme_mod('zoo_main_menu_bg_hover', 'transparent') . ';}';
    /*End Main Menu*/
    /*Sub Menu*/
    $css .= '.primary-nav nav>ul ul{background:' . get_theme_mod('zoo_sub_menu_block_bg', '#fff') . ';}';
    $css .= zoo_generate_font('.primary-nav ul > li li *,.primary-nav ul > li div *', $sub_nav_font);
    $css .= zoo_generate_color('.primary-nav nav>ul ul li:hover>a, .primary-nav nav>ul ul li:hover:after', get_theme_mod('zoo_sub_menu_color_hover', ''));
    if(get_theme_mod('zoo_sub_menu_bg', '')){
        $css .= '.primary-nav nav>ul ul li{background:' . get_theme_mod('zoo_sub_menu_bg', '') . '}';
    }
    if(get_theme_mod('zoo_sub_menu_bg_hover', '')){
        $css .= '.primary-nav nav>ul ul li:hover{background:' . get_theme_mod('zoo_sub_menu_bg_hover', '') . '}';
    }
    /*End Sub Menu*/
    /* Main Pahe Back ground*/
    if(get_post_meta(get_the_ID(),'zoo_main_page_bg',true) != ''){
        $css .= '#main{background:' . get_post_meta(get_the_ID(),'zoo_main_page_bg',true) . '}';
    }
    /*Footer Options*/
    $css .= zoo_generate_font('.footer-widget-title', $footer_title);
    /* Footer bg**/
    $footer_bg = get_theme_mod('zoo_footer_bg_color', '');
    if ($footer_bg != '')
        $footer_bg = 'background:' . $footer_bg;
    $footer_bg_img = get_theme_mod('zoo_footer_bg_image', '');
    if ($footer_bg_img != '') {
        $footer_bg .= ' url("' . $footer_bg_img . '") ' . get_theme_mod('zoo_footer_bg_position', 'center center') . '/' . get_theme_mod('zoo_footer_bg_size', 'cover') . ';';
        $footer_bg .= ' background-repeat:' . get_theme_mod('zoo_footer_bg_repeat', 'no-repeat') . ';';
        $footer_bg .= ' background-attachment:' . get_theme_mod('zoo_footer_bg_attachment', 'inherit') . ';';
    }
    if (is_page()) {
        if (get_post_meta(get_the_ID(), 'zoo_enable_footer_color', true) == 1) {
            $footer_bg = zoo_hex2rgba(get_post_meta(get_the_ID(), 'zoo_footer_bg_color', true), get_post_meta(get_the_ID(), 'zoo_footer_bg_color_opc', true));
            $css .= '#zoo-footer{background:' . $footer_bg . '}';
        } else {
            if (get_post_meta(get_the_ID(), 'zoo_footer_layout', 'true') == 'inherit') {
                $css .= '#zoo-footer{' . $footer_bg . '}';
            }
        }
    } else {
        $css .= '#zoo-footer{' . $footer_bg . '}';
    }
    $zoo_enable_footer_color = get_post_meta(get_the_ID(), 'zoo_enable_footer_color', true);
    if (is_page() && get_post_meta(get_the_ID(), 'zoo_enable_footer_color', true) == 1) {
        $css .= zoo_generate_color('#zoo-footer .footer-widget-title', get_post_meta(get_the_ID(), 'zoo_footer_title_color', true));
        $css .= zoo_generate_color('#top-footer, #main-footer', get_post_meta(get_the_ID(), 'zoo_footer_color', true));
        $css .= zoo_generate_color('#top-footer a, #main-footer a', get_post_meta(get_the_ID(), 'zoo_footer_link_color', true));
        $css .= zoo_generate_color('#top-footer a:hover, #main-footer a:hover, .footer-widget .zoo-widget-social-icon a:hover', get_post_meta(get_the_ID(), 'zoo_footer_link_color_hover', true));
        $css .= ".separator hr{border-color: " . zoo_hex2rgba(get_post_meta(get_the_ID(), 'zoo_footer_bt_border_color', true), get_post_meta(get_the_ID(), 'zoo_footer_bt_border_color_opc', true)) . "}";
    } else {
        $css .= zoo_generate_color('#top-footer', get_theme_mod('zoo_top_footer_color', ''));
        $css .= zoo_generate_color('#top-footer a', get_theme_mod('zoo_top_footer_link_color', ''));
        $css .= zoo_generate_color('#top-footer a:hover', get_theme_mod('zoo_top_footer_link_color_hover', ''));
        if (get_theme_mod('zoo_top_footer_bg', '') != '') {
            $css .= '#top-footer{background:' . get_theme_mod('zoo_top_footer_bg', '') . '}';
        }
        $css .= zoo_generate_color('#main-footer', get_theme_mod('zoo_main_footer_color', ''));
        $css .= zoo_generate_color('#main-footer a', get_theme_mod('zoo_main_footer_link_color', ''));
        $css .= zoo_generate_color('#main-footer a:hover', get_theme_mod('zoo_main_footer_link_color_hover', ''));
        if (get_theme_mod('zoo_main_footer_bg', '') != '') {
            $css .= '#main-footer, .wrap-footer-2-layout .main-footer-block{background:' . get_theme_mod('zoo_main_footer_bg', '') . '}';
        }
        if (get_theme_mod('zoo_footer_border', '') != '') {
            $css .= "#main-footer{border-top:1px solid" . get_theme_mod('zoo_footer_border', '') . "}";
        }
    }
    $zoo_bt_footer_color = get_theme_mod('zoo_bt_footer_color','');
    if($zoo_enable_footer_color == 1 && get_post_meta(get_the_ID(),'zoo_bt_footer_color', true) != ''){
        $zoo_bt_footer_color = get_post_meta(get_the_ID(),'zoo_bt_footer_color', true);
    }
    $zoo_bt_footer_link_color = get_theme_mod('zoo_bt_footer_link_color','');
    if($zoo_enable_footer_color == 1 && get_post_meta(get_the_ID(),'zoo_bt_footer_link_color', true) != ''){
        $zoo_bt_footer_link_color = get_post_meta(get_the_ID(),'zoo_bt_footer_link_color', true);
    }
    $zoo_bt_footer_link_color_hover = get_theme_mod('zoo_bt_footer_link_color_hover','');
    if($zoo_enable_footer_color == 1 && get_post_meta(get_the_ID(),'zoo_bt_footer_color', true) != ''){
        $zoo_bt_footer_link_color_hover = get_post_meta(get_the_ID(),'zoo_bt_footer_link_color_hover', true);
    }
    $zoo_bt_footer_bg = get_theme_mod('zoo_bt_footer_bg','');
    if($zoo_enable_footer_color == 1 && get_post_meta(get_the_ID(),'zoo_bt_footer_color', true) != ''){
        $zoo_bt_footer_bg = get_post_meta(get_the_ID(),'zoo_bt_footer_bg', true);
    }
    if($zoo_bt_footer_color){
        $css .= zoo_generate_color('#bottom-footer', $zoo_bt_footer_color);
    }
    if($zoo_bt_footer_link_color){
        $css .= zoo_generate_color('#bottom-footer a', $zoo_bt_footer_link_color);
    }
    if($zoo_bt_footer_link_color_hover){
        $css .= zoo_generate_color('#bottom-footer a:hover', $zoo_bt_footer_link_color_hover);
    }
    if($zoo_bt_footer_bg){
        $css .= '#bottom-footer{background:'.$zoo_bt_footer_bg.'}';
    }

    /*End Footer Options*/
    /*Archive page*/
    $css .= zoo_generate_font('.zoo-blog-item .title-post,.readmore', $archive_title);
    $css .= zoo_generate_color('.zoo-blog-item .title-post:hover', get_theme_mod('zoo_blog_archive_title_hover', ''));
    $css .= zoo_generate_color('.zoo-blog-item .entry-content', get_theme_mod('zoo_blog_archive_text', ''));
    $css .= zoo_generate_color('.zoo-blog-item .post-info, .post-info span,  .zoo-blog-item .post-info > span', get_theme_mod('zoo_blog_archive_info', ''));
    $css .= zoo_generate_color('.post-label li a', get_theme_mod('zoo_blog_archive_link', ''));
    $css .= zoo_generate_color('.post-label li a:hover', get_theme_mod('zoo_blog_archive_link_hover', ''));
    $css .= zoo_generate_color('.post-label li a:hover', get_theme_mod('zoo_blog_archive_link_hover', ''));
    $lb_cat= get_theme_mod('zoo_blog_lb_cat_bg', '');
    if($lb_cat!=''){
        $css .='.post-label li.cat-post-label{background:'.$lb_cat.'}';
    }
    $lb_cat_hv= get_theme_mod('zoo_blog_lb_cat_bg_hv', '');
    if($lb_cat_hv!=''){
        $css .='.post-label li.cat-post-label:hover,.post-label li.cat-post-label:after{background:'.$lb_cat_hv.'}';
        $css .='.post-label li.cat-post-label:after{box-shadow:  0 0 5px 5px '.$lb_cat_hv.'}';
    }
    $css .= zoo_generate_color('.zoo-blog-item .readmore', get_theme_mod('zoo_blog_archive_rm', ''));
    $css .= zoo_generate_color('.zoo-blog-item .readmore:hover', get_theme_mod('zoo_blog_archive_rm_hover', ''));
    /*End Archive page*/
    $margin_top_content = get_post_meta(get_the_ID(),'zoo_margin_top_content',true);
    $margin_bottom_content = get_post_meta(get_the_ID(),'zoo_margin_bottom_content',true);
    if(is_page()){
        if( $margin_top_content!=''){
            $css .= '#main{padding-top:'.$margin_top_content.'px}';
        }
        else{
            $css .= '#main{padding-top:40px}';
        }
        if( $margin_bottom_content!=''){
            $css .= '#main{padding-bottom:'.$margin_bottom_content.'px}';
        }
        else{
            $css .= '#main{padding-bottom:40px}';
        }
    }
    if(is_single()){
        $css .= '#main{padding-top:0}';
        $css .= '#main{padding-bottom:0}';
    }
    /*Post Sidebar page*/
    $css .= zoo_generate_font('.zoo-posts-widget .post-widget-item .title-post, .post-related .zoo-blog-item .title-post', $sidebar_title);
    $css .= zoo_generate_color('.zoo-posts-widget .post-widget-item .title-post:hover, .post-related .zoo-blog-item .title-post:hover', get_theme_mod('zoo_blog_sidebar_title_hover', ''));
    $css .= zoo_generate_color('.zoo-posts-widget .date-post, .post-related .date-post', get_theme_mod('zoo_blog_sidebar_info_color', ''));
    /*Post Sidebar page*/
    /*Single post*/
    $css .= zoo_generate_font('.single .title-detail', get_theme_mod('zoo_typo_blog_single_title', array('font-family' => 'Exo','variant' => '600','text-transform' => 'none','font-size' => '36','line-height' => '1.5','letter-spacing' => '0','color'=>'#252525')));
    $css .= zoo_generate_color('.single .post-info > .date-post', get_theme_mod('zoo_blog_single_info', ''));
    $css .= zoo_generate_color('.single .post-info span  a, .single .logged-in-as a ', get_theme_mod('zoo_blog_single_link', ''));
    $css .= zoo_generate_color('.single .post-info a:hover, .single .logged-in-as a:hover ', get_theme_mod('zoo_blog_single_link_hover', ''));
    /*End Single post*/
    /*Sidebar*/
    $css .= zoo_generate_font('.sidebar .widget .widget-title,.zoo-image-hover,.wpcf7-form-control.wpcf7-submit', $sidebar_title);
    /*Shop page*/
    if (class_exists('WooCommerce')) {
        if(get_theme_mod('zoo_products_item_image_padding_herizontal',0)){
            $css .= '.products .wrap-product-img img{padding-left:'.get_theme_mod('zoo_products_item_image_padding_herizontal',0).'px }';
            $css .= '.products .wrap-product-img img{padding-right:'.get_theme_mod('zoo_products_item_image_padding_herizontal',0).'px }';
        }
        if(get_theme_mod('zoo_products_item_image_padding_vertical',0)){
            $css .= '.products .wrap-product-img img{padding-top:'.get_theme_mod('zoo_products_item_image_padding_herizontal',0).'px }';
            $css .= '.products .wrap-product-img img{padding-bottom:'.get_theme_mod('zoo_products_item_image_padding_herizontal',0).'px }';
        }
        
        $css .= zoo_generate_font('.compare-button,ul.products li.product .price, .quick-view,.wrap-after-shop-cart a', $woo_price);
        $css .= zoo_generate_font('.products .product .product-name,.product_list_widget .product-title, .woocommerce table.shop_table tbody .product-name a', $woo_title);
        $css .= zoo_generate_font('.woocommerce div.product h1.product_title, .variations .zoo-cw-attr-row .label, .zoo-custom-wishlist-btn, .compare, .control-share, .woo-custom-share,.zoo-tabs,.cart .button', $woo_single_title);
        $css .= zoo_generate_color('.woocommerce .products .product .product-name a:hover,.product_list_widget .product-title:hover, .woocommerce table.shop_table tbody .product-name a:hover', get_theme_mod('zoo_woo_title_hover', ''));
        $css .= zoo_generate_color('.products .quick-view', get_theme_mod('zoo_woo_qv_color', ''));
        $css .= zoo_generate_color('.woocommerce .star-rating span::before', get_theme_mod('zoo_woo_rate_color', ''));
        if (get_theme_mod('zoo_woo_qv_bg', '') != '') {
            $css .= '.products .quick-view{background: ' . get_theme_mod('zoo_woo_qv_bg', '') . '}';
        }
        $css .= zoo_generate_color('.products .quick-view:hover', get_theme_mod('zoo_woo_qv_color_hover', ''));
        if (get_theme_mod('zoo_woo_qv_bg_hover', '') != '') {
            $css .= '.products .quick-view:hover{background: ' . get_theme_mod('zoo_woo_qv_bg_hover', '') . '}';
        }
        //Cart
        $css .= zoo_generate_color('.woocommerce ul.products li.product .button, .woocommerce .zoo-single-product .entry-summary .cart .button', get_theme_mod('zoo_woo_cart_color', ''));
        if (get_theme_mod('zoo_woo_cart_bg', '') != '')
            $css .= '.woocommerce ul.products li.product .button, .woocommerce .zoo-single-product .entry-summary .cart .button{background: ' . get_theme_mod('zoo_woo_cart_bg', '') . '}';
        $css .= zoo_generate_color('.woocommerce ul.products li.product .button:hover, .woocommerce .zoo-single-product .entry-summary .cart .button:hover', get_theme_mod('zoo_woo_cart_color_hover', ''));
        if (get_theme_mod('zoo_woo_cart_bg_hover', '') != '')
            $css .= '.woocommerce ul.products li.product .button:hover, .woocommerce .zoo-single-product .entry-summary .cart .button:hover{background: ' . get_theme_mod('zoo_woo_cart_bg_hover', '') . '}';
        //Sale label
        $css .= zoo_generate_color('.woocommerce .zoo-woo-page span.onsale, #zoo-quickview-lb.woocommerce span.onsale', get_theme_mod('zoo_woo_color_lb_sale', ''));
        if (get_theme_mod('zoo_woo_bg_lb_sale', '') != '')
            $css .= '.woocommerce .zoo-woo-page span.onsale, #zoo-quickview-lb.woocommerce span.onsale{background: ' . get_theme_mod('zoo_woo_bg_lb_sale', '') . '}';
        //Stock
        $css .= zoo_generate_color('.stock-label.low-stock-label', get_theme_mod('zoo_woo_lb_low_stock', ''));
        if (get_theme_mod('zoo_woo_lb_low_stock', '') != '')
            $css .= '.stock-label.low-stock-label{border-color:' . get_theme_mod('zoo_woo_lb_low_stock', '') . '}';
        $css .= zoo_generate_color('.stock-label.out-stock-label', get_theme_mod('zoo_woo_lb_out_stock', ''));
        if (get_theme_mod('zoo_woo_lb_out_stock', '') != '')
            $css .= '.stock-label.out-stock-label{border-color:' . get_theme_mod('zoo_woo_lb_out_stock', '') . '}';
        //Price
        $css .= zoo_generate_color('.amount, .woocommerce-cart ul.shop_table .amount, .woocommerce-checkout ul.shop_table .amount, amount, .zoo-mini-cart .mini_cart_item .right-mini-cart-item .amount', get_theme_mod('zoo_woo_price_color', ''));
        $css .= zoo_generate_color('.woocommerce div.product p.price del, .woocommerce div.product span.price del', get_theme_mod('zoo_woo_price_regular_color', ''));
        $css .= zoo_generate_color('.woocommerce div.product p.price ins, .woocommerce div.product span.price ins', get_theme_mod('zoo_woo_price_sale_color', ''));
        //Button for ajax cart and cart page
        $css .= zoo_generate_color('.woocommerce-checkout #payment.woocommerce-checkout-payment #place_order, .woocommerce .button.checkout, .woocommerce .wrap-coupon input.button, .woocommerce-cart .woocommerce .wc-proceed-to-checkout .checkout-button.button, .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .checkout-button.button', get_theme_mod('zoo_woo_pri_btn_color', ''));
        if (get_theme_mod('zoo_woo_pri_btn_bg', '') != '')
            $css .= '.woocommerce-checkout #payment.woocommerce-checkout-payment #place_order, .woocommerce .button.checkout, .woocommerce .wrap-coupon input.button, .woocommerce-cart .woocommerce .wc-proceed-to-checkout .checkout-button.button, .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .checkout-button.button{background:' . get_theme_mod('zoo_woo_pri_btn_bg', '') . '}';
        $css .= zoo_generate_color('.woocommerce-checkout #payment.woocommerce-checkout-payment #place_order:hover,.woocommerce .button.checkout:hover, .woocommerce .wrap-coupon input.button:hover, .woocommerce-cart .woocommerce .wc-proceed-to-checkout .checkout-button.button:hover, .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .checkout-button.button:hover', get_theme_mod('zoo_woo_pri_btn_color_hover', ''));
        if (get_theme_mod('zoo_woo_pri_btn_bg_hover', '') != '')
            $css .= '.woocommerce-checkout #payment.woocommerce-checkout-payment #place_order:hover,.woocommerce .button.checkout:hover, .woocommerce .wrap-coupon input.button:hover, .woocommerce-cart .woocommerce .wc-proceed-to-checkout .checkout-button.button:hover, .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .checkout-button.button:hover{background:' . get_theme_mod('zoo_woo_pri_btn_bg_hover', '') . '}';
        $css .= zoo_generate_color('.woocommerce-cart .woocommerce .wc-proceed-to-checkout .button:not(.checkout-button), .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .button:not(.checkout-button),.bottom-cart .buttons .button:not(.checkout)', get_theme_mod('zoo_woo_sec_btn_color', ''));
        $css .= zoo_generate_color('.woocommerce-cart .woocommerce .wc-proceed-to-checkout .button:hover:not(.checkout-button), .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .button:hover:not(.checkout-button),.bottom-cart .buttons .button:hover:not(.checkout)', get_theme_mod('zoo_woo_sec_btn_color_hover', ''));
        if (get_theme_mod('zoo_woo_sec_btn_bg', '') != '')
            $css .= '.woocommerce-checkout .woocommerce .login.global-login-form .button, .woocommerce-checkout .woocommerce .checkout_coupon .button, .woocommerce-cart .woocommerce .wc-proceed-to-checkout .button:not(.checkout-button), .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .button:not(.checkout-button),.bottom-cart .buttons .button:not(.checkout){background:' . get_theme_mod('zoo_woo_sec_btn_bg', '') . '}';
        if (get_theme_mod('zoo_woo_sec_btn_bg_hover', '') != '')
            $css .= '.woocommerce-checkout .woocommerce .login.global-login-form .button:hover, .woocommerce-checkout .woocommerce .checkout_coupon .button:hover, .woocommerce-cart .woocommerce .wc-proceed-to-checkout .button:hover:not(.checkout-button), .woocommerce-checkout .woocommerce .wc-proceed-to-checkout .button:hover:not(.checkout-button),.bottom-cart .buttons .button:hover:not(.checkout){background:' . get_theme_mod('zoo_woo_sec_btn_bg_hover', '') . '}';
    }
    /*End Shop page*/
    $css .= zoo_generate_color('.text-field, input[type="text"], input[type="search"], input[type="password"], textarea, input[type="email"], input[type="tel"]', get_theme_mod('zoo_form_style_color', ''));
    if (get_theme_mod('zoo_form_style_border', '') != '') {
        $css .= '.text-field, input[type="text"], input[type="search"], input[type="password"], textarea, input[type="email"], input[type="tel"]{border-color:' . get_theme_mod('zoo_form_style_border', '') . '}';
    }
    if (get_theme_mod('zoo_form_style_border_active', '') != '') {
        $css .= '.text-field:focus, input[type="text"]:focus, input[type="search"]:focus, input[type="password"]:focus, textarea:focus, input[type="email"]:focus, input[type="tel"]:focus{border-color:' . get_theme_mod('zoo_form_style_border_active', '') . '}';
    }
    if (get_theme_mod('zoo_form_style_bg', '') != '') {
        $css .= '.text-field, input[type="text"], input[type="search"], input[type="password"], textarea, input[type="email"], input[type="tel"]{background-color:' . get_theme_mod('zoo_form_style_bg', '') . '}';
    }
    $css .= zoo_generate_color('.btn, input[type="submit"], button:not(.vc_general), .button', get_theme_mod('zoo_btn_style_color', ''));
    $css .= zoo_generate_color('.btn:hover, input[type="submit"]:hover, button:hover:not(.vc_general), .button:hover', get_theme_mod('zoo_btn_style_color_hover', ''));
    if (get_theme_mod('zoo_btn_style_bg', '') != "")
        $css .= '.btn, input[type="submit"], button:not(.vc_general), .button{background:' . get_theme_mod('zoo_btn_style_bg', '') . '}';
    if (get_theme_mod('zoo_btn_style_bg_hover', '') != "")
        $css .= '.btn:hover, input[type="submit"]:hover, button:hover:not(.vc_general), .button:hover{background:' . get_theme_mod('zoo_btn_style_bg_hover', '') . '}';
    /* Custom color header text transparent */
    $zoo_color_text_header_transparent = get_post_meta(get_the_ID(),'zoo_color_text_header_transparent',true);
    if($zoo_color_text_header_transparent){
        $css .= zoo_generate_color('.header-transparent #zoo-header .sticky-wrapper:not(.is-sticky) #main-header #main-navigation .cmm-container > ul > li > a,.header-transparent #zoo-header .sticky-wrapper:not(.is-sticky) #main-header .icon-header .search a,.header-transparent #zoo-header .sticky-wrapper:not(.is-sticky) #main-header .icon-header .top-wl-url a,.header-transparent #zoo-header .sticky-wrapper:not(.is-sticky) #main-header .icon-header .icon-user a,.header-transparent #zoo-header .sticky-wrapper:not(.is-sticky) #main-header .icon-header .top-cart .wrap-icon-cart .top-cart-icon',$zoo_color_text_header_transparent);
    }
    /*Customize Addition*/
    if (get_theme_mod('zoo_custom_css') != '') {
        $css .= get_theme_mod('zoo_custom_css');
    }
    return $css;
}