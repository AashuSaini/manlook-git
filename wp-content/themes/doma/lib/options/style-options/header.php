<?php
/**
 * Style Panel of Header
 *
 * @uses    object    $wp_customize     WP_Customize_Manager
 * @uses    object    $this             Zoo_Customizer
 *
 * @package    zoo_Theme
 *
 */

/* ----------------------------------------------------------
					Section - Header
---------------------------------------------------------- */
$zoo_customize->add_section($zoo_style_prefix . 'header', array(
    'title' => esc_html__('Header', 'doma'),
    'panel' => 'style'
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'colors_type_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Top Header', 'doma') . '</div>',
    'priority' => 10
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_top_color',
    'label' => esc_html__('Color', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 11
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_top_link_color',
    'label' => esc_html__('Link color', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 12
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_top_link_color_hover',
    'label' => esc_html__('Link color hover', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 13
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_top_bg_color',
    'label' => esc_html__('Background', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 14
));

/* Options heading - Header main */
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'header_main_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Main Header', 'doma') . '</div>',
    'priority' => 15
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_main_color',
    'label' => esc_html__('Color', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 16
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_main_link_color',
    'label' => esc_html__('Link color', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '#252525',
    'priority' => 17
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_main_link_color_hover',
    'label' => esc_html__('Link color hover', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '#fb6622',
    'priority' => 18
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_main_background_color',
    'label' => esc_html__('Background', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 19
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_main_color_sticky',
    'label' => esc_html__('Color Sticky', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 19
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_main_color_hv_sticky',
    'label' => esc_html__('Color Hover Sticky', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 19
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_main_bg_sticky',
    'label' => esc_html__('Background Sticky', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 19
));

/* Options heading - Header Main Menu */
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'header_menu_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Header Navigation', 'doma') . '</div>',
    'priority' => 20
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' =>  $zoo_prefix . 'header_menu_color',
    'label' => esc_html__('Color', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 20
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'header_menu_bg',
    'label' => esc_html__('Background', 'doma'),
    'description' => esc_html__('Background of menu bar', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 20
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'header_menu_typo_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '<div class="zoo-options-heading-block">' . esc_html__('Main Menu', 'doma') . '</div>',
    'priority' => 21
));
// Navigation font
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' =>  $zoo_prefix . 'typo_main_menu',
    'label' => esc_html__('', 'doma'),
    'description' => esc_html__('Typography options for site navigation ', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => array(
        'font-family' => 'Exo',
        'variant' => '600',
        'subsets' => array(),
        'text-transform' => 'upppercase',
        'font-size' => '14',
        'line-height' => '1.5',
        'letter-spacing' => '0',
        'color' => '#252525',
    ),
    'priority' => 22
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'main_menu_color_hover',
    'label' => esc_html__('Color Hover', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 23
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'main_menu_bg',
    'label' => esc_html__('Background', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'description' => esc_html__('Background for main menu item', 'doma'),
    'default' => '',
    'priority' => 24
));$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'main_menu_bg_hover',
    'label' => esc_html__('Background hover', 'doma'),
    'description' => esc_html__('Background for main menu item when hover', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 24
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'header_menu_color_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '<div class="zoo-options-heading-block">' . esc_html__('Sub Menu', 'doma') . '</div>',
    'priority' => 25
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' =>  $zoo_prefix . 'typo_sub_menu',
    'label' => esc_html__('', 'doma'),
    'description' => esc_html__('Typography options for sub menu of site navigation ', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => array(
        'font-family' => 'Exo',
        'variant' => '400',
        'subsets' => array(),
        'text-transform' => 'none',
        'font-size' => '14',
        'line-height' => '1.5',
        'letter-spacing' => '0',
    ),
    'priority' => 25
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'sub_menu_color_hover',
    'label' => esc_html__('Color hover', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 26
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' =>  $zoo_prefix . 'sub_menu_block_bg',
    'label' => esc_html__('Background block', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'description' => esc_html__('Background for sub menu', 'doma'),
    'default' => '',
    'priority' => 27
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' =>  $zoo_prefix . 'sub_menu_bg',
    'label' => esc_html__('Background', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'description' => esc_html__('Background for sub menu item', 'doma'),
    'default' => '',
    'priority' => 27
));$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' =>  $zoo_prefix . 'sub_menu_bg_hover',
    'label' => esc_html__('Background hover', 'doma'),
    'description' => esc_html__('Background for sub menu item when hover', 'doma'),
    'section' => $zoo_style_prefix . 'header',
    'default' => '',
    'priority' => 27
));
