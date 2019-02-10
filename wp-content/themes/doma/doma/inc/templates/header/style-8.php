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
<div id="main-header" class="wrap-header-block">
    <div class="main-header-inner">
        <div id="site-branding">
            <div class="site-branding-inner">
                <div class="wrap-logo">
                    <?php get_template_part('inc/templates/logo'); ?>
                </div>
                <div id="main-navigation" class="primary-nav">
                <?php
                if (has_nav_menu('vertical')) {
                    wp_nav_menu(array('container_class' => 'main-menu', 'theme_location' => 'vertical', 'container' => 'nav'));
                } else {
                    wp_nav_menu(array('container_class' => 'main-menu', 'container' => 'nav'));
                }
                ?>
                </div>
                <div class="site-branding-right vertical">
                    <?php get_template_part('inc/templates/header/icon', 'header'); ?>
                </div>
            </div>
        </div>
        
    </div>
</div>