<?php
/**
 * Woocommerce functions
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
/*Default woocomerce*/
//Remove link close woo 2.5
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
//Custom number product display
add_filter( 'loop_shop_per_page', 'zoo_products_number_items', 20 );
if(!function_exists('zoo_products_number_items')) {
    function zoo_products_number_items( $cols ) {
      // $cols contains the current number of products per page based on the value stored on Options -> Reading
      // Return the number of products you wanna show per page.
      $cols = get_theme_mod('zoo_products_number_items', '9');
      return $cols;
    }
}
/* ==============  WooCommerce - Ajax add to cart ============== */
/* Ajax Url ==========================================================================================================*/
add_action('wp_enqueue_scripts', 'zoo_framework_ajax_url_render', 1000);
// Enqueue scripts for theme.
if(!function_exists('zoo_framework_ajax_url_render')) {
    function zoo_framework_ajax_url_render()
    {
        // Load custom style
        wp_add_inline_script('doma', zoo_framework_ajax_url());
    }
}
if(!function_exists('zoo_framework_ajax_url')) {
    function zoo_framework_ajax_url()
    {
        $ajaxurl = 'var ajaxurl = "' . esc_url(admin_url('admin-ajax.php')) . '";';
        return $ajaxurl;
    }
}
//Update topcart when addtocart(Ajax cart)
add_filter('woocommerce_add_to_cart_fragments', 'zoo_top_cart');
if (!function_exists("zoo_top_cart")) {
    function zoo_top_cart($fragments)
    {
        ob_start();
        get_template_part('woocommerce/theme-custom/topheadcart');
        $fragments['.top-cart'] = ob_get_clean();
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'zoo_total_cart');
if (!function_exists("zoo_total_cart")) {
   function zoo_total_cart($fragments)
   {
       ob_start();
       echo '<span class="top-cart-total">'.sprintf(_n('<span>%d</span> <label>item</label>', '<span>%d</span> <label>items</label>', esc_html(WC()->cart->get_cart_contents_count()), 'doma'), esc_html(WC()->cart->get_cart_contents_count())).'</span>';
       $fragments['.top-cart-total'] = ob_get_clean();
       return $fragments;
   }
}
/* ======  WooCommerce - Ajax remover cart ====== */
add_action('wp_ajax_cart_remove_product', 'zoo_woo_remove_product');
add_action('wp_ajax_nopriv_cart_remove_product', 'zoo_woo_remove_product');
if (!function_exists('zoo_woo_remove_product')) {
    function zoo_woo_remove_product()
    {
        $product_key = $_POST['product_key'];
        $cart = WC()->instance()->cart;
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $product_key) {
                $removed = WC()->cart->remove_cart_item($cart_item_key);
            }
        }
        $output['status'] = '1';
        $output['cart_count'] = $cart->get_cart_contents_count();
        $output['cart_subtotal'] = $cart->get_cart_subtotal();
        echo json_encode($output);
        exit;
    }
}
/*-------Quick view ajax--------*/
add_action('wp_ajax_zoo_quickview', 'zoo_quickview');
add_action('wp_ajax_nopriv_zoo_quickview', 'zoo_quickview');
/* The Quickview Ajax Output */
if (!function_exists('zoo_quickview')) {
    function zoo_quickview()
    {
        global $post, $product, $woocommerce;
        wp_enqueue_script('wc-add-to-cart-variation');
        $product_id = $_POST['product_id'];
        $product = wc_get_product($product_id);
        $post = $product->post;
        setup_postdata($post);
        ob_start();
        wc_get_template_part('theme-custom/quick', 'view');
        $output = ob_get_contents();
        ob_end_clean();
        wp_reset_postdata();
        echo ent2ncr($output);
        exit;
    }
}
/*End Default woocomerce*/
/*-------Shop page functions--------*/
//Add lazy img for product

if(!function_exists( 'check_better_amp' )){
    function check_better_amp(){
        $is_better_amp = false;
        if(function_exists('is_better_amp')){
            $is_better_amp = is_better_amp();
        }
        return $is_better_amp;
    }
}


