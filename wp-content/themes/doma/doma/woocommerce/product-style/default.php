<?php
/**
 * Style of product item
 * For Product Item
 * @since zoo-theme 1.0.4
 */
global $product;
?>

<div class="wrap-product-img">
    <?php
    /**
     * woocommerce_before_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action('woocommerce_before_shop_loop_item');

    /**
     * woocommerce_before_shop_loop_item_title hook.
     *
     * @hooked woocommerce_show_product_loop_sale_flash - 10
     * @hooked woocommerce_template_loop_product_thumbnail - 10
     */
    do_action('woocommerce_before_shop_loop_item_title');

    /**
     * woocommerce_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_product_title - 10
     *
     */
    if(get_new_product() != ''): ?>
        <span class="product-new"><?php echo esc_attr(get_new_product()); ?></span>
    <?php endif;
    if (zoo_woo_enable_stocklabel()) {
        if (!$product->is_in_stock()) {
            ?>
            <span class="out-stock-label stock-label"><?php esc_html_e('Out of Stock', 'doma'); ?></span>
            <?php
        } else {
            if (get_option('woocommerce_notify_low_stock_amount') > $product->get_stock_quantity() && $product->get_stock_quantity()) {
                ?>
                <span class="low-stock-label stock-label"><?php esc_html_e('Low Stock', 'doma'); ?></span>
                <?php
            }
        }
    }
    if (zoo_woo_enable_quickview()) {
        wp_enqueue_style('slick');
        wp_enqueue_script('slick');
        wp_enqueue_script('zoomove');
        wp_enqueue_script('wc-add-to-cart-variation');
        ?>
        <a data-product_id="<?php echo esc_attr(get_the_id()); ?>" class="btn quick-view"
           href="#">
            <?php echo esc_html__('Quick View', 'doma'); ?>
        </a>
    <?php } ?>
    <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
        } ?>
</div>
<div class="wrap-product-infor">
    <h3 class="product-name">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?></a>                
    </h3>
    <?php
    do_action('zoo_woo_loop_rating');
    ?>
    <div class="wrap-after-shop-title">
        <?php
        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action('woocommerce_after_shop_loop_item_title');
        ?>
    </div>
    <div class="product-description">
        <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
    </div>
    <div class="wrap-after-shop-cart">
        <?php

        /**
         * woocommerce_after_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        do_action('woocommerce_after_shop_loop_item');
        ?>
        <?php if (is_plugin_active('yith-woocommerce-compare/init.php')) {?>
            <div class="compare-button">
                <a href="<?php home_url('') ?>?action=yith-woocompare-add-product&amp;id=<?php echo get_the_ID() ?>" class="compare button" data-product_id="<?php echo get_the_ID() ?>" rel="nofollow"><?php echo get_option('yith_woocompare_button_text'); ?></a>
            </div>
        <?php } ?>
    </div>
</div>
<div class="list-style">
    <div class="right-top">
        <?php woocommerce_template_loop_price(); ?>
        <div class="cp-wl">
        <?php if (is_plugin_active('yith-woocommerce-compare/init.php')) {?>
            <a href="<?php home_url('') ?>?action=yith-woocompare-add-product&amp;id=<?php echo get_the_ID() ?>" class="compare button" title="<?php echo get_option('yith_woocompare_button_text'); ?>" data-product_id="<?php echo get_the_ID() ?>" rel="nofollow">
                <i class="cs-font clever-icon-reload"></i>
            </a>
        <?php } ?>
        <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {?>
            <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
        <?php } ?>
        </div>
    </div>
    <div class="right-middle">
        <?php echo esc_html__('Last updated: ','doma'); ?><?php echo esc_html(get_the_date()); ?>
    </div>
    <div class="right-bottom">
        <?php if (zoo_woo_enable_quickview()) {?>
        <a data-product_id="<?php echo esc_attr(get_the_id()); ?>" class="btn quick-view" href="#" title="<?php echo esc_attr__('Quick View', 'doma'); ?>">
            <?php echo esc_html__('Quick View', 'doma'); ?>
        </a>
        <?php } ?>
        <?php do_action('zoo_loop_add_to_cart'); ?>
    </div>
</div>