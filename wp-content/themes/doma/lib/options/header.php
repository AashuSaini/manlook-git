<?php
/**
 * Header Panel
 *
 * @uses    object    $this          CleverTheme
 * @uses    object    $this    zoo_Customizer
 *
 * @package    zoo_Theme\Core\Backend\Customizer
 */

/* ----------------------------------------------------------
					Section - Site Identity
---------------------------------------------------------- */

$zoo_customize->add_field( 'zoo_customizer',  array(
    'type'        => 'image',
    'settings'    => 'zoo_site_logo_sticky',
    'label'       => esc_html__( 'Site Logo - Sticky', 'doma' ),
    'description' => esc_html__( 'An alternative logo image used on headers sticky.', 'doma' ),
    'section'     => 'title_tagline',
    'transport'   => $transport,
) );

$zoo_customize->add_field( 'zoo_customizer',  array(
    'type'        => 'image',
    'settings'    => 'zoo_site_logo_mobile',
    'label'       => esc_html__( 'Site Logo - Mobile', 'doma' ),
    'description' => esc_html__( 'An alternative logo image used on headers mobile device.', 'doma' ),
    'section'     => 'title_tagline',
    'transport'   => $transport,
) );

$zoo_customize->add_field( 'zoo_customizer',  array(
    'type'     => 'number',
    'settings' => 'zoo_logo_height',
    'label'    => esc_html__( 'Logo Height', 'doma' ),
    'description' => esc_html__( 'Height of logo. If it blank, logo will use keep original size of logo image', 'doma' ),
    'section'  => 'title_tagline',
    'default'  => '',
) );$zoo_customize->add_field( 'zoo_customizer',  array(
    'type'     => 'slider',
    'settings' => 'zoo_main_header_padding_top',
    'label'    => esc_html__( 'Main Header Padding Top', 'doma' ),
    'section'  => 'title_tagline',
    'default'  => 15,
    'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
) );
$zoo_customize->add_field( 'zoo_customizer',  array(
    'type'     => 'slider',
    'settings' => 'zoo_main_header_padding_bottom',
    'label'    => esc_html__( 'Main Header Padding Bottom', 'doma' ),
    'section'  => 'title_tagline',
    'default'  => 15,
    'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
) );

$zoo_customize->add_section( 'header', array(
    'title'    => esc_html__( 'Header', 'doma' ),
    'priority' => 80
) );
/* ----------------------------------------------------------
					Section - Header Presets
---------------------------------------------------------- */
/* Options heading - Header */
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => 'zoo_header_options_notice',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => 'header',
    'default'   => '<div class="zoo-notice"><i class="fa  fa-info" aria-hidden="true"></i>' . esc_html__( 'On Page/post some options of customize will override by options of that page/post.', 'doma' ) . '</div>',
    'priority' => 5
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => 'zoo_header_layout_heading',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => 'header',
    'default'   => '<div class="zoo-options-heading">' . esc_html__( 'Header Layout', 'doma' ) . '</div>',
    'priority' => 5
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'radio-image',
    'settings' => 'zoo_header_layout',
    'label'    => esc_html__( 'Header layout', 'doma' ),
    'description'=> esc_html__( 'Choose header layout you want use for your site.', 'doma' ),
    'section'  => 'header',
    'default'  => 'style-1',
    'choices'  => array(
        'style-1' => esc_url(get_template_directory_uri() . '/lib/assets/icons/2-lines-style-2.png'),
        'style-2' => esc_url(get_template_directory_uri() . '/lib/assets/icons/2-lines-style-2.png'),
    ),
    'priority' => 6
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => 'zoo_header_options_heading',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => 'header',
    'default'   => '<div class="zoo-options-heading">' . esc_html__( 'Header Options', 'doma' ) . '</div>',
    'priority' => 7
) );

$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'switch',
    'settings'  => 'zoo_enable_header_transparent',
    'label'     => esc_html__( 'Enable header transparent', 'doma' ),
    'description'=> esc_html__( 'Header will has position is absolute, and visible on top.', 'doma' ),
    'section'   => 'header',
    'default'   => '0',
    'choices' => array(
        '1'  => esc_attr__( 'Yes', 'doma' ),
        '0' => esc_attr__( 'No', 'doma' )
    ),
    'priority' => 9
) );

$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'switch',
    'settings'  => 'zoo_header_sticky',
    'label'     => esc_html__( 'Use sticky header', 'doma' ),
    'description'=> esc_html__( 'Header will always visible on top.', 'doma' ),
    'section'   => 'header',
    'default'   => '1',
    'choices' => array(
        '1'  => esc_attr__( 'Yes', 'doma' ),
        '0' => esc_attr__( 'No', 'doma' )
    ),
    'priority' => 10
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'switch',
    'settings'  => 'zoo_login_icon',
    'label'     => esc_html__( 'Use login icon', 'doma' ),
    'description'=> esc_html__( 'Login icon will show on header', 'doma' ),
    'section'   => 'header',
    'default'   => '1',
    'choices' => array(
        '1'  => esc_attr__( 'Yes', 'doma' ),
        '0' => esc_attr__( 'No', 'doma' )
    ),
    'priority' => 10
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'switch',
    'settings'  => 'zoo_enable_header_fullwidth',
    'label'     => esc_html__( '100% Header width', 'doma' ),
    'description'=> esc_html__( 'Header will full width.', 'doma' ),
    'section'   => 'header',
    'default'   => '0',
    'choices' => array(
        '1'  => esc_attr__( 'Yes', 'doma' ),
        '0' => esc_attr__( 'No', 'doma' )
    ),
    'priority' => 11
) );
