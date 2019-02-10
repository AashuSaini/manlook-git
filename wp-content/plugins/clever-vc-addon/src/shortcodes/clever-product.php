<?php
/**
 * Clever Product Shortcode
 */
if(!function_exists('cvca_get_products_data')) {
    function cvca_get_products_data()
    {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
        );
        $the_query = new \WP_Query($args);
        $results = array();

        if ($the_query->have_posts()):
            while ($the_query->have_posts()): $the_query->the_post();
                $data = array();
                $data['value'] = get_the_ID();
                $data['label'] = get_the_title();
                $results[] = $data;
            endwhile;
        endif;
        wp_reset_postdata();
        return $results;
    }
}
if (!function_exists('cvca_shortcode_products')) {
    function cvca_shortcode_products($atts, $content)
    {

        if (class_exists('WooCommerce')) {
            $product_categories = get_categories(
                array(
                    'taxonomy' => 'product_cat',
                )
            );
            $product_cats = array();
            $product_cats_all = '';
            if (count($product_categories) > 0) {

                foreach ($product_categories as $value) {
                    $product_cats[$value->name] = $value->slug;
                }
                $product_cats_all = implode(',', $product_cats);
            }

            $product_tags = get_terms('product_tag');
            $product_tags_arr = array();
            $product_tags_all = '';
            if (count($product_tags) > 0) {

                foreach ($product_tags as $value) {
                    $product_tags_arr[$value->name] = $value->slug;
                }
                $product_tags_all = implode(',', $product_tags_arr);
            }


            $attributes_arr = array();
            $attributes_arr_all = '';
            if (function_exists('wc_get_attribute_taxonomies')) {
                $product_attribute_taxonomies = wc_get_attribute_taxonomies();
                if (count($product_attribute_taxonomies) > 0) {

                    foreach ($product_attribute_taxonomies as $value) {
                        $attributes_arr[$value->attribute_label] = $value->attribute_name;
                    }
                    $attributes_arr_all = implode(',', $attributes_arr);
                }
            }

            $atts = shortcode_atts(apply_filters('CleverProduct_shortcode_atts',array(
                'post_type' => 'product',
                'products_ids' => '',
                'column' => '4',
                'column_tablet' => '2',
                'column_mobile' => '2',
                'posts_per_page' => 4,
                'loadmore' => '',
                'highlight_featured' => '',
                'products_type' => 'grid',
                'paged' => 1,
                'show' => '',
                'show_nav' => '1',
                'show_pag' => '',
                'orderby' => 'date',
                'filter_categories' => $product_cats_all,
                'filter_tags' => $product_tags_all,
                'filter_attributes' => $attributes_arr_all,
                'show_filter' => 0,
                'show_featured_filter' => 0,
                'show_price_filter' => 0,
                'price_filter_level' => 5,
                'price_filter_range' => 100,
                'element_custom_class' => '',
                'filter_col' => '4',
                'css' => '',
            )), $atts, 'CleverProduct');


            $meta_query = WC()->query->get_meta_query();

            $orderby=$atts['products_ids'] != ''?'post__in':$atts['orderby'];
            $wc_attr = array(
                'post_type' => 'product',
                'posts_per_page' => $atts['posts_per_page'],
                'paged' => $atts['paged'],
                'orderby' => $orderby,
            );
            if ($atts['products_ids'] != '') {
                $wc_attr['post__in'] = explode(",", $atts['products_ids']);
            }else {
                if ($atts['show'] == 'featured') {
                    $meta_query[] = array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field' => 'name',
                            'terms' => 'featured',
                            'operator' => 'IN'
                        ),
                    );
                    $wc_attr['tax_query'] = $meta_query;
                } elseif ($atts['show'] == 'onsale') {

                    $product_ids_on_sale = wc_get_product_ids_on_sale();

                    $wc_attr['post__in'] = $product_ids_on_sale;

                    $wc_attr['meta_query'] = $meta_query;

                } elseif ($atts['show'] == 'best-selling') {

                    $wc_attr['meta_key'] = 'total_sales';

                    $wc_attr['meta_query'] = $meta_query;

                } elseif ($atts['show'] == 'latest') {

                    $wc_attr['orderby'] = 'date';

                    $wc_attr['order'] = 'DESC';

                } elseif ($atts['show'] == 'toprate') {

                    add_filter('posts_clauses', array('WC_Shortcodes', 'order_by_rating_post_clauses'));

                } elseif ($atts['show'] == 'price') {

                    $wc_attr['orderby'] = "meta_value_num {$wpdb->posts}.ID";
                    $wc_attr['order'] = 'ASC';
                    $wc_attr['meta_key'] = '_price';

                } elseif ($atts['show'] == 'price-desc') {
                    $wc_attr['orderby'] = "meta_value_num {$wpdb->posts}.ID";
                    $wc_attr['order'] = 'DESC';
                    $wc_attr['meta_key'] = '_price';

                } elseif ($atts['show'] == 'deal') {
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $wc_attr['post__in'] = $product_ids_on_sale;
                    $wc_attr['meta_query'] = array(
                        'relation' => 'AND',
                        array(
                            'key' => '_sale_price_dates_to',
                            'value' => time(),
                            'compare' => '>'
                        )
                    );
                }
            }
            if ($atts['filter_categories'] != $product_cats_all && $atts['filter_categories'] != '') {
                $wc_attr['product_cat'] = $atts['filter_categories'];

            }

            /* Fix for select2 field - default value */
            if ( $atts['filter_categories'] === 'Array' ) {
                $wc_attr['product_cat'] = $product_cats_all;
            }

            $atts['wc_attr'] = $wc_attr;
            $html = cvca_get_shortcode_view( 'product', $atts, $content );

            return $html;
        }
        return null;

    }
}
add_shortcode('CleverProduct', 'cvca_shortcode_products');

