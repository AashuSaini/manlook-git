<?php
/**
 * Pagination functionality
 */

/**
 * Default pagination
 */
if (!function_exists('zoo_ajax_pagination'))
{
    function zoo_ajax_pagination(WP_Query $query = null, array $args = array())
    {
        $query = $query ? : $GLOBALS['wp_query'];

        if (1 >= $query->max_num_pages) {
            return;
        }

        $paged = !empty($query->query_vars['paged']) ? intval($query->query_vars['paged']) : 1;

        $args = array(
            'type'                 => !empty($args['type']) ? $args['type'] : 'infinity',
            'delay'                => !empty($args['delay']) ? $args['delay'] : 500,
            'container_selector'   => !empty($args['container_selector']) ? $args['container_selector'] : '.zoo-container',
            'item_selector'        => !empty($args['item_selector']) ? $args['item_selector'] : '.post',
            'layout_mode'          => !empty($args['layout_mode']) ? $args['layout_mode'] : 'vertical',
            'images_loaded'        => !empty($args['images_loaded']) ? $args['images_loaded'] : false,
            'prev_text'            => !empty($args['prev_text']) ? $args['prev_text'] : esc_html__('Prev Posts', 'doma'),
            'next_text'            => !empty($args['next_text']) ? $args['next_text'] : esc_html__('Next Posts', 'doma'),
            'horizontal_alignment' => '',
            'gutter'               => '',
            'column_width'         => '',
            'more_text'            => !empty($args['more_text']) ? $args['more_text'] : apply_filters('zoo_ajax_pagination_more_text', esc_html__('Load More', 'doma')),
            'no_more_text'         => !empty($args['no_more_text']) ? $args['no_more_text'] : apply_filters('zoo_ajax_pagination_no_more_text', esc_html__('No More Posts', 'doma')),
        );

        $uid = crc32(serialize($args));

        $prev_link = get_pagenum_link($paged - 1);
        $next_link = get_pagenum_link($paged + 1);

        echo '<div id="spinner-'.esc_attr($uid).'" class="ias-trigger" style="text-align:center;display:none">' . apply_filters('zoo_ajax_pagination_spinner', '<lable class="pagination-loading"><span class="loading">'.esc_html__("LOADING...","doma").'</span></label>') . '</div>';

        ?><div id="zoo-pagination-<?php echo esc_attr($uid) ?>" class="zoo-pagination"><?php
            if ($paged > 1 && $paged <= $query->max_num_pages) {
                echo '<a id="prev-page-link-'.esc_attr($uid).'" class="prev-page-link" href="'.esc_url($prev_link).'">' . $args['prev_text'] . '</a>';
            }
            if ($paged < $query->max_num_pages) {
                echo '<a id="next-page-link-'.esc_attr($uid).'" class="next-page-link" href="'.esc_url($next_link).'">' . $args['next_text'] . '</a>';
            }
        ?></div><?php

        $layout_mode_options = '';

        if ('masonry' === $args['layout_mode']) {
            $layout_mode_options .= !empty($args['gutter']) ? 'gutter:'.$args['gutter'] : 'gutter:20';
        } elseif ('fitRows' === $args['layout_mode']) {
            $layout_mode_options .= !empty($args['gutter']) ? 'gutter:'.$args['gutter'] : 'gutter:20';
        } elseif ('vertical' === $args['layout_mode']) {
            $layout_mode_options .= !empty($args['horizontal_alignment']) ? 'horizontalAlignment:'.$args['horizontal_alignment'] : 'horizontalAlignment:0';
        }

        $inline_scripts = 'jQuery(document).ready( function($) {
    		var spinner = $("#spinner-'.esc_attr($uid).'");
    		var container = $("'.$args['container_selector'].'");
    		var ias = $.ias({
                container:  "'.$args['container_selector'].'",
                item:       "'.$args['item_selector'].'",
                pagination: "#zoo-pagination-'.esc_attr($uid).'",
                next:       "#next-page-link-'.esc_attr($uid).'",
                delay:      '.$args['delay'].'
            });
            var iso_init = container.data("isotope");
            if ( typeof $.fn.isotope !== "undefined" ) {
              var iso = container.isotope({
          			percentPosition: true,
          			itemSelector: "'.$args['item_selector'].'",
          			layoutMode: "'.$args['layout_mode'].'",
          		});';
              if ($args['images_loaded']) {
                  if (!wp_script_is('imagesloaded', 'enqueued')) {
                      $inline_scripts .= '
                      iso.imagesLoaded().progress(function(){
                          iso.isotope("layout");
                      });
                      ';
                      wp_enqueue_script('imagesloaded');
                  }
              }
            $inline_scripts .= '}';

            $inline_scripts .= '
            ias.on("load", function(e) {
    			spinner.show();
    		});

	    ias.on("render", function(items) {
	      	$(items).css({
	            opacity: 0
	        });
	    });

	    ias.on("rendered", function(items) {
			    spinner.hide();
          container.isotope("appended", $(items));
          if($("#top-product-page")[0]){
            var active_column_before = $(".layout-control-column .item.active").data("column");
            $(".archive .products.grid .product").each(function(){
              $(this).removeClass("col-md-3 col-md-4 col-md-1-5 col-md-6");
              if(active_column_before == 2){
                  $(this).addClass("col-md-6");
              }
              if(active_column_before == 3){
                  $(this).addClass("col-md-4");
              }
              if(active_column_before == 4){
                  $(this).addClass("col-md-3");
              }
              if(active_column_before == 5){
                  $(this).addClass("col-md-1-5");
              }
            });
            setTimeout(function () {
                $(".products.grid").isotope({layoutMode: "fitRows",});
            }, 200);
          }
	    });

  		ias.on("noneLeft", function(){
  			spinner.empty().append("<span>'. $args['no_more_text'] .'</span>").show();
  		});';

        if ('ajaxload' === $args['type']) {
            $inline_scripts .= '
            ias.extension(new IASTriggerExtension({
                text: "'. $args['more_text'] .'",
                offset: 1
            }));';
        }

        $inline_scripts .= '});';

        if (!wp_script_is('jquery-ias', 'enqueued')) {
            wp_add_inline_script('jquery-ias', $inline_scripts);
            wp_enqueue_script('jquery-ias');
        }
    }
}
