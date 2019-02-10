<?php
/**
 * Follow me Shortcode
 */
$follow_mes = vc_param_group_parse_atts($atts['follow-me']);
$html='';
foreach ($follow_mes as $fl) {
    $html.='<a href="'.(vc_build_link( $fl['socail-link'] )['url']==''?'#':vc_build_link( $fl['socail-link'] )['url']).'" title="'.vc_build_link( $fl['socail-link'] )['title'].'" target="'.vc_build_link( $fl['socail-link'] )['target'].'">';
    $html.='<i class="'.$fl['socail-icon'].'"></i>';
    if( vc_build_link( $fl['socail-link'] )['title']!=''){
        $html.= '<span>'.vc_build_link( $fl['socail-link'] )['title'].'</span>';
    }
    $html .='</a>';
}
$allowhtml=array(
    'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array()
    ),
    'i' => array('class' => array()),
    'span' => array('class' => array()),
);
$id = 'cvca-follow-me-' . uniqid();
$css_class ='cvca-follow-me '.$atts['style'].' ';
if($atts['css_animation']!='none') {
    $css_class .= 'wpb_animate_when_almost_visible ' . $atts['css_animation'] . ' ';
}
$css_class .= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $atts['css'], ' ' ), 'CleverFollowMe', $atts );

?><div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($css_class);?>">
    <?php if($atts['title']!=''){?>
        <h3 class="title-shortcode">
            <?php echo esc_html($atts['title'])?>
        </h3>
    <?php }?>
    <div class="cvca-follow-me-content">
        <?php
            echo wp_kses($html,$allowhtml);
        ?>
    </div>
</div>
