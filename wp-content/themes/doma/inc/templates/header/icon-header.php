<?php
/**
 * Menu Right layout.
 * Template of Zoo Theme
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
?>
<ul class="icon-header">
    <?php if(zoo_header_layout() != 'style-4' && zoo_header_layout() != 'style-5' && zoo_header_layout() != 'style-6' && zoo_header_layout() != 'style-vendor'): ?>
    <li class="search">
        <a href="#" class="search-trigger" title="<?php echo esc_attr__('Toggle Search block', 'doma') ?>">
            <i class="cs-font clever-icon-search-5"></i>
        </a>
    </li>
    <?php endif; ?>
    <?php if (class_exists('WooCommerce')) :
        if(get_theme_mod('zoo_login_icon','1')):
            if ( !is_user_logged_in() ) : ?>
                <li class="icon-user login">
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                        <i class="cs-font clever-icon-user-6"></i>
                    </a>
                    <?php if( !is_checkout() ): ?>
                    <div class="login-form-popup">
                        <div class="wrap-login-form">
                            <label class="close-login"><i class="cs-font clever-icon-close"></i></label>
                            <p><label class="lb-login"><?php echo esc_html__('Sign In','doma'); ?></label>
                                <label class="lb-register click"><a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php echo esc_html__('Create an Account','doma'); ?></a></label></p>
                            <?php echo do_shortcode('[woocommerce_my_account]'); ?>
                        </div>
                    </div>
                    <div class="overlay"></div>
                    <?php endif; ?>
                </li>
            <?php else : ?>
                <li class="icon-user logout">
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                        <i class="cs-font clever-icon-user-6"></i>
                    </a>
                    <div class="wrap-dashboard-form">
                        <?php echo do_shortcode('[woocommerce_my_account]'); ?>
                    </div>
                </li>
        <?php endif; endif;
        if (is_plugin_active('yith-woocommerce-wishlist/init.php')) :
            $wishlist_url = YITH_WCWL()->get_wishlist_url();
            ?>
            <li class="top-wl-url">
                <a href="<?php echo esc_url($wishlist_url) ?>" rel="nofollow"
                   title="<?php echo apply_filters('yith-wcwl-browse-wishlist-label', '') ?>">
                    <i class="cs-font clever-icon-heart-o"></i>
                </a>
            </li>
            <?php
        endif;
        if (!zoo_woo_catalog_mod()) : ?>
            <li class="top-ajax-cart">
                <?php
                get_template_part('woocommerce/theme-custom/topheadcart'); ?>
            </li>
            <?php
        endif;
    endif;

    if (is_active_sidebar('canvas-sidebar') && zoo_header_canvas_sidebar() == true):
        ?>
        <li class="canvas-sidebar-control">
            <a href="#" rel="nofollow" class="canvas-sidebar-trigger"
               title="<?php echo esc_attr__('Show/Hide off canvas sidebar','doma')?>">
                <i class="cs-font clever-icon-three-dots"></i>
            </a>
        </li>
    <?php endif; ?>
</ul>
