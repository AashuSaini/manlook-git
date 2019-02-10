<?php
/**
 * Assets' helpers
 */

/**
 * Register assets
 *
 * @internal  Used as a callback
 */
function cvca_register_assets()
{
    $js_suffix = SCRIPT_DEBUG ? '.js' : '.min.js';
    $css_suffix = SCRIPT_DEBUG ? '.css' : '.min.css';


    wp_register_style('animations', CVCA_URI . 'assets/vendor/animations.min.css', array(), CVCA_VERSION);
    wp_register_style('cleverfont', CVCA_URI . 'assets/vendor/cleverfont/style.css', array(), CVCA_VERSION);
    wp_register_style('7-stroke', CVCA_URI . 'assets/vendor/pe-icon-7-stroke/css/pe-icon-7-stroke.css', array(), CVCA_VERSION);
    wp_register_style('stroke-gap-icons', CVCA_URI . 'assets/vendor/stroke-gap-icons.css', array(), CVCA_VERSION);
    wp_register_style('slick', CVCA_URI . 'assets/vendor/slick/slick.css', array(), '1.6.0');
    wp_register_style('cvca-style', CVCA_URI . 'assets/css/cvca-style' . $css_suffix, array(), CVCA_VERSION);
    wp_register_script('cvca-libs', CVCA_URI . 'assets/js/libs.js', array('jquery-core'), false, true);
    wp_register_script('cvca-ajax-product', CVCA_URI . 'assets/js/cvca-ajax-product-shortcode' . $js_suffix, array('jquery-core'), CVCA_VERSION, true);
    wp_register_script('cvca-script', CVCA_URI . 'assets/js/cvca-script' . $js_suffix, array('jquery-core'), CVCA_VERSION, true);
}

add_action('init', 'cvca_register_assets', 10, 0);

/**
 * Enqueue icon font for vc
 *
 */
function cvca_enqueue_font_for_vc()
{
    wp_enqueue_style('cleverfont');
    wp_enqueue_style('7-stroke');
}

add_action('vc_backend_editor_enqueue_js_css', 'cvca_enqueue_font_for_vc');
add_action('vc_frontend_editor_enqueue_js_css', 'cvca_enqueue_font_for_vc');

function cvca_enqueue_font_icon_style($font)
{
    if ('cleverfont' == $font) {
        wp_enqueue_style('cleverfont');
    }
    if ('7-stroke' == $font) {
        wp_enqueue_style('7-stroke');
    }

    if ('stroke-gap-icons' == $font) {
        wp_enqueue_style('stroke-gap-icons');
    }
}

add_action('vc_backend_editor_enqueue_jscss', 'cvca_enqueue_font_icon_style', 10, 2);

/**
 * Load admin assets
 *
 * @param  string $hooksuffix
 *
 * @internal  Used as a callback
 */
function cvca_enqueue_admin_assets($hooksuffix)
{
    /* Stylesheet */
    // wp_enqueue_style( 'cleverfont' );
    wp_enqueue_style('multiple-select', CVCA_URI . 'assets/vendor/multiple-select/multiple-select.css', array(), CVCA_VERSION);
    wp_enqueue_style('select2', CVCA_URI . 'assets/vendor/select2/css/select2.min.css', array(), CVCA_VERSION);
    wp_enqueue_style('cvca-admin', CVCA_URI . 'assets/css/cvca-admin.css', array(), CVCA_VERSION);
    /* Script */
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('multiple-select', CVCA_URI . 'assets/vendor/multiple-select/multiple-select.js', array('jquery-core'), CVCA_VERSION, true);
    wp_enqueue_script('select2', CVCA_URI . 'assets/vendor/select2/js/select2.min.js', array('jquery-core'), CVCA_VERSION, true);
}

add_action('admin_enqueue_scripts', 'cvca_enqueue_admin_assets');

/**
 * Load public assets
 *
 * @internal  Used as a callback
 */
function cvca_enqueue_public_assets()
{
    wp_enqueue_style('cleverfont');
}

add_action('wp_enqueue_scripts', 'cvca_enqueue_public_assets', 10, 0);
