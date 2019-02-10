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
if (!function_exists('cvca_add_clever_blog_shortcode')) {
    function cvca_add_clever_blog_shortcode( $atts, $content = null )
    {
        $atts = shortcode_atts(
            apply_filters('CleverBlog_shortcode_atts', array(
                'title' => '',
                'layout'=> 'grid',
                'col_xl' => 3,
                'col_lg' => 3,
                'col_md' => 3,
                'col_sm' => 2,
                'col' => 2,
                'cat' => '',
                'post_in' => '',
                'number' => 8,
                'preset' => 'default',
                'title_size' => '',
                'blog_img_size'=>'medium',
                'pagination'=>'none',
                'output_type'=>'yes',
                'post_info'=>'yes',
                'excerpt_length'=>20,
                'view_more' => 'yes',
                'text_view_more' => 'Continue reading',
                'animation_type' => '',
                'element_custom_class' => '',
                'css' => '',
            )),$atts, 'CleverBlog');

        $html = cvca_get_shortcode_view( 'blog', $atts, $content );

        return $html;
    }
    add_shortcode( 'CleverBlog', 'cvca_add_clever_blog_shortcode' );
    add_action( 'vc_before_init', 'cvca_integrate_clever_blog_shortcode_integrate_vc');
    function cvca_integrate_clever_blog_shortcode_integrate_vc()
    {
        vc_map(array(
            'name' => esc_html__('Clever Blog', 'cvca'),
            'base' => 'CleverBlog',
            'icon' => 'data-is-container',
            'category' => esc_html__('CleverSoft Elements', 'cvca'),

            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Title", 'cvca'),
                    "param_name" => "title",
                    "admin_label" => true,
                    'description' => esc_html__('Enter text used as shortcode title (Note: located above content element)', 'cvca'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Layout", 'cvca'),
                    "param_name" => "layout",
                    'std' => 'grid',
                    "value" => array(
                        esc_html__('Grid', 'cvca' ) => 'grid',
                        esc_html__('List', 'cvca' ) => 'list',
                    ),
                    'group'=>esc_html__('Layout','cvca'),
                    'description' => esc_html__('Layout of posts', 'cvca'),
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
                    'dependency' => array('element' => 'layout', 'value' => 'grid'),
                    'group'=>esc_html__('Layout','cvca'),
                    'description' => esc_html__('Display post with the number of column', 'cvca'),
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
                    'dependency' => array('element' => 'layout', 'value' => 'grid'),
                    'group'=>esc_html__('Layout','cvca'),
                    'description' => esc_html__('Display post with the number of column', 'cvca'),
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
                    'dependency' => array('element' => 'layout', 'value' => 'grid'),
                    'group'=>esc_html__('Layout','cvca'),
                    'description' => esc_html__('Display post with the number of column', 'cvca'),
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
                    'dependency' => array('element' => 'layout', 'value' => 'grid'),
                    'group'=>esc_html__('Layout','cvca'),
                    'description' => esc_html__('Display post with the number of column', 'cvca'),
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
                    'dependency' => array('element' => 'layout', 'value' => 'grid'),
                    'group'=>esc_html__('Layout','cvca'),
                    'description' => esc_html__('Display post with the number of column', 'cvca'),
                ),
                array(
                    "type" => "cvca_multiselect2",
                    "heading" => esc_html__("Categories", 'cvca'),
                    "param_name" => 'cat',
                    "std" => '',
                    "value" => get_custom_posttype_categories_for_vc('category'),
                ),
                array(
                    "type" => "autocomplete",
                    "heading" => esc_html__("Post IDs", 'cvca'),
                    "description" => esc_html__("comma separated list of post ids", 'cvca'),
                    "param_name" => "post_in",
                    'settings' => array(
                        'multiple' => true,
                        'sortable' => true,
                        'min_length' => 0,
                        'no_hide' => true,
                        'groups' => true, 
                        'unique_values' => true, 
                        'display_inline' => true,
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Image size', 'cvca'),
                    'group'=>esc_html__('Layout','cvca'),
                    'std' => 'medium',
                    'param_name' => 'blog_img_size',
                    'value' => cvca_get_post_size_image(),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Posts Count", 'cvca'),
                    "param_name" => "number",
                    "value" => '8',
                    'description' => esc_html__('Number of post showing', 'cvca'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Pagination", 'cvca'),
                    "param_name" => "pagination",
                    'std' => 'none',
                    "value" => array(
                        esc_html__('None', 'cvca' ) => 'none',
                        esc_html__('Standard', 'cvca' ) => 'numeric',
                        esc_html__('Infinity Scroll', 'cvca' ) => 'infinity',
                        esc_html__('Ajaxload More', 'cvca' ) => 'ajaxload',
                    ),
                    'description' => esc_html__('Select pagination type', 'cvca'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Content display", 'cvca'),
                    "param_name" => "output_type",
                    'std' => 1,
                    'group'=>esc_html__('Layout','cvca'),
                    "value" => array(
                        esc_html__('None', 'cvca' ) => 'no',
                        esc_html__('Excerpt', 'cvca' ) => 'excerpt',
                        esc_html__('Full content', 'cvca' ) => 'content',
                    ),
                    'description' => esc_html__('Select type of content', 'cvca'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Excerpt length", 'cvca'),
                    "param_name" => "excerpt_length",
                    'group'=>esc_html__('Layout','cvca'),
                    'dependency' => array('element' => 'output_type', 'value' => array('excerpt')),
                    "description" => esc_html__("Total character display of excerpt.", 'cvca'),
                    "value" => '20'
                ),
                
                array(
                    "type" => 'dropdown',
                    "heading" => esc_html__('Layout', 'cvca'),
                    "param_name" => 'preset',
                    'std' => 'default',
                    "value" => array(
                        esc_html__('Default', 'cvca') => 'default',
                        esc_html__('Style 1', 'cvca') => 'style-1',
                        esc_html__('Style 2', 'cvca') => 'style-2',
                    ),
                    'group' => esc_html__('Layout', 'cvca'),
                    'description' => esc_html__('Preset for grid posts', 'cvca'),
                    'dependency' => array('element' => 'layout', 'value' => array('grid')),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__("Show Post information", 'cvca'),
                    'param_name' => 'post_info',
                    'group'=>esc_html__('Layout','cvca'),
                    'std' => 'yes',
                    'value' => array(esc_html__('Yes', 'cvca') => 'yes'),
                    'description' => esc_html__('Show category and date post', 'cvca'),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__("Show View More", 'cvca'),
                    'param_name' => 'view_more',
                    'group'=>esc_html__('Layout','cvca'),
                    'std' => 'yes',
                    'value' => array(esc_html__('Yes', 'cvca') => 'yes'),
                    'description' => esc_html__('Yes, If you want to show button "Read more"', 'cvca'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Text view more", 'cvca'),
                    "param_name" => "text_view_more",
                    'std' => 'Continue reading',
                    'group'=>esc_html__('Layout','cvca'),
                    'dependency' => array('element' => 'view_more', 'value' => 'yes'),
                ),
                array(
                    "type" => 'cvca_animation_type',
                    "heading" => esc_html__("Animation Type", 'cvca'),
                    "param_name" => "animation_type",
                    'group'=>esc_html__('Layout','cvca'),
                    "admin_label" => true,
                    'description' => esc_html__('Select animation type', 'cvca'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Custom Class', 'cvca'),
                    'value' => '',
                    'param_name' => 'element_custom_class',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cvca'),
                ),
                array(
                    'type'       => 'css_editor',
                    'counterup'  => __( 'Css', 'cvca' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'cvca' ),
                ),
            )
        ));
    }
}

add_filter( 'vc_autocomplete_CleverBlog_post_in_callback', 'vc_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_CleverBlog_post_in_render', 'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value);