if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
    function woocommerce_template_loop_product_thumbnail()
    {
        echo '<a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title(get_the_ID()).'">';
        echo woocommerce_get_product_thumbnail().zoo_aternative_images();
        echo '</a>';
    }
}

//Aternative images
if(!function_exists('zoo_aternative_images')){
    function zoo_aternative_images(){
        if(get_theme_mod('zoo_aternative_images','0')!='0'){
            $id = get_the_ID();
            $gallery = get_post_meta($id, '_product_image_gallery', true);

            if (!empty($gallery)) {
                $gallery = explode(',', $gallery);
                $first_image_id = $gallery[0];
                $zoo_item = wp_get_attachment_image_src($first_image_id, 'woocommerce_thumbnail');
                $zoo_img_url = $zoo_item[0];
                $zoo_width = $zoo_item[1];
                $zoo_height = $zoo_item[2];
                $zoo_img_title = get_the_title($first_image_id);
                $img_srcset = wp_get_attachment_image_srcset( $first_image_id );
                $img_sizes = wp_get_attachment_image_sizes( $first_image_id , 'woocommerce_thumbnail' );
                ?>
                
                <img src="<?php echo esc_url($zoo_img_url) ?>"
                    height="<?php echo esc_attr($zoo_height) ?>" 
                    width="<?php echo esc_attr($zoo_width) ?>"
                    class="lazy-img hover-image"
                    alt="<?php echo esc_attr($zoo_img_title); ?>"
                    srcset="<?php echo esc_attr($img_srcset) ?>"
                    sizes="<?php echo esc_attr($img_sizes) ?>"/>
                <?php
            }
        }
    }
}

//Hight Light Featured Product
if(!function_exists('zoo_highlight_featured')){
    function zoo_highlight_featured(){
        $zoo_highlight_featured = get_theme_mod('zoo_highlight_featured','1');
        if(isset($_GET['zoo_highlight_featured'])) {
            $zoo_highlight_featured = $_GET['zoo_highlight_featured'];
        }
        return $zoo_highlight_featured;
    }
}
//Move breadcrumb
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('zoo_woocommerce_breadcrumb', 'woocommerce_breadcrumb', 10);
add_action('zoo_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart',10);
//Catalog Mod
if (!function_exists('zoo_woo_catalog_mod')) {
    function zoo_woo_catalog_mod()
    {
        $zoo_catalog_status = get_theme_mod('zoo_catalog_mod', '') == '1' ? true : false;
        if (isset($_GET['catalog_mod'])):
            $zoo_catalog_status = true;
        endif;
        if ($zoo_catalog_status) {
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            remove_action('zoo_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart',10);
        }
        return $zoo_catalog_status;
    }
}
//Shop Product style
if (!function_exists('zoo_product_style')) {
    function zoo_product_style(){

        $zoo_product_style = get_theme_mod('zoo_product_style', 'style-1');
        if (isset($_GET['style'])) {
            $zoo_product_style = $_GET['style'];
        }
        if($zoo_product_style!='default'){
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart',10);
        }
        return $zoo_product_style;
    }
} 
//Woocommerce Sidebar
if (!function_exists('zoo_woo_sidebar')) {
    function zoo_woo_sidebar(){
        
        $zoo_choose_sidebar_filter = get_theme_mod('zoo_choose_sidebar_filter','default');
        switch ($zoo_choose_sidebar_filter) {
            case 'default':
                $zoo_woo_sidebar = get_theme_mod('zoo_shop_sidebar_option_default', 'canvas-sidebar');
                break;
            case 'widget-ajax':
                $zoo_woo_sidebar = get_theme_mod('zoo_shop_sidebar_option_widget_ajax', 'canvas-sidebar');
                break;
            case 'cln':
                $zoo_woo_sidebar = get_theme_mod('zoo_shop_sidebar_option_cln', 'horizontal-sidebar');
                break;
            default:
                $zoo_woo_sidebar = get_theme_mod('zoo_shop_sidebar_option_default', 'canvas-sidebar');
                break;
        }
        
        if (isset($_GET['sidebar'])):
            if ($_GET['sidebar'] == 'left') {
                $zoo_woo_sidebar = 'left-sidebar';
            } else if ($_GET['sidebar'] == 'no') {
                $zoo_woo_sidebar = 'no-sidebar';
            }
            else if ($_GET['sidebar'] == 'canvas') {
                $zoo_woo_sidebar = 'canvas-sidebar';
            } 
            else if ($_GET['sidebar'] == 'horizontal') {
                $zoo_woo_sidebar = 'horizontal-sidebar';
            }else {
                $zoo_woo_sidebar = 'right-sidebar';
            }
        endif;
        check_vendor()?$zoo_woo_sidebar = 'left-sidebar' : $zoo_woo_sidebar;
        return $zoo_woo_sidebar;

    }
}
//Woocommerce Pagination
if (!function_exists('zoo_get_pagination')) {
    function zoo_get_pagination()
    {
        $zoo_choose_sidebar_filter = get_theme_mod('zoo_choose_sidebar_filter','default');
        switch ($zoo_choose_sidebar_filter) {
            case 'default':
                $zoo_get_pagination = get_theme_mod('zoo_products_pagination_default', 'numeric');
                break;
            case 'widget-ajax':
                $zoo_get_pagination = get_theme_mod('zoo_products_pagination_widget_ajax', 'infinity');
                break;
            case 'cln':
                $zoo_get_pagination = get_theme_mod('zoo_products_pagination_cln', 'numeric');
                break;
            default:
                $zoo_get_pagination = get_theme_mod('zoo_shop_sidebar_option_default', 'numeric');
                break;
        }
        if(isset($_GET['sidebar'])){

            if($_GET['sidebar'] == 'horizontal'){
                $zoo_get_pagination = 'numeric';
            }
            if($_GET['sidebar'] != 'horizontal' && $_GET['sidebar'] != ''){
                $zoo_get_pagination = 'infinity';
            }
        }
        return $zoo_get_pagination;

    }
}

