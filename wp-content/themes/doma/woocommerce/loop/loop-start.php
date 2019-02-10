<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
global $wp;
$zoo_wrap = zoo_woo_layout();
$zoo_wrap .= zoo_woo_catalog_mod()||get_theme_mod('zoo_product_cart_button', '0') == 1?' cart-disable':'';
$data_link = get_permalink(wc_get_page_id('shop'));
if(check_vendor()){
	$data_link = home_url( $wp->request );
}
$columns = '';
if(is_shop() || is_product_category() || check_vendor()){
	$columns = ' grid-lg-'.get_theme_mod('zoo_products_columns_pc','4').'-cols grid-md-'. get_theme_mod('zoo_products_columns_tablet','3').'-cols grid-'.get_theme_mod('zoo_products_columns_mobile','2').'-cols';
}
?>
<ul class="products <?php echo esc_attr($zoo_wrap).esc_attr($columns);?>" data-shoplink="<?php echo esc_url($data_link) ?>">
