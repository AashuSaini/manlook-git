<?php

/**
 * Add shortcode
 *
 * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
 *
 * @param    array    $atts    Users' defined attributes in shortcode.
 *
 * @return    string    $html    Rendered shortcode content.
 */
function cvca_add_clever_banner_slider_shortcode( $atts, $content = null )
{
    $atts = shortcode_atts(
        apply_filters('CleverBannerSlider_shortcode_atts',array(
            'show_pag' => '',
            'show_nav' => '',
            'banners'    => '',
            'col_xl' => 3,
            'col_lg' => 3,
            'col_md' => 3,
            'col_sm' => 2,
            'col' => 2,
            'custom_carousel'=> 1,
            'nav_position' => 'middle-nav',
            'autoplay'=> 1,
            'speed'=> 5000,
            'scroll'=> 1,
            'el_class'  => ''
        )),
        $atts, 'CleverBannerSlider'
    );

    $html = cvca_get_shortcode_view( 'banner-slider', $atts, $content );

    return $html;
}
add_shortcode( 'CleverBannerSlider', 'cvca_add_clever_banner_slider_shortcode' );


/**
 * Integrate to Visual Composer
 *
 * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
 */
function cvca_integrate_clever_banner_slider_shortcode_with_vc()
{
    vc_map(
        array(
            'name' => esc_html__('Clever Banner Slider', 'cvca'),
            'base' => 'CleverBannerSlider',
            'icon' => 'data-is-container',

            'category' => esc_html__('CleverSoft Elements', 'cvca'),
            'description' => esc_html__('Simple banner slider', 'cvca'),
            'params' => array(
                
                array(
                    "type" => "param_group",
                    "heading" => esc_html__("Banners", 'cvca'),
                    'value' => '',
                    'param_name' => 'banners',
                    'description' => esc_html__('Click to show more options, and starting add content.', 'cvca'),
                    'params' => array(
                        array(
                            'type' => 'attach_image',
                            'heading' => esc_html__('Image', 'cvca'),
                            'value' => '',
                            'param_name' => 'image',
                        ),
                        array(
                            'type' => 'vc_link',
                            'heading' => esc_html__( 'Link', 'cvca' ),
                            'param_name' => 'link',
                            'description' => esc_html__( 'Link of Image', 'cvca' ),
                            'std'=>''
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Title', 'cvca' ),
                            'param_name' => 'title',
                            'description' => esc_html__( 'Primary content', 'cvca' ),
                            'std'=>''
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Descriptions', 'cvca' ),
                            'param_name' => 'desc',
                            'description' => esc_html__( 'description content', 'cvca' ),
                            'std'=>''
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Box Background Color', 'cvca'),
                            'description' => esc_html__( 'Background of block text content', 'cvca' ),
                            'value' => '',
                            'param_name' => 'bg_color',
                            'std'=>''
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Text Color', 'cvca'),
                            'description' => esc_html__( 'Color of text content', 'cvca' ),
                            'value' => '#fff',
                            'param_name' => 'text_color',
                        ),
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Columns Extra Large device ( Screen  ≥ 1200px )', 'cvca'),
                    'param_name' => 'col_xl',
                    'std' => 3,
                    "value" => array(
                        esc_html__('1 columns', 'cvca') => 1,
                        esc_html__('2 columns', 'cvca') => 2,
                        esc_html__('3 columns', 'cvca') => 3,
                        esc_html__('4 columns', 'cvca') => 4,
                        esc_html__('5 columns', 'cvca') => 5,
                        esc_html__('6 columns', 'cvca') => 6,
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Columns Large device ( Screen  ≥ 992px )', 'cvca'),
                    'param_name' => 'col_lg',
                    'std' => 3,
                    "value" => array(
                        esc_html__('1 columns', 'cvca') => 1,
                        esc_html__('2 columns', 'cvca') => 2,
                        esc_html__('3 columns', 'cvca') => 3,
                        esc_html__('4 columns', 'cvca') => 4,
                        esc_html__('5 columns', 'cvca') => 5,
                        esc_html__('6 columns', 'cvca') => 6,
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Column Medium device ( Screen  ≥ 768px )', 'cvca'),
                    'param_name' => 'col_md',
                    'std' => 3,
                    "value" => array(
                        esc_html__('1 columns', 'cvca') => 1,
                        esc_html__('2 columns', 'cvca') => 2,
                        esc_html__('3 columns', 'cvca') => 3,
                        esc_html__('4 columns', 'cvca') => 4,
                        esc_html__('5 columns', 'cvca') => 5,
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Column Small device ( Screen  ≥ 576px )', 'cvca'),
                    'param_name' => 'col_sm',
                    'std' => 2,
                    "value" => array(
                        esc_html__('1 column', 'cvca') => 1,
                        esc_html__('2 columns', 'cvca') => 2,
                        esc_html__('3 columns', 'cvca') => 3,
                        esc_html__('4 columns', 'cvca') => 4,
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Column Extra small device ( Screen  < 576px )', 'cvca'),
                    'param_name' => 'col',
                    'std' => 2,
                    "value" => array(
                        esc_html__('1 column', 'cvca') => 1,
                        esc_html__('2 columns', 'cvca') => 2,
                        esc_html__('3 columns', 'cvca') => 3,
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Show Custom Carousel', 'cvca'),
                    'param_name' => 'custom_carousel',
                    'std' => 1,
                    'value' => array(esc_html__('Allow', 'cvca') => 1),
                    'description' => esc_html__('', 'cvca'),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Carousel: Auto Play', 'cvca'),
                    'param_name' => 'autoplay',
                    'std' => 1,
                    'dependency' => Array('element' => 'custom_carousel', 'value' => array('1')),
                    'value' => array(esc_html__('Allow', 'cvca') => 1),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Carousel: Speed to Scroll', 'cvca'),
                    'std' => 5000,
                    'param_name' => 'speed',
                    'dependency' => Array('element' => 'custom_carousel', 'value' => array('1')),
                    'description' => esc_html__('', 'cvca'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Carousel: Slide to Scroll', 'cvca'),
                    'std' => 1,
                    'param_name' => 'scroll',
                    'dependency' => Array('element' => 'custom_carousel', 'value' => array('1')),
                    'description' => esc_html__('', 'cvca'),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Show pagination', 'cvca'),
                    'param_name' => 'show_pag',
                    'description' => esc_html__('If check, pagination of gallery will show', 'cvca'),
                    'value'=>true,
                    'std'=>''
                ),array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Show navigation', 'cvca'),
                    'param_name' => 'show_nav',
                    'description' => esc_html__('If check, navigation of gallery will show', 'cvca'),
                    'value'=>true,
                    'std'=>''
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Carousel: Navigation position', 'cvca'),
                    'param_name' => 'nav_position',
                    'std' => 'middle-nav',
                    'value' => array(
                        esc_html__('Top', 'cvca') => 'top-nav',
                        esc_html__('Middle', 'cvca') => 'middle-nav',
                    ),
                    'dependency' => Array('element' => 'custom_carousel', 'value' => array('1')),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'cvca'),
                    'param_name' => 'el_class',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cvca')
                )
                )
            )
        );
}
add_action( 'vc_before_init', 'cvca_integrate_clever_banner_slider_shortcode_with_vc', 10, 0 );