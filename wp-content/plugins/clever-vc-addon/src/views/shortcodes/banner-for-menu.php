<?php
/**
 * Banner for menu Shortcode
 */
$css_class = $position = $align = $zoo_start_link = $zoo_link_text = $zoo_end_link = '';
$custom_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $atts['css'], ' ' ), 'bannerMenu', $atts );
if ( !empty( $atts['el_class'] ) ) {
    $custom_class .= ' ' . $atts['el_class'];
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
if($atts['top']){
    $position .= 'top:' . $atts['top'] .'; ';
}
if($atts['right']){
    $position .= 'right:' . $atts['right'] .'; ';
}
if($atts['bottom']){
    $position .= 'bottom:' . $atts['bottom'] .'; ';
}
if($atts['left']){
    $position .= 'left:' . $atts['left'] .'; ';
}
if($position){
    $position = 'style=" position: absolute; z-index: 1; '.$position.'"';
}
if($atts['align']){
    $align .= 'text-align:' . $atts['align'] .'; ';
}

if ( !empty( $atts['link'] ) ) {
    $zoo_link = vc_build_link( $atts['link'] );

    if ( $zoo_link['url'] != '' ) {
        $zoo_start_link = '<a';
        $zoo_start_link .= ' class="banner-menu-link"';
        $zoo_start_link .= ' href="' . $zoo_link['url'] . '"';

        if ( $zoo_link['title'] != '' ) {
            $zoo_start_link .= ' title="' . $zoo_link['title'] . '"';
        }
        
        if ( $zoo_link['target'] != '' ) {
            $zoo_start_link .= ' target="' . $zoo_link['target'] . '"';
        }

        if ( $zoo_link['rel'] != '' ) {
            $zoo_start_link .= ' rel="' . $zoo_link['rel'] . '"';
        }

        $zoo_start_link .= '>';
    }

    $zoo_link_text = ( $zoo_link['title'] != '' ) ? $zoo_link['title'] : '';

    if ( $zoo_link['url'] != '' ) {
        $zoo_end_link = '</a>';
    }
}

?>
<div class="cvca-shortcode-banner-for-menu <?php echo esc_attr( $custom_class ); ?>">
    <?php
    if ( $atts['image'] != '') { ?>
        <div class="wrap-banner-menu" style="position: relative;<?php echo esc_attr($align); ?>">
            <div class="banner-menu-inner" <?php echo ent2ncr($position); ?>>
                <?php if ( $atts['image'] != '' ) {
                    echo ent2ncr($zoo_start_link);
                    echo wp_get_attachment_image( $atts['image'], 'full' );
                    echo ent2ncr($zoo_end_link);
                } ?>
            </div>
        </div>
    <?php } ?>
</div>
