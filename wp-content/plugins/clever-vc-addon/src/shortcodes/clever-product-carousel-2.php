<?php
/**
 * Clever Products Carousel 2
 */
if (!function_exists('cvca_shortcode_products_carousel_2')) {
    function cvca_shortcode_products_carousel_2($atts, $content)
    {

        if (class_exists('WooCommerce')) {
            $atts = shortcode_atts(apply_filters('CleverProductCarousel2_shortcode_atts',array(
                'title' => '',
                'link'=> '',
                'orderby' => 'date',
                'order' => 'desc',
                'posts_per_page' => 6,
                'product_ids' => '',
                'filter_categories' => '',
                'asset_type' => '',
                'custom_carousel'=> 1,
                'col_xl' => 3,
                'col_lg' => 3,
                'col_md' => 3,
                'col_sm' => 2,
                'col' => 2,
                'show_pag' => 1,
                'show_nav'=> 1,
                'autoplay'=> 1,
                'speed'=> 5000,
                'scroll'=> 1,
                'nav_position' => 'middle-nav',
                'element_custom_class' => '',
                'css' => '',
            )), $atts, 'CleverProductCarousel2');
            $html = cvca_get_shortcode_view( 'product-carousel-2', $atts, $content );

            return $html;
        }
        return null;

    }
}
add_shortcode('CleverProductCarousel2', 'cvca_shortcode_products_carousel_2');

add_action('vc_before_init', 'cvca_product_carousel_2_integrate_vc');

if (!function_exists('cvca_product_carousel_2_integrate_vc')) {
    function cvca_product_carousel_2_integrate_vc()
    {
        if (class_exists('WooCommerce')) {
            $asset_type =  array(
                array('label' => esc_html__('New Arrivals','torano'),'value' => 'latest' ),
                array('label' => esc_html__('Featured','torano'),'value' => 'featured' ),
                array('label' => esc_html__('Onsale','torano'),'value' => 'onsale' ),
                array('label' => esc_html__('Deal','torano'),'value' => 'deal' ),
                array('label' => esc_html__('Best Seller','torano'),'value' => 'best-selling' ),
                array('label' => esc_html__('Top Rate','torano'),'value' => 'toprate' ),
            );
            vc_map(
                array(
                    'name' => esc_html__('Clever Products Carousel 2', 'cvca'),
                    'base' => 'CleverProductCarousel2',
                    'icon' => 'icon-wpb-woocommerce',
                    'category' => esc_html__('CleverSoft Elements', 'cvca'),
                    'description' => esc_html__('Show multiple products with layout carousel', 'cvca'),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Enter Title', 'cvca'),
                            'param_name' => 'title',
                            'description' => esc_html__('', 'cvca'),
                        ),
                        array(
                            'type' => 'vc_link',
                            'heading' => esc_html__('Action Link and Text', 'cvca'),
                            'value' => '#',
                            'param_name' => 'link',
                            'description' => esc_html__('Enter text and link', 'cvca'),
                        ),
                        array(
                            "type" => "cvca_multiselect2",
                            "heading" => esc_html__("Categories", 'cvca'),
                            "param_name" => "filter_categories",
                            "value" => get_custom_posttype_categories_for_vc('product_cat'),
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
                            'heading' => esc_html__('Asset type', 'cvca'),
                            'value' => $asset_type,
                            'std' => '',
                            'param_name' => 'asset_type',
                            'description' => esc_html__('Select asset type of products for show filter', 'cvca'),
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
                            'type' => 'textfield',
                            'heading' => esc_html__('Products per Pages', 'cvca'),
                            'value' => 6,
                            'param_name' => 'posts_per_page',
                            'description' => esc_html__('Products per Page showing', 'cvca'),
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
                            'heading' => esc_html__('Carousel: Show Pagination', 'cvca'),
                            'param_name' => 'show_pag',
                            'std' => 1,
                            'dependency' => Array('element' => 'custom_carousel', 'value' => array('1')),
                            'value' => array(esc_html__('Allow', 'cvca') => 1),
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => esc_html__('Carousel: Show Navigation', 'cvca'),
                            'param_name' => 'show_nav',
                            'std' => 1,
                            'dependency' => Array('element' => 'custom_carousel', 'value' => array('1')),
                            'value' => array(esc_html__('Allow', 'cvca') => 1),
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
                            'type' => 'dropdown',
                            'heading' => esc_html__('Carousel: Navigation position', 'cvca'),
                            'param_name' => 'nav_position',
                            'std' => 'middle-nav',
                            'value' => array(
                                esc_html__('Middle', 'cvca') => 'middle-nav',
                            ),
                            'dependency' => Array('element' => 'custom_carousel', 'value' => array('1')),
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
add_filter( 'vc_autocomplete_CleverProductCarousel2_product_ids_callback', array(
    $wc_class,
    'productIdAutocompleteSuggester',
), 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_CleverProductCarousel2_product_ids_render', array(
    $wc_class,
    'productIdAutocompleteRender',
), 10, 1 ); // Render exact product. Must return an array (label,value)
//For param: ID default value filter
add_filter( 'vc_form_fields_render_field_CleverProductCarousel2_product_ids_param_value', array(
    $wc_class,
    'productIdDefaultValue',
), 10, 4 ); // Defines default value for param if not provided. Takes from other param value.