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
$zoo_sticky = zoo_header_stick();
?>
<div id="main-header" class="wrap-header-block">
    <div class="main-header-inner">
        <div id="site-branding">
            <?php if(zoo_header_fullwidth() == null):?>
            <div class="container">
            <?php endif; ?>
            <div class="site-branding-inner">
                <?php
                if(is_plugin_active('ajax-search-lite/ajax-search-lite.php')){
                    echo do_shortcode('[wpdreams_ajaxsearchlite]');
                }else{
                ?>
                <form method="get" class="search-form clearfix" action="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                    if (class_exists('WooCommerce')) {
                        ?>
                        <input type="hidden" name="post_type" value="product"/>
                        <?php
                    } ?>
                    <input type="text" class="ipt text-field body-font" name="s"
                           placeholder="<?php echo esc_attr__('Search products...', 'doma'); ?>" autocomplete="off"/>
                    <button type="submit" class="btn">
                        <i class="cs-font clever-icon-search-5"></i>
                    </button>
                </form>
                <?php } ?>
                
                <div class="wrap-logo">
                    <?php get_template_part('inc/templates/logo'); ?>
                </div>
                <?php get_template_part('inc/templates/header/icon', 'header'); ?>
            </div>
            <?php if(zoo_header_fullwidth() == null) :?>
            </div>
        <?php endif; ?>
        </div>
        <div id="main-navigation" class="primary-nav menu-mini-cart <?php echo esc_attr($zoo_sticky) ?>">
            <?php if(zoo_header_fullwidth() == null):?>
            <div class="container">
            <?php endif; ?>
                <div class="main-navigation-inner">
                <?php get_template_part('inc/templates/sticky','logo'); ?>
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array('container_class' => 'main-menu', 'theme_location' => 'primary', 'container' => 'nav'));
                } else {
                    wp_nav_menu(array('container_class' => 'main-menu', 'container' => 'nav'));
                }
                get_template_part('woocommerce/theme-custom/mini-top', 'cart');
                ?>
                </div>
            <?php if(zoo_header_fullwidth() == null) :?>
            </div>
            <?php endif; ?>
            
        </div>
    </div>
</div>