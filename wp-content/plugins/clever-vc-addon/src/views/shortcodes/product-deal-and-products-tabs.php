<?php
/**
 * Product Grid Tabs Shortcode
 */
wp_enqueue_style('cvca-style');
wp_enqueue_script('cvca-ajax-product');
wp_enqueue_script('cvca-script');

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
if($atts['filter_categories'] == null || $atts['filter_categories'] == "Array"){
    $atts['filter_categories'] = $product_cats_all;
}
$product_ids = '';
if($atts['product_ids']){
    $product_ids = explode(',', $atts['product_ids']);
}

if ( is_front_page() ) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;   
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
}
$meta_query = WC()->query->get_meta_query();
$wc_attr = array(
    'post_type' => 'product',
    'product_cat' => $atts['filter_categories'],
    'posts_per_page' => $atts['posts_per_page'],
    'paged' => $paged,
    'orderby' => $atts['orderby'],
    'order' => $atts['order'],
    'post__not_in'=> $product_ids,
);
if($atts['asset_type'] == ''){
   $atts['asset_type'] = 'latest,featured,onsale,deal,best-selling,toprate';
}
$assets = explode(',',str_replace(' ','',$atts['asset_type']));
switch ($atts['default_asset_type']) {
    case 'featured':
        $meta_query[] = array(
            array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN'
            ),
        );
        $wc_attr['tax_query'] = $meta_query;
        break;
    case 'onsale':
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $wc_attr['post__in'] = $product_ids_on_sale;
        break;
    case 'best-selling':
        $wc_attr['meta_key'] = 'total_sales';
        $wc_attr['orderby']  = 'meta_value_num';
        break;
    case 'latest':
        $wc_attr['orderby'] = 'date';
        break;
    case 'toprate':
        add_filter('posts_clauses', array('WC_Shortcode_Products', 'order_by_rating_post_clauses'));
        break;
    case 'deal':
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
        break;
    default:
        break;
}

$atts['wc_attr'] = $wc_attr; 

$varid = mt_rand();
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverProductDealandTabs', $atts);
$css_class .= $atts['element_custom_class'];

?>
<div class="woocommerce product-carousel-shortcode cvca-products-wrap cvca-products-wrap_<?php echo esc_attr($varid); ?> <?php echo esc_attr($css_class) ?>"
    data-args='<?php
    //shortcode agurgument
    if (!isset($_POST['show'])) {
        $init_atts = $atts;
        unset($init_atts['wc_attr']);
        echo json_encode($init_atts);
    } else {
        echo json_encode($_POST);
    }
    ?>'
    data-empty="<?php echo esc_attr__('No product found', 'cvca'); ?>"
    data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
    <div class="cvca-wrapper-products-shortcode ">
        <?php
        $cvca_wrap_class = "cvca-wrap-products-sc";
        $class = 'grid-layout';
        $grid_class = '  grid-xl-' . $atts['col_xl'] . '-cols  grid-lg-' . $atts['col_lg'] . '-cols grid-md-' . $atts['col_md'] . '-cols grid-sm-' . $atts['col_sm'] . '-cols grid-' . $atts['col'] .'-cols';
        
        $product_query = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $atts['wc_attr']));
        
        ?>
        <div class="<?php echo esc_attr($cvca_wrap_class) ?> row ">
            <div class="product-deal cvca-product-deal style-1 col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="cvca-product-deal-inner <?php echo esc_attr($atts['show_border'] == '1'? "show-border" : ''); ?>" style="border:2px solid <?php echo esc_attr($atts['accent_color']); ?>; min-height: <?php echo esc_attr($atts['min_height']); ?>px;">
                    <?php
                        $wc_attr2 = array(
                            'post_type' => 'product',
                            'posts_per_page' => 1,
                            'post__in' => array($atts['deal_id']),
                        );
                        $atts['wc_attr2'] = $wc_attr2; 
                        $deal_query = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $atts['wc_attr2']));

                    ?>
                    <div class="wrap-head-product-filter">
                        <div class="wrap-head-product-filter-inner">
                            <?php if (isset($atts['deal_title']) && $atts['deal_title'] != '') { ?>
                                <h3 class="title"><?php echo esc_html($atts['deal_title']) ?></h3>
                            <?php } ?>
                        </div>
                        <?php if($atts['accent_color']): ?>
                        <div class="border-accent-color" style="position: relative;width: 100%;display: block;height: 1px;clear: both;background: #ebebeb;" >
                            <span class="after-color" style="position: absolute;top:-1px;left: 0;width: <?php echo esc_attr($atts['border_after_width']); ?>px;height: 2px;background: <?php echo esc_attr($atts['accent_color']); ?>">
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <ul class="products deal <?php echo esc_attr($class) ?>">
                        <?php 
                            add_action('woocommerce_after_shop_loop_item_title','zoo_sold_bar', 15); 
                            add_action('woocommerce_after_shop_loop_item_title','zoo_single_product_sale_countdown', 16);
                        ?>
                        <?php while ($deal_query->have_posts()) {
                            $deal_query->the_post();
                            wc_get_template_part( 'content', 'product' );
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="product-tabs cvca-grid append-class <?php echo esc_attr($grid_class) ?> col-12 col-sm-12 col-md-12 col-lg-8">
                <div class="wrap-head-product-filter">
                    <div class="wrap-head-product-filter-inner">
                    <?php if (isset($atts['title']) && $atts['title'] != '') { ?>
                        <h3 class="title"><?php echo esc_html($atts['title']) ?></h3>
                    <?php } ?>
                    <ul class="cvca-ajax-load filter-asset cvca-list-product-category">
                        <?php
                        $asset_title = '';
                        switch ($atts['default_asset_type']) {
                            case 'featured':
                                $asset_title =  esc_html__('Featured','torano');
                                break;
                            case 'onsale':
                                $asset_title =  esc_html__('On Sale','torano');
                                break;
                            case 'deal':
                                $asset_title =  esc_html__('Deal','torano');
                                break;
                            case 'latest':
                                $asset_title =  esc_html__('New Arrivals','torano');
                                break;
                            case 'best-selling':
                                $asset_title =  esc_html__('Best Seller','torano');
                                break;
                            case 'toprate':
                                $asset_title =  esc_html__('Top Rate','torano');
                                break;
                            default:
                                break;
                        } ?>
                        <li>
                            <a href="#" class="active" data-type="asset_type" data-value="<?php echo esc_attr($atts['default_asset_type']) ?>" title="<?php echo esc_attr($asset_title); ?>"><?php echo esc_attr($asset_title); ?></a>
                        </li>
                    <?php
                    $html = '';
                    foreach ($assets as $val) {
                        switch ($val) {
                            case 'featured':
                                $html .= $atts['default_asset_type'] != 'featured'? '<li><a href="#" data-type="asset_type" data-value="featured" title="'.esc_html__('Featured','torano').'">'.esc_html__('Featured','torano').'</a></li>' : '';
                                break;
                            case 'onsale':
                                $html .= $atts['default_asset_type'] != 'onsale'? '<li><a href="#" data-type="asset_type" data-value="onsale" title="'.esc_html__('On Sale','torano').'">'.esc_html__('On Sale','torano').'</a></li>' : '';
                                break;
                            case 'deal':
                                $html .= $atts['default_asset_type'] != 'deal'? '<li><a href="#" data-type="asset_type" data-value="deal" title="'.esc_html__('Deal','torano').'">'.esc_html__('Deal','torano').'</a></li>' : '';
                                break;
                            case 'latest':
                                $html .= $atts['default_asset_type'] != 'latest'? '<li><a href="#" data-type="asset_type" data-value="latest" title="'.esc_html__('New Arrivals','torano').'">'.esc_html__('New Arrivals','torano').'</a></li>' : '';
                                break;
                            case 'best-selling':
                                $html .= $atts['default_asset_type'] != 'best-selling'? '<li><a href="#" data-type="asset_type" data-value="best-selling" title="'.esc_html__('Best Seller','torano').'">'.esc_html__('Best Seller','torano').'</a></li>' : '';
                                break;
                            case 'toprate':
                                $html .= $atts['default_asset_type'] != 'toprate'? '<li><a href="#" data-type="asset_type" data-value="toprate" title="'.esc_html__('Top Rate','torano').'">'.esc_html__('Top Rate','torano').'</a></li>' : '';
                                break;
                            default:
                                break;
                        }
                    } ?>
                    <?php echo ent2ncr($html); ?>
                    </ul>
                
                    </div>
                    <?php if($atts['accent_color']): ?>
                        <div class="border-accent-color" style="position: relative;width: 100%;display: block;height: 1px;clear: both;background: #ebebeb;" >
                            <span class="after-color" style="position: absolute;top:-1px;left: 0;width: <?php echo esc_attr($atts['border_after_width']); ?>px;height: 2px;background: <?php echo esc_attr($atts['accent_color']); ?>">
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
                <div style="display: block;height: 30px;width: 100%; clear: both;"></div>
                <ul class="products <?php echo esc_attr($class) ?>">
                    <?php 
                        remove_action('woocommerce_after_shop_loop_item_title','zoo_sold_bar', 15); 
                        remove_action('woocommerce_after_shop_loop_item_title','zoo_single_product_sale_countdown', 16);
                    ?>
                    <?php while ($product_query->have_posts()) {
                        $product_query->the_post();
                        wc_get_template_part( 'content', 'product' );
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
    wp_reset_postdata();
    ?>
</div>