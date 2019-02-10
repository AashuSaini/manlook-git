<?php
/**
 * Mini Ajax Cart block at header
 * Template of Zoo Theme
 * Ver: 1.0
 */
?>
<div class="mini-top-cart">
    <a href="#" class="search-trigger" title="Toggle Search block">
        <i class="cs-font clever-icon-search-5"></i>
    </a>
    <?php
    if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
        $wishlist_url = YITH_WCWL()->get_wishlist_url();
        ?>
        <div class="wishlist-url">
            <a href="<?php echo esc_url($wishlist_url) ?>" rel="nofollow"
               title="<?php echo apply_filters('yith-wcwl-browse-wishlist-label', '') ?>">
                <i class="cs-font clever-icon-heart-o"></i>
            </a>
        </div>
        <?php
    }
if (class_exists('WooCommerce')) {
    if (!zoo_woo_catalog_mod()) {
        ?>
        <div class="wrap-icon-cart">
            <a class="top-cart-icon" href="<?php echo wc_get_cart_url(); ?>"
               title="<?php echo esc_html__('View your shopping cart', 'doma') ?>"><i
                        class="cs-font clever-icon-cart-10"></i></a>
            <span class="top-cart-total">
            <?php echo sprintf(_n('<span>%d</span> <label>item</label>', '<span>%d</span> <label>items</label>', esc_html(WC()->cart->get_cart_contents_count()), 'doma'), esc_html(WC()->cart->get_cart_contents_count())); ?>
            </span>
        </div>
    <?php } } 
    if (is_active_sidebar('canvas-sidebar') && zoo_header_canvas_sidebar() == true){
        ?>
        <div class="canvas-sidebar-control">
            <a href="#" rel="nofollow" class="canvas-sidebar-trigger"
               title="<?php echo esc_attr__('Show/Hide off canvas sidebar','doma')?>">
                <i class="cs-font clever-icon-three-dots"></i>
            </a>
        </div>
    <?php
    }?>
</div>