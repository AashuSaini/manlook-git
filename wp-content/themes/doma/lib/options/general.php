<?php
/**
 * General Panel
 *
 * @uses    object    $this          CleverTheme
 * @uses    object    $this    Clever_Customizer
 *
 * @package    Clever_Theme\Core\Backend\Customizer
 */

$zoo_customize->add_section( 'general', array(
    'title'    => esc_html__( 'General', 'doma' ),
    'priority' => 1
) );

/* Options heading - Site layout */
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => 'zoo_site_layout_heading',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => 'general',
    'default'   => '<div class="zoo-options-heading">' . esc_html__( 'Site layout', 'doma' ) . '</div>',
    'priority' => 5
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'radio-buttonset',
    'settings' => 'zoo_site_layout',
    'label'    => esc_html__( 'Available Layout', 'doma' ),
    'section'  => 'general',
    'default'  => 'full',
    'choices'  => array(
        'full'  => esc_html__( 'Full Width', 'doma' ),
        'boxed' => esc_html__( 'Boxed', 'doma' )
    ),
    'priority' => 6
) );

$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'textarea',
    'settings' => 'zoo_site_width',
    'label'    => esc_html__( 'Site With', 'doma' ),
    'section'  => 'general',
    'default'  => '1200',
    'priority' => 6
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_site_layout_box_shadow',
    'label'     => esc_html__( 'Add Drop Shadow to Content box', 'doma' ),
    'section'   => 'general',
    'default'   => '1',
    'priority' => 7
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_disable_breadcrumbs',
    'label'     => esc_html__( 'If check, breadcrumbs will hide.', 'doma' ),
    'section'   => 'general',
    'default'   => '0',
    'priority' => 7
) );
/* Options heading - Page loader */
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => 'zoo_site_page_loader_heading',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => 'general',
    'default'   => '<div class="zoo-options-heading">' . esc_html__( 'Page loader', 'doma' ) . '</div>',
    'priority' => 10
) );

$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'switch',
    'settings'  => 'zoo_site_page_loader',
    'label'     => esc_html__( 'Enable page loader effect', 'doma' ),
    'section'   => 'general',
    'default'   => '0',
    'choices'     => array(
        'on'  => esc_html__( 'On', 'doma' ),
        'off' => esc_html__( 'Off', 'doma' ),
    ),
    'priority' => 11
) );