add_action('vc_before_init', 'cvca_product_integrate_vc');

if (!function_exists('cvca_product_integrate_vc')) {
    function cvca_product_integrate_vc()
    {
        if (class_exists('WooCommerce')) {
            $product_categories = get_terms('product_cat');
            $product_categories = array_values($product_categories);
            $product_cats = array();
            cvca_create_select_tree(0, $product_categories, 0, $product_cats);
            $product_tags = get_terms('product_tag');
            $product_tags_arr = array();
            $product_tags_all = '';
            if (count($product_tags) > 0) {

                foreach ($product_tags as $value) {
                    $product_tags_arr[$value->name] = $value->slug;
                }
                $product_tags_all = implode(',', $product_tags_arr);
            }


            $attributes_arr = array();
            $attributes_arr_all = '';
            if (function_exists('wc_get_attribute_taxonomies')) {
                $product_attribute_taxonomies = wc_get_attribute_taxonomies();
                if (count($product_attribute_taxonomies) > 0) {

                    foreach ($product_attribute_taxonomies as $value) {
                        $attributes_arr[$value->attribute_label] = $value->attribute_name;
                    }
                    $attributes_arr_all = implode(',', $attributes_arr);
                }
            }


            vc_map(
                array(
                    'name' => esc_html__('Clever Advanced Products', 'cvca'),
                    'base' => 'CleverProduct',
                    'icon' => '',
                    'category' => esc_html__('CleverSoft Elements', 'cvca'),
                    'description' => esc_html__('Show multiple products with advanced settings and filters.', 'cvca'),
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Layout', 'cvca'),
                            'value' => array(
                                esc_html__('Grid', 'cvca') => 'grid',
                                esc_html__('Carousel', 'cvca') => 'carousel',
                            ),
                            "admin_label" => true,
                            'std'=>'grid',
                            'param_name' => 'products_type',
                            'description' => esc_html__('Select layout type for display product', 'cvca'),
                        ),
                        array(
                            "type" => "cvca_multiselect2",
                            "heading" => esc_html__("Categories", 'cvca'),
                            "param_name" => "filter_categories",
                            "value" => $product_cats,
                            'std' => ''
                        ),
                        array(
                            "type" => "autocomplete",
                            "heading" => esc_html__("Product IDs", 'cvca'),
                            "description" => esc_html__("Display only products follow list product added here.", 'cvca'),
                            "param_name" => "products_ids",
                            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'min_length' => 0,
                                'no_hide' => true, // In UI after select doesn't hide an select list
                                'groups' => true, // In UI show results grouped by groups
                                'unique_values' => true, // 0In UI show results except selected. NB! You should manually check values in backend
                                'display_inline' => true, // In UI show results inline view
                            ),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Asset type', 'cvca'),
                            'value' => array(
                                esc_html__('All', 'cvca') => '',
                                esc_html__('Featured product', 'cvca') => 'featured',
                                esc_html__('Onsale product', 'cvca') => 'onsale',
                                esc_html__('Deal product', 'cvca') => 'deal',
                                esc_html__('Best Selling', 'cvca') => 'best-selling',
                                esc_html__('Latest product', 'cvca') => 'latest',
                                esc_html__('Top rate product', 'cvca') => 'toprate ',
                                esc_html__('Sort by price: low to high', 'cvca') => 'price',
                                esc_html__('Sort by price: high to low', 'cvca') => 'price-desc',
                            ),
                            'std' => '',
                            'param_name' => 'show',
                            'description' => esc_html__('Select asset type of products', 'cvca'),
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
                            'type' => 'textfield',
                            'heading' => esc_html__('Number of product', 'cvca'),
                            'value' => 6,
                            "admin_label" => true,
                            'param_name' => 'posts_per_page',
                            'description' => esc_html__('Number of product showing', 'cvca'),
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => esc_html__('Highlight Featured Products', 'cvca'),
                            'param_name' => 'highlight_featured',
                            'std' => '',
                            'group' => esc_html__('Layout', 'cvca'),
                            "dependency" => array('element' => 'products_type', 'value' => array('grid')),
                            'value' => array(esc_html__('Yes', 'cvca') => '1'),
                        ),
                        array(
                            'type' => 'textfield',
                            'group' => esc_html__('Layout', 'cvca'),
                            'heading' => esc_html__('Columns number', 'cvca'),
                            'std' => '4',
                            'param_name' => 'column',
                            'description' => esc_html__('Display product with the number of columns, accept only number. Maximum is 6 with grid layout.', 'cvca'),
                        ),
                        array(
                            'type' => 'textfield',
                            'group' => esc_html__('Layout', 'cvca'),
                            'heading' => esc_html__('Tablet Columns number', 'cvca'),
                            'std' => '2',
                            'param_name' => 'column_tablet',
                            'description' => esc_html__('Display product with the number of columns in tablet device, accept only number. Maximum is 6 with grid layout.', 'cvca'),
                        ),
                        array(
                            'type' => 'textfield',
                            'group' => esc_html__('Layout', 'cvca'),
                            'heading' => esc_html__('Mobile Columns number', 'cvca'),
                            'std' => '2',
                            'param_name' => 'column_mobile',
                            'description' => esc_html__('Display product with the number of columns in mobile device, accept only number. Maximum is 6 with grid layout.', 'cvca'),
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => esc_html__('Show carousel pagination', 'cvca'),
                            'param_name' => 'show_pag',
                            'std' => '',
                            'group' => esc_html__('Layout', 'cvca'),
                            "dependency" => array('element' => 'products_type', 'value' => array('carousel')),
                            'value' => array(esc_html__('Yes', 'cvca') => '1'),
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => esc_html__('Show carousel navigation', 'cvca'),
                            'param_name' => 'show_nav',
                            'std' => '1',
                            'group' => esc_html__('Layout', 'cvca'),
                            "dependency" => array('element' => 'products_type', 'value' => array('carousel')),
                            'value' => array(esc_html__('Yes', 'cvca') => '1'),
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => esc_html__('Enable Load more', 'cvca'),
                            'param_name' => 'loadmore',
                            'std' => '',
                            'group' => esc_html__('Layout', 'cvca'),
                            "dependency" => array('element' => 'products_type', 'value' => array('grid')),
                            'value' => array(esc_html__('Yes', 'cvca') => '1'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Custom Class', 'cvca'),
                            'value' => '',
                            'param_name' => 'element_custom_class',
                            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cvca'),
                        ),

                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Show Filter", 'cvca'),
                            "param_name" => "show_filter",
                            "admin_label" => true,
                            "dependency" => array('element' => 'products_type', 'value' => array('grid')),
                            "description" => esc_html__('Number columns product filter on row', 'cvca'),
                            'group' => esc_html__('Filter', 'cvca'),
                            'std' => 0,
                            "value" => array(
                                esc_html__('No', 'cvca') => 0,
                                esc_html__('Yes', 'cvca') => 1,
                            ),
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Filter columns", 'cvca'),
                            "param_name" => "filter_col",
                            "admin_label" => true,
                            "dependency" => array('element' => 'show_filter', 'value' => array('1')),
                            'group' => esc_html__('Filter', 'cvca'),
                            'std' => 4,
                            "value" => array(
                                esc_html__('1', 'cvca') => 1,
                                esc_html__('2', 'cvca') => 2,
                                esc_html__('3', 'cvca') => 3,
                                esc_html__('4', 'cvca') => 4,
                                esc_html__('5', 'cvca') => 5,
                                esc_html__('6', 'cvca') => 6,
                            ),
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Show Featured, Onsale, Best Selling, Latest product filter", 'cvca'),
                            "param_name" => "show_featured_filter",
                            'std' => '0',
                            'group' => esc_html__('Filter', 'cvca'),
                            "dependency" => array('element' => 'show_filter', 'value' => '1'),
                            "value" => array(
                                esc_html__('No', 'cvca') => 0,
                                esc_html__('Yes', 'cvca') => 1,
                            ),
                        ),
                        array(
                            "type" => "cvca_multi_select",
                            "heading" => esc_html__("Tags showing in the filter", 'cvca'),
                            "param_name" => "filter_tags",
                            'group' => esc_html__('Filter', 'cvca'),
                            "dependency" => array('element' => 'show_filter', 'value' => '1'),
                            "std" => $product_tags_all,
                            "value" => $product_tags_arr,
                        ),
                        array(
                            "type" => "cvca_multi_select",
                            "heading" => esc_html__("Product attributes showing in the filter", 'cvca'),
                            "param_name" => "filter_attributes",
                            'group' => esc_html__('Filter', 'cvca'),
                            "dependency" => array('element' => 'show_filter', 'value' =>'1'),
                            "std" => $attributes_arr_all,
                            "value" => $attributes_arr,
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Show Price Filter", 'cvca'),
                            "param_name" => "show_price_filter",
                            'group' => esc_html__('Filter', 'cvca'),
                            "std" => 0,
                            "dependency" => array('element' => 'show_filter', 'value' => '1'),
                            "value" => array(
                                esc_html__('No', 'cvca') => 0,
                                esc_html__('Yes', 'cvca') => 1,
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Number of price levels', 'cvca'),
                            'value' => '5',
                            'std' => '5',
                            'group' => esc_html__('Filter', 'cvca'),
                            'param_name' => 'price_filter_level',
                            "dependency" => array('element' => 'show_price_filter', 'value' =>'1'),
                            'description' => esc_html__('Number of price levels showing in the filter', 'cvca'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Filter range', 'cvca'),
                            'std' => '100',
                            'value' => '100',
                            'group' => esc_html__('Filter', 'cvca'),
                            'param_name' => 'price_filter_range',
                            "dependency" => array('element' => 'show_price_filter', 'value' => '1'),
                            'description' => esc_html__('Range of price filter. Example range equal 100 => price filter are "0$ to 100$", "100$ to 200$"', 'cvca'),
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
add_filter( 'vc_autocomplete_CleverProduct_product_ids_callback', array(
    $wc_class,
    'productIdAutocompleteSuggester',
), 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_CleverProduct_product_ids_render', array(
    $wc_class,
    'productIdAutocompleteRender',
), 10, 1 ); // Render exact product. Must return an array (label,value)
//For param: ID default value filter
add_filter( 'vc_form_fields_render_field_CleverProduct_product_ids_param_value', array(
    $wc_class,
    'productIdDefaultValue',
), 10, 4 ); // Defines default value for param if not provided. Takes from other param value.