//Woocommerce Shop Sidebar
if (!function_exists('zoo_get_shop_sidebar')) {
    function zoo_get_shop_sidebar()
    {
        $zoo_choose_sidebar_filter = get_theme_mod('zoo_choose_sidebar_filter','default');
        switch ($zoo_choose_sidebar_filter) {
            case 'default':
                $zoo_get_shop_sidebar = get_theme_mod('zoo_shop_sidebar_default', 'shop');
                break;
            case 'widget-ajax':
                $zoo_get_shop_sidebar = get_theme_mod('zoo_shop_sidebar_widget_ajax', 'shop');
                break;
            case 'cln':
                $zoo_get_shop_sidebar = get_theme_mod('zoo_shop_sidebar_cln', 'shop_cln');
                break;
            default:
                $zoo_get_shop_sidebar = get_theme_mod('zoo_shop_sidebar_default', 'shop');
                break;
        }
        if(isset($_GET['sidebar'])){
            if($_GET['sidebar'] == 'horizontal'){
                $zoo_get_shop_sidebar = 'shop_cln';
            }
            if($_GET['sidebar'] != 'horizontal' && $_GET['sidebar'] != ''){
                $zoo_get_shop_sidebar = 'shop';
            }
        }
        
        
        return $zoo_get_shop_sidebar;

    }
}

if(!function_exists('zoo_active_ajax_filter')){
    function zoo_active_ajax_filter(){
        $zoo_active_ajax_filter = null;
        if(get_theme_mod('zoo_choose_sidebar_filter','default')  == 'widget-ajax'){
            $zoo_active_ajax_filter = "catalog-sidebar";
        }
        return $zoo_active_ajax_filter;
    }
}

