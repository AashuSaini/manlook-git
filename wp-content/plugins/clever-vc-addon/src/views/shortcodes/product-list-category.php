<?php
/**
 * Product Grid Tabs Shortcode
 */
wp_enqueue_style('cvca-style');
wp_enqueue_script('cvca-ajax-product');
wp_enqueue_script('cvca-script');

$filter_style = $atts['filter_style'];
$class_style = '';

$product_categories = get_categories(
    array(
        'taxonomy' => 'product_cat',
        'parent' => $filter_style == 'sub_cate'? 0 : '',
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

if($filter_style == 'sub_cate'){
    $class_style = 'list-style';
    if($atts['filter_sub_cate'] == null || $atts['filter_sub_cate'] == "Array"){
        $atts['filter_sub_cate'] = $product_cats_all;
    }
    $filter_categories_arr = explode(',',$atts['filter_sub_cate']);
}
else{
    $class_style = 'grid-style';
    if($atts['filter_list'] == null || $atts['filter_list'] == "Array"){
        $atts['filter_list'] = $product_cats_all;
    }
    $filter_list_arr = explode(',',$atts['filter_list']);
}

$varid = mt_rand();
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverProductwithLisCategory_shortcode_atts', $atts);
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
        $cvca_wrap_class = "cvca-wrap-products-sc cvca-grid col-12 col-sm-12 col-md-12 col-lg-12";
        $class = 'grid-layout';
        $grid_class = '  grid-xl-' . $atts['col_xl'] . '-cols  grid-lg-' . $atts['col_lg'] . '-cols grid-md-' . $atts['col_md'] . '-cols grid-sm-' . $atts['col_sm'] . '-cols grid-' . $atts['col'] .'-cols';
        $cvca_wrap_class .= $grid_class . ' '.$class_style;
        
        
        ?>
        <div class="<?php echo esc_attr($cvca_wrap_class) ?> ">
            <?php if (isset($atts['title']) && $atts['title'] != '') { ?>
            <div class="wrap-head-product-filter">
                <div class="wrap-head-product-filter-inner">
                
                    <h3 class="title"><?php echo esc_html($atts['title']) ?></h3>
                
                </div>
                 <?php if($atts['accent_color'] && $filter_style == 'sub_cate'): ?>
                    <div class="border-accent-color" style="position: relative;width: 100%;display: block;height: 1px;clear: both;background: #ebebeb;" >
                        <span class="after-color" style="position: absolute;top:-1px;left: 0;width: <?php echo esc_attr($atts['border_after_width']); ?>px;height: 2px;background: <?php echo esc_attr($atts['accent_color']); ?>">
                        </span>
                    </div>
                <?php endif; ?>
            </div>
            <?php $space_height = $filter_style == 'sub_cate'?  'height: 30px' : 'height: 10px'; ?>
            <div style="display: block;<?php echo esc_attr($space_height); ?>;width: 100%; clear: both;"></div>
            <?php } ?>
            <ul class="products <?php echo esc_attr($class) ?>">
                <?php 
                if($filter_style == 'sub_cate'){
                    foreach ($filter_categories_arr as $key => $cat) {
                        $cat_opp = get_term_by('slug', $cat, 'product_cat');
                        if(isset($cat_opp->term_id)) {
                            $children = get_term_children($cat_opp->term_id,'product_cat');
                            if($cat_opp->term_id){
                                echo '<li class="product category-items"><div class="wrap-product-loop-content"><div class="wrap-product-img wrap-img">';
                                $thumbnail_id = get_woocommerce_term_meta( $cat_opp->term_id, 'thumbnail_id', true );
                                if($thumbnail_id){ 

                                    $zoo_item = wp_get_attachment_image_src($thumbnail_id, 'woocommerce_thumbnail');
                                    $zoo_img_url = $zoo_item[0];
                                    $zoo_width = $zoo_item[1];
                                    $zoo_height = $zoo_item[2];
                                    $resolution = $zoo_width / $zoo_height;
                                    $zoo_img_title = get_the_title($thumbnail_id);
                                    $zoo_img_srcset = wp_get_attachment_image_srcset($thumbnail_id);?>

                                    <img src="<?php echo get_template_directory_uri() . '/assets/images/placeholder.jpg'; ?>"
                                         height="<?php echo esc_attr($zoo_height) ?>" 
                                         width="<?php echo esc_attr($zoo_width) ?>"
                                         class="wp-post-image" 
                                         alt="<?php echo esc_attr($zoo_img_title); ?>"
                                         sizes="<?php echo wp_get_attachment_image_sizes($thumbnail_id, 'woocommerce_thumbnail') ?>"
                                         srcset="<?php echo esc_attr($zoo_img_srcset) ?>"/>
                                    <?php

                                }
                                
                                echo '</div><div class="category-content wrap-product-loop-detail"><h3 class="product-loop-title">';
                                echo '<a href="'.esc_url(get_category_link($cat_opp->term_id)).'" title="'.esc_attr(get_the_category_by_ID($cat_opp->term_id)).'">';
                                echo esc_attr(get_the_category_by_ID($cat_opp->term_id));
                                echo '</a>';
                                echo '</h3>';
                                foreach ($children as $key => $child) {
                                    echo '<p class="category-item">';
                                    echo '<a href="'.esc_url(get_category_link($child)).'" title="'.esc_attr(get_the_category_by_ID($child)).'">';
                                    echo esc_attr(get_the_category_by_ID($child));
                                    echo '</a>';
                                    echo '</p>';
                                }
                                echo '</div></div></li>';
                            }
                        }
                    }
                }
                else{
                    foreach ($filter_list_arr as $key => $cat) {
                        $cat_opp = get_term_by('slug', $cat, 'product_cat');
                        if(isset($cat_opp->term_id)){
                            echo '<li class="product category-items"><div class="wrap-product-loop-content"><div class="wrap-product-img">';
                            $thumbnail_id = get_woocommerce_term_meta( $cat_opp->term_id, 'thumbnail_id', true );
                            if($thumbnail_id){
                                echo wp_get_attachment_image($thumbnail_id, 'full');
                            }
                            
                            echo '</div><div class="category-content wrap-product-loop-detail"><h3 class="product-loop-title">';
                            echo '<a href="'.esc_url(get_category_link($cat_opp->term_id)).'" title="'.esc_attr(get_the_category_by_ID($cat_opp->term_id)).'">';
                            echo esc_attr(get_the_category_by_ID($cat_opp->term_id));
                            echo '</a>';
                            echo '</h3>';
                            echo '</div></div></li>';
                        }
                        
                    }
                }
                
                ?>
            </ul>
        </div>
        
    </div> 
    <?php wp_reset_postdata(); ?>
</div>