<?php
/**
 * Meta box for theme
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
add_filter('rwmb_meta_boxes', 'zoo_add_meta_box_options');
function zoo_add_meta_box_options()
{
    $prefix = "zoo_";
    $meta_boxes = array();
    //All page
    $meta_boxes[] = array(
        'id' => $prefix.'layout_single_heading',
        'title' => esc_html__('Layout Single Product', 'doma'),
        'pages' => array('product'),
        'context' => 'advanced',
        'fields' => array(
            array(
                'name' => esc_html__('Layout Options', 'doma'),
                'id' => $prefix."single_gallery_layout",
                'type' => 'select',
                'options' => array(
                    'inherit' => 'Inherit',
                    'vertical-gallery' =>esc_html__('Vertical Gallery','doma'),
                    'vertical-gallery-center-thumb' =>esc_html__('Vertical Gallery Center Thumb','doma'),
                    'horizontal-gallery' =>esc_html__('Horizontal Gallery','doma'),
                    'carousel' =>esc_html__('Carousel','doma'),
                    'sticky' =>esc_html__('Sticky','doma'),
                    'sticky-right-content' =>esc_html__('Sticky Right Content','doma'),
                    'sticky-accordion' =>esc_html__('Sticky Accordion','doma'),
                    'images-center' =>esc_html__('Images Center','doma'),
                    'center' =>esc_html__('Center Layout','doma'),
                ),
                'std' => 'inherit',
                'desc' => esc_html__('Choose Options Sidebar.', 'doma')
            ),
        ));
    $meta_boxes[] = array(
        'id' => $prefix.'single_product_video_heading',
        'title' => esc_html__('Product Video', 'doma'),
        'pages' => array('product'),
        'context' => 'side',
        'fields' => array(
            array(
                'id' => $prefix."single_product_video",
                'type' => 'oembed',
                'desc' => esc_html__('Enter your embed video url.', 'doma')
            ),
        ));
    $meta_boxes[] = array(
        'id' => $prefix.'single_post_options',
        'title' => esc_html__('Overlay Color Of Featured Image', 'doma'),
        'pages' => array('post'),
        'context' => 'advanced',
        'fields' => array(
            array(
                'id' => $prefix."single_post_overlay_of_featured",
                'type' => 'color',
                'name' => esc_html__('Choose color overlay of featured image.', 'doma')
            ),
            array(
                'id' => $prefix."single_post_opcity_of_featured",
                'type' => 'slider',
                'name' => esc_html__('Choose opcity of featured image.', 'doma'),
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
        ));
    $meta_boxes[] = array(
        'id' => 'title_meta_box',
        'title' => esc_html__('Layout Options', 'doma'),
        'pages' => array('page'),
        'context' => 'advanced',
        'fields' => array(
            
            array(
                'name' => esc_html__('Logo page', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."logo_stt",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Logo for page', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."logo_page",
                'type' => 'image_advanced',
                'max_file_uploads' => 1
            ),
            array(
                'name' => esc_html__('Main header padding top', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."main_header_padding_top",
                'type' => 'number'
            ), array(
                'name' => esc_html__('Main header padding bottom', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."main_header_padding_bottom",
                'type' => 'number'
            ),
            array(
                'name' => esc_html__('Hide site Tag line.', 'doma'),
                'id' => $prefix."hide_tag_line",
                'type' => 'checkbox',
            ),
            array(
                'name' => esc_html__('Font Title & Breadcrumbs Options', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."heading_title",
                'type' => 'heading'
            ),

            array(
                'name' => esc_html__('Body Font', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."typo_body_font",
                'type' => 'font'
            ),
            array(
                'name' => esc_html__('Heading Font', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."typo_heading_font",
                'type' => 'font'
            ),
            array(
                'name' => esc_html__('Disable Title', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."disable_title",
                'std' => '0',
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Disable Breadcrumbs', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."disable_breadcrumbs",
                'std' => '0',
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Page Layout', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."body_heading",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Padding Top Content Page', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."margin_top_content",
                'type' => 'number',
                'std'  => 40,
                'min'  => 0,
                'step' => 1,
            ),
            array(
                'name' => esc_html__('Padding Bottom Content Page', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."margin_bottom_content",
                'type' => 'number',
                'std'  => 40,
                'min'  => 0,
                'step' => 1,
            ),
            array(
                'name' => esc_html__('Page Layout', 'doma'),
                'id' => $prefix."page_layout",
                'type' => 'select',
                'options' => array(
                    'inherit' =>esc_html__('Inherit','doma'),
                    'boxes' =>esc_html__('Boxes','doma'),
                    'full-width' =>esc_html__('Full with','doma'),
                ),
                'std' => 'inherit',
                'desc' => esc_html__('Choose page Layout.', 'doma')
            ),
            array(
                'name' => esc_html__('Page Max Width', 'doma'),
                'desc' => esc_html__('Accept only number. If not set, it will follow customize config.', 'doma'),
                'id' => $prefix."site_width",
                'type' => 'number'
            ),
            array(
                'name' => esc_html__('Main Page BG', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."main_page_bg",
                'type' => 'color'
            ),
            array(
                'name' => esc_html__('Header Options', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."heading_header",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Choose top header.', 'doma'),
                'id' => $prefix."top_header",
                'type' => 'select',
                'options' => array(
                    'inherit' =>esc_html__('Inherit','doma'),
                    '0' =>esc_html__('None','doma'),
                    '1' =>esc_html__('Style 1','doma'),
                ),
                'std' => 'inherit',
            ),
            array(
                'name' => esc_html__('Disable top slogun.', 'doma'),
                'id' => $prefix."enable_top_header_slogun",
                'type' => 'checkbox',
                
            ),
            array(
                'name' => esc_html__('Enable header sticky.', 'doma'),
                'id' => $prefix."header_sticky",
                'type' => 'checkbox',
            ),
            array(
                'name' => esc_html__('Header Layout', 'doma'),
                'id' => $prefix."header_layout",
                'type' => 'image_select',
                'options' => array(
                    'inherit' => esc_url(get_template_directory_uri() . '/assets/images/inherit.png'),
                    'style-1' => esc_url(get_template_directory_uri() . '/assets/images/style-1.png'),
                    'style-2' => esc_url(get_template_directory_uri() . '/assets/images/style-2.png'),
                    'style-3' => esc_url(get_template_directory_uri() . '/assets/images/style-3.png'),
                    'style-4' => esc_url(get_template_directory_uri() . '/assets/images/style-4.png'),
                    'style-5' => esc_url(get_template_directory_uri() . '/assets/images/style-5.png'),
                    'style-6' => esc_url(get_template_directory_uri() . '/assets/images/style-6.png'),
                    'style-7' => esc_url(get_template_directory_uri() . '/assets/images/style-7.png'),
                    'style-8' => esc_url(get_template_directory_uri() . '/assets/images/style-8.png'),
                    'style-vendor' => esc_url(get_template_directory_uri() . '/assets/images/style-vendor.jpg'),
                    'style-landing' => esc_url(get_template_directory_uri() . '/assets/images/footer-landing.png'),
                ),
                'std' => 'inherit',
            ),
            array(
                'name' => esc_html__('Enable Header Transparency', 'doma'),
                'id' => $prefix."enable_header_transparent",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('If check, header will be use transparent style.', 'doma')
            ),
            array(
                'name' => esc_html__('Color Text On Header Transparency', 'doma'),
                'id' => $prefix."color_text_header_transparent",
                'type' => 'color',
                'desc' => esc_html__('', 'doma')
            ),
            array(
                'name' => esc_html__('100% Header Width', 'doma'),
                'id' => $prefix."enable_header_fullwidth",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('Check this box to set the header to 100% of the browser width. Uncheck to follow the site width.', 'doma')
            ),
            array(
                'name' => esc_html__('Enable Header Canvas Sidebar', 'doma'),
                'id' => $prefix."header_canvas_sidebar",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('Check this box to set the header canvas sidebar will show', 'doma')
            ),
            
            array(
                'name' => esc_html__('Footer Options', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."heading_footer",
                'type' => 'heading',
                'class'=>'clear',
            ),
            array(
                'name' => esc_html__('Enable top footer', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."top_footer",
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Disable main footer', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."disable_main_footer",
                'type' => 'checkbox',
            ),
            array(
                'name' => esc_html__('Footer Layout', 'doma'),
                'id' => $prefix."footer_layout",
                'type' => 'image_select',
                'options' => array(
                    'inherit' =>esc_url(get_template_directory_uri() . '/assets/images/inherit.png'),
                    'style-1' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-1.png'),
                    'style-2' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-2.png'),
                    'style-3' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-3.png'),
                    'style-4' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-4.png'),
                    'style-5' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-5.png'),
                    'style-6' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-6.png'),
                    'style-7' => esc_url(get_template_directory_uri() . '/assets/images/footer-style-7.png'),
                    'style-landing' => esc_url(get_template_directory_uri() . '/assets/images/footer-landing.png'),
                ),
                'std' => 'inherit',
            ),
            array(
                'name' => esc_html__('100% Footer Width', 'doma'),
                'desc' => esc_html__('Check this box to set the footer to 100% of the browser width. Uncheck to follow the site width.', 'doma'),
                'id' => $prefix."enable_footer_fullwidth",
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('100% Separator Width', 'doma'),
                'desc' => esc_html__('Check this box to set the separator to 100% of the browser width. Uncheck to follow the site width.', 'doma'),
                'id' => $prefix."enable_separator_fullwidth",
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Enable Sticky Footer', 'doma'),
                'desc' => esc_html__('Check this box to set footer sticky. Uncheck to follow the site footer.', 'doma'),
                'id' => $prefix."enable_footer_sticky",
                'type' => 'checkbox'
            ),
        )
    );
    $meta_boxes[] = array(
        'id' => 'zoo_heading_color',
        'title' => esc_html__('Color Options', 'doma'),
        'pages' => array('page'),
        'context' => 'advanced',
        'fields' => array(
            array(
                'name' => esc_html__('Page Color & Background', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."heading_page_color",
                'type' => 'heading',
            ),
            array(
                'name' => esc_html__('Page Accent Color', 'doma'),
                'id' => $prefix."accent_color",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Page background', 'doma'),
                'desc' => esc_html__('Background Image for page', 'doma'),
                'id' => $prefix."page_bg",
                'type' => 'image_advanced',
                'max_file_uploads' => 1
            ),
            array(
                'name' => esc_html__('Page Background Color', 'doma'),
                'id' => $prefix."page_bg_color",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Header Color & Background', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."heading_header_color",
                'type' => 'heading',
            ),
            array(
                'name' => esc_html__('Active Custom color & background header', 'doma'),
                'id' => $prefix."enable_header_color",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('If check, all value custom color & background will be accept', 'doma')
            ),
            array(
                'name' => esc_html__('Top Header Background', 'doma'),
                'desc' => esc_html__('Background of top header', 'doma'),
                'id' => $prefix."top_header_bg",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Top Header Background Opacity', 'doma'),
                'desc' => esc_html__('Controls the opacity for the top header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'doma'),
                'id' => $prefix."top_header_bg_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Top Header Color', 'doma'),
                'desc' => esc_html__('Color of text in top header include link', 'doma'),
                'id' => $prefix."top_header_color",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Top Header Color Hover', 'doma'),
                'desc' => esc_html__('Color of link when hover', 'doma'),
                'id' => $prefix."top_header_color_hover",
                'type' => 'color',
            ),            array(
                'name' => esc_html__('Header Color', 'doma'),
                'desc' => esc_html__('Color of text in header', 'doma'),
                'id' => $prefix."header_color",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Header Color Hover', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."header_color_hover",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Header Background', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."custom_bg_header",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Header Background Opacity', 'doma'),
                'desc' => esc_html__('Controls the opacity for the header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'doma'),
                'id' => $prefix."custom_bg_header_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Header Menu Background', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."custom_bg_header_menu",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Header Menu Background Opacity', 'doma'),
                'desc' => esc_html__('Controls the opacity for the header menu. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'doma'),
                'id' => $prefix."custom_bg_header_menu_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Header Menu Color', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."custom_color_header_menu",
                'type' => 'color',
            ),array(
                'name' => esc_html__('Header Menu Color Hover', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."custom_color_header_menu_hover",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Header sticky Background', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."bg_sticky_header",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Header sticky Color', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."color_sticky_header",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Header sticky Color Hover', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."color_hv_sticky_header",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Header Sticky Background Opacity', 'doma'),
                'desc' => esc_html__('Controls the opacity for the header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'doma'),
                'id' => $prefix."bg_sticky_header_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Header Border Color', 'doma'),
                'id' => $prefix."header_border_color",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Header Border Color', 'doma'),
                'desc' => esc_html__('Controls the opacity for the header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'doma'),
                'id' => $prefix."header_border_color_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Footer Color', 'doma'),
                'desc' => esc_html__('', 'doma'),
                'id' => $prefix."heading_footer_color",
                'type' => 'heading',
                'class'=>'clear',
            ),
            array(
                'name' => esc_html__('Active Custom color & background footer', 'doma'),
                'id' => $prefix."enable_footer_color",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('If check, all value custom color & background will be accept', 'doma')
            ),
            array(
                'name' => esc_html__('Footer Background', 'doma'),
                'id' => $prefix."footer_bg_color",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Footer Background Opacity', 'doma'),
                'desc' => esc_html__('Controls the opacity for the footer. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'doma'),
                'id' => $prefix."footer_bg_color_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Footer Title Color', 'doma'),
                'id' => $prefix."footer_title_color",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Footer Color', 'doma'),
                'id' => $prefix."footer_color",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Footer Link Color', 'doma'),
                'id' => $prefix."footer_link_color",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Footer Link Color Hover', 'doma'),
                'id' => $prefix."footer_link_color_hover",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Footer Bottom Border Color', 'doma'),
                'id' => $prefix."footer_bt_border_color",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Footer Bottom Border Opacity', 'doma'),
                'desc' => esc_html__('Controls the opacity for the footer. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'doma'),
                'id' => $prefix."footer_bt_border_color_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Footer Bottom Background', 'doma'),
                'id' => $prefix."bt_footer_bg",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Footer Bottom Color', 'doma'),
                'id' => $prefix."bt_footer_color",
                'type' => 'color',
            ),
            array(
                'name' => esc_html__('Footer Bottom Link Color', 'doma'),
                'id' => $prefix."bt_footer_link_color",
                'type' => 'color',
                'std' => '',
            ),
            array(
                'name' => esc_html__('Footer Bottom Link Color Hover', 'doma'),
                'id' => $prefix."bt_footer_link_color_hover",
                'type' => 'color',
                'std' => '',
            ),
        ));
    return $meta_boxes;
}

include_once ABSPATH . 'wp-admin/includes/plugin.php';
if (is_plugin_active('meta-box/meta-box.php')) {
    if(class_exists('RWMB_Field')){
        get_template_part('inc/metaboxes/field/sidebars');
        get_template_part('inc/metaboxes/field/font');

    }
}