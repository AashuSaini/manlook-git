<?php
/**
 * Product Trending Tags Shortcode
 */
if (!function_exists('cvca_shortcode_products_trending_tags')) {
    function cvca_shortcode_products_trending_tags($atts, $content)
    {

        if (class_exists('WooCommerce')) {
            $atts = shortcode_atts(apply_filters('CleverProductwithTrendingTags_shortcode_atts',array(
                'title' => '',
                'accent_color' => '',
                'border_after_width' => '90',
                'filter_tags' => '',
                'col_xl' => 3,
                'col_lg' => 3,
                'col_md' => 3,
                'col_sm' => 2,
                'col' => 2,
                'show_pag' => 1,
                'show_nav' => 1,
                'scroll' => 1,
                'autoplay'=> true,
                'speed' => 5000,
                'nav_position' => 'middle-nav',
                'element_custom_class' => '',
                'css' => '',
            )), $atts, 'CleverProductwithTrendingTags');
            $html = cvca_get_shortcode_view( 'product-trending-tags', $atts, $content );

            return $html;
        }
        return null;

    }
}
add_shortcode('CleverProductwithTrendingTags', 'cvca_shortcode_products_trending_tags');

add_action('vc_before_init', 'cvca_products_trending_tags_integrate_vc');

if (!function_exists('cvca_products_trending_tags_integrate_vc')) {
    function cvca_products_trending_tags_integrate_vc()
    {
        if (class_exists('WooCommerce')) {
            vc_map(
                array(
                    'name' => esc_html__('Product List Trending Tags', 'cvca'),
                    'base' => 'CleverProductwithTrendingTags',
                    'icon' => 'icon-wpb-woocommerce',
                    'category' => esc_html__('CleverSoft Elements', 'cvca'),
                    'description' => esc_html__('Show multiple product list tags.', 'cvca'),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Title', 'cvca'),
                            "admin_label" => true,
                            'param_name' => 'title',
                            'description' => esc_html__('', 'cvca'),
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Border Color', 'cvca'),
                            "admin_label" => true,
                            'param_name' => 'accent_color',
                            'description' => esc_html__('', 'cvca'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Border After Width', 'cvca'),
                            "admin_label" => true,
                            'std' => '90',
                            'param_name' => 'border_after_width',
                            'description' => esc_html__('Add number for border after width.', 'cvca'),
                        ),
                        
                        array(
                            "type" => "cvca_multiselect2",
                            "heading" => esc_html__("Choose product tags", 'cvca'),
                            "param_name" => "filter_tags",
                            "value" => get_custom_posttype_categories_for_vc('product_tag'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Columns Extra Large device ( Screen  ≥ 1200px )', 'cvca'),
                            'param_name' => 'col_xl',
                            'std' => 10,
                            
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Columns Large device ( Screen  ≥ 992px )', 'cvca'),
                            'param_name' => 'col_lg',
                            'std' => 8,
                           
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Column Medium device ( Screen  ≥ 768px )', 'cvca'),
                            'param_name' => 'col_md',
                            'std' => 5,
                            
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Column Small device ( Screen  ≥ 576px )', 'cvca'),
                            'param_name' => 'col_sm',
                            'std' => 4,
                            
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Column Extra small device ( Screen  < 576px )', 'cvca'),
                            'param_name' => 'col',
                            'std' => 4,
                            
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => esc_html__('Show carousel pagination', 'cvca'),
                            'param_name' => 'show_pag',
                            'std' => 1,
                            'value' => array(esc_html__('Yes', 'cvca') => 1),
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => esc_html__('Show carousel navigation', 'cvca'),
                            'param_name' => 'show_nav',
                            'std' => '1',
                            'value' => array(esc_html__('Yes', 'cvca') => 1),
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => esc_html__('Auto Play', 'cvca'),
                            'param_name' => 'autoplay',
                            'std' => '1',
                            'value' => array(esc_html__('Yes', 'cvca') => 1),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Speed to Scroll', 'cvca'),
                            'std' => 5000,
                            "admin_label" => true,
                            'param_name' => 'speed',
                            'description' => esc_html__('', 'cvca'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Slide to Scroll', 'cvca'),
                            'std' => '1',
                            "admin_label" => true,
                            'param_name' => 'scroll',
                            'description' => esc_html__('', 'cvca'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Navigation position', 'cvca'),
                            'param_name' => 'nav_position',
                            'std' => 'middle-nav',
                            'value' => array(
                                //esc_html__('Top', 'cvca') => 'top-nav',
                                esc_html__('Middle', 'cvca') => 'middle-nav',
                            ),
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
                )
            );
        }
    }
}