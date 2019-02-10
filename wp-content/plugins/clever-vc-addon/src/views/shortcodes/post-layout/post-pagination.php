<?php
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

$zoo_pag_type = $atts['pagination'];?>
<?php if(check_better_amp()){
  cvca_pagination(3, $product_query, '', '<i class="zoo-icon-long-arrow-left"></i> ' . esc_html__('', 'torano'), esc_html__('', 'torano') . ' <i class="zoo-icon-long-arrow-right"></i>');
} else { ?>
<?php if($zoo_pag_type == 'ajaxload' || $zoo_pag_type == 'infinity'): ?>
<div class="pagination-ajax" style="display: none;">
<?php endif; ?>
<?php
cvca_pagination(3, $the_query, '', '<i class="zoo-icon-long-arrow-left"></i> ' . esc_html__('', 'torano'), esc_html__('', 'torano') . ' <i class="zoo-icon-long-arrow-right"></i>');
?>
<?php if($zoo_pag_type == 'ajaxload' || $zoo_pag_type == 'infinity'): 
  wp_enqueue_script('cvca-libs');
  wp_enqueue_script('cvca-script');

  ?>
  </div>
  <div class="page-load-status">
    <div class="infinite-scroll-request">
      <div class="pagination-loading"><span class="loading"><?php echo esc_html__('LOADING...','torano') ?></span></div>
    </div>
    <p class="infinite-scroll-last"><?php echo esc_html__('All items loaded','torano'); ?></p>
    <p class="infinite-scroll-error"><?php echo esc_html__('No more page','torano'); ?></p>
  </div>
  <?php if ($zoo_pag_type == 'ajaxload') { ?>
    <p class="view-more-button"><span><?php echo esc_html__('Load More','torano') ?></span></p> 
  <?php } ?>
<?php endif; } ?>
<?php
wp_reset_postdata();
?>