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
    wc_get_template_part('/woocommerce/theme-custom/stock','label');
    if(get_new_product() != ''): ?>
        <span class="product-new"><?php echo esc_attr(get_new_product()); ?></span>
    <?php endif;
    ?>
</div>
<div class="wrap-product-info">
    <h3 class="product-name"><a href="<?php the_permalink(); ?>"
                                title="<?php the_title(); ?>"><?php the_title(); ?></a>
        <?php
        /**
         * woocommerce_after_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        do_action('woocommerce_after_shop_loop_item');
        ?>
    </h3>
    <div class="wrap-after-shop-title">
        <?php
        do_action('zoo_woo_loop_rating');
        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action('woocommerce_after_shop_loop_item_title'); ?>
    </div>
    <?php
    if (shortcode_exists('zoo_cw_shop_swatch')) {
        echo do_shortcode('[zoo_cw_shop_swatch]');
    }
    ?>
    <div class="product-description">
        <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
    </div>
</div>
<div class="wrap-product-button">
    <div class="ef-cart"><?php do_action('zoo_loop_add_to_cart'); ?></div>
        <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {?>
        <div class="ef-wishlist">
            <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
        </div>  
        <?php } ?>
<?php if (is_plugin_active('yith-woocommerce-compare/init.php')) {?>
    <div class="ef-compare">
        <a href="<?php home_url('') ?>?action=yith-woocompare-add-product&amp;id=<?php echo get_the_ID() ?>" class="compare button" title="<?php echo get_option('yith_woocompare_button_text'); ?>" data-product_id="<?php echo get_the_ID() ?>" rel="nofollow"><i class="cs-font clever-icon-reload"></i></a></div>
<?php } ?>
<?php if (zoo_woo_enable_quickview()) {
    ?>
    <div class="ef-view"><a data-product_id="<?php echo esc_attr(get_the_id()); ?>" class="btn quick-view"
       href="#" title="<?php echo esc_attr__('Quick View', 'doma'); ?>">
        <i class="cs-font clever-icon-search-4"></i>
    </a></div>
<?php } ?>
</div>