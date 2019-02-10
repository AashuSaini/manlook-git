<?php
/**
 * Product Grid Tabs Shortcode
 */
if (!function_exists('cvca_shortcode_products_list_category')) {
    function cvca_shortcode_products_list_category($atts, $content)
    {

        if (class_exists('WooCommerce')) {
            $atts = shortcode_atts(apply_filters('CleverProductwithLisCategory_shortcode_atts',array(
                'title' => '',
                'accent_color' => '',
                'border_after_width' => '90',
                'filter_style' => 'sub_cate',
                'filter_sub_cate' => '',
                'filter_list' => '',
                'col_xl' => 3,
                'col_lg' => 3,
                'col_md' => 3,
                'col_sm' => 2,
                'col' => 2,
                'element_custom_class' => '',
                'css' => '',
            )), $atts, 'CleverProductwithLisCategory');
            $html = cvca_get_shortcode_view( 'product-list-category', $atts, $content );

            return $html;
        }
        return null;

    }
}
add_shortcode('CleverProductwithLisCategory', 'cvca_shortcode_products_list_category');

add_action('vc_before_init', 'cvca_products_list_category_integrate_vc');

if (!function_exists('cvca_products_list_category_integrate_vc')) {
    function cvca_products_list_category_integrate_vc()
    {
        if (class_exists('WooCommerce')) {
            vc_map(
                array(
                    'name' => esc_html__('Product List Categories', 'cvca'),
                    'base' => 'CleverProductwithLisCategory',
                    'icon' => 'icon-wpb-woocommerce',
                    'category' => esc_html__('CleverSoft Elements', 'cvca'),
                    'description' => esc_html__('Show multiple product list categories.', 'cvca'),
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
                            'type' => 'dropdown',
                            'heading' => esc_html__('Filter Style', 'cvca'),
                            'param_name' => 'filter_style',
                            'std' => 'sub_cate',
                            "value" => array(
                                esc_html__('Sub categories', 'cvca') => 'sub_cate',
                                esc_html__('List categories', 'cvca') => 'list',
                            ),
                        ),
                        
                        array(
                            "type" => "cvca_multiselect2",
                            "heading" => esc_html__("Choose categories for show tabs", 'cvca'),
                            "param_name" => "filter_sub_cate",
                            "value" => get_custom_posttype_categories_parent_for_vc('product_cat'),
                            'dependency' => array('element' => 'filter_style', 'value' => 'sub_cate'),
                        ),
                        array(
                            "type" => "cvca_multiselect2",
                            "heading" => esc_html__("Choose categories for show tabs", 'cvca'),
                            "param_name" => "filter_list",
                            "value" => get_custom_posttype_categories_for_vc('product_cat'),
                            'dependency' => array('element' => 'filter_style', 'value' => 'list'),
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