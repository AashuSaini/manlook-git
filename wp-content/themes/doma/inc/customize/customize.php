<?php
/**
 * Register custom theme mods from a theme
 *
 * @param  object $zoo_customizer \Zoo_Customizer
 * @param  object $wp_customize \WP_Customize_Manager
 * @param  mixed $mods Theme mods - value of `get_theme_mods()`
 */
add_filter('zoo_body_font_size',function(){return 16;});
if (!function_exists('zoo_register_theme_mods')) {
    function zoo_register_theme_mods($zoo_customizer, $zoo_mods)
    {
        $zoo_prefix = 'zoo_';
        $zoo_style_prefix = 'zoo_style_';
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'typography',
            'settings' => $zoo_prefix . 'typo_primary_font',
            'label' => esc_html__('Primary Font', 'doma'),
            'description' => esc_html__('Apply for some special location.', 'doma'),
            'section' => $zoo_style_prefix . 'body',
            'default' => array(
                'font-family' => 'Poppins',
                'letter-spacing' => '0'
            ),
            'priority' => 11,
        ));
        $zoo_customizer->add_field( 'zoo_customizerr', array(
            'type'     => 'radio-image',
            'settings' => 'zoo_header_layout',
            'label'    => esc_html__( 'Header layout', 'doma' ),
            'description'=> esc_html__( 'Choose header layout you want use for your site.', 'doma' ),
            'section'  => 'header',
            'default'  => 'style-2',
            'choices'  => array(
                'style-1' => esc_url(get_template_directory_uri() . '/assets/images/style-1.png'),
                'style-2' => esc_url(get_template_directory_uri() . '/assets/images/style-2.png'),
                'style-3' => esc_url(get_template_directory_uri() . '/assets/images/style-3.png'),
                'style-4' => esc_url(get_template_directory_uri() . '/assets/images/style-4.png'),
                'style-5' => esc_url(get_template_directory_uri() . '/assets/images/style-5.png'),
                'style-6' => esc_url(get_template_directory_uri() . '/assets/images/style-6.png'),
                'style-7' => esc_url(get_template_directory_uri() . '/assets/images/style-7.png'),
                'style-8' => esc_url(get_template_directory_uri() . '/assets/images/style-8.png'),
                'style-vendor' => esc_url(get_template_directory_uri() . '/assets/images/style-vendor.jpg'),
                'style-landing' => esc_url(get_template_directory_uri() . '/assets/images/footer-landing.png'),
            ),
            'priority' => 6
        ) );
        $zoo_customizer->add_field( 'zoo_customizer', array(
            'type'      => 'radio-buttonset',
            'settings'  => 'zoo_enable_top_header_slogun',
            'label'     => esc_html__( 'Choose Top Slogun', 'doma' ),
            'section'   => 'header',
            'default'   => '1',
            'choices' => array(
                '0'  => esc_attr__( 'None', 'doma' ),
                '1'  => esc_attr__( 'Top Slogun ', 'doma' ),
            ),
            'priority' => 8
        ) );
        $zoo_customizer->add_field( 'zoo_customizer', array(
            'type'      => 'radio-buttonset',
            'settings'  => 'zoo_enable_top_header',
            'label'     => esc_html__( 'Choose Top Header', 'doma' ),
            'section'   => 'header',
            'default'   => '1',
            'choices' => array(
                '0'  => esc_attr__( 'None', 'doma' ),
                '1'  => esc_attr__( 'Top Header', 'doma' ),
            ),
            'priority' => 8
        ) );
        $zoo_customizer->add_field( 'zoo_customizer', array(
            'type'      => 'switch',
            'settings'  => 'zoo_header_canvas_sidebar',
            'label'     => esc_html__( 'Use header canvas sidebar', 'doma' ),
            'description'=> esc_html__( 'Header will show canvas sidebar', 'doma' ),
            'section'   => 'header',
            'default'   => '0',
            'choices' => array(
                '1'  => esc_attr__( 'Yes', 'doma' ),
                '0' => esc_attr__( 'No', 'doma' )
            ),
            'priority' => 8
        ) );
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'radio-image',
            'settings' => 'zoo_footer_layout',
            'label' => esc_html__('Footer Layout', 'doma'),
            'section' => 'footer',
            'default' => 'style-1',
            'choices' => array(
                'style-1' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-1.png'),
                'style-2' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-2.png'),
                'style-3' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-3.png'),
                'style-4' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-4.png'),
                'style-5' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-5.png'),
                'style-6' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-6.png'),
                'style-7' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-7.png'),
                'style-landing' => esc_url(get_template_directory_uri() . '/assets/images/footer-landing.png'),
            ),
            'priority' => 6
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'switch',
            'settings' => $zoo_prefix . 'blog_show_readmore',
            'label' => esc_html__('Show Read more', 'doma'),
            'section' => 'blog-archive',
            'priority' => 9,
            'default' => true,
            'choices' => array(
                true => esc_html__('On', 'doma'),
                false => esc_html__('Off', 'doma'),
            ),
        ));
        /*Woocommerce page cover*/
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'text',
            'settings' => $zoo_prefix . 'shop_cover_text',
            'label' => esc_html__('Cover shop page title', 'doma'),
            'description' => esc_html__('Title of cover shop page', 'doma'),
            'section' => 'shop-archive',
            'default' => '',
            'priority' => 8,
        ));$zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'image',
            'settings' => $zoo_prefix . 'shop_cover_img_bg',
            'label' => esc_html__('Image Background', 'doma'),
            'description' => esc_html__('Image background of cover shop page', 'doma'),
            'section' => 'shop-archive',
            'default' => '',
            'priority' => 8,
        ));$zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'color',
            'settings' => $zoo_prefix . 'shop_cover_color_bg',
            'label' => esc_html__('Color Background', 'doma'),
            'description' => esc_html__('Background color of cover shop page', 'doma'),
            'section' => 'shop-archive',
            'default' => '',
            'priority' => 8,
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'slider',
            'settings' => $zoo_prefix . 'shop_cover_padding_top',
            'label' => esc_html__('Cover Padding Top', 'doma'),
            'description' => esc_html__('White space from top heading of cover page to top. It\'s work on case Slider shortcode blank', 'doma'),
            'section' => 'shop-archive',
            'default' => 0,
            'choices' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1
            ),
            'priority' => 8,
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'slider',
            'settings' => $zoo_prefix . 'shop_cover_padding_bottom',
            'label' => esc_html__('Cover Padding Bottom', 'doma'),
            'description' => esc_html__('White space from bottom heading of cover page to bottom. It\'s work on case Slider shortcode blank', 'doma'),
            'section' => 'shop-archive',
            'default' => 0,
            'choices' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1
            ),
            'priority' => 8,
        ));
        /*End Woocommerce page cover*/
        /*Woocommerce Up sell*/
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'custom',
            'settings' => 'zoo_single_upsell_heading',
            'label' => esc_html__('', 'doma'),
            'section' => 'shop-single',
            'default' => '<div class="zoo-options-heading">' . esc_html__('Up sell Product', 'doma') . '</div>',
            'priority' => 20
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'checkbox',
            'settings' => 'zoo_single_upsell',
            'label' => esc_html__('Show Up sell product', 'doma'),
            'section' => 'shop-single',
            'default' => '1',
            'priority' => 21
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'checkbox',
            'settings' => 'zoo_single_upsell_slider',
            'label' => esc_html__('Enable slider for Up sell products', 'doma'),
            'section' => 'shop-single',
            'default' => '1',
            'priority' => 22
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'number',
            'settings' => 'zoo_single_upsell_number',
            'label' => esc_html__('Number items', 'doma'),
            'section' => 'shop-single',
            'default' => '4',
            'priority' => 23
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'slider',
            'settings' => 'zoo_single_upsell_cols',
            'label' => esc_html__('Columns', 'doma'),
            'section' => 'shop-single',
            'default' => '4',
            'choices' => array(
                'min' => '1',
                'max' => '6',
                'step' => '1',
            ),
            'priority' => 24,
            'active_callback' => array(
                array(
                    'setting' => 'zoo_single_upsell_slider',
                    'operator' => '==',
                    'value' => '1',
                )),
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'checkbox',
            'settings' => 'zoo_product_cart_button',
            'label' => esc_html__('Disable cart button', 'doma'),
            'section' => 'shop-archive',
            'default' => '0',
            'priority' => 21
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'checkbox',
            'settings' => 'zoo_highlight_featured',
            'label' => esc_html__('Highlight product related', 'doma'),
            'description' => esc_html__('If check product related will bigger more than another product.', 'doma'),
            'section' => 'shop-archive',
            'default' => '1',
            'priority' => 14
        ));

        /*End Woocommerce Up sell*/
        $zoo_customizer->add_section($zoo_style_prefix . 'sidebar', array(
            'title' => esc_html__('Sidebar', 'doma'),
            'panel' => 'style',
            'priority' => 10,
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'typography',
            'settings' => $zoo_prefix . 'typo_title_sidebar',
            'label' => esc_html__('Sidebar title Font', 'doma'),
            'description' => esc_html__('Apply for title sidebar.', 'doma'),
            'section' => $zoo_style_prefix . 'sidebar',
            'default' => array(
                'font-family' => ' ',
                'variant' => ' ',
                'subsets' => array(),
                'font-size' => '15',
                'line-height' => '1',
                'letter-spacing' => '0',
                'color' => '#252525'
            ),
            'priority' => 11,
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'color',
            'settings' => $zoo_prefix . 'blog_archive_link',
            'label' => esc_html__('Post label categories color', 'doma'),
            'section' => $zoo_style_prefix . 'blog',
            'default' => '',
            'priority' => 13
        ));$zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'color',
            'settings' => $zoo_prefix . 'blog_lb_cat_bg',
            'label' => esc_html__('Post label categories background color', 'doma'),
            'section' => $zoo_style_prefix . 'blog',
            'default' => '',
            'priority' => 13
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'color',
            'settings' => $zoo_prefix . 'blog_archive_link_hover',
            'label' => esc_html__('Post label categories color hover', 'doma'),
            'section' => $zoo_style_prefix . 'blog',
            'default' => '',
            'priority' => 13
        ));        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'color',
            'settings' => $zoo_prefix . 'blog_lb_cat_bg_hv',
            'label' => esc_html__('Post label categories background color hover', 'doma'),
            'section' => $zoo_style_prefix . 'blog',
            'default' => '',
            'priority' => 13
        ));
        $zoo_customizer->add_field('zoo_customizerr', array(
            'type' => 'select',
            'settings' => 'zoo_single_gallery_layout',
            'label' => esc_html__('Shop Gallery Layout', 'doma'),
            'section' => 'shop-single',
            'default' => 'vertical-gallery',
            'choices' => array(
                'vertical-gallery' =>esc_html__('Vertical Gallery','doma'),
                'vertical-gallery-center-thumb' =>esc_html__('Vertical Gallery Center Thumb','doma'),
                'horizontal-gallery' =>esc_html__('Horizontal Gallery','doma'),
                'carousel' =>esc_html__('Carousel','doma'),
                'sticky' =>esc_html__('Sticky','doma'),
                'sticky-right-content' =>esc_html__('Sticky Right Content','doma'),
                'sticky-accordion' =>esc_html__('Sticky Accordion','doma'),
                'images-center' =>esc_html__('Images Center','doma'),
                'center' =>esc_html__('Center Layout','doma'),
            ),
            'priority' => 6
        ));

        $zoo_customizer->add_field( 'zoo_customizerr', array(
            'type'      => 'checkbox',
            'settings' => $zoo_prefix . 'blog_single_nav',
            'label'     => esc_html__( 'Show block single navigation', 'doma' ),
            'section'   => 'blog-single',
            'default'   => '1',
            'priority' => 16
        ) );

        /*Custom footer*/
        $zoo_customizer->add_field( 'zoo_customizerr', array(
            'type'      => 'repeater',
            'settings' => $zoo_prefix . 'footer_bottom_right',
            'label'     => esc_html__( 'Show multi card pay images', 'doma' ),
            'fields' => array(
                'image' => array(
                    'type'        => 'image',
                    'label'       => esc_attr__( 'Add Image', 'doma' ),
                ),
                'link_url' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Link URL', 'doma' ),
                    'description' => esc_attr__( 'This will be the link URL', 'doma' ),
                ),
            ),
            'section'   => 'footer',
            'priority' => 14
        ) );
    }
}
add_action('zoo_before_customize_register', 'zoo_register_theme_mods', 15, 4);