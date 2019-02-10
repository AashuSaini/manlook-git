<?php
/**
 * Style Panel
 *
 * @uses    object    $wp_customize     WP_Customize_Manager
 * @uses    object    $this             Zoo_Customizer
 *
 * @package    zoo_Theme\Core\Backend\Customizer
 */
$zoo_prefix = 'zoo_';
$zoo_style_prefix = 'zoo_style_';
$zoo_customize->add_panel('style', array(
    'title' => esc_html__('Style', 'doma'),
    'description' => esc_html__('Control your theme color, background, typography...', 'doma'),
    'priority' => 85
));
/*Section General*/
$zoo_customize->add_section($zoo_style_prefix . 'general', array(
    'title' => esc_html__('General', 'doma'),
    'panel' => 'style'
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'site_font_awesome',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Font Icon', 'doma') . '</div>',
    'priority' => 5,
));
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'switch',
    'settings' => $zoo_prefix . 'enable_font_awesome',
    'label'     => esc_html__( 'Enable page loader Font Awesome', 'doma' ),
    'section'   => $zoo_style_prefix .'general',
    'default'   => 'off',
    'choices'     => array(
        'on'  => esc_html__( 'On', 'doma' ),
        'off' => esc_html__( 'Off', 'doma' ),
    ),
    'priority' => 5
) );
/*Color for general*/
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'site_color_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Color', 'doma') . '</div>',
    'priority' => 10,
));

// Accent color
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'color_accent',
    'label' => esc_html__('Accent Color', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '#FB6622 ',
    'priority' => 10,
));
// Button color
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'button_color',
    'label' => esc_html__('Button Color', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '#fff',
    'priority' => 10,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'button_color_hover',
    'label' => esc_html__('Button Color Hover', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '#fff',
    'priority' => 10,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'button_color_bg',
    'label' => esc_html__('Button Color Background', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '#FB6622',
    'priority' => 10,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'button_color_bg_hover',
    'label' => esc_html__('Button Color Background Hover', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '#f75d17',
    'priority' => 10,
));


/* Options heading - Site background */
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'site_bg_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Site Background', 'doma') . '</div>',
    'priority' => 23,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'site_background_color',
    'label' => esc_html__('Default Background Color', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '',
    'priority' => 24,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'image',
    'settings' => $zoo_prefix . 'site_background_image',
    'label' => esc_html__('Default Background Image', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => '',
    'priority' => 25,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'select',
    'settings' => $zoo_prefix . 'site_background_size',
    'label' => esc_html__('Background Size', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => 'cover',
    'choices' => array(
        'auto' => esc_html__('Auto', 'doma'),
        'cover' => esc_html__('Cover', 'doma'),
        'contain' => esc_html__('Contain', 'doma'),
        'initial' => esc_html__('Initial', 'doma')
    ),
    'priority' => 26,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'select',
    'settings' => $zoo_prefix . 'site_background_repeat',
    'label' => esc_html__('Background Repeat', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => 'no-repeat',
    'choices' => array(
        'no-repeat' => esc_html__('No Repeat', 'doma'),
        'repeat' => esc_html__('Repeat', 'doma'),
        'repeat-x' => esc_html__('Repeat X', 'doma'),
        'repeat-y' => esc_html__('Repeat Y', 'doma')
    ),
    'priority' => 27,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'select',
    'settings' => $zoo_prefix . 'site_background_position',
    'label' => esc_html__('Background Position', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => 'center center',
    'choices' => array(
        'left top' => esc_html__('Left Top', 'doma'),
        'left center' => esc_html__('Left Center', 'doma'),
        'left bottom' => esc_html__('Left Bottom', 'doma'),
        'right top' => esc_html__('Right Top', 'doma'),
        'right center' => esc_html__('Right Center', 'doma'),
        'right bottom' => esc_html__('Right Bottom', 'doma'),
        'center top' => esc_html__('Center Top', 'doma'),
        'center bottom' => esc_html__('Center Bottom', 'doma'),
        'center center' => esc_html__('Center Center', 'doma')
    ),
    'priority' => 28,
));

$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'select',
    'settings' => $zoo_prefix . 'site_background_attachment',
    'label' => esc_html__('Background Attachment', 'doma'),
    'section' => $zoo_style_prefix . 'general',
    'default' => 'inherit',
    'choices' => array(
        'inherit' => esc_html__('Inherit', 'doma'),
        'scroll' => esc_html__('Scroll', 'doma'),
        'fixed' => esc_html__('Fixed', 'doma'),
        'local' => esc_html__('Local', 'doma')
    ),
    'priority' => 29,
));

require ZOO_THEME_DIR . 'lib/options/style-options/header.php';
require ZOO_THEME_DIR . 'lib/options/style-options/body.php';
require ZOO_THEME_DIR . 'lib/options/style-options/blog.php';
require ZOO_THEME_DIR . 'lib/options/style-options/woocommerce.php';
require ZOO_THEME_DIR . 'lib/options/style-options/footer.php';
require ZOO_THEME_DIR . 'lib/options/style-options/extend.php';