if (!function_exists('zoo_woo_sidebar_status')) {
    function zoo_woo_sidebar_status()
    {
        $zoo_sb_status = '';
        if (isset($_COOKIE['sidebar-status'])) {
            $zoo_sb_status = ($_COOKIE['sidebar-status'] == 'true' ? ' disable-sidebar' : '');
        }
        return $zoo_sb_status;
    }

}
//Layout options
if (!function_exists('zoo_woo_layout')) {
    function zoo_woo_layout()
    {
        return get_theme_mod('zoo_products_layout', 'grid-layout');
    }
}
/*Product item options*/
//Disable cart
if (get_theme_mod('zoo_product_cart_button', '0') == 1) {
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
}
//Sale label status
if (get_theme_mod('zoo_product_sale_label', '1') != 1) {
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
}
//Remove Rating
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
if (get_theme_mod('zoo_product_rating', '1') != 1) {
    add_action('zoo_woo_loop_rating', 'woocommerce_template_loop_rating', 5);
}
//Change position price
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 50);
//Hide Quick view
if (!function_exists('zoo_woo_enable_quickview')) {
    function zoo_woo_enable_quickview()
    {
        $zoo_qv_status = true;
        if (get_theme_mod('zoo_product_disable_qv', '0') == 1) {
            $zoo_qv_status = false;
        }
        return $zoo_qv_status;
    }

}
//Sale countdown
//add_action('woocommerce_before_shop_loop_item_title', 'zoo_sale_countdown', 10);
if (!function_exists('zoo_sale_countdown')) {
    function zoo_sale_countdown()
    {
        return wc_get_template_part('loop/sale-count','down');
    }

}
//Hide Stock label
if (!function_exists('zoo_woo_enable_stocklabel')) {
    function zoo_woo_enable_stocklabel()
    {
        $zoo_status = true;
        if (get_theme_mod('zoo_product_stock_label', '0') == 1) {
            $zoo_status = false;
        }
        return $zoo_status;
    }

}

//Add control New Product
add_action( 'woocommerce_product_options_general_product_data', 'wc_custom_add_custom_fields_new' );
if (!function_exists('wc_custom_add_custom_fields_new')) {
    function wc_custom_add_custom_fields_new() {
        woocommerce_wp_text_input( array(
            'id' => '_custom_product_day',
            'label' => 'New Product In',
            'description' => 'Enter number days ( Only positive integers ) will show "New"',
            'desc_tip' => 'true',
            ) 
        );
    }
}
add_action( 'woocommerce_process_product_meta', 'wc_custom_save_custom_fields' );
if (!function_exists('wc_custom_save_custom_fields')) {
    function wc_custom_save_custom_fields( $post_id ) {
        if ( ! empty( $_POST['_custom_product_day'] ) ) {
            update_post_meta( $post_id, '_custom_product_day', esc_attr( $_POST['_custom_product_day'] ) );
        }
    }
}
if(!function_exists('zoo_get_date_published')){
        function zoo_get_date_published(){
            $time = '';
            $time = current_time( 'timestamp' ) - get_the_time( 'U' );
            $date = ceil($time/(60*60*24));
            return $date;
        }
    }    
if (!function_exists('get_new_product')) {
    function get_new_product(){
        $_new_product = '';
        $_new_product = intval(get_post_meta(get_the_ID(),'_custom_product_day',true));
        if($_new_product > 0){
            if($_new_product - zoo_get_date_published() >= 0){
                return esc_html__('New','doma');
            } 

        }
    }
}
/*-------End Shop page functions--------*/
/*-------Single Woocommerce functions-------*/
//Single product navigation
if (!function_exists('zoo_woo_single_nav')) {
    function zoo_woo_single_nav()
    {
        $zoo_status = false;
        if (get_theme_mod('zoo_single_link_product', '1') == 1) {
            $zoo_status = true;
        }
        return $zoo_status;
    }
}
//Disable Zoom
if (!function_exists('zoo_woo_enable_zoom')) {
    function zoo_woo_enable_zoom()
    {
        $zoo_status = false;
        if (get_theme_mod('zoo_single_product_zoom', '1') == 1) {
            $zoo_status = true;
        }
        return $zoo_status;
    }
}
//Single Product share
if (!function_exists('zoo_woo_enable_share')) {
    function zoo_woo_enable_share()
    {
        $zoo_status = false;
        if (get_theme_mod('zoo_single_share', '1') == 1) {
            $zoo_status = true;
        }
        return $zoo_status;
    }
}
//Product Detail Layout
if (!function_exists('zoo_woo_gallery_layout_single')) {
    function zoo_woo_gallery_layout_single($productId='')
    {
        if($productId!=''){
            $zoo_layout_single = get_post_meta($productId, 'zoo_single_gallery_layout', true);
        }else{
            $zoo_layout_single = get_post_meta(get_the_ID(), 'zoo_single_gallery_layout', true);
        }
        if ($zoo_layout_single == 'inherit' || $zoo_layout_single == '') {
            $zoo_layout_single = get_theme_mod('zoo_single_gallery_layout', 'vertical-gallery');
        }
        return $zoo_layout_single;
    }
}
//Woocommerce Sidebar
if (!function_exists('zoo_woo_single_sidebar')) {
    function zoo_woo_single_sidebar()
    {
        $zoo_woo_sidebar = get_theme_mod('zoo_single_product_sidebar_option', 'no-sidebar');
        if (isset($_GET['sidebar'])):
            if ($_GET['sidebar'] == 'left') {
                $zoo_woo_sidebar = 'left-sidebar';
            } else if ($_GET['sidebar'] == 'no') {
                $zoo_woo_sidebar = 'no-sidebar';
            } else {
                $zoo_woo_sidebar = 'right-sidebar';
            }
        endif;
        return $zoo_woo_sidebar;
    }
}

