<?php
/**
 * Video Shortcode
 */
wp_enqueue_style('cvca-style');
$el_class = $css = '';

// Generate map id
$randid = 'cvca-video-' . uniqid();

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverVideo', $atts);


$button_style = '';
if (!empty($atts['btn_color']) || !empty($atts['btn_bg_color'])) {
    $button_style .= ' style="';

    if (!empty($atts['btn_color'])) {
        $button_style .= 'color: ' . $atts['btn_color'] . ';';
    }

    if (!empty($atts['btn_bg_color'])) {
        $button_style .= 'background-color: ' . $atts['btn_bg_color'] . ';';
    }

    $button_style .= '"';
}

$output = '';

$output .= '<div id="' . esc_attr($randid) . '" class="cvca-video ' . esc_attr($atts['el_class']) . ' ' . esc_attr($css_class) . '">';
if ($atts['thumbnail'] != '') {
    $output .= '<img class="cvca-video-thumb" src="' . wp_get_attachment_url($atts['thumbnail']) . '" alt="video popup"/>';
}

if (!empty($atts['overlay_color'])) {
    $output .= '<span class="zoo-addon-overlay"';
    if (!empty($atts['overlay_color'])) {
        $output .= ' style="background-color:' . $atts['overlay_color'] . '"';
    }
    $output .= '></span>';
    $output .= '<div class="zoo-overlay-content">';
}

$output .= '<div class="cvca-wrap-video-content">';

if (!empty($atts['title'])) {
    $output .= '<h3 class="cvca-video-title">' . wp_kses($atts['title'], array('br' => array())) . '</h3>';
}

if (!empty($content)) {
    $output .= '<div class="cvca-video-desc">';
    $output .= $content;
    $output .= '</div>';
}

$output .= '<a href="' . esc_url($atts['source_video']) . '"  class="cvca-video-button"' . $button_style . ' data-height="' . esc_attr($atts['height']) . '" data-width="' . esc_attr($atts['width']) . '">
<svg version="1.1" id="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="100px" width="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                <path class="stroke-solid" fill="none" stroke="#fff" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                          C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                                <path class="stroke-dotted" fill="none" stroke="#fff" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                          C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                                <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
                            </svg>
</a>';
$output .= '</div>';

if (!empty($atts['overlay_color'])) {
    $output .= '</div>';
}

$output .= '</div>';

echo ent2ncr($output); // End view
wp_enqueue_script('cvca-script');