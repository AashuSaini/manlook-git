<?php
/**
 * Sub menu Shortcode
 */

$css_class = $zoo_start_link = $zoo_link_text = $zoo_end_link = '';

$custom_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'subMenu', $atts);

if (!empty($atts['el_class'])) {
    $css_class .= ' ' . $atts['el_class'];
}
if (!empty($custom_class)) {
    $css_class .= ' ' . $custom_class;
}

$menu_items = vc_param_group_parse_atts($atts['menu_items']);
?>
<div class="cvca-shortcode-submenu <?php echo esc_attr($css_class); ?>">
    <?php if($atts['title']): ?><h4 class="title"><?php echo esc_attr($atts['title']) ?></h4><?php endif; ?>
    <ul class="sub-menu">
    <?php
    if (count($menu_items) > 0) {
        foreach ($menu_items as $item) {
            if (!empty($item['link'])) {
                $zoo_link = vc_build_link($item['link']);
                if ($zoo_link['url'] != '') {
                    $zoo_start_link = '<li><a';
                    $zoo_start_link .= ' href="' . $zoo_link['url'] . '"';

                    if ($zoo_link['title'] != '') {
                        $zoo_start_link .= ' title="' . $zoo_link['title'] . '"';
                    }

                    if ($zoo_link['target'] != '') {
                        $zoo_start_link .= ' target="' . $zoo_link['target'] . '"';
                    }

                    if ($zoo_link['rel'] != '') {
                        $zoo_start_link .= ' rel="' . $zoo_link['rel'] . '"';
                    }

                    $zoo_start_link .= '>';
                }

                $zoo_link_text = ($zoo_link['title'] != '') ? $zoo_link['title'] : '';

                if ($zoo_link['url'] != '') {
                    $zoo_end_link = '</a></li>';
                }
                echo ent2ncr($zoo_start_link);
                echo ent2ncr($zoo_link_text);
                echo ent2ncr($zoo_end_link);
            }
            
        }
    }
    ?>
    </ul>
</div>
