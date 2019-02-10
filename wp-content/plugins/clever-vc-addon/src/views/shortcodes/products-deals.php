<?php
/**
 * Clever Product Carousel Shortcode
 */
wp_enqueue_style('cvca-style');
wp_enqueue_script('cvca-script');
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
wp_enqueue_script('cvca-libs');
add_action('woocommerce_after_shop_loop_item_title','zoo_sold_bar', 15);
if($atts['style-layout'] == 'style-1'){
    add_action('woocommerce_after_shop_loop_item_title','zoo_single_product_sale_countdown', 16);
}
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
    'product_cat'=> $atts['filter_categories'],
    'posts_per_page' => $atts['posts_per_page'],
    'paged' => $paged,
    'orderby' => $atts['orderby'],
    'order' => $atts['order'],
    'post__not_in'=> $product_ids,
);

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

$atts['wc_attr'] = $wc_attr; 

$varid = mt_rand();
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverProductDeal', $atts);
$css_class .= $atts['element_custom_class'];
// Action link and text

$zoo_link_text = $zoo_start_link = $zoo_end_link = null;

if ( !empty( $atts['link'] ) ) {
    $zoo_link = vc_build_link( $atts['link'] );

    if ( $zoo_link['url'] != '' ) {
        $zoo_start_link = '<a';
        $zoo_start_link .= ' class="action-to-link"';
        $zoo_start_link .= ' href="' . $zoo_link['url'] . '"';
        $zoo_start_link .= ' style="display: flex;align-items:center;font-size: 16px; font-weight: bold; color: #000; margin-left: 30px;"';
        if ( $zoo_link['title'] != '' ) {
            $zoo_start_link .= ' title="' . $zoo_link['title'] . '"';
        }
        
        if ( $zoo_link['target'] != '' ) {
            $zoo_start_link .= ' target="' . $zoo_link['target'] . '"';
        }

         if ( $zoo_link['rel'] != '' ) {
            $zoo_start_link .= ' rel="' . $zoo_link['rel'] . '"';
        }

        $zoo_start_link .= '>';
    }

    $zoo_link_text = ( $zoo_link['title'] != '' ) ? $zoo_link['title'].'<i class="cs-font clever-icon-arrow-right-4" style="font-size: 26px; margin-left: 15px;"></i>' : '';

    if ( $zoo_link['url'] != '' ) {
        $zoo_end_link = '</a>';
    }
}

?>
<div class="woocommerce product-carousel-shortcode cvca-products-wrap cvca-products-wrap_<?php echo esc_attr($varid); ?> <?php echo esc_attr($css_class) ?>">
    <div class="cvca-wrapper-products-shortcode row ">
        <?php
        $cvca_wrap_class = "cvca-wrap-products-sc col-12 col-sm-12 col-md-12 col-lg-12";

        $class = 'grid-layout carousel';
        if($atts['style-layout'] == 'style-2'){
            $class .= ' middle-nav';
        }
        else{
            $class .= ' top-nav';
        }
        $cvca_wrap_class .= ' cvca-product-deal cvca-carousel ' . $atts['style-layout'];

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
        $style = $style1 = $style2 = '';
        if($atts['style-layout'] == 'style-1'){
            if($atts['min_height']){
                $style1 = 'min-height:'.esc_attr($atts['min_height']).'px;';
            }
            
            if($atts['show_border'] == '1'){
                $style2 .= 'border: 2px solid '. esc_attr($atts['accent_color']).';';
            }
            if($style1 || $style2){
                $style = 'style="'.$style1.$style2.'"';
            }
            
        }
        
        ?>
        <div class="<?php echo esc_attr($cvca_wrap_class) ?> " data-config='<?php echo esc_attr($cvca_json_config) ?>'>
            <div class="cvca-product-deal-inner" <?php echo ent2ncr($style); ?>>
                <div class="wrap-head-product-filter">
                    <div class="title-of-deal">
                    <?php if (isset($atts['title']) && $atts['title'] != '') { ?>
                        <h3 class="title"><?php echo esc_html($atts['title']) ?></h3>
                    <?php } ?>
                    <?php wp_enqueue_script('countdown');
                    if($atts['style-layout'] == 'style-2'):
                    $time_now = strtotime("+1 day",strtotime(current_time('mysql')));
                     ?>
                    <div class="zoo-countdown">
                        <i class="cs-font clever-icon-clock-3"></i>
                        <div class="countdown-block" data-countdown="countdown"
                             data-date="<?php echo date('m', $time_now) . '-' . date('d', $time_now) . '-' . date('Y', $time_now) . '-' . date('H', $time_now) . '-' . date('i', $time_now) . '-' . date('s', $time_now); ?>">
                        </div>
                    </div>
                    <?php
                        echo ent2ncr( $zoo_start_link );
                        echo ent2ncr($zoo_link_text);
                        echo ent2ncr( $zoo_end_link );
                    ?>
                    <?php endif; ?>
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
    </div>
    <?php
    wp_reset_postdata();
    remove_action('woocommerce_after_shop_loop_item_title','zoo_sold_bar', 15);
    if($atts['style-layout'] == 'style-1'){
        remove_action('woocommerce_after_shop_loop_item_title','zoo_single_product_sale_countdown', 16);
    }
    ?>
</div>