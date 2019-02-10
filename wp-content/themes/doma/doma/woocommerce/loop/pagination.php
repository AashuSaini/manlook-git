<?php
$zoo_pag_type = zoo_get_pagination();
if($zoo_pag_type == 'ajaxload' || $zoo_pag_type == 'infinity'): 
    wp_enqueue_script('infinite-scroll');
  ?>
    <div class="pagination-ajax" style="display: none;">
<?php endif; ?>
<?php
global $wp_query;

if ($wp_query->max_num_pages > 1) {
    ?>
    <nav class="woocommerce-pagination">
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
<?php }
?>
<?php if($zoo_pag_type == 'ajaxload' || $zoo_pag_type == 'infinity'): 
  
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
<?php endif; ?>