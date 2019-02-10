<?php
/**
 * Banner Shortcode
 */

wp_enqueue_style('cvca-style');

$css_class = $zoo_start_link = $zoo_link_text = $zoo_end_link = '';
$title_style = '';
if($atts['title-color']){
    $title_style .= 'color:'.$atts['title-color'].';';
}
if($atts['title-size']){
    $title_style .= 'font-size:'.$atts['title-size'].'px;';
}
if($atts['font-weight']){
    $title_style .= 'font-weight:'.$atts['font-weight'].';';
}

$custom_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $atts['css'], ' ' ), 'CleverBanner', $atts );

if ( !empty( $atts['el_class'] ) ) {
    $css_class .= ' ' . $atts['el_class'];
}

if ( !empty( $atts['content_align'] ) ) {
    $css_class .= ' ' . $atts['content_align'];
}

if ( !empty( $custom_class ) ) {
    $css_class .= ' ' . $custom_class;
}
$css_class .= ' '.$atts['preset'] . ' ' .$atts['style'];

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

if ( !empty( $atts['link'] ) ) {
    $zoo_link = vc_build_link( $atts['link'] );

    if ( $zoo_link['url'] != '' ) {
        $zoo_start_link = '<a';
        $zoo_start_link .= ' class="banner-media-link heading-font"';
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
<div class="cvca-shortcode-banner cvca-banner-image<?php echo esc_attr( $css_class ); ?>">
    <?php
    if ( $atts['image'] != '') { ?>
        <div class="banner-media<?php echo ( empty( $atts['link'] ) ) ? ' banner-media-link' : ''; ?>">
            <?php if ( $atts['image'] != '' ) {
            ?>
                <span class="zoo-addon-overlay"<?php echo ( !empty( $atts['overlay_color'] ) ) ? ' style="background-color:' . $atts['overlay_color'] . '"' : ''; ?>></span>
            <?php
                echo wp_get_attachment_image( $atts['image'], 'full' );
            } ?>
        </div>
    <?php } ?>
    <div class="banner-content">
        <?php if ( $atts['title'] != '' ) : ?>
            <h4 class="banner-title" <?php if($title_style){ echo 'style="'.$title_style.'"';} ?>>
                <?php echo esc_html( $atts['title'] ); ?>
            </h4>
        <?php endif; ?>

        <?php if ( !empty( $content ) ) : ?>
            <div class="banner-description">
                <?php echo ent2ncr($content); ?>
            </div>
        <?php endif; ?>
        <?php if ( $zoo_link_text != '' ) : ?>
            <?php 
                echo wp_kses( $zoo_start_link, $zoo_allow_tag ); 
                echo esc_html( $zoo_link_text );
                echo wp_kses( $zoo_end_link, $zoo_allow_tag );
            ?>
        <?php endif;
        
        ?>
    </div>
</div>
