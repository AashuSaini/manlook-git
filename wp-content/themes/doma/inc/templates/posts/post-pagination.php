<?php

$zoo_pag_type = get_theme_mod('zoo_blog_pagination','numeric');

if ($zoo_pag_type == 'infinity' || $zoo_pag_type == 'ajaxload') {
  $args = array(
      'type'                 => $zoo_pag_type,
      'delay'                => 500,
      'container_selector'   => '.zoo-container',
      'item_selector'        => '.post.status-publish',
      'layout_mode'          => 'masonry',
      'prev_text'            => esc_html__('Prev Products', 'doma'),
      'next_text'            => esc_html__('Next Products', 'doma'),
      'more_text'            => esc_html__('Load more', 'doma'),
      'no_more_text'         => esc_html__('All items loaded', 'doma'), // or use filter hook: zoo_ajax_pagination_no_more_text
  );

  zoo_ajax_pagination($GLOBALS['wp_query'], $args);
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
    the_posts_pagination( array(
        'prev_text'          =>'<i class="cs-font clever-icon-arrow-left"></i>',
        'next_text'          => '<i class="cs-font clever-icon-arrow-right"></i>',
        'before_page_number' => '',
    ) );
}