//Change location of single product hook (remove if not use it)
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('zoo_woo_single_meta', 'woocommerce_template_single_meta', 10);
//Move price location
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);

remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
add_action('zoo_woocommerce_show_product_sale_flash', 'woocommerce_show_product_sale_flash', 5);
//Notice
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
add_action( 'zoo_woo_print_notices', 'wc_print_notices', 10 );
//Cart page
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('zoo_woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 5);
//Theme support lightbox
add_action( 'woocommerce_output_product_data_tabs', 'woocommerce_output_product_data_tabs',10 );
add_action( 'after_setup_theme', 'zoo_support_lb' );
if(!function_exists('zoo_support_lb')){
    function zoo_support_lb() {
        add_theme_support( 'wc-product-gallery-lightbox' );
    }
}
//Number related products display
if (!function_exists('zoo_woo_related_products_limit')) {
    function zoo_woo_related_products_limit($args)
    {
        $args['posts_per_page'] = get_theme_mod('zoo_single_related_product_number', '4');
        return $args;
    }
}
add_filter('woocommerce_output_related_products_args', 'zoo_woo_related_products_limit');
//Upsell product display
if ( ! function_exists( 'zoo_woo_output_upsells' ) ) {
    function zoo_woo_output_upsells() {
        $zoo_args = get_theme_mod('zoo_single_upsell_number', '4');
        woocommerce_upsell_display( $zoo_args,$zoo_args);
    }
}
add_filter( 'woocommerce_layered_nav_count','zoo_nav_count_change',1,1);
function zoo_nav_count_change($html){
    $html = str_replace('<span class="count">(', '<span  class="count">', $html);
    $html = str_replace(')</span>', '</span>', $html);
    return $html;
}
add_filter('wp_list_categories', 'zoo_cat_count_span');
function zoo_cat_count_span($links) {
    $links = str_replace('<span class="count">(', '<span  class="count">', $links);
    $links = str_replace(')</span>', '</span>', $links);
    return $links;
}
//Single product video
if (!function_exists('zoo_oembed_dataparse')) {
    function zoo_oembed_dataparse($return, $data, $url)
    {
        if (false === strpos($return, 'youtube.com'))
            return $return;
        $id = explode('watch?v=', $url);
        $add_id = str_replace('allowfullscreen>', 'allowfullscreen id="yt-' . $id[1] . '">', $return);
        $add_id = str_replace('?feature=oembed', '?enablejsapi=1', $add_id);
        return $add_id;
    }
}
add_filter('oembed_dataparse', 'zoo_oembed_dataparse', 10, 3);
add_action('zoo_single_product_video','zoo_product_video',10);
if(!function_exists('zoo_product_video')){
    function zoo_product_video(){
        $zoo_product_video= get_post_meta(get_the_ID(),'zoo_single_product_video',true);
        if($zoo_product_video!='') {

            $zoo_product_video_url = parse_url($zoo_product_video);
            if ($zoo_product_video_url['host'] == 'vimeo.com')
                wp_enqueue_script('vimeoapi', 'https://player.vimeo.com/api/player.js', true);
            if ($zoo_product_video_url['host'] == 'youtube.com' || $zoo_product_video_url['host'] == 'www.youtube.com')
                wp_enqueue_script('youtube-api', 'https://www.youtube.com/player_api', true);
            switch ($zoo_product_video_url['host']) {
                case 'vimeo.com':
                    $zoo_embed_class = 'vimeo-embed';
                    break;
                case 'youtube.com':
                    $zoo_embed_class = 'youtube-embed';
                    break;
                case 'www.youtube.com':
                    $zoo_embed_class = 'youtube-embed';
                    break;
                default:
                    $zoo_embed_class = '';
            }
            $zoo_pv_html = '<div class="wrap-product-video '.$zoo_embed_class.'"><a href=' . $zoo_product_video . ' title="' . get_the_title() . '" class="video-lb-control"><i class="cs-font clever-icon-play"></i> '.esc_html__("Watch Video","doma").'</a>';
            $zoo_pv_html .='<div class="mask-product-video"><i class="cs-font clever-icon-close-1"></i> </div>'.wp_oembed_get($zoo_product_video).'</div>';
            echo ent2ncr($zoo_pv_html);
            wp_enqueue_script('zoo-product-embed');
        }else{
            return;
        }

    }
}
//Move price,stock stt of variable product.
remove_action('woocommerce_single_variation','woocommerce_single_variation',10);
add_action('woocommerce_before_variations_form','woocommerce_single_variation',10);

if ( ! function_exists( 'woocommerce_widget_shopping_cart_button_view_cart' ) ) {
    function woocommerce_widget_shopping_cart_button_view_cart() {
        echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward" data-view="'.esc_html__( 'View cart', 'woocommerce' ).'">' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
    }
}
if ( ! function_exists( 'woocommerce_widget_shopping_cart_proceed_to_checkout' ) ) {
    function woocommerce_widget_shopping_cart_proceed_to_checkout() {
        echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward" data-check="'.esc_html__( 'Checkout', 'woocommerce' ).'">' . esc_html__( 'Checkout', 'woocommerce' ) . '</a>';
    }
}
/* Add to cart message*/
add_filter('woocommerce_add_to_cart_fragments', 'zoo_add_to_cart_message');
if (!function_exists("zoo_add_to_cart_message")) {
   function zoo_add_to_cart_message($fragments)
   {
       $product_id = isset($_POST['product_id'])?$_POST['product_id'] : '';
       if (get_option('woocommerce_cart_redirect_after_add') != 'yes' && $product_id != '') {
           $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
           $fragments['zoo_add_to_cart_message'] = '<div id="zoo-add-to-cart-message">' . wc_add_to_cart_message($product_id, $quantity, true) . '</div>';
       }
       return $fragments;
   }
}

if(!function_exists('zoo_custom_meta_wl_cp_before')){
    function zoo_custom_meta_wl_cp_before(){
        echo '<div class="wrap-wl-cp"><div class="wrap-ql-atc">';
    }
}
add_action('woocommerce_before_add_to_cart_button','zoo_custom_meta_wl_cp_before', 10 );
if(!function_exists('zoo_custom_meta_wl_cp')){
    function zoo_custom_meta_wl_cp(){
        echo '</div><div class="wl-cp">';
        if (is_plugin_active('yith-woocommerce-wishlist/init.php')) { 
            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
        }
        if (is_plugin_active('yith-woocommerce-compare/init.php')){?>
            <a href="<?php home_url('') ?>?action=yith-woocompare-add-product&amp;id=<?php echo get_the_ID() ?>" class="compare" title="<?php echo get_option('yith_woocompare_button_text'); ?>" data-product_id="<?php echo get_the_ID() ?>" rel="nofollow"></a>
        <?php 
        }
        echo '</div></div>';
    }
}
add_action('woocommerce_after_add_to_cart_button','zoo_custom_meta_wl_cp', 10 );

if(!function_exists('clever_get_page_base_url')){
    function clever_get_page_base_url() {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
            $link = get_post_type_archive_link( 'product' );
        } elseif ( is_product_category() ) {
            $link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
        } elseif ( is_product_tag() ) {
            $link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
        } else {
            $queried_object = get_queried_object();
            $link           = get_term_link( $queried_object->slug, $queried_object->taxonomy );
        }

        return $link;
    }
}

