<?php
/**
 * Style Panel of WooCommerce
 * All style of blog add at here
 *
 * @uses    object    $wp_customize     WP_Customize_Manager
 * @uses    object    $this             Zoo_Customizer
 *
 * @package    zoo_Theme
 */
$zoo_customize->add_section($zoo_style_prefix . 'woo', array(
    'title' => esc_html__('WooCommerce', 'doma'),
    'panel' => 'style'
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_color_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading">' . esc_html__('WooCommerce style', 'doma') . '</div>',
    'priority' => 10,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_rate_color',
    'label' => esc_html__('Rating color', 'doma'),
    'description' => esc_html__('Color of rating product', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 12
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_qv_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading-block">' . esc_html__('Button Quick View', 'doma') . '</div>',
    'priority' => 13,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_qv_color',
    'label' => esc_html__('Quick view text', 'doma'),
    'description' => esc_html__('Color of Quick view button', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 13
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_qv_color_hover',
    'label' => esc_html__('Quick view text hover', 'doma'),
    'description' => esc_html__('Color of button Quick view when hover', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 13
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_qv_bg',
    'label' => esc_html__('Quick view background', 'doma'),
    'description' => esc_html__('Background of button Quick view', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 14
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_qv_bg_hover',
    'label' => esc_html__('Quick view text hover', 'doma'),
    'description' => esc_html__('Background of button Quick view when hover', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 14
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_cart_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading-block">' . esc_html__('Button Cart', 'doma') . '</div>',
    'priority' => 15,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_cart_color',
    'label' => esc_html__('Cart text', 'doma'),
    'description' => esc_html__('Color of button cart ', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 15
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_cart_color_hover',
    'label' => esc_html__('Cart hover', 'doma'),
    'description' => esc_html__('Color of button cart when hover', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 15
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_cart_bg',
    'label' => esc_html__('Cart background', 'doma'),
    'description' => esc_html__('Background of button cart', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 16
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_cart_bg_hover',
    'label' => esc_html__('Cart background hover', 'doma'),
    'description' => esc_html__('Background of button cart when hover', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 16
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_lb_sale_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading-block">' . esc_html__('Sale label', 'doma') . '</div>',
    'priority' => 17,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_color_lb_sale',
    'label' => esc_html__('Sale label', 'doma'),
    'description' => esc_html__('Color of sale label', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 17
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_bg_lb_sale',
    'label' => esc_html__('Background Sale label', 'doma'),
    'description' => esc_html__('Background of sale label', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 17
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_lb_stock_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading-block">' . esc_html__('Stock label', 'doma') . '</div>',
    'priority' => 18,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_lb_low_stock',
    'label' => esc_html__('Low Stock label', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 18
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_lb_out_stock',
    'label' => esc_html__('Out Stock label', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 18
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_price_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading-block">' . esc_html__('Price', 'doma') . '</div>',
    'priority' => 20,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' => $zoo_prefix . 'typo_woo_price',
    'label' => esc_html__('Typography for price', 'doma'),
    'description' => esc_html__('Typography for price product on shop page', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => array(
        'font-family' => 'Exo',
        'variant' => '400',
        'subsets' => array(),
        'text-transform' => 'none',
        'font-size' => '16',
        'line-height' => '1.5',
        'letter-spacing' => '0',
        'color' => '#959595',
    ),
    'priority' => 20,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_price_color',
    'label' => esc_html__('Price', 'doma'),
    'description' => esc_html__('Default color of price', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 20
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_price_regular_color',
    'label' => esc_html__('Regular price', 'doma'),
    'description' => esc_html__('Color regular price of product on sale', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 20
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_price_sale_color',
    'label' => esc_html__('Sale price', 'doma'),
    'description' => esc_html__('Color sale price of product on sale', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 20
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_shop_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Shop Product', 'doma') . '</div>',
    'priority' => 20,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' => $zoo_prefix . 'typo_woo_shop_title',
    'label' => esc_html__('Typography for title', 'doma'),
    'description' => esc_html__('Typography for title product', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => array(
        'font-family' => 'Roboto',
        'variant' => '400',
        'subsets' => array(),
        'text-transform' => 'none',
        'font-size' => '14',
        'line-height' => '1.5',
        'letter-spacing' => '0',
        'color' => '#111111',
    ),
    'priority' => 21,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_title_shop_hover',
    'label' => esc_html__('Title hover', 'doma'),
    'description' => esc_html__('Color of title product on shop page when hover', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 21
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_single_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Single Product', 'doma') . '</div>',
    'priority' => 25,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'typography',
    'settings' => $zoo_prefix . 'typo_woo_single_title',
    'label' => esc_html__('Typography for title', 'doma'),
    'description' => esc_html__('Typography for title product', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => array(
        'font-family' => 'Exo',
        'variant' => '900',
        'subsets' => array(),
        'text-transform' => 'none',
        'font-size' => '34',
        'line-height' => '1.5',
        'letter-spacing' => '0',
        'color' => '#252525',
        ),
    'priority' => 26,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_cart_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading">' . esc_html__('Cart and check out', 'doma') . '</div>',
    'priority' => 30,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_pri_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading-block">' . esc_html__('Primary button', 'doma') . '</div>',
    'priority' => 31,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_pri_btn_color',
    'label' => esc_html__('Color', 'doma'),
    'description' => esc_html__('Color checkout, place order button', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 31
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_pri_btn_color_hover',
    'label' => esc_html__('Color hover', 'doma'),
    'description' => esc_html__('Color checkout, place order button when hover', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 31
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_pri_btn_bg',
    'label' => esc_html__('Background', 'doma'),
    'description' => esc_html__('Background of checkout, place order button', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 31
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_pri_btn_bg_hover',
    'label' => esc_html__('Background hover', 'doma'),
    'description' => esc_html__('Background of checkout, place order button when hover', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 31
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'custom',
    'settings' => $zoo_prefix . 'woo_sec_heading',
    'section' => $zoo_style_prefix . 'woo',
    'default' => '<div class="zoo-options-heading-block">' . esc_html__('Second button', 'doma') . '</div>',
    'priority' => 32,
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_sec_btn_color',
    'label' => esc_html__('Color', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 32
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_sec_btn_color_hover',
    'label' => esc_html__('Color hover', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 32
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_sec_btn_bg',
    'label' => esc_html__('Background', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 32
));
$zoo_customize->add_field('zoo_customizer', array(
    'type' => 'color',
    'settings' => $zoo_prefix . 'woo_sec_btn_bg_hover',
    'label' => esc_html__('Background hover', 'doma'),
    'section' => $zoo_style_prefix . 'woo',
    'default' => '',
    'priority' => 32
));
