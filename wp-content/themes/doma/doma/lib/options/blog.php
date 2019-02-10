<?php
/**
 * Blog Panel
 *
 * @uses    object    $this          CleverTheme
 * @uses    object    $this    Clever_Customizer
 *
 * @package    Clever_Theme\Core\Backend\Customizer
 */
$zoo_customize->add_panel( 'blog', array(
    'title'       => esc_html__( 'Blog', 'doma' ),
    'description' => esc_html__( 'Blog theme options.', 'doma' ),
    'priority' => 83
) );
/* ----------------------------------------------------------
					Section - Blog Archive
---------------------------------------------------------- */
$zoo_customize->add_section( 'blog-archive', array(
    'title'       => esc_html__( 'Blog Archive', 'doma' ),
    'panel'       => 'blog',
    'description' => esc_html__( 'Set a default layout for your archive page.', 'doma' ),
    'priority' => 5
) );
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => 'zoo_blog_layout_heading',
    'label' => esc_html__('', 'doma'),
    'section' => 'blog-archive',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Blog Layout', 'doma') . '</div>',
    'priority' => 5
));

$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'select',
    'settings' => 'zoo_blog_layout',
    'label'    => esc_html__( 'Posts layout', 'doma' ),
    'section'  => 'blog-archive',
    'default'  => 'list',
    'choices'  => array(
        'grid'  => esc_html__('Grid','doma'),
        'list'  => esc_html__('List','doma'),
    ),
    'priority' => 6
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'select',
    'settings' => 'zoo_blog_col',
    'label'    => esc_html__( 'Columns', 'doma' ),
    'section'  => 'blog-archive',
    'default'  => '3',
    'description' => esc_html__( 'Columns per row of grid layout.', 'doma' ),
    'choices'  => array(
        '1'  => esc_html__('1','doma'),
        '2'  => esc_html__('2','doma'),
        '3'  => esc_html__('3','doma'),
        '4'  => esc_html__('4','doma'),
        '5'  => esc_html__('5','doma'),
        '6'  => esc_html__('6','doma'),
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'zoo_blog_layout',
            'operator' => '==',
            'value'    => 'grid',
        ),
    ),
    'priority' => 7
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_blog_show_excerpt',
    'label'     => esc_html__( 'Show Excerpt', 'doma' ),
    'section'   => 'blog-archive',
    'default'   => '1',
    'priority' => 8
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'slider',
    'settings'  => 'zoo_blog_excerpt_length',
    'label'     => esc_html__( 'Number character display the post excerpt.', 'doma' ),
    'section'   => 'blog-archive',
    'default'   => '60',
    'choices'     => array(
        'min'  => '0',
        'max'  => '200',
        'step' => '1',
    ),
    'priority' => 9
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'select',
    'settings' => 'zoo_blog_pagination',
    'label'    => esc_html__( 'Posts Pagination type', 'doma' ),
    'section'  => 'blog-archive',
    'default'  => 'numeric',
    'choices'  => array(
        'numeric'  => esc_html__('Numeric','doma'),
        'simple'  => esc_html__('Simple','doma'),
    ),
    'priority' => 10
) );
/* ----------------------------------------------------------
					Section - Blog Single Post
---------------------------------------------------------- */
$zoo_customize->add_section( 'blog-single', array(
    'title'       => esc_html__( 'Blog Single Post', 'doma' ),
    'panel'       => 'blog',
    'description' => esc_html__( 'Set a default layout for your single post page.', 'doma' ),
    'priority' => 15
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'color',
    'settings'  => 'zoo_single_post_overlay_of_featured',
    'label'     => esc_html__( 'Overlay color of featured image', 'doma' ),
    'section'   => 'blog-single',
    'priority' => 16
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'slider',
    'settings'  => 'zoo_single_post_opcity_of_featured',
    'label'     => esc_html__( 'Overlay opcity of featured image', 'doma' ),
    'default'   => '1',
    'choices'     => array(
        'min'  => '0',
        'max'  => '1',
        'step' => '0.1',
    ),
    'section'   => 'blog-single',
    'priority' => 16
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_blog_single_tags',
    'label'     => esc_html__( 'Show Tags', 'doma' ),
    'section'   => 'blog-single',
    'default'   => '1',
    'priority' => 16
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_blog_single_author',
    'label'     => esc_html__( 'Show Author', 'doma' ),
    'section'   => 'blog-single',
    'default'   => '0',
    'priority' => 16
) );
/* Options heading - Blog Related Posts */
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'custom',
    'settings'  => 'zoo_blog_single_related_heading',
    'label'     => esc_html__( '', 'doma' ),
    'section'   => 'blog-single',
    'default'   => '<div class="zoo-options-heading">' . esc_html__( 'Blog Related Posts', 'doma' ) . '</div>',
    'priority' => 17
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'checkbox',
    'settings'  => 'zoo_blog_single_related',
    'label'     => esc_html__( 'Show Related posts', 'doma' ),
    'section'   => 'blog-single',
    'default'   => '0',
    'priority' => 18
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'      => 'slider',
    'settings'  => 'zoo_blog_single_related_number_items',
    'label'     => esc_html__( 'Number items', 'doma' ),
    'section'   => 'blog-single',
    'default'   => '3',
    'choices'     => array(
        'min'  => '1',
        'max'  => '6',
        'step' => '1',
    ),
    'priority' => 19
) );
/* ----------------------------------------------------------
					Section - Blog Archive
---------------------------------------------------------- */
$zoo_customize->add_section( 'blog-sidebar', array(
    'title'       => esc_html__( 'Blog sidebar', 'doma' ),
    'panel'       => 'blog',
    'description' => esc_html__( 'Set a default sidebar for your archive page.', 'doma' ),
    'priority' => 20
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'select',
    'settings' => 'zoo_blog_sidebar_left',
    'label'    => esc_html__( 'Blog Sidebar Left', 'doma' ),
    'section'  => 'blog-sidebar',
    'description' => esc_html__( 'If select none, left sidebar will hide.', 'doma' ),
    'default' =>'none',
    'choices'  => zoo_get_sidebar_options(),
    'priority' => 21
) );
$zoo_customize->add_field( 'zoo_customizer', array(
    'type'     => 'select',
    'settings' => 'zoo_blog_sidebar_right',
    'label'    => esc_html__( 'Blog Sidebar Right', 'doma' ),
    'description' => esc_html__( 'If select none, right sidebar will hide.', 'doma' ),
    'default' =>'sidebar-1',
    'section'  => 'blog-sidebar',
    'choices'  => zoo_get_sidebar_options(),
    'priority' => 22
) );