if(!function_exists('check_vendor')){
    function check_vendor(){
        global $WCMp, $vendor, $wp;
        $check_vendor = false;
        if (is_plugin_active('dc-woocommerce-multi-vendor/dc_product_vendor.php')) {
            $vendor_store = get_wcmp_vendor_by_store_url(home_url( $wp->request ));
            $check_vendor_store = $vendor_store ? $vendor_store->taxonomy : '';
            
            if($check_vendor_store == 'dc_vendor_shop'){
                $check_vendor = true;
            }
        }
        return $check_vendor;
    }
    
}

if (is_plugin_active('dc-woocommerce-multi-vendor/dc_product_vendor.php')) {

    // Add link Register form vendor
    if(!function_exists('clever_register_vendor_url')){
        function clever_register_vendor_url() {
            echo '<p class="vendor-register"><a href="'.esc_url(get_permalink(wcmp_vendor_registration_page_id())).'"> Create a Vendor account. </a></p>';
        }
    }
    add_action('woocommerce_register_vendor_form','clever_register_vendor_url', 10);

    // Get vendor user
    if(!function_exists('get_vendor_user')){
        function get_vendor_user() {
            global $WCMp;
            $ob_vendors = get_wcmp_vendors();
            $vendors = array();
            foreach ($ob_vendors as $key => $value) {
                $id = $value->user_data->data->ID;
                $name = $value->user_data->data->user_login;
                $vendors[]['id'] = $id;
                $vendors[]['name'] = $name;
            }
            return $vendors;
        }
    }
    
    if(!function_exists('wcmp_after_add_to_cart_form')){
        function wcmp_after_add_to_cart_form() {
            global $WCMp, $post;
            if ('Enable' === get_wcmp_vendor_settings('sold_by_catalog', 'general') && apply_filters('wcmp_sold_by_text_after_products_shop_page', true, $post->ID)) {
                $vendor = get_wcmp_product_vendors($post->ID);
                if ($vendor) {
                    $sold_by_text = apply_filters('wcmp_sold_by_text', __('', 'dc-woocommerce-multi-vendor'), $post->ID);
                    echo '<div class="vendor-link"><span>'.esc_html__('Sold by: ').'</span><a class="by-vendor-name-link" href="' . $vendor->permalink . '">' . $sold_by_text . ' ' . $vendor->user_data->display_name . '</a></div>';
                }
            }
        }
    }
    add_action('vendor_store_shop_link','wcmp_after_add_to_cart_form', 10);

    if(!function_exists('zoo_get_vendor_info')){
        function zoo_get_vendor_info(){
            global $WCMp, $vendor, $wp;
            $vendor_archive_info = array();
            $vendor_archive_info['vendor_id'] = $vendor_archive_info['display_name'] = $vendor_archive_info['profile'] = ''; 
            $vendor_archive_info['banner'] = $vendor_archive_info['description'] = $vendor_store = $check_vendor_store = ''; 

            $vendor_store = get_wcmp_vendor_by_store_url(home_url( $wp->request ));
            $check_vendor_store = $vendor_store ? $vendor_store->taxonomy : '';
            
            if($check_vendor_store == 'dc_vendor_shop'){
                $image = $vendor->get_image();
                $address = '';
                if ($vendor->city) {
                    $address = $vendor->city . ', ';
                }
                if ($vendor->state) {
                    $address .= $vendor->state . ', ';
                }
                if ($vendor->country) {
                    $address .= $vendor->country;
                }
                $vendor_archive_info['vendor_id'] = $vendor->id;
                $vendor_archive_info['display_name'] = $vendor->user_data->data->display_name;
                $vendor_archive_info['profile'] = $image;
                $vendor_archive_info['banner'] = $vendor->get_image('banner');
                $vendor_archive_info['description'] = stripslashes($vendor->description);
                $vendor_archive_info['mobile'] = $vendor->phone;
                $vendor_archive_info['location'] = $address;
                $vendor_archive_info['email'] = $vendor->user_data->user_email;

                $vendor_archive_info['social']['fb'] = get_user_meta($vendor->id, '_vendor_fb_profile', true);
                $vendor_archive_info['social']['tw'] = get_user_meta($vendor->id, '_vendor_twitter_profile', true);
                $vendor_archive_info['social']['ld'] = get_user_meta($vendor->id, '_vendor_linkdin_profile', true);
                $vendor_archive_info['social']['gp'] = get_user_meta($vendor->id, '_vendor_google_plus_profile', true);
                $vendor_archive_info['social']['yt'] = get_user_meta($vendor->id, '_vendor_youtube', true);
                $vendor_archive_info['social']['it'] = get_user_meta($vendor->id, '_vendor_instagram', true);
            }
            return $vendor_archive_info;
        }
    }
}

