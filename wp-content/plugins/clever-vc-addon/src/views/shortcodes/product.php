<?php
/**
 * Clever Product Shortcode
 */
if (!isset($_POST['show'])) {
    echo '<input name="cvca-filter-page-baseurl" type="hidden" value="' . cvca_current_url() . '">';
}
$varid = mt_rand();
wp_enqueue_style('cvca-style');
if ($atts['products_type'] != 'carousel') {
    wp_enqueue_script('cvca-libs');
}
wp_enqueue_script('cvca-script');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverProduct', $atts);
$css_class .= $atts['element_custom_class'];
?>
<div class="woocommerce cvca-products-wrap advanced-filter cvca-products-wrap_<?php echo esc_attr($varid); ?> <?php echo esc_attr($css_class) ?>"
    <?php if ($atts['show_filter'] || $atts['loadmore']) { ?>
        data-args='<?php
        if (!isset($_POST['show'])) {
            $init_atts = $atts;
            unset($init_atts['wc_attr']);
            echo json_encode($init_atts);
        } else {
            echo json_encode($_POST);
        }
        ?>'
        data-categories="<?php echo esc_attr($atts['filter_categories']); ?>"
        data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
        data-empty="<?php echo esc_attr__('No product found','cvca'); ?>"<?php } ?>>
    <?php
    echo cvca_get_shortcode_view('woocommerce/product-filter', $atts);
    $class = 'zoo-products grid-layout'; ?>
    <div class="cvca-wrapper-products-shortcode">
        <?php
        $cvca_wrap_class = "cvca-wrap-products-sc ";
        if ($atts['products_type'] == 'carousel') {
            $class .= ' products-carousel';
            $cvca_wrap_class .= ' cvca-carousel';
            $cvca_pag = $atts['show_pag'] != '' ? 'true' : 'false';
            $cvca_nav = $atts['show_nav'] != '' ? 'true' : 'false';
            $cvca_json_config = '{"col_width_pc":"' . $atts['column'] . '","col_width_tablet":"' . $atts['column_tablet'] . '","col_width_mobile":"' . $atts['column_mobile'] . '","wrap":"ul.products","pagination":"' . $cvca_pag . '","navigation":"' . $cvca_nav . '"}';
            wp_enqueue_style('slick');
            wp_enqueue_style('slick-theme');
            wp_enqueue_script('cvca-libs');
        } else {
            wp_enqueue_script('cvca-libs');
            $cvca_json_config='{"cols":"' . $atts['column'] . '","tablet":"' . $atts['column_tablet'] . '","mobile":"' . $atts['column_mobile'] . '","highlight_featured":"' . $atts['highlight_featured'] . '"}';
        }
        $class.=' grid-lg-' . $atts['column'] . '-cols grid-md-' . $atts['column_tablet'] . '-cols grid-' . $atts['column_mobile'] . '-cols';
        $class.=' hover-effect-'.get_theme_mod('zoo_product_hover_effect', 'default');
        if(!!$atts['highlight_featured']){
            $class .= ' highlight-featured';
        }
        $product_query = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $atts['wc_attr']));
        $product_query->query($atts['wc_attr']);
        remove_filter('posts_clauses', array('WC_Shortcodes', 'order_by_rating_post_clauses'));
        ?>
        <div class="<?php echo esc_attr($cvca_wrap_class) ?>"
             <?php if ($atts['products_type'] == 'carousel'){ ?> data-config='<?php echo esc_attr($cvca_json_config) ?>'<?php } ?>>
            <ul class="products <?php echo esc_attr($class) ?>"  <?php if ($atts['products_type'] != 'carousel'){ ?>data-zoo-config='<?php echo esc_attr($cvca_json_config) ?>'<?php } ?>>
                <?php while ($product_query->have_posts()) {
                    $product_query->the_post();
                    global $product;
                    echo cvca_get_shortcode_view('woocommerce/content-product', $atts);
                }
                ?>
            </ul>
        </div>
        <?php
        if (!isset($_POST['ajax'])):
            if ($atts['loadmore'] && $product_query->max_num_pages > $atts['wc_attr']['paged']):?>
                <a class="cvca_ajax_load_more_button btn" href="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
                   title="<?php esc_attr_e('Load more', 'cvca') ?>"
                   data-empty="<?php esc_attr_e('No more Load', 'cvca') ?>"
                   data-maxpage='<?php echo esc_attr($product_query->max_num_pages); ?>'
                ><?php esc_html_e('Load more products', 'cvca'); ?></a>
                <?php
                wp_enqueue_script('cvca-ajax-product');
            endif; ?>
        <?php endif; ?>
    </div>
    <?php
    wp_reset_postdata();
    wp_reset_query();
    ?>
</div>