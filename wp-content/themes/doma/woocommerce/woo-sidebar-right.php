<?php

/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage zoo-theme
 * @since zoo-theme 1.0
 */
$zoo_sidebar = zoo_get_shop_sidebar();
check_vendor() ? $zoo_sidebar = 'vendor' : $zoo_sidebar;
if(is_single()){
    $zoo_sidebar = get_theme_mod('zoo_single_product_sidebar', 'shop-single');
}?>
<aside id="zoo-woo-sidebar-right" class="zoo-woo-sidebar widget-area col-xs-12 col-sm-12 col-md-3 <?php echo zoo_active_ajax_filter(); ?>" role="complementary">
    <a href="#" class="close-btn close-sidebar" title="<?php esc_attr__('Close','doma')?>"><i class="cs-font clever-icon-close"></i> </a>
    <div class="content-zoo-woo-sidebar">
        <?php dynamic_sidebar($zoo_sidebar); ?>
    </div>
</aside><!-- .widget-area -->
<div class="mask-sidebar"></div>
