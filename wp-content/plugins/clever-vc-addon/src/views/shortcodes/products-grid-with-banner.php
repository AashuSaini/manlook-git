<?php
/**
 * Products Carousel with Category Tabs Shortcode
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
if($atts['filter_categories'] == null || $atts['filter_categories'] == "Array"){
    $product_categories = $product_cats;
}
else{
    $product_categories = explode(',', $atts['filter_categories']);
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
    'product_cat' => $atts['default_category'] ? $atts['default_category'] : $atts['filter_categories'],
    'posts_per_page' => $atts['posts_per_page'],
    'paged' => $paged,
    'orderby' => $atts['orderby'],
    'order' => $atts['order'],
    'post__not_in'=> $product_ids,
);


$atts['wc_attr'] = $wc_attr; 

$varid = mt_rand();
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverProductsGridwithBanner', $atts);
$css_class .= $atts['element_custom_class'];
// Action link and text
$zoo_allow_tag = array(
    'a' => array(
        'class' => array(),
        'href' => array(),
        'target' => array(),
        'rel' => array(),
        'title' => array()
    ),
    'br' => array()
);
$zoo_link_text = $zoo_start_link = $zoo_end_link = null;

if ( !empty( $atts['link'] ) ) {
    $zoo_link = vc_build_link( $atts['link'] );

    if ( $zoo_link['url'] != '' ) {
        $zoo_start_link = '<a';
        $zoo_start_link .= ' class="action-to-link"';
        $zoo_start_link .= ' href="' . $zoo_link['url'] . '"';

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

    $zoo_link_text = ( $zoo_link['title'] != '' ) ? $zoo_link['title'] : '';

    if ( $zoo_link['url'] != '' ) {
        $zoo_end_link = '</a>';
    }
}
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
        $cvca_wrap_class = "cvca-wrap-products-sc cvca-grid cvca-grid-with-banner col-12 col-sm-12 col-md-12 col-lg-12";

        $class = 'grid-layout';
        $grid_class = '  grid-xl-' . $atts['col_xl'] . '-cols  grid-lg-' . $atts['col_lg'] . '-cols grid-md-' . $atts['col_md'] . '-cols grid-sm-' . $atts['col_sm'] . '-cols grid-' . $atts['col'] .'-cols';
        $cvca_wrap_class .= $grid_class;
        $product_query = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $atts['wc_attr']));
        
        ?>
        <div class="<?php echo esc_attr($cvca_wrap_class) ?> ">
            <div class="wrap-head-product-filter">
                <div class="wrap-head-product-filter-inner">
                    <?php if (isset($atts['title']) && $atts['title'] != '') { ?>
                        <h3 class="title"><?php echo esc_html($atts['title']) ?></h3>
                    <?php } ?>
                    <ul class="cvca-ajax-load filter-cate cvca-list-product-category">
                        <?php
                        if($atts['default_category'] && isset(get_term_by('slug',$atts['default_category'], 'product_cat')->name)){
                            echo '<li><a class="active" data-type="product_cat" data-value="'.$atts['default_category'].'" >' . get_term_by('slug',$atts['default_category'], 'product_cat')->name . '</a></li>';
                        }
                        foreach ($product_categories as $product_cat_slug) {

                            $product_cat = get_term_by('slug', $product_cat_slug, 'product_cat');
                            if(isset($product_cat->slug)){
                                echo '<li><a 
                                data-type="product_cat" data-value="' . esc_attr($product_cat->slug) . '" 
                                href="' . esc_url(get_term_link($product_cat->slug, 'product_cat')) . '" 
                                title="' . esc_attr($product_cat->name) . '">' . esc_html($product_cat->name) . '</a></li>';
                            }
                            
                        } ?>
                    </ul>
                </div>
            </div>
            <div class="products-banner-content append-class">
                <div class="products-banner hidden-md">
                    <div class="banner-inner">
                        <?php 
                        echo wp_kses( $zoo_start_link, $zoo_allow_tag ); 
                        echo wp_get_attachment_image($atts['img_banner'], 'full'); 
                        echo wp_kses( $zoo_end_link, $zoo_allow_tag ); 
                        ?>
                    </div>
                </div>
                
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
    ?>
</div>