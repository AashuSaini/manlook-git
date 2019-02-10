<?php
/**
 * Product Grid Tabs Shortcode
 */
wp_enqueue_style('cvca-style');
wp_enqueue_script('cvca-script');
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
wp_enqueue_script('cvca-libs');
if(!$atts['filter_tags']){
    return;
}

$tags_arr = explode(',',$atts['filter_tags']);

$varid = mt_rand();
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverProductwithTrendingTags_shortcode_atts', $atts);
$css_class .= ' '.$atts['element_custom_class'];

?>
<div class="woocommerce product-trending-tags cvca-products-wrap cvca-products-wrap_<?php echo esc_attr($varid); ?> <?php echo esc_attr($css_class) ?>">
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
        
        ?>
        <div class="<?php echo esc_attr($cvca_wrap_class) ?> " data-config='<?php echo esc_attr($cvca_json_config) ?>'>
            <?php if (isset($atts['title']) && $atts['title'] != '') { ?>
            <div class="wrap-head-product-filter">
                <div class="wrap-head-product-filter-inner">
                    <h3 class="title"><?php echo esc_html($atts['title']) ?></h3>
                </div>
                <?php if (isset($atts['border_after_width']) && $atts['border_after_width'] != '') { ?>
                <div class="border-accent-color" style="position: relative;width: 100%;display: block;height: 1px;clear: both;background: #ebebeb;" >
                    <span class="after-color" style="position: absolute;top:-1px;left: 0;width: <?php echo esc_attr($atts['border_after_width']); ?>px;height: 2px;background: <?php echo esc_attr($atts['accent_color']); ?>">
                    </span>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            <div style="display: block;height: 20px;width: 100%; clear: both;"></div>
            <ul class="products <?php echo esc_attr($class) ?>">
                <?php 
                foreach ($tags_arr as $key => $tag) {
                        $tags = get_term_by('slug', $tag, 'product_tag');
                        if(isset($tags->term_id)){
                            echo '<li class="product tag-item">';
                            echo '<a href="'.esc_url(get_tag_link($tags->term_id)).'" title="'.esc_attr($tags->name).'">';
                            echo  esc_attr($tags->name);
                            echo '</a></li>';
                        }
                        
                    }
                ?>
            </ul>
        </div>
        
    </div> 
    <?php wp_reset_postdata(); ?>
</div>