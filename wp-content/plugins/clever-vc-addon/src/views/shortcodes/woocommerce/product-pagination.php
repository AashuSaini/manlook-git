<?php
$zoo_pag_type = $atts['pagination'];
$product_query = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $atts['wc_attr']));?>
<?php if(check_better_amp()){
  cvca_pagination(3, $product_query, '', '<i class="zoo-icon-long-arrow-left"></i> ' . esc_html__('', 'torano'), esc_html__('', 'torano') . ' <i class="zoo-icon-long-arrow-right"></i>');
} else { ?>
<?php if($zoo_pag_type == 'ajaxload' || $zoo_pag_type == 'infinity'): ?>
<div class="pagination-ajax" style="display: none;">
<?php endif; ?>
<?php
cvca_pagination(3, $product_query, '', '<i class="zoo-icon-long-arrow-left"></i> ' . esc_html__('', 'torano'), esc_html__('', 'torano') . ' <i class="zoo-icon-long-arrow-right"></i>');
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