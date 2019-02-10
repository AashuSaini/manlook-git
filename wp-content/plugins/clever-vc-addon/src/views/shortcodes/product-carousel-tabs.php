<?php
/**
 * Clever Products Carousel Tabs Shortcode
 */
wp_enqueue_style('cvca-style');
wp_enqueue_script('cvca-ajax-product');
wp_enqueue_script('cvca-script');
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
wp_enqueue_script('cvca-libs');

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
switch ($assets[0]) {
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
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverProductCarouselTabs', $atts);
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
    <div class="cvca-wrapper-products-shortcode row ">
        <?php
        $cvca_wrap_class = "cvca-wrap-products-sc col-12 col-sm-12 col-md-12 col-lg-12";

        $class = 'grid-layout carousel';
        $class .= ' ' . $atts['nav_position'];
        $cvca_wrap_class .= ' cvca-carousel';

        $col_xl = $atts['col_xl'];
        $col_lg = $atts['col_lg'];
        $col_md = $atts['col_md'];
        $col_sm = $atts['col_sm'];
        $col = $atts['col'];

        $show_pag = $atts['show_pag'] ? 'true' : 'false';
        $show_nav = $atts['show_nav'] ? 'true' : 'false';
        $autoplay = $atts['autoplay'] ? 'true' : 'false';
        $speed = $atts['speed'];
        $scroll = $atts['scroll'];

        $cvca_json_config = '{
                                "col_xl" : ' . $col_xl . ',
                                "col_lg" : ' . $col_lg . ',
                                "col_md" : ' . $col_md . ',
                                "col_sm" : ' . $col_sm . ',
                                "col" : ' . $col . ',
                                "speed": ' . $speed . ',
                                "scroll": ' . $scroll . ',
                                "autoplay": ' . $autoplay . ',
                                "show_pag": ' . $show_pag . ',
                                "show_nav": ' . $show_nav . ',
                                "wrap": "ul.products"
                            }';
        
        $product_query = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $atts['wc_attr']));
        
        ?>
        <div class="append-class <?php echo esc_attr($cvca_wrap_class) ?> " data-config='<?php echo esc_attr($cvca_json_config) ?>'>
            <div class="wrap-head-product-filter">
                <div class="wrap-head-product-filter-inner">
                <?php if (isset($atts['title']) && $atts['title'] != '') { ?>
                    <h3 class="title"><?php echo esc_html($atts['title']) ?></h3>
                <?php } ?>
                <ul class="cvca-ajax-load filter-asset cvca-list-product-category">
                    <?php
                    $asset_title = '';
                    switch ($assets[0]) {
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
                    <li class="cvca-ajax-load">
                        <a href="#" class="active" data-type="asset_type" data-value="<?php echo esc_attr($assets[0]) ?>" title="<?php echo esc_attr($asset_title); ?>"><?php echo esc_attr($asset_title); ?></a>
                    </li>
                <?php
                $html = '';
                foreach ($assets as $val) {
                    switch ($val) {
                        case 'featured':
                            $html .= $assets[0] != 'featured'? '<li><a href="#" data-type="asset_type" data-value="featured" title="'.esc_html__('Featured','torano').'">'.esc_html__('Featured','torano').'</a></li>' : '';
                            break;
                        case 'onsale':
                            $html .= $assets[0] != 'onsale'? '<li><a href="#" data-type="asset_type" data-value="onsale" title="'.esc_html__('On Sale','torano').'">'.esc_html__('On Sale','torano').'</a></li>' : '';
                            break;
                        case 'deal':
                            $html .= $assets[0] != 'deal'? '<li><a href="#" data-type="asset_type" data-value="deal" title="'.esc_html__('Deal','torano').'">'.esc_html__('Deal','torano').'</a></li>' : '';
                            break;
                        case 'latest':
                            $html .= $assets[0] != 'latest'? '<li><a href="#" data-type="asset_type" data-value="latest" title="'.esc_html__('New Arrivals','torano').'">'.esc_html__('New Arrivals','torano').'</a></li>' : '';
                            break;
                        case 'best-selling':
                            $html .= $assets[0] != 'best-selling'? '<li><a href="#" data-type="asset_type" data-value="best-selling" title="'.esc_html__('Best Seller','torano').'">'.esc_html__('Best Seller','torano').'</a></li>' : '';
                            break;
                        case 'toprate':
                            $html .= $assets[0] != 'toprate'? '<li><a href="#" data-type="asset_type" data-value="toprate" title="'.esc_html__('Top Rate','torano').'">'.esc_html__('Top Rate','torano').'</a></li>' : '';
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
                <?php while ($product_query->have_posts()) {
                    $product_query->the_post();
                    wc_get_template_part( 'content', 'product' );
                }
                ?>
            </ul>
        </div>
    </div>
    <?php
    wp_reset_postdata();
    ?>
</div>