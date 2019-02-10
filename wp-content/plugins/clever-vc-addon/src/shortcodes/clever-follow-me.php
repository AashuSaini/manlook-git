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
function cvca_add_follow_me_shortcode( $atts, $content = null )
{
    $atts = shortcode_atts(
        apply_filters('CleverFollowMe_shortcode_atts',array(
            'title'     => '',
            'follow-me' => '',
            'style'     => 'normal',
            'css_animation'=> '',
            'el_class'  => '',
            'css' => ''
        )),
        $atts, 'CleverFollowMe'
    );

    $html = cvca_get_shortcode_view( 'follow-me', $atts, $content );

    return $html;
}
add_shortcode( 'CleverFollowMe', 'cvca_add_follow_me_shortcode' );
/**
 * Integrate to Visual Composer
 *
 * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
 */
function cvca_integrate_clever_follow_me_shortcode_with_vc()
{
    vc_map(
        array(
            'name' => esc_html__('Clever Follow Me', 'cvca'),
            'base' => 'CleverFollowMe',
            'icon' => 'data-is-container',

            'category' => esc_html__('CleverSoft Elements', 'cvca'),
            'description' => esc_html__('Social Follow Me Block', 'cvca'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'cvca'),
                    'value' => '',
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    "type" => "param_group",
                    "heading" => esc_html__("Follow Me block", 'cvca'),
                    'value' => '',
                    'param_name' => 'follow-me',
                    'description' => esc_html__('Icons and links block, click to starting add', 'cvca'),
                    // Note params is mapped inside param-group:
                    'params' => array(
                        array(
                            'type' => 'iconpicker',
                            'value' => '',
                            'heading' => esc_html__('Socail icon', 'cvca'),
                            'param_name' => 'socail-icon',
                            'edit_field_class'=>'vc_col-xs-6',
                        ),
                        array(
                            'type' => 'vc_link',
                            'value' => '',
                            'heading' => esc_html__('Link', 'cvca'),
                            'param_name' => 'socail-link',
                            'edit_field_class'=>'vc_col-xs-6',
                        ),
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Style', 'cvca'),
                    'param_name' => 'style',
                    'std' => 'circle',
                    'edit_field_class'=>'vc_col-xs-6',
                    "value" => array(
                        esc_html__('Normal', 'cvca' ) => 'normal',
                        esc_html__('Circle', 'cvca' ) => 'circle',
                        esc_html__('Square', 'cvca' ) => 'square'
                    ),
                ),
                array(
                    'type' => 'animation_style',
                    'heading' => esc_html__('CSS Animation', 'cvca'),
                    'param_name' => 'css_animation',
                    'edit_field_class'=>'vc_col-xs-6',
                    'value' => '',
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
add_action( 'vc_before_init', 'cvca_integrate_clever_follow_me_shortcode_with_vc', 10, 0 );