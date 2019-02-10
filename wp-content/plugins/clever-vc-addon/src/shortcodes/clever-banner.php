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
function cvca_add_clever_banner_shortcode( $atts, $content = null )
{
    $atts = shortcode_atts(
        apply_filters('CleverBanner_shortcode_atts', array(
            'image'    => '',
            'lazy_load' => 0,
            'preset' => 'flat',
            'style' => 'default',
            'overlay_color' => '',

            'bf_title'    => '',
            'font_size_bf_title' => '16',
            'font_weight_bf_title' => '300',
            'color_bf_title' => '#ffffff',

            'title'    => '',
            'font_size_title' => '20',
            'font_weight_title' => '700',
            'color_title' => '#ffffff',

            'content'  => '',

            'link'     => '',
            'color_link' => '#ffffff',
            'font_weight_link' => '400',
            'font_size_link' => '13',

            'content_align'    => 'center-center',
            'box_shadow' => '',
            'el_class' => '',
            'css'      => ''
        )),
        $atts, 'CleverBanner'
    );

    $html = cvca_get_shortcode_view( 'banner', $atts, $content );

    return $html;
}
add_shortcode( 'CleverBanner', 'cvca_add_clever_banner_shortcode' );

/**
 * Integrate to Visual Composer
 *
 * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
 */
function cvca_integrate_clever_banner_shortcode_with_vc()
{
    vc_map(
        array(
            'name' => esc_html__('Clever Banner', 'cvca'),
            'base' => 'CleverBanner',
            'icon' => 'data-is-container',

            'category' => esc_html__('CleverSoft Elements', 'cvca'),
            'description' => esc_html__('Display your single banner image', 'cvca'),
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'cvca' ),
                    'param_name' => 'image',
                    'description' => esc_html__( 'Image of banner', 'cvca' )
                ),
                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__('Active Lazy Load', 'cvca'),
                    "param_name" => 'lazy_load',
                    'std' => 0,
                ),
                array(
                    "type" => 'dropdown',
                    "heading" => esc_html__('Type', 'cvca'),
                    "param_name" => 'preset',
                    'std' => 'flat',
                    "value" => array(
                        esc_html__('Flat', 'cvca') => 'flat',
                        esc_html__('Round', 'cvca') => 'round',
                        esc_html__('Overlap', 'cvca') => 'overlap',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Image overlay color', 'cvca'),
                    'value' => '',
                    'param_name' => 'overlay_color',
                    "dependency" => array('element' => 'preset', 'value' => array('overlap')),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Content Box Align', 'cvca'),
                    'param_name' => 'content_align',
                    'std' => 'center-center',
                    "dependency" => array('element' => 'preset', 'value' => array('overlap')),
                    'value' => array(
                        esc_html__('Top Left', 'cvca' )      => 'top-left',
                        esc_html__('Top Right', 'cvca' )     => 'top-right',
                        esc_html__('Top Center', 'cvca' )    => 'top-center',
                        esc_html__('Center Left', 'cvca' )   => 'center-left',
                        esc_html__('Center Right', 'cvca' )  => 'center-right',
                        esc_html__('Center Center', 'cvca' ) => 'center-center',
                        esc_html__('Bottom Left', 'cvca' )   => 'bottom-left',
                        esc_html__('Bottom Right', 'cvca' )  => 'bottom-right',
                        esc_html__('Bottom Center', 'cvca' ) => 'bottom-center',
                    ),
                ),
                array(
                    "type" => 'dropdown',
                    "heading" => esc_html__('Style', 'torano'),
                    "param_name" => 'style',
                    "dependency" => array('element' => 'preset', 'value' => array('overlap')),
                    'std' => 'default',
                    "value" => array(
                        esc_html__('Default', 'torano') => 'default',
                        esc_html__('Style 1', 'torano') => 'style-1',
                        esc_html__('Style 2', 'torano') => 'style-2',
                        esc_html__('Style 3', 'torano') => 'style-3',
                        esc_html__('Style 4', 'torano') => 'style-4',
                        esc_html__('Style 5', 'torano') => 'style-5',
                        esc_html__('Style 6', 'torano') => 'style-6',
                        esc_html__('Style 7', 'torano') => 'style-7',
                    ),
                ),
                // before title
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Before Title', 'cvca' ),
                    'param_name' => 'bf_title',
                    "admin_label" => true,
                    'description' => esc_html__('', 'cvca'),
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__('Font Size of Before Title', 'cvca'),
                    "param_name" => 'font_size_bf_title',
                    'std' => '16',
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__('Font Weight of Before Title', 'cvca'),
                    "param_name" => 'font_weight_bf_title',
                    'std' => '300',
                ),
                array(
                    "type" => 'colorpicker',
                    "heading" => esc_html__('Color of Before Title', 'cvca'),
                    "param_name" => 'color_bf_title',
                    'std' => '#ffffff',
                ),
                // title
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'cvca' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                    'description' => esc_html__('', 'cvca'),
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__('Font Size of Title', 'cvca'),
                    "param_name" => 'font_size_title',
                    'std' => '20',
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__('Font Weight of Title', 'cvca'),
                    "param_name" => 'font_weight_title',
                    'std' => '700',
                ),
                array(
                    "type" => 'colorpicker',
                    "heading" => esc_html__('Color of Title', 'cvca'),
                    "param_name" => 'color_title',
                    'std' => '#ffffff',
                ),
                //
                array(
                    'type' => 'textarea_html',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__( 'Content', 'cvca' ),
                    'param_name' => 'content', 
                    'value' => '',
                    'description' => esc_html__( 'Enter your content.', 'cvca' )
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__('Link', 'cvca'),
                    'value' => '#',
                    'param_name' => 'link',
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__('Font Size of Link', 'cvca'),
                    "param_name" => 'font_size_link',
                    'std' => '13',
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__('Font Weight of Link', 'cvca'),
                    "param_name" => 'font_weight_link',
                    'std' => '400',
                ),
                array(
                    "type" => 'colorpicker',
                    "heading" => esc_html__('Color of Link', 'cvca'),
                    "param_name" => 'color_link',
                    'std' => '#ffffff',
                ),
                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__('Active box shadow', 'cvca'),
                    "param_name" => 'box_shadow',
                    'std' => '',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Extra class name', 'cvca' ),
                    'param_name' => 'el_class',
                    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'cvca' )
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'Css', 'cvca' ),
                    'param_name' => 'css',
                    'group' => __( 'Design options', 'cvca' ),
                ),
            )
        )
    );
}
add_action( 'vc_before_init', 'cvca_integrate_clever_banner_shortcode_with_vc', 10, 0 );