<?php
/**
 * Footer Panel
 *
 * @uses    object    $this          CleverTheme
 * @uses    object    $this    Clever_Customizer
 *
 * @package    Clever_Theme\Core\Backend\Customizer
 */

$zoo_customize->add_section('footer', array(
    'title'       => esc_html__('Footer', 'doma'),
    'description' => esc_html__('Footer theme options.', 'doma'),
    'priority' => 82
));
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => 'zoo_footer_layout_heading',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => 'footer',
    'default'   => '<div class="zoo-options-heading">' . esc_html__( 'Footer Layout', 'doma' ) . '</div>','priority' => 5
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'radio-image',
    'settings' => 'zoo_footer_layout',
    'label'    => esc_html__( 'Footer Layout', 'doma' ),
    'section'  => 'footer',
    'default'  => 'style-1',
    'choices'  => array(
        'style-1' => esc_url(get_template_directory_uri() . '/lib/assets/icons/footer-style1.png'),
        'style-2' => esc_url(get_template_directory_uri() . '/lib/assets/icons/footer-style2.png'),
        'style-3' => esc_url(get_template_directory_uri() . '/lib/assets/icons/footer-style3.png'),
        'style-4' => esc_url(get_template_directory_uri() . '/lib/assets/icons/footer-style4.png'),
        'style-5' => esc_url(get_template_directory_uri() . '/lib/assets/icons/footer-style4.png'),
    ),
    'priority' => 6
) );
/* Options heading - Top Footer */
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => 'zoo_top_footer_heading',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => 'footer',
    'default'   => '<div class="zoo-options-heading">' . esc_html__( 'Top Footer', 'doma' ) . '</div>',
    'priority' => 10
) );

$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_top_footer',
    'label'     => esc_html__( 'Enable Top Footer', 'doma' ),
    'section'   => 'footer',
    'default'   => '0',
    'priority' => 11
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_main_footer',
    'label'     => esc_html__( 'Enable Main Footer', 'doma' ),
    'section'   => 'footer',
    'default'   => '1',
    'priority' => 12
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_enable_footer_fullwidth',
    'label'     => esc_html__( '100% Footer Width', 'doma' ),
    'section'   => 'footer',
    'default'   => '0',
    'priority' => 12
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_enable_footer_sticky',
    'label'     => esc_html__( 'Enable Sticky Footer', 'doma' ),
    'section'   => 'footer',
    'default'   => '0',
    'priority' => 12
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => 'zoo_bottom_footer_heading',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => 'footer',
    'default'   => '<div class="zoo-options-heading">' . esc_html__( 'Bottom Footer', 'doma' ) . '</div>',
    'priority' => 12
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'textarea',
    'settings' => 'zoo_footer_copyright',
    'label'    => esc_html__( 'Copyright text', 'doma' ),
    'section'  => 'footer',
    'default'  => esc_html( 'Copyright &#169; 2018 <a href="#"> ZooTemplate</a>. All rights reserved','doma' ),
    'priority' => 13
) );
