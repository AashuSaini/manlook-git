<?php
/**
 * Blog Shortcode
 */
wp_enqueue_style('cvca-style');
$wrapID = 'shortcode_blog_' . uniqid();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => ($atts['number'] > 0) ? $atts['number'] : get_option('posts_per_page')
);
if ($atts['cat'] != '') {
    $catid = array();
    foreach (explode(',', $atts['cat']) as $catslug) {
        $catid[] .= get_category_by_slug($catslug)->term_id;
    }
    $args['category__in'] = $catid;
    
}
if ($atts['post_in'] != '') {
    $args['post__in'] = explode(",", $atts['post_in']);
}
if (!isset($atts['paged'])) {
    $args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
} else {
    $args['paged'] = $atts['paged'];
}
$the_query = new WP_Query($args);
$layout = $atts['layout'];
$wrapClass = $atts['element_custom_class'] . ' ' . $atts['layout'] . '-layout ' . $atts['preset'];
$wrapClass .= ' zoo-blog-shortcode';
if ($atts['animation_type'] != '' && $atts['animation_type'] != 'none') {
    wp_enqueue_style('animations');
}
if ($atts['layout'] == 'grid') {
    $wrapClass .= '  grid-xl-' . $atts['col_xl'] . '-cols  grid-lg-' . $atts['col_lg'] . '-cols grid-md-' . $atts['col_md'] . '-cols grid-sm-' . $atts['col_sm'] . '-cols grid-' . $atts['col'] .'-cols';
}
$wrapClass .= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverBlog', $atts);

?>
<div id="<?php echo esc_attr($wrapID); ?>" class="<?php echo esc_attr($wrapClass) ?>">
    <?php
    if ($atts['title'] != '') {
        ?>
        <h3 class="title-block"><?php echo esc_html($atts['title']) ?> </h3>
        <?php
    }
    if ($the_query->have_posts()):
        ?>
        <div class="wrap-loop-content">
            <div class="row">
                <?php
                while ($the_query->have_posts()): $the_query->the_post();
                    echo cvca_get_shortcode_view('post-layout/'.$atts['layout'].'-layout', $atts);
                endwhile;
                ?>
            </div>
            <?php
            //paging
            if ($atts['pagination'] != 'none') :
                echo cvca_get_shortcode_view('post-layout/post-pagination', $atts);
            endif; ?>
        </div>
    <?php
    endif;
    wp_reset_postdata();
    ?>
</div>
