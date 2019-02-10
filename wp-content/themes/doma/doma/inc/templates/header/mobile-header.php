<?php
/**
 * Stack menu left
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
<div id="main-header-mobile">
    <div id="site-branding-mobile">
        <div class="mobile-menu-icon">
            <a href="#" id="menu-mobile-trigger">
                <i class="clever-icon-menu-1 cs-font"></i>
            </a>
            <a href="#" class="search-trigger" title="<?php echo esc_attr__('Toggle Search block', 'doma') ?>">
                <i class="cs-font clever-icon-search-5"></i>
            </a>
        </div>
        <?php get_template_part('inc/templates/mobile','logo'); ?>
        <?php if(class_exists('WooCommerce') && !zoo_woo_catalog_mod() || is_active_sidebar('canvas-sidebar')): ?>
        <ul class="icon-header">
            <?php if (class_exists('WooCommerce')) :
                if (!zoo_woo_catalog_mod()) : ?>
                    <li class="top-ajax-cart">
                        <div id="top-cart-mobile" class="top-cart">
                            <div class="wrap-icon-cart">
                                <a class="top-cart-icon" href="<?php echo wc_get_cart_url(); ?>"
                                   title="<?php echo esc_html__('View your shopping cart', 'doma') ?>"><i
                                        class="cs-font clever-icon-cart-10"></i></a>
                                 <span class="top-cart-total">
                                <?php echo sprintf(_n('<span>%d</span> <label>item</label>', '<span>%d</span> <label>items</label>', esc_html(WC()->cart->get_cart_contents_count()), 'doma'), esc_html(WC()->cart->get_cart_contents_count())); ?>
                            </span>
                            </div>

                        </div>
                    </li>
                    <?php
                endif;endif;
                ?>
            <?php if(is_active_sidebar('canvas-sidebar')): ?>
            <li class="canvas-sidebar-control">
                <a href="#" rel="nofollow" class="canvas-sidebar-trigger"
                   title="<?php echo esc_attr__('Show/Hide off canvas sidebar','doma')?>">
                    <i class="cs-font clever-icon-three-dots"></i>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>