<?php
/**
 * Banner Shortcode
 */

wp_enqueue_style('cvca-style');

$css_class = $zoo_start_link = $zoo_link_text = $zoo_end_link = '';

$custom_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' '), 'CleverBanner', $atts);
$css_class .= ' ' . $atts['preset'];
if (!empty($atts['el_class'])) {
    $css_class .= ' ' . $atts['el_class'];
}
if (!empty($atts['box_shadow'])) {
    $css_class .= ' shadow';
}

if (!empty($atts['content_align']) && $atts['preset'] == 'overlap') {
    $css_class .= ' ' . $atts['content_align'];
}
if($atts['preset'] == 'overlap' && !empty($atts['style'])) {
    $css_class .= ' ' . $atts['style'];
}
if (!empty($custom_class)) {
    $css_class .= ' ' . $custom_class;
}

$overlay_style = $overlay_color =  '';
if($atts['overlay_color']){
    $overlay_color = 'background-color:'.$atts['overlay_color'].';';
}

if($overlay_color ){
    $overlay_style = 'style="' . $overlay_color . '"';
}


$zoo_allow_tag = array(
    'a' => array(
        'class' => array(),
        'href' => array(),
        'target' => array(),
        'rel' => array(),
        'title' => array()
    ),
    'br' => array()
);
$zoo_content_tag =array(
    'a' => array(
        'class' => array(),
        'href' => array(),
        'target' => array(),
        'rel' => array(),
        'title' => array()
    ),
    'div' => array(
        'style' =>  array()
    ),
    'span' => array(
        'style' =>  array()

    ),
    'strong' => array(),
    'h4' => array(),
);
$title_style = $font_size_title = $font_weight_title = $color_title =  '';
if($atts['font_size_title']){
    $font_size_title = 'font-size:'.$atts['font_size_title'].'px;';
}
if($atts['font_weight_title']){
    $font_weight_title = 'font-weight:'.$atts['font_weight_title'].';';
}
if($atts['color_title']){
    $color_title = 'color:'.$atts['color_title'].';';
}
if($font_size_title || $font_weight_title || $color_title){
    $title_style = 'style="'.$font_size_title . $font_weight_title . $color_title . '"';
}

$title_bf_style = $font_size_bf_title = $font_weight_bf_title = $color_bf_title =  '';
if($atts['font_size_bf_title']){
    $font_size_bf_title = 'font-size:'.$atts['font_size_bf_title'].'px;';
}
if($atts['font_weight_bf_title']){
    $font_weight_bf_title = 'font-weight:'.$atts['font_weight_bf_title'].';';
}
if($atts['color_bf_title']){
    $color_bf_title = 'color:'.$atts['color_bf_title'].';';
}
if($font_size_bf_title || $font_weight_bf_title || $color_bf_title){
    $title_bf_style = 'style="'.$font_size_bf_title . $font_weight_bf_title . $color_bf_title . '"';
}

$link_style = $font_size_link = $font_weight_link = $color_link =  '';
if($atts['font_size_link']){
    $font_size_link = 'font-size:'.$atts['font_size_link'].'px;';
}
if($atts['font_weight_link']){
    $font_weight_link = 'font-weight:'.$atts['font_weight_link'].';';
}
if($atts['color_link']){
    $color_link = 'color:'.$atts['color_link'].';';
}
if($font_size_link || $font_weight_link || $color_link){
    $link_style = 'style="'.$font_size_link . $font_weight_link . $color_link . '"';
}

if (!empty($atts['link'])) {
    $zoo_link = vc_build_link($atts['link']);

    if ($zoo_link['url'] != '') {
        $zoo_start_link = '<a ';
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
        $zoo_end_link = '</a>';
    }
}

?>
<div class="cvca-shortcode-banner cvca-banner-image<?php echo esc_attr($css_class); ?>">
    <?php

    if ($atts['image'] != '') { ?>
        <div class="banner-media<?php echo (empty($atts['link'])) ? ' banner-media-link' : ''; ?>">

            <?php
            echo wp_kses($zoo_start_link, $zoo_allow_tag);
            if ($atts['image'] != '') { ?>
                <span class="zoo-addon-overlay" <?php echo ent2ncr($overlay_style); ?>></span>
                <?php
                
                if($atts['lazy_load']){
                    echo wp_get_attachment_image($atts['image'], 'full');
                }
                else{
                    $zoo_item = wp_get_attachment_image_src($atts['image'], 'full');
                    $zoo_img_url = $zoo_item[0];
                    $zoo_width = $zoo_item[1];
                    $zoo_height = $zoo_item[2];
                    $resolution = $zoo_width / $zoo_height;
                    $zoo_img_title = get_the_title($atts['image']);
                    $zoo_img_srcset = wp_get_attachment_image_srcset($atts['image']);?>

                    <img src="<?php echo get_template_directory_uri() . '/assets/images/placeholder.jpg'; ?>"
                         height="<?php echo esc_attr($zoo_height) ?>" 
                         width="<?php echo esc_attr($zoo_width) ?>"
                         class="wp-post-image" 
                         alt="<?php echo esc_attr($zoo_img_title); ?>"
                         sizes="<?php echo wp_get_attachment_image_sizes($atts['image'], 'full') ?>"
                         srcset="<?php echo esc_attr($zoo_img_srcset) ?>"/>
                    <?php
                }
            }
            echo wp_kses($zoo_end_link, $zoo_allow_tag);
            if($atts['style']=='style-3'){
                ?>
                <?php if ($zoo_link_text != '') : ?>
                    <div class="banner-readmore">
                        <?php echo wp_kses($zoo_start_link, $zoo_allow_tag); ?>
                        <span class="banner-media-link" <?php echo ent2ncr($link_style); ?>>
                <?php
                echo esc_html($zoo_link_text);
                ?></span>
                        <?php echo wp_kses($zoo_end_link, $zoo_allow_tag); ?>
                    </div>
                <?php endif;

                ?>
            <?php
            }
            ?>

        </div>
    <?php } ?>
    <?php if ($atts['title'] != '' || !empty($content)) : ?>
    <div class="banner-content">
        <div class="banner-content-inner">
            <?php if($atts['bf_title'] != '') : ?>
                <span class="bf-title" <?php echo ent2ncr($title_bf_style); ?>><?php echo esc_html($atts['bf_title']) ?></span><br>
            <?php endif; ?>
            <?php if ($atts['title'] != '') : ?>
                <h4 class="banner-title" <?php echo ent2ncr($title_style); ?>>
                    <?php
                    echo wp_kses($zoo_start_link, $zoo_allow_tag);
                        echo esc_html($atts['title']);
                    echo wp_kses($zoo_end_link, $zoo_allow_tag);
                    ?>
                </h4><br>
            <?php endif; ?>

            <?php if (!empty($content)) : ?>
                <div class="banner-description">
                    <?php echo wp_kses($content, $zoo_content_tag); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($zoo_link_text != '' && $atts['style']!='style-3') : ?>
            <div class="banner-readmore">
                <?php echo wp_kses($zoo_start_link, $zoo_allow_tag); ?>
                <span class="banner-media-link" <?php echo ent2ncr($link_style); ?>>
                <?php
                echo esc_html($zoo_link_text);
                ?></span>
                <?php echo wp_kses($zoo_end_link, $zoo_allow_tag); ?>
            </div>
        <?php endif;

        ?>
    </div>
    <?php endif; ?>
</div>