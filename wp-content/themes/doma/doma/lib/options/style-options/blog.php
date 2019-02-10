<?php
/**
 * Style Panel of Blog
 * All style of blog add at here
 *
 * @uses    object    $wp_customize     WP_Customize_Manager
 * @uses    object    $this             Zoo_Customizer
 *
 * @package    zoo_Theme
 */
$zoo_customize->add_section($zoo_style_prefix . 'blog', array(
    'title'       => esc_html__('Blog', 'doma'),
    'panel' => 'style'
));
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => $zoo_prefix.'blog_archive_notice',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => $zoo_style_prefix . 'blog',
    'default'   => '<div class="zoo-notice"><i class="fa  fa-info" aria-hidden="true"></i>' . esc_html__( 'Color and typography for Post archive/category page and shortcode blog.', 'doma' ) . '</div>',
) );
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'blog_archive_color_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Archive page', 'doma') . '</div>',
    'priority' => 10,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' => $zoo_prefix . 'typo_blog_archive_title',
    'label' => esc_html__('Typography for title', 'doma'),
    'description' => esc_html__('Typography for title post', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => array(
        'font-family' => 'Exo',
        'variant' => '600',
        'subsets' => array(),
        'text-transform' => 'none',
        'font-size' => '30',
        'line-height' => '1.5',
        'letter-spacing' => '0',
        'color' => '#111111',
    ),
    'priority' => 11,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_archive_title_hover',
    'label' => esc_html__('Title hover', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 11
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_archive_text',
    'label' => esc_html__('Post text', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 12
));$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_archive_info',
    'label' => esc_html__('Post info', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 12
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_archive_link',
    'label' => esc_html__('Post link', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 13
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_archive_link_hover',
    'label' => esc_html__('Post link hover', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 13
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_archive_rm',
    'label' => esc_html__('Read more', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 14
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_archive_rm_hover',
    'label' => esc_html__('Read more hover', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 14
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'blog_sidebar_color_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Sidebar', 'doma') . '</div>',
    'priority' => 20,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' => $zoo_prefix . 'typo_blog_sidebar_title',
    'label' => esc_html__('Typography for title', 'doma'),
    'description' => esc_html__('Typography for title post sidebar', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => array(
        'font-family' => 'Exo',
        'variant' => '600',
        'subsets' => array(),
        'text-transform' => 'normal',
        'font-size' => '24',
        'line-height' => '1.5',
        'letter-spacing' => '0',
        'color' => '#111111',
    ),
    'priority' => 21,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_sidebar_title_hover',
    'label' => esc_html__('Title hover', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 21
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_sidebar_info_color',
    'label' => esc_html__('Post info', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 22
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'blog_single_color_heading',
    'label' => esc_html__('', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Single', 'doma') . '</div>',
    'priority' => 30,
));
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => $zoo_prefix.'blog_single_notice',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => $zoo_style_prefix . 'blog',
    'default'   => '<div class="zoo-notice"><i class="fa  fa-info" aria-hidden="true"></i>' . esc_html__( 'Content of post will follow config of body.', 'doma' ) . '</div>',
    'priority' => 30,
) );
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' => $zoo_prefix . 'typo_blog_single_title',
    'label' => esc_html__('Typography for title', 'doma'),
    'description' => esc_html__('Typography for title single post', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => array(
        'font-family' => 'Exo',
        'variant' => '600',
        'subsets' => array(),
        'text-transform' => 'none',
        'font-size' => '36',
        'line-height' => '1.5',
        'letter-spacing' => '0',
        'color' => '#111111',
    ),
    'priority' => 31,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_single_info',
    'label' => esc_html__('Post info', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 32
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_single_link',
    'label' => esc_html__('Post link', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 33
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'blog_single_link_hover',
    'label' => esc_html__('Post link hover', 'doma'),
    'section' => $zoo_style_prefix . 'blog',
    'default' => '',
    'priority' => 33
));
