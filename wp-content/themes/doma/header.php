<?php
/**
 * The template for displaying the header
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<?php
$zoo_class_header = '';
$zoo_header_top = zoo_enable_header_top();
$zoo_header_layout = zoo_header_layout();
$zoo_class_header .= zoo_header_fullwidth() . ' ' . $zoo_header_layout;
?>
<body <?php body_class(); ?>>
<?php
if (get_theme_mod('zoo_site_page_loader', '0') == 1) {
    ?>
    <div id="page-load">
        <span class="loading"></span>
    </div>
    <?php
}
if (zoo_header_stick() != '') {
    wp_enqueue_script('sticky');
}
get_template_part('/inc/templates/search','form');
if (is_active_sidebar('canvas-sidebar')) {?>
    <div id="canvas-sidebar" class="sidebar canvas">
        <span class="close-canvas"><i class="cs-font  clever-icon-close-1"></i> </span>
        <?php dynamic_sidebar('canvas-sidebar'); ?>
    </div>
    <div class="mask-canvas-sidebar"></div>
<?php } ?>
<?php if (zoo_boxes()) : ?>
<div class="layout-boxes container <?php if (get_theme_mod('zoo_site_layout_box_shadow', '1') == 1) {
    echo esc_attr('box-shadow');
} ?>">
    <?php endif; ?>
    <div class="mask-nav"></div>
    <div class="wrap-mobile-nav">
        <span class="close-nav"><i class="cs-font clever-icon-close"></i> </span>
        <nav id="mobile-nav" class="primary-font">
            <?php wp_nav_menu(array('container_class' => 'mobile-menu', 'theme_location' => 'mobile')); ?>
        </nav>
    </div>
    <header id="zoo-header" class="wrap-header <?php echo esc_attr($zoo_class_header); ?>">
        <?php
        if(zoo_enable_top_header_slogun() == 1){
            get_template_part('/inc/templates/header/top-header-2');
        }
        if ($zoo_header_top != 0) {
            get_template_part('/inc/templates/header/top-header-'.$zoo_header_top);
        }
        get_template_part('/inc/templates/header/mobile-header');
        get_template_part('/inc/templates/header/' . $zoo_header_layout);
        ?>
    </header>