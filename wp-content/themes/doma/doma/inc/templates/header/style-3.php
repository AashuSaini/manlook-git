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
<div id="main-header" class="wrap-header-block <?php echo esc_attr($zoo_sticky) ?>">
    <div class="main-header-inner">
        <div id="site-branding">
            <?php if(zoo_header_fullwidth() == null):?>
            <div class="container">
            <?php endif; ?>
            <div class="site-branding-inner">
                <div class="wrap-logo">
                    <?php get_template_part('inc/templates/logo'); ?>
                    <?php get_template_part('inc/templates/sticky','logo'); ?>
                </div>
                <div id="main-navigation" class="primary-nav">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array('container_class' => 'main-menu', 'theme_location' => 'primary', 'container' => 'nav'));
                } else {
                    wp_nav_menu(array('container_class' => 'main-menu', 'container' => 'nav'));
                }
                ?>
                </div>
                <?php get_template_part('inc/templates/header/icon', 'header'); ?>
            </div>
            <?php if(zoo_header_fullwidth() == null) :?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>