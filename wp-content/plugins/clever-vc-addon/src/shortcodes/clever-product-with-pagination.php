<?php
/**
 * Product Grid Tabs Shortcode
 */
if (!function_exists('cvca_shortcode_products_with_pagination')) {
    function cvca_shortcode_products_with_pagination($atts, $content)
    {

        if (class_exists('WooCommerce')) {
            $atts = shortcode_atts(apply_filters('CleverProductwithPagination_shortcode_atts',array(
                'title' => '',
                'accent_color' => '',
                'border_after_width' => '90',
                'product_ids' => '',
                'posts_per_page' => 4,
                'filter' => 'cate',
                'filter_categories' => '',
                'asset_type'=> '',
                'col_xl' => 3,
                'col_lg' => 3,
                'col_md' => 3,
                'col_sm' => 2,
                'col' => 2,
                'orderby' => 'date',
                'order' => 'desc',
                'pagination' => 'none',
                'element_custom_class' => '',
                'css' => '',
            )), $atts, 'CleverProductwithPagination');
            $html = cvca_get_shortcode_view( 'product-with-pagination', $atts, $content );

            return $html;
        }
        return null;

    }
}
add_shortcode('CleverProductwithPagination', 'cvca_shortcode_products_with_pagination');

add_action('vc_before_init', 'cvca_products_with_pagination_integrate_vc');

if (!function_exists('cvca_products_with_pagination_integrate_vc')) {
    function cvca_products_with_pagination_integrate_vc()
    {
        if (class_exists('WooCommerce')) {
            $asset_type =  array(
                array('label' => esc_html__('All Products','torano'),'value' => 'all' ),
                array('label' => esc_html__('New Arrivals','torano'),'value' => 'latest' ),
                array('label' => esc_html__('Featured','torano'),'value' => 'featured' ),
                array('label' => esc_html__('Onsale','torano'),'value' => 'onsale' ),
                array('label' => esc_html__('Deal','torano'),'value' => 'deal' ),
                array('label' => esc_html__('Best Seller','torano'),'value' => 'best-selling' ),
                array('label' => esc_html__('Top Rate','torano'),'value' => 'toprate' ),
            );
            vc_map(
                array(
                    'name' => esc_html__('Product with Pagination', 'cvca'),
                    'base' => 'CleverProductwithPagination',
                    'icon' => 'icon-wpb-woocommerce',
                    'category' => esc_html__('CleverSoft Elements', 'cvca'),
                    'description' => esc_html__('Show multiple products with pagination. Do not use this shortcode twice in the same page', 'cvca'),
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
                            'type' => 'textfield',
                            'heading' => esc_html__('Products per Page', 'cvca'),
                            'value' => 6,
                            "admin_label" => true,
                            'param_name' => 'posts_per_page',
                            'description' => esc_html__('Products per Page showing', 'cvca'),
                        ),
                        array(
                            "type" => "cvca_multiselect2",
                            "heading" => esc_html__("Choose categories for show tabs", 'cvca'),
                            "param_name" => "filter_categories",
                            "value" => get_custom_posttype_categories_for_vc('product_cat'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Asset type', 'cvca'),
                            'value' => $asset_type,
                            'std' => '',
                            'param_name' => 'asset_type',
                            'description' => esc_html__('Select asset type of products for show filter', 'cvca'),
                        ),
                        array(
                            'type' => 'autocomplete',
                            'heading' => esc_html__('Exclude Product IDs', 'cvca'),
                            'std' => '',
                            'param_name' => 'product_ids',
                            'description' => esc_html__('A comma-separated list of product you want to exclude.', 'cvca'),
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
                            'heading' => esc_html__('Order by', 'cvca'),
                            'value' => array(
                                esc_html__('Date', 'cvca') => 'date',
                                esc_html__('Menu order', 'cvca') => 'menu_order',
                                esc_html__('Title', 'cvca') => 'title',
                                esc_html__('Random', 'cvca') => 'rand',
                            ),
                            'std' => 'date',
                            'param_name' => 'orderby',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Order', 'cvca'),
                            'value' => array(
                                esc_html__('DESC', 'cvca') => 'desc',
                                esc_html__('ASC', 'cvca') => 'asc',
                            ),
                            'std' => 'desc',
                            'param_name' => 'order',
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
                            'type' => 'dropdown',
                            'heading' => esc_html__('Pagination type', 'cvca'),
                            'param_name' => 'pagination',
                            'std' => 'none',
                            'value' => array(
                                esc_html__('None', 'cvca') => 'none',
                                esc_html__('Numeric', 'cvca') => 'numeric',
                                esc_html__('simple', 'cvca') => 'simple',
                                esc_html__('Ajax Load More', 'cvca') => 'ajaxload',
                                esc_html__('Infinity Scroll', 'cvca') => 'infinity',
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

$wc_class = new Vc_Vendor_Woocommerce;
//Filters For autocomplete param:
//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
add_filter( 'vc_autocomplete_CleverProductwithPagination_product_ids_callback', array(
    $wc_class,
    'productIdAutocompleteSuggester',
), 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_CleverProductwithPagination_product_ids_render', array(
    $wc_class,
    'productIdAutocompleteRender',
), 10, 1 ); // Render exact product. Must return an array (label,value)
//For param: ID default value filter
add_filter( 'vc_form_fields_render_field_CleverProductwithPagination_product_ids_param_value', array(
    $wc_class,
    'productIdDefaultValue',
), 10, 4 ); // Defines default value for param if not provided. Takes from other param value.