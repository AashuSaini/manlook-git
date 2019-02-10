<?php

$zoo_pag_type = zoo_get_pagination();

if(get_theme_mod('zoo_choose_sidebar_filter','default') == 'widget-ajax'){
  $class = 'paging-loadmore';
  wp_enqueue_script('infinite-scroll');
  wp_enqueue_script('zoo-woocommerce-ajax-filter');
}
else{
  $class = 'infinity-pagination';
}
if ($zoo_pag_type == 'infinity' || $zoo_pag_type == 'ajaxload') { 
  global $wp_query;
  wp_enqueue_script('infinite-scroll');
  if ($wp_query->max_num_pages > 1) {
      ?>
      <nav class="woocommerce-pagination <?php echo esc_attr($class); ?>" style="display: none;">
          <?php
          echo paginate_links(apply_filters('woocommerce_pagination_args', array(
              'base' => esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false)))),
              'format' => '',
              'add_args' => false,
              'current' => max(1, get_query_var('paged')),
              'total' => $wp_query->max_num_pages,
              'prev_text' => '<i class="cs-font clever-icon-arrow-left" aria-hidden="true"></i>',
              'next_text' => '<i class="cs-font clever-icon-arrow-right" aria-hidden="true"></i>',
              'type' => 'list',
              'end_size' => 3,
              'mid_size' => 3
          )));
          ?>
      </nav>
      <div class="page-load-status" style="display: none;">
        <div class="infinite-scroll-request">
          <lable class="pagination-loading"><span class="loading"><?php echo esc_html__('LOADING...','doma') ?></span></label>
        </div>
        <p class="infinite-scroll-last"><?php echo esc_html__('All products loaded','doma'); ?></p>
        <p class="infinite-scroll-error"><?php echo esc_html__('No more page','doma'); ?></p>
      </div>
      <?php if ($zoo_pag_type == 'ajaxload') { ?>
      <p class="ias-trigger view-more-button"><a href="/loadmore"><?php echo esc_html__('Load More','doma') ?></a></p> 
      <?php } ?>
  <?php
  }
} else if ($zoo_pag_type == 'simple') {
    /* Previous/next link. */ ?>
    <div class="zoo-wrap-pagination primary-font simple">
        <div class="prev-page">
            <?php
            previous_posts_link(esc_html__('Previous page', 'doma'));
            ?>
        </div>
        <div class="next-page">
            <?php
            next_posts_link(esc_html__('Next page', 'doma'));
            ?>
        </div>
    </div>
    <?php
} else if ($zoo_pag_type == 'numeric') {
  woocommerce_pagination();
}