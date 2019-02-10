<?php
/**
 * Top Header Template
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
?>
<?php if (is_active_sidebar('top-left-header') || is_active_sidebar('top-right-header') ): ?>
<div id="top-header" class="top-header">
    <?php if(zoo_header_fullwidth() == null):?>
        <div class="container">
        <?php endif; ?>
            <div class="row">
            <?php
            if (zoo_header_layout() != 'two-lines-4') {
                ?>
                <div class="col-xs-12 col-sm-6" id="top-left-header">
                    <?php dynamic_sidebar('top-left-header'); ?>
                </div>
            <?php } ?>
            <div class="col-xs-12 col-sm-6" id="top-right-header">
                <?php
                if (zoo_header_layout() == 'two-lines-4') {
                ?>
                <div class="wrap-top-link pull-right">
                    <?php
                    if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                        ?>
                        <a class="top-acc-url zoo-top-link"
                           href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                           title="<?php if (!is_user_logged_in()) {
                               echo esc_attr__('Sign In', 'doma');
                           } else {
                               echo esc_attr__('Hello', 'doma');
                               $zoo_current_user = wp_get_current_user();
                               printf(' %s!', esc_html($zoo_current_user->display_name));
                           } ; ?>">
                            <i class="cs-font  clever-icon-user-6"></i>
                            <span>
                    <?php if (!is_user_logged_in()) {
                        echo esc_html__('Sign In', 'doma');
                    } else {
                        echo esc_html__('Hello', 'doma');
                        $zoo_current_user = wp_get_current_user();
                        printf(' %s!', esc_html($zoo_current_user->display_name));
                    } ?>
                        </span>
                        </a>
                        <?php
                    }
                    if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
                        $wishlist_url = YITH_WCWL()->get_wishlist_url();
                        ?>
                        <a class="zoo-top-link zoo-wl-url" href="<?php echo esc_url($wishlist_url) ?>" rel="nofollow"
                           title="<?php echo apply_filters('yith-wcwl-browse-wishlist-label', esc_attr__('Wishlist', 'doma')) ?>">
                            <i class="cs-font clever-icon-heart-1"></i>
                            <span><?php echo apply_filters('yith-wcwl-browse-wishlist-label', esc_html__('Wishlist', 'doma')) ?></span>
                        </a>
                        <?php
                    }
                    }
                    if (zoo_header_layout() == 'two-lines-3' || zoo_header_layout() == 'two-lines-4') {
                    get_template_part('/inc/templates/search', 'form');
                    if (zoo_header_layout() == 'two-lines-4'){
                    ?>
                </div>
            <?php } ?>
                <div class="wrap-widgets">
                    <?php
                    }
                    dynamic_sidebar('top-right-header');
                    if (zoo_header_layout() == 'two-lines-3' || zoo_header_layout() == 'two-lines-4') { ?>
                </div>
            <?php } ?>
            </div>
        </div>
    <?php if(zoo_header_fullwidth() == null) :?>
        </div>
    <?php endif; ?>
</div>
<?php endif; ?>