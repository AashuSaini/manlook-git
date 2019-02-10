<?php
/**
 * Shop Panel
 *
 * @uses    object    $this          CleverTheme
 * @uses    object    $this    Clever_Customizer
 *
 * @package    Clever_Theme\Core\Backend\Customizer
 */

if (class_exists('WooCommerce')) {
    $zoo_customize->add_panel('woocommerce', array(
        'title' => esc_html__('Woocommerce', 'doma'),
        'description' => esc_html__('Woocommerce theme options.', 'doma'),
        'priority' => 84
    ));

    /* ----------------------------------------------------------
                        Section - Category Page
    ---------------------------------------------------------- */
    $zoo_customize->add_section('shop-archive', array(
        'title' => esc_html__('Shop Page', 'doma'),
        'panel' => 'woocommerce',
        'description' => esc_html__('The settings for archive shop, eg: archive, shop, category...', 'doma'),
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'custom',
        'settings' => 'zoo_slider_cover_heading',
        'label' => esc_html__('', 'doma'),
        'section' => 'shop-archive',
        'default' => '<h3 class="zoo-options-heading">' . esc_html__('Cover shop page', 'doma') . '</h3>',
        'priority' => 5
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'text',
        'settings' => 'zoo_slider_cover',
        'label' => esc_html__('Slider shortcode', 'doma'),
        'section' => 'shop-archive',
        'default' => '',
        'description' => esc_html__('Enter shortcode of rev slider for shop page', 'doma'),
        'priority' => 7
    ));
    /* Options heading - Category Box */
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'custom',
        'settings' => 'zoo_shop_page_heading',
        'label' => esc_html__('', 'doma'),
        'section' => 'shop-archive',
        'default' => '<h3 class="zoo-options-heading">' . esc_html__('Shop page layout', 'doma') . '</h3>',
        'priority' => 10
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_catalog_mod',
        'label' => esc_html__('Enable Catalog Mode', 'doma'),
        'section' => 'shop-archive',
        'default' => '0',
        'description' => esc_html__('If check, catalog mod will active, all button cart, icon cart will be hide, ', 'doma'),
        'priority' => 11
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type'     => 'select',
        'settings' => 'zoo_choose_sidebar_filter',
        'label'    => esc_html__( 'Shop Choose Sidebar Filter Type', 'doma' ),
        'section'  => 'shop-archive',
        'default'  => 'default',
        'choices'  => array(
            'default'  => esc_html__('Default Widget Filter','doma'),
            'widget-ajax'  => esc_html__('Ajax Widget Filter','doma'),
            'cln'  => esc_html__('Use Clever Layered Navigation','doma'),
        ),
        'priority' => 12
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'select',
        'settings' => 'zoo_shop_sidebar_option_default',
        'label' => esc_html__('Shop sidebar options position', 'doma'),
        'section' => 'shop-archive',
        'default' => 'canvas-sidebar',
        'choices' => array(
            'no-sidebar' =>  esc_html__('No Sidebar','doma'),
            'left-sidebar' =>  esc_html__('Left Sidebar','doma'),
            'right-sidebar' =>  esc_html__('Right Sidebar','doma'),
            'canvas-sidebar' =>  esc_html__('Canvas Sidebar','doma'),
        ),
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_choose_sidebar_filter',
                'operator' => '==',
                'value'    => 'default',
            )),
        'priority' => 12
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'select',
        'settings' => 'zoo_shop_sidebar_option_widget_ajax',
        'label' => esc_html__('Shop sidebar options position', 'doma'),
        'section' => 'shop-archive',
        'default' => 'canvas-sidebar',
        'choices' => array(
            'no-sidebar' =>  esc_html__('No Sidebar','doma'),
            'left-sidebar' =>  esc_html__('Left Sidebar','doma'),
            'right-sidebar' =>  esc_html__('Right Sidebar','doma'),
            'canvas-sidebar' =>  esc_html__('Canvas Sidebar','doma'),
        ),
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_choose_sidebar_filter',
                'operator' => '==',
                'value'    => 'widget-ajax',
            )),
        'priority' => 12
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'select',
        'settings' => 'zoo_shop_sidebar_option_cln',
        'label' => esc_html__('Shop sidebar options position', 'doma'),
        'section' => 'shop-archive',
        'default' => 'horizontal-sidebar',
        'choices' => array(
            'no-sidebar' =>  esc_html__('No Sidebar','doma'),
            'left-sidebar' =>  esc_html__('Left Sidebar','doma'),
            'right-sidebar' =>  esc_html__('Right Sidebar','doma'),
            'canvas-sidebar' =>  esc_html__('Canvas Sidebar','doma'),
            'horizontal-sidebar' =>  esc_html__('Horizontal Sidebar','doma'),
        ),
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_choose_sidebar_filter',
                'operator' => '==',
                'value'    => 'cln',
            )),
        'priority' => 12
    ));

    $zoo_customize->add_field('zoo_customizer', array(
        'type'     => 'select',
        'settings' => 'zoo_products_pagination_default',
        'label'    => esc_html__( 'Shop Pagination type', 'doma' ),
        'section'  => 'shop-archive',
        'default'  => 'numeric',
        'choices'  => array(
            'numeric'  => esc_html__('Numeric','doma'),
            'simple'  => esc_html__('Simple','doma'),
            'ajaxload'  => esc_html__('Ajax load more','doma'),
            'infinity'  => esc_html__('Infinity scroll','doma'),
        ),
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_choose_sidebar_filter',
                'operator' => '==',
                'value'    => 'default',
            )),
        'priority' => 12
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type'     => 'select',
        'settings' => 'zoo_products_pagination_widget_ajax',
        'label'    => esc_html__( 'Shop Pagination type', 'doma' ),
        'section'  => 'shop-archive',
        'default'  => 'infinity',
        'choices'  => array(
            'numeric'  => esc_html__('Numeric','doma'),
            'simple'  => esc_html__('Simple','doma'),
            'ajaxload'  => esc_html__('Ajax load more','doma'),
            'infinity'  => esc_html__('Infinity scroll','doma'),
        ),
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_choose_sidebar_filter',
                'operator' => '==',
                'value'    => 'widget-ajax',
            )),
        'priority' => 12
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type'     => 'select',
        'settings' => 'zoo_products_pagination_cln',
        'label'    => esc_html__( 'Shop Pagination type', 'doma' ),
        'section'  => 'shop-archive',
        'default'  => 'numeric',
        'choices'  => array(
            'numeric'  => esc_html__('Numeric','doma'),
            'simple'  => esc_html__('Simple','doma'),
        ),
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_choose_sidebar_filter',
                'operator' => '==',
                'value'    => 'cln',
            )),
        'priority' => 12
    ));
    
    $zoo_customize->add_field( 'zoo_customizer', array(
        'type'     => 'select',
        'settings' => 'zoo_shop_sidebar_default',
        'label'    => esc_html__( 'Shop Sidebar', 'doma' ),
        'section'  => 'shop-archive',
        'default'  => 'shop',
        'choices'  => zoo_get_sidebar_options(),
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_choose_sidebar_filter',
                'operator' => '==',
                'value'    => 'default',
            )),
        'priority' => 13
    ) );
    $zoo_customize->add_field( 'zoo_customizer', array(
        'type'     => 'select',
        'settings' => 'zoo_shop_sidebar_widget_ajax',
        'label'    => esc_html__( 'Shop Sidebar', 'doma' ),
        'section'  => 'shop-archive',
        'default'  => 'shop',
        'choices'  => zoo_get_sidebar_options(),
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_choose_sidebar_filter',
                'operator' => '==',
                'value'    => 'widget-ajax',
            )),
        'priority' => 13
    ) );
    $zoo_customize->add_field( 'zoo_customizer', array(
        'type'     => 'select',
        'settings' => 'zoo_shop_sidebar_cln',
        'label'    => esc_html__( 'Shop Sidebar', 'doma' ),
        'section'  => 'shop-archive',
        'default'  => 'shop_cln',
        'choices'  => zoo_get_sidebar_options(),
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_choose_sidebar_filter',
                'operator' => '==',
                'value'    => 'cln',
            )),
        'priority' => 13
    ) );
    
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'text',
        'settings' => 'zoo_products_number_items',
        'label' => esc_html__('Products per Page', 'doma'),
        'section' => 'shop-archive',
        'default' => '9',
        'priority' => 15
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'select',
        'settings' => 'zoo_products_columns_pc',
        'label' => esc_html__('Shop Columns PC for Row', 'doma'),
        'section' => 'shop-archive',
        'default' => '4',
        'choices' => array(
            '2' => esc_attr__('2 Columns', 'doma'),
            '3' => esc_attr__('3 Columns', 'doma'),
            '4' => esc_attr__('4 Columns', 'doma'),
            '5' => esc_attr__('5 Columns', 'doma'),
            '6' => esc_attr__('6 Columns', 'doma')
        ),
        'priority' => 16
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'select',
        'settings' => 'zoo_products_columns_tablet',
        'label' => esc_html__('Shop Columns Tablet for Row', 'doma'),
        'section' => 'shop-archive',
        'default' => '3',
        'choices' => array(
            '2' => esc_attr__('2 Columns', 'doma'),
            '3' => esc_attr__('3 Columns', 'doma'),
            '4' => esc_attr__('4 Columns', 'doma'),
        ),
        'priority' => 16
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'select',
        'settings' => 'zoo_products_columns_mobile',
        'label' => esc_html__('Shop Columns Mobile for Row', 'doma'),
        'section' => 'shop-archive',
        'default' => '2',
        'choices' => array(
            '1' => esc_attr__('1 Columns', 'doma'),
            '2' => esc_attr__('2 Columns', 'doma'),
            '3' => esc_attr__('3 Columns', 'doma'),
        ),
        'priority' => 16
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'switch',
        'settings' => 'zoo_disable_columns',
        'label' => esc_html__('Show Shop Columns', 'doma'),
        'section' => 'shop-archive',
        'default' => '1',
        'choices' => array(
            '1'  => esc_attr__( 'Yes', 'doma' ),
            '0' => esc_attr__( 'No', 'doma' )
        ),
        'priority' => 16
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'select',
        'settings' => 'zoo_products_layout',
        'label' => esc_html__('Products Grid / List Layout Show Default', 'doma'),
        'section' => 'shop-archive',
        'default' => 'grid-layout',
        'choices' => array(
            'grid-layout' => esc_attr__('Grid', 'doma'),
            'list-layout' => esc_attr__('List', 'doma')
        ),
        'priority' => 16
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'switch',
        'settings' => 'zoo_show_products_layout',
        'label' => esc_html__('Show Products Grid / List Layout ', 'doma'),
        'section' => 'shop-archive',
        'default' => '1',
        'choices' => array(
            '1'  => esc_attr__( 'Yes', 'doma' ),
            '0' => esc_attr__( 'No', 'doma' )
        ),
        'priority' => 16
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'switch',
        'settings' => 'zoo_show_get_free_shipping',
        'label' => esc_html__('Show Get Free Shipping', 'doma'),
        'section' => 'shop-archive',
        'default' => '1',
        'choices' => array(
            '1'  => esc_attr__( 'Yes', 'doma' ),
            '0' => esc_attr__( 'No', 'doma' )
        ),
        'priority' => 16
    ));
    
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'slider',
        'settings' => 'zoo_products_item_image_padding_herizontal',
        'label' => esc_html__('Product Image Padding Herizontal', 'doma'),
        'section' => 'shop-archive',
        'default' => '0',
        'choices' => array(
            'min' => '0',
            'max' => '50',
            'step' => '1',
        ),
        'priority' => 16
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'slider',
        'settings' => 'zoo_products_item_image_padding_vertical',
        'label' => esc_html__('Product Image Padding Vertical', 'doma'),
        'section' => 'shop-archive',
        'default' => '0',
        'choices' => array(
            'min' => '0',
            'max' => '50',
            'step' => '1',
        ),
        'priority' => 16
    ));

    /* Options heading - Category Box */
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'custom',
        'settings' => 'zoo_products_item_heading',
        'label' => esc_html__('', 'doma'),
        'section' => 'shop-archive',
        'default' => '<h3 class="zoo-options-heading">' . esc_html__('Product Item', 'doma') . '</h3>',
        'priority' => 20
    ));
    $zoo_customize->add_field('zoo_customizer', array(
         'type'     => 'select',
         'settings' => 'zoo_product_style',
         'label'    => esc_html__( 'Product style', 'doma' ),
         'section'  => 'shop-archive',
         'default'  => 'style-1',
         'choices'  => array(
             'default'  => esc_html__('Default','doma'),
             'style-1'  => esc_html__('Style 1','doma'),
             'style-2'  => esc_html__('Style 2','doma'),
             'style-3'  => esc_html__('Style 3','doma'),
             'style-4'  => esc_html__('Style 4','doma'),
             'style-5'  => esc_html__('Style 5','doma'),
             'style-6'  => esc_html__('Style 6','doma'),
         ),
         'priority' => 20
     ));


    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_aternative_images',
        'label' => esc_html__('Aternative images', 'doma'),
        'section' => 'shop-archive',
        'default' => '0',
        'description' => esc_html__('Show alternative product images on mouse hover (in category view and in product sliders)', 'doma'),
        'priority' => 20
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_product_cart_button',
        'label' => esc_html__('Disable cart button', 'doma'),
        'section' => 'shop-archive',
        'default' => '0',
        'priority' => 21
    ));

    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_product_sale_label',
        'label' => esc_html__('Show Sale Label', 'doma'),
        'section' => 'shop-archive',
        'default' => '1',
        'priority' => 22
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'select',
        'settings' => 'zoo_sale_type',
        'label' => esc_html__('Sale label type', 'doma'),
        'section' => 'shop-archive',
        'default' => 'number',
        'choices' => array(
            'number' => esc_html__('Number', 'doma'),
            'text' => esc_html__('Text', 'doma'),
        ),
        'priority' => 23
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_product_rating',
        'label' => esc_html__('Hide Rating', 'doma'),
        'description' => esc_html__('Rating of product will be hide', 'doma'),
        'section' => 'shop-archive',
        'default' => '1',
        'priority' => 24
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_product_stock_label',
        'label' => esc_html__('Hide Stock Label', 'doma'),
        'description' => esc_html__('Stock label will be hide', 'doma'),
        'section' => 'shop-archive',
        'default' => '0',
        'priority' => 25
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_product_disable_qv',
        'label' => esc_html__('Disable quick view', 'doma'),
        'description' => esc_html__('Quick view and all function require will disable', 'doma'),
        'section' => 'shop-archive',
        'default' => '0',
        'priority' => 26
    ));
    /* ----------------------------------------------------------
                        Section - Product Page
    ---------------------------------------------------------- */
    $zoo_customize->add_section('shop-single', array(
        'title' => esc_html__('Single Product Page', 'doma'),
        'panel' => 'woocommerce',
        'description' => esc_html__('The settings for single product', 'doma'),
    ));

    /* Options heading - Layout */
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'custom',
        'settings' => 'zoo_single_layout_heading',
        'label' => esc_html__('', 'doma'),
        'section' => 'shop-single',
        'default' => '<div class="zoo-options-heading">' . esc_html__('Layout', 'doma') . '</div>',
        'priority' => 5
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'select',
        'settings' => 'zoo_single_gallery_layout',
        'label' => esc_html__('Shop Gallery Layout', 'doma'),
        'section' => 'shop-single',
        'default' => 'vertical-gallery',
        'choices' => array(
            'vertical-gallery' =>esc_html__('Vertical Gallery','doma'),
            'horizontal-gallery' =>esc_html__('Horizontal Gallery','doma'),
            'carousel' =>esc_html__('Carousel','doma'),
            'sticky' =>esc_html__('Sticky','doma'),
        ),
        'priority' => 6
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'radio-image',
        'settings' => 'zoo_single_product_sidebar_option',
        'label' => esc_html__('Single product sidebar option', 'doma'),
        'section' => 'shop-single',
        'default' => 'no-sidebar',
        'choices' => array(
            'no-sidebar' => esc_url(ZOO_THEME_URI. 'lib/assets/icons/no-sidebar.png'),
            'left-sidebar' => esc_url(ZOO_THEME_URI. 'lib/assets/icons/left-sidebar.png'),
            'right-sidebar' => esc_url(ZOO_THEME_URI. 'lib/assets/icons/right-sidebar.png'),
        ),
        'priority' => 7
    ));
    $zoo_customize->add_field( 'zoo_customizer', array(
        'type'     => 'select',
        'settings' => 'zoo_single_product_sidebar',
        'label'    => esc_html__( 'Single product Sidebar', 'doma' ),
        'section' => 'shop-single',
        'choices'  => zoo_get_sidebar_options(),
        'priority' => 8
    ) );
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_single_product_zoom',
        'label' => esc_html__('Enable Product Zoom', 'doma'),
        'section' => 'shop-single',
        'default' => '1',
        'description' => esc_html__('If check, zoom feature will active', 'doma'),
        'priority' => 9
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_single_link_product',
        'label' => esc_html__('Show Next and previous Product', 'doma'),
        'section' => 'shop-single',
        'default' => '1',
        'priority' => 10
    ));

    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_single_share',
        'label' => esc_html__('Show Social Share', 'doma'),
        'section' => 'shop-single',
        'default' => '1',
        'priority' => 11
    ));
    /* Options heading - Related Product */
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'custom',
        'settings' => 'zoo_single_related_product_heading',
        'label' => esc_html__('', 'doma'),
        'section' => 'shop-single',
        'default' => '<div class="zoo-options-heading">' . esc_html__('Related Product', 'doma') . '</div>',
        'priority' => 15
    ));

    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_single_related_product',
        'label' => esc_html__('Show Related product', 'doma'),
        'section' => 'shop-single',
        'default' => '1',
        'priority' => 16
    ));

    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'checkbox',
        'settings' => 'zoo_single_related_product_slider',
        'label' => esc_html__('Enable slider for Related products', 'doma'),
        'section' => 'shop-single',
        'default' => '1',
        'priority' => 17
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'number',
        'settings' => 'zoo_single_related_product_number',
        'label' => esc_html__('Number items', 'doma'),
        'section' => 'shop-single',
        'default' => '4',
        'priority' => 18
    ));
    $zoo_customize->add_field('zoo_customizer', array(
        'type' => 'slider',
        'settings' => 'zoo_single_related_cols',
        'label' => esc_html__('Columns', 'doma'),
        'section' => 'shop-single',
        'default' => '4',
        'choices' => array(
            'min' => '1',
            'max' => '6',
            'step' => '1',
        ),
        'priority' => 19,
        'active_callback'  => array(
            array(
                'setting'  => 'zoo_single_related_product_slider',
                'operator' => '==',
                'value'    => '1',
            )),
    ));
}