//Cart free shipping notice
if (!function_exists('zoo_free_shipping_cart_notice_zones')) {
   function zoo_free_shipping_cart_notice_zones()
   {
       if (get_theme_mod('zoo_show_get_free_shipping', true)) {
           global $woocommerce;
           $min_amounts = array();
           $default_zone = new WC_Shipping_Zone(0);
           $default_methods = $default_zone->get_shipping_methods();

           foreach ($default_methods as $key => $value) {
               if ($value->id === "free_shipping") {
                   if ($value->min_amount > 0) $min_amounts[] = $value->min_amount;
               }
           }
           $delivery_zones = WC_Shipping_Zones::get_zones();

           foreach ($delivery_zones as $key => $delivery_zone) {
               foreach ($delivery_zone['shipping_methods'] as $key => $value) {
                   if ($value->id === "free_shipping") {
                       if ($value->min_amount > 0) $min_amounts[] = $value->min_amount;
                   }
               }
           }
           if (is_array($min_amounts) && $min_amounts) {
               $min_amount = min($min_amounts);
               $current = WC()->cart->subtotal;
               $percent = ($current / $min_amount) * 100;
               $percent >= 100 ? $percent = '100' : '';
               
               $parse_class = '';
               if ($percent < 40) {
                   $parse_class = 'first-parse';
               } elseif ($percent >= 40 && $percent < 80) {
                   $parse_class = 'second-parse';
               } else {
                   $parse_class = 'final-parse';
               }
               $parse_class .= ' free-shipping-required-notice';
               if($percent){
                   if ($current < $min_amount) {
                       $added_text = '<div class="shipping-heading-notice">' . esc_html__('Get ', 'doma') . '<b>' . esc_html__('Free Shipping', 'doma') . '</b>' . esc_html__(' if you order ', 'doma') . wc_price($min_amount - $current) . esc_html__(' more!', 'doma') . '</div>';
                       $return_to = apply_filters('woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect(wc_get_raw_referer(), false) : wc_get_page_permalink('shop'));
                       $notice = sprintf('%s<a href="%s" class="button wc-forward">%s</a>', $added_text, esc_url($return_to), esc_html__('Continue Shopping', 'doma'));
                   } else {
                       $notice = '<div class="shipping-heading-notice">' . esc_html__('Congratulations! You\'ve got free shipping!', 'doma') . '</div>';
                   }
                   $html = '<div class="' . esc_attr($parse_class) . '">';
                   $html .= '<div class="zoo-loading-bar"><div class="load-percent" style="width:' . esc_attr($percent) . '%">';
                   $html .= esc_html(round($percent,2,PHP_ROUND_HALF_UP)) . '%';
                   $html .= '</div></div>';
                   $html .= $notice;
                   $html .= '</div>';
                   echo $html;
                }
           }
       }
   }
}
add_action('zoo_free_shipping_cart_notice', 'zoo_free_shipping_cart_notice_zones');