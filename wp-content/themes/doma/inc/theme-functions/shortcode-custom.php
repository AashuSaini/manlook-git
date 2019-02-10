<?php
/**
 * Custom file of shortcode, add/change remove shortcode attribute
 */
if(!function_exists('get_custom_posttype_categories_for_vc')){
    function get_custom_posttype_categories_for_vc($post_type){
        $data = array();
        $tax_slug = esc_attr( apply_filters( $post_type, _x( $post_type, 'taxonomy archive slug', 'zoo-charitable' ) ) );
        $query = new WP_Term_Query(array(
            'hide_empty' => true,
            'taxonomy'   => $tax_slug,
        ));

        if (!empty($query->terms)) {
            foreach ($query->terms as $cat) {
                $cat_data = array('label' => $cat->name, 'value' => $cat->slug);
                $data[] = $cat_data;
            }
        }

        return $data;
    }
}

add_filter('CleverBlog_shortcode_atts', function ($atts) {
    $atts['preset'] = 'default';
    $atts['show_author'] = 'yes';
    $atts['show_date'] = 'yes';
    $atts['show_cate'] = 'yes';
    $atts['title_size'] = '';

    return $atts;
});
add_filter('CleverBanner_shortcode_atts', function ($atts) {
    $atts['box_shadow'] = '';
    $atts['style'] = '';
    $atts['title-color'] = '';
    $atts['title-size'] = '';
    $atts['font-weight'] = '';
    return $atts;
});
add_filter('CleverMultiBanner_shortcode_atts', function ($atts) {
    $atts['preset'] = 'default';
    return $atts;
});
add_filter('CleverProduct_shortcode_atts', function ($atts) {
    $atts['topnav'] = '';
    $atts['thumbnail'] = '';
    return $atts;
});
add_action('vc_after_init', function () {
    vc_add_params('CleverBlog', array(
            array(
                "type" => 'dropdown',
                "heading" => esc_html__('Layout', 'doma'),
                "param_name" => 'preset',
                'std' => 'default',
                "value" => array(
                    esc_html__('Default', 'doma') => 'default',
                    esc_html__('Style 1', 'doma') => 'style-1',
                    esc_html__('Style 2', 'doma') => 'style-2',
                ),
                'group' => esc_html__('Layout', 'doma'),
                'description' => esc_html__('Preset for grid posts', 'doma'),
                'dependency' => array('element' => 'layout', 'value' => array('grid')),
            ),
            array(
                "type" => 'checkbox',
                "heading" => esc_html__('Show Author', 'doma'),
                "param_name" => 'show_author',
                'std' => 'yes',
                'value' => array(esc_html__('Yes', 'doma') => 'yes'),
                'group' => esc_html__('Layout', 'doma'),
                'dependency' => array('element' => 'post_info', 'value' => 'yes'),
            ),
            array(
                "type" => 'checkbox',
                "heading" => esc_html__('Show Date', 'doma'),
                "param_name" => 'show_date',
                'std' => 'yes',
                'value' => array(esc_html__('Yes', 'doma') => 'yes'),
                'group' => esc_html__('Layout', 'doma'),
                'dependency' => array('element' => 'post_info', 'value' => 'yes'),
            ),
            array(
                "type" => 'checkbox',
                "heading" => esc_html__('Show Categories', 'doma'),
                "param_name" => 'show_cate',
                'std' => 'yes',
                'value' => array(esc_html__('Yes', 'doma') => 'yes'),
                'group' => esc_html__('Layout', 'doma'),
                'dependency' => array('element' => 'post_info', 'value' => 'yes'),
            ),
            array(
                "type" => 'textfield',
                "heading" => esc_html__('Post Title Size', 'doma'),
                "param_name" => 'title_size',
                'group' => esc_html__('Layout', 'doma'),
                
            ),

        )
    );
    vc_add_params('CleverMultiBanner', array(
            array(
                "type" => 'dropdown',
                "heading" => esc_html__('Preset', 'doma'),
                "param_name" => 'preset',
                'std' => 'default',
                "value" => array(
                    esc_html__('Default', 'doma') => 'default',
                    esc_html__('Style 1', 'doma') => 'style-1',
                    esc_html__('Style 2', 'doma') => 'style-2',
                    esc_html__('Style 3', 'doma') => 'style-3',
                    esc_html__('Style 4', 'doma') => 'style-4',

                ),
            ),
        )
    );
    vc_add_params('CleverBanner', array(
            array(
                "type" => 'checkbox',
                "heading" => esc_html__('Active box shadow', 'doma'),
                "param_name" => 'box_shadow',
                'std' => '',
            ),
            array(
                "type" => 'dropdown',
                "heading" => esc_html__('Style', 'doma'),
                "param_name" => 'style',
                'std' => 'default',
                "value" => array(
                    esc_html__('Default', 'doma') => 'default',
                    esc_html__('Style 1', 'doma') => 'style-1',
                    esc_html__('Style 2', 'doma') => 'style-2',
                    esc_html__('Style 3', 'doma') => 'style-3',
                    esc_html__('Style 4', 'doma') => 'style-4',
                    esc_html__('Style 5', 'doma') => 'style-5',
                    esc_html__('Style 6', 'doma') => 'style-6',
                    esc_html__('Style 7', 'doma') => 'style-7',
                    esc_html__('Style 8', 'doma') => 'style-8',
                ),
            ),
            array(
                "type" => 'colorpicker',
                "heading" => esc_html__('Title Color', 'doma'),
                "param_name" => 'title-color',
            ),
            array(
                "type" => 'textfield',
                "heading" => esc_html__('Title Size', 'doma'),
                "param_name" => 'title-size',
                'std' => '18',
            ),
            array(
                "type" => 'textfield',
                "heading" => esc_html__('Font Weight', 'doma'),
                "param_name" => 'font-weight',
                'std' => '700',
            ),
        )
    ); vc_add_params('CleverProduct', array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show carousel navigation position', 'doma'),
                'param_name' => 'topnav',
                'std' => 'center',
                'group' => esc_html__('Layout', 'doma'),
                "dependency" => Array('element' => 'products_type', 'value' => array('carousel')),
                "value" => array(
                    esc_html__('Center', 'doma') => 'center',
                    esc_html__('Top', 'doma') => 'top',
                    esc_html__('Bottom', 'doma') => 'bottom',
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Thumbnail size', 'doma'),
                'param_name' => 'thumbnail',
                'std' => '',
                'group' => esc_html__('Layout', 'doma'),
                'value' => array(esc_html__('Yes', 'doma') => '1'),
                'description' => esc_html__('If check, product image will use thumbnail size', 'doma'),
            ),
        )
    );
}, 10, 0);