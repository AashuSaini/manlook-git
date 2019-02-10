<?php
/**
 * Style Panel of Body
 *
 * @uses    object    $wp_customize     WP_Customize_Manager
 * @uses    object    $this             Zoo_Customizer
 *
 * @package    zoo_Theme
 *
 */
/*Section body*/
$zoo_customize->add_section($zoo_style_prefix . 'body', array(
    'title' => esc_html__('Body', 'doma'),
    'panel' => 'style',
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'site_general_typo_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Typography', 'doma') . '</div>',
    'priority' => 10,
));
/*Starting typo*/
// Body font
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' => $zoo_prefix . 'typo_body_font',
    'label' => esc_html__('Body Font', 'doma'),
    'description' => esc_html__('Select the main typography options for your site.', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => array(
        'font-family' => 'Roboto',
        'variant' => '400',
        'subsets' => array(),
        'text-transform' => 'none',
        'font-size' => '16',
        'line-height' => '1.5',
        'letter-spacing' => '0',
        'color' => '#7d7d7d',
    ),
    'priority' => 11,
));

// Heading font
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' => $zoo_prefix . 'typo_heading_font',
    'label' => esc_html__('Heading font', 'doma'),
    'description' => esc_html__('Select the main typography options for a heading tag ( h1, h2, h3, h4, h5, h6 ).', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => array(
        'font-family' => 'Poppins',
        'variant' => '700',
        'letter-spacing' => '0'
    ),
    'priority' => 12,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'text',
    'settings' => $zoo_prefix . 'typo_heading_size_h1',
    'label' => esc_html__('H1', 'doma'),
    'description' => esc_html__('Select the main typography options for h1 tag.', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '36px',
    'priority' => 13,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'text',
    'settings' => $zoo_prefix . 'typo_heading_size_h2',
    'label' => esc_html__('H2', 'doma'),
    'description' => esc_html__('Select the main typography options for h2 tag.', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '30px',
    'priority' => 14,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'text',
    'settings' => $zoo_prefix . 'typo_heading_size_h3',
    'label' => esc_html__('H3', 'doma'),
    'description' => esc_html__('Select the main typography options for h3 tag.', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '24px',
    'priority' => 15,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'text',
    'settings' => $zoo_prefix . 'typo_heading_size_h4',
    'label' => esc_html__('H4', 'doma'),
    'description' => esc_html__('Select the main typography options for h4 tag.', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '20px',
    'priority' => 16,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'text',
    'settings' => $zoo_prefix . 'typo_heading_size_h5',
    'label' => esc_html__('H5', 'doma'),
    'description' => esc_html__('Select the main typography options for h5 tag.', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '18px',
    'priority' => 17,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'text',
    'settings' => $zoo_prefix . 'typo_heading_size_h6',
    'label' => esc_html__('H6', 'doma'),
    'description' => esc_html__('Select the main typography options for h6 tag.', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '14px',
    'priority' => 18,
));

/*End typo*/
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'site_general_color_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Color', 'doma') . '</div>',
    'priority' => 19,
));
// Base color
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'color_body',
    'label' => esc_html__('Body Color', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'priority' => 20,
    'default' => ''
));

// Heading color
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'color_heading',
    'label' => esc_html__('Heading Color', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'priority' => 21,
    'default' => ''
));

// Link Color
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'color_link',
    'label' => esc_html__('Link Color', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '',
    'priority' => 23,
));
// Link Color: Hover
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'color_link_hover',
    'label' => esc_html__('Link Color: Hover', 'doma'),
    'section' => $zoo_style_prefix . 'body',
    'default' => '',
    'priority' => 24,
));
