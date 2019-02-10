<?php
/**
 * Style Panel of Extend style
 * All style of input and button add at here
 *
 * @uses    object    $wp_customize     WP_Customize_Manager
 * @uses    object    $this             Zoo_Customizer
 *
 * @package    zoo_Theme
 */
$zoo_customize->add_section($zoo_style_prefix . 'form', array(
    'title' => esc_html__('Form field and button', 'doma'),
    'panel' => 'style'
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'form_style_heading',
    'section' => $zoo_style_prefix . 'form',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Form field', 'doma') . '</div>',
    'priority' => 10,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'form_style_color',
    'label' => esc_html__('Color', 'doma'),
    'description' => esc_html__('Color of form field', 'doma'),
    'section' => $zoo_style_prefix . 'form',
    'default' => '',
    'priority' => 11
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'form_style_border',
    'label' => esc_html__('Border color', 'doma'),
    'description' => esc_html__('Border color of form field', 'doma'),
    'section' => $zoo_style_prefix . 'form',
    'default' => '',
    'priority' => 11
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'form_style_border_active',
    'label' => esc_html__('Border color active', 'doma'),
    'description' => esc_html__('Border color of form field when active or focus', 'doma'),
    'section' => $zoo_style_prefix . 'form',
    'default' => '',
    'priority' => 11
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'form_style_bg',
    'label' => esc_html__('Background', 'doma'),
    'description' => esc_html__('Background color of form field.', 'doma'),
    'section' => $zoo_style_prefix . 'form',
    'default' => '',
    'priority' => 11
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'btn_style_heading',
    'section' => $zoo_style_prefix . 'form',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Button', 'doma') . '</div>',
    'priority' => 15,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'btn_style_color',
    'label' => esc_html__('Color', 'doma'),
    'section' => $zoo_style_prefix . 'form',
    'default' => '',
    'priority' => 16
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'btn_style_color_hover',
    'label' => esc_html__('Color hover', 'doma'),
    'section' => $zoo_style_prefix . 'form',
    'default' => '',
    'priority' => 16
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'btn_style_bg',
    'label' => esc_html__('Background', 'doma'),
    'section' => $zoo_style_prefix . 'form',
    'default' => '',
    'priority' => 16
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'btn_style_bg_hover',
    'label' => esc_html__('Background hover', 'doma'),
    'section' => $zoo_style_prefix . 'form',
    'default' => '',
    'priority' => 16
));
