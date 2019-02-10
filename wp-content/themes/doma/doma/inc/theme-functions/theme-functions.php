<?php
/**
 * Theme functions
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
/**
 * Register features
 */
if (!function_exists('is_plugin_active')) {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if (!function_exists('zoo_theme_setup')) :
    function zoo_theme_setup()
    {
        load_theme_textdomain('doma', get_template_directory() . '/languages');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        add_theme_support('automatic-feed-links');

        add_theme_support('post-formats', array('aside', 'gallery', 'image', 'quote', 'video', 'audio'));

        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
        add_theme_support('custom-logo', array(
            'height' => 100,
            'width' => 400,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array('site-title', 'site-description'),
        ));
        add_theme_support("custom-header");
        add_theme_support("custom-background");
        add_theme_support( 'html5', array( 'script', 'style' ) );
        add_editor_style();
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'doma'),
            'mobile' => esc_html__('Mobile Menu', 'doma'),
            'vertical' => esc_html__('Vertical Menu', 'doma'),
            'categories' => esc_html__('Categories Menu', 'doma'),
            'landing' => esc_html__('Landing Menu', 'doma'),
            'left-menu' => esc_html__('Left Menu', 'doma'),
            'right-menu' => esc_html__('Right Menu', 'doma'),

        ));
        if (!isset($GLOBALS['content_width'])) $GLOBALS['content_width'] = 640;
        add_theme_support('advanced-image-compression');
        if (class_exists('WooCommerce', false)) {
            add_theme_support( 'woocommerce', array(
            'gallery_thumbnail_image_width' => 150,
            ) );

        }
        if (is_plugin_active('clever-vc-addon/clever-vc-addon.php') && class_exists('Vc_Manager')) {
            add_theme_support('testimonial-post-type');
        }

    }
endif;
add_action('after_setup_theme', 'zoo_theme_setup');
/**/
if (!function_exists('cc_mime_types')) :
    function cc_mime_types($mimes) {
      $mimes['svg'] = 'image/svg+xml';
      return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');
endif;
if (!function_exists('wpse240579_fix_svg_size_attributes')) :
    function wpse240579_fix_svg_size_attributes( $out, $id ) {
        $image_url  = wp_get_attachment_url( $id );
        $file_ext   = pathinfo( $image_url, PATHINFO_EXTENSION );

        if ( is_admin() || 'svg' !== $file_ext ) {
            return false;
        }

        return array( $image_url, null, null, false );
    }
    add_filter( 'image_downsize', 'wpse240579_fix_svg_size_attributes', 10, 2 ); 
endif;
/**
 * Register Sidebar
 * */
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'doma'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'doma'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar 2', 'doma'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add widgets here to appear in your sidebar 2.', 'doma'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Topbar 1 - Left', 'doma'),
        'id' => 'top-left-header',
        'description' => esc_html__('Add widgets here to appear in your top header left.', 'doma'),
        'before_widget' => '<div id="%1$s" class="top-head-widget header-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Topbar 1 - Right', 'doma'),
        'id' => 'top-right-header',
        'description' => esc_html__('Add widgets here to appear in your top header right.', 'doma'),
        'before_widget' => '<div id="%1$s" class="top-head-widget header-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Topbar 2', 'doma'),
        'id' => 'topbar-2',
        'description' => esc_html__('Add widgets here to appear in your top header 2.', 'doma'),
        'before_widget' => '<div id="%1$s" class="top-head-widget header-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Header service', 'doma'),
        'id' => 'header-service',
        'description' => esc_html__('Add widgets here to appear in your header service.', 'doma'),
        'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Header service vendor', 'doma'),
        'id' => 'header-service-vendor',
        'description' => esc_html__('Add widgets here to appear in your header service for vendor.', 'doma'),
        'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Top Footer', 'doma'),
        'id' => 'top-footer',
        'description' => esc_html__('Add widgets here to appear in your top footer.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 1 Style 1', 'doma'),
        'id' => 'main-footer-1',
        'description' => esc_html__('Add widgets here to appear in your main footer 1. Use for footer style 1.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 1 Style 2', 'doma'),
        'id' => 'main-footer-1-style-2',
        'description' => esc_html__('Add widgets here to appear in your main footer 1. Use for footer style 2.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 1 Style 3', 'doma'),
        'id' => 'main-footer-1-style-3',
        'description' => esc_html__('Add widgets here to appear in your main footer 1. Use for footer style 3.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 1 Style 4', 'doma'),
        'id' => 'main-footer-1-style-4',
        'description' => esc_html__('Add widgets here to appear in your main footer 1. Use for footer style 4.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 1 Style 5', 'doma'),
        'id' => 'main-footer-1-style-5',
        'description' => esc_html__('Add widgets here to appear in your main footer 1. Use for footer style 5.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 1 Style 6', 'doma'),
        'id' => 'main-footer-1-style-6',
        'description' => esc_html__('Add widgets here to appear in your main footer 1. Use for footer style 6.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 1 Style 7', 'doma'),
        'id' => 'main-footer-1-style-7',
        'description' => esc_html__('Add widgets here to appear in your main footer 1. Use for footer style 7.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 2', 'doma'),
        'id' => 'main-footer-2',
        'description' => esc_html__('Add widgets here to appear in your Main footer 2. Use for footer default.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 2 Style 4', 'doma'),
        'id' => 'main-footer-2-style-4',
        'description' => esc_html__('Add widgets here to appear in your Main footer 2 Style 4. Use for footer default.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 2 Style 5', 'doma'),
        'id' => 'main-footer-2-style-5',
        'description' => esc_html__('Add widgets here to appear in your Main footer 2 Style 5. Use for footer default.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 2 Style 7', 'doma'),
        'id' => 'main-footer-2-style-7',
        'description' => esc_html__('Add widgets here to appear in your Main footer 2 Style 7. Use for footer default.', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 3', 'doma'),
        'id' => 'main-footer-3',
        'description' => esc_html__('Add widgets here to appear in your Main footer 3. Use for footer default', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 3 Style 4', 'doma'),
        'id' => 'main-footer-3-style-4',
        'description' => esc_html__('Add widgets here to appear in your Main footer 3 Style 4. Use for footer default', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 3 Style 7', 'doma'),
        'id' => 'main-footer-3-style-7',
        'description' => esc_html__('Add widgets here to appear in your Main footer 3 Style 7. Use for footer default', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 4 Style 1', 'doma'),
        'id' => 'main-footer-4',
        'description' => esc_html__('Add widgets here to appear in your Main footer 4. Use for footer style 1', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 4 Style 2', 'doma'),
        'id' => 'main-footer-4-style-2',
        'description' => esc_html__('Add widgets here to appear in your Main footer 4. Use for footer style 2', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 4 Style 3', 'doma'),
        'id' => 'main-footer-4-style-3',
        'description' => esc_html__('Add widgets here to appear in your Main footer 4. Use for footer style 3', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 4 Style 4', 'doma'),
        'id' => 'main-footer-4-style-4',
        'description' => esc_html__('Add widgets here to appear in your Main footer 4. Use for footer style 4', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Main Footer 4 Style 7', 'doma'),
        'id' => 'main-footer-4-style-7',
        'description' => esc_html__('Add widgets here to appear in your Main footer 4. Use for footer style 7', 'doma'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Canvas Header', 'doma'),
        'id' => 'canvas-sidebar',
        'description' => esc_html__('Add widgets here to appear in canvas sidebar.', 'doma'),
        'before_widget' => '<div id="%1$s" class="canvas-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="cv-widget-title">',
        'after_title' => '</h4>',
    ));

    if (class_exists('WooCommerce', false)) {
        register_sidebar(array(
            'name' => esc_html__('Shop Sidebar', 'doma'),
            'id' => 'shop',
            'description' => esc_html__('Add widgets here to appear in your sidebar use for Default Sidebar & Widget Ajax.', 'doma'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
        register_sidebar(array(
            'name' => esc_html__('Shop Sidebar CLN', 'doma'),
            'id' => 'shop_cln',
            'description' => esc_html__('Add widgets here to appear in your sidebar use for CLN.', 'doma'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
        register_sidebar(array(
            'name' => esc_html__('Vendor Sidebar', 'doma'),
            'id' => 'vendor',
            'description' => esc_html__('Add widgets here to appear in your sidebar use for Vendor Sidebar.', 'doma'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
    } else {
        unregister_sidebar('shop');
    }
}
/**
 * Enqueue scripts and styles for front end.
 *
 * @since 1.0
 */
function zoo_theme_styles(){
    /**
     * Enqueue styles.
     *
     * @since 1.0
     */
    // Bootstrap
    wp_enqueue_style('bootstrap', ZOO_THEME_URI . 'assets/vendor/bootstrap/bootstrap.min.css');
    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', ZOO_THEME_URI . 'assets/vendor/bootstrap/bootstrap-rtl.min.css');
    }
    // FontAwesome
    if (get_theme_mod('zoo_enable_font_awesome', 'off') == 'on') {
        wp_enqueue_style('fontawesome', ZOO_THEME_URI . 'assets/vendor/font-awesome/css/font-awesome.min.css');
    }
    // Cleversoft font
    wp_enqueue_style('theme-cleverfont', ZOO_THEME_URI . 'assets/vendor/cleverfont/style.css');
    wp_register_style('slick', ZOO_THEME_URI . 'assets/vendor/slick/slick.css');
    wp_enqueue_style('zoo-layout', ZOO_THEME_URI . 'assets/css/zoo-theme-layout.css');
    wp_deregister_style('cleverfont');
    if (class_exists('WooCommerce', false)) {
        wp_register_style('zoomove', ZOO_THEME_URI . 'assets/vendor/zoomove/zoomove.min.css');
        wp_deregister_style('woocommerce-layout');
        wp_deregister_style('woocommerce-smallscreen');
        //Remove style don't use.
        wp_deregister_style('woocommerce_prettyPhoto_css');
        wp_deregister_style('yith-wcwl-font-awesome');
        wp_deregister_style('jquery-selectBox');
    }
    // Load style for child theme
    if (is_child_theme()) {
        wp_enqueue_style('zoo-theme-parent-style', ZOO_THEME_URI . 'style.css', array(), false, 'all');
    }
    // Main style
    wp_enqueue_style('doma', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'zoo_theme_styles',999);
/*Load theme Script*/
function zoo_theme_scripts()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_register_script('jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), false, true);
    wp_register_script('slick', ZOO_THEME_URI . 'assets/vendor/slick/slick.min.js', array('jquery-core'), false, true);
    wp_register_script('sticky', ZOO_THEME_URI . 'assets/vendor/sticky/jquery.sticky.js', array('jquery-core'), false, true);
    wp_register_script('isotope', ZOO_THEME_URI . 'assets/vendor/isotope/isotope.pkgd.min.js', array('jquery-core'), false, true);
    wp_register_script('imagesloaded', ZOO_THEME_URI . 'assets/vendor/imagesloaded/imagesloaded.pkgd.min.js', array('jquery-core'), false, true);
    wp_register_script('lazyload-master', ZOO_THEME_URI . 'assets/vendor/lazyload-master/jquery.lazyload.min.js', array('jquery-core'), false, true);
    wp_register_script('parallax', ZOO_THEME_URI . 'assets/vendor/parallax1.5/jquery.parallax.min.js', array('jquery-core'), false, true);
    wp_register_script('parally', ZOO_THEME_URI . 'assets/vendor/parally/parally.min.js', array('jquery-core'), false, true);
    wp_register_script('jquery-ias', ZOO_THEME_URI . 'assets/vendor/infinitescroll/jquery-ias.min.js', array('jquery-core'), false, true);
    wp_register_script('infinite-scroll', ZOO_THEME_URI . 'assets/vendor/infinitescroll/infinite-scroll.min.js', array('jquery-core'), false, true);

    if (class_exists('WooCommerce', false)) {
        wp_register_script('tippy', ZOO_THEME_URI . 'assets/vendor/tippy/tippy.all.min.js');
        wp_register_script('sticky-kit', ZOO_THEME_URI . 'assets/vendor/sticky-kit/jquery.sticky-kit.min.js');
        wp_register_script('zoomove', ZOO_THEME_URI . 'assets/vendor/zoomove/zoomove.min.js', array('jquery-core'), false, true);
        wp_enqueue_script('zoo-ajax-cart', ZOO_THEME_URI . 'assets/js/ajax-cart.min.js', array('jquery-core'), false, true);
        wp_register_script('zoo-product-embed', ZOO_THEME_URI . 'assets/js/product-embed.js', array('jquery-core'), false, true);
        wp_enqueue_script('zoo-woocommerce', ZOO_THEME_URI . 'assets/js/woocommerce.min.js', array('jquery-core'), false, true);
        wp_register_script('zoo-woocommerce-ajax-filter', ZOO_THEME_URI . 'assets/js/woocommerce-ajax-filter.min.js', array('jquery-core'), false, true);
        
        if (zoo_woo_enable_quickview()) {
            wp_enqueue_style('slick');
            wp_enqueue_script('slick');
            wp_enqueue_script('wc-add-to-cart-variation');
            if (zoo_woo_enable_zoom()) {
                wp_enqueue_style('zoomove');
                wp_enqueue_script('zoomove');
            }
        }
    }
    wp_register_script('doma', ZOO_THEME_URI . 'assets/js/theme.min.js', array('jquery-core'), false, true);
    
    wp_enqueue_script('doma');
    
    
}

add_action('wp_enqueue_scripts', 'zoo_theme_scripts');

/*Admin css*/
if (!function_exists('zoo_admin_style')) {
    function zoo_admin_style() {
        wp_enqueue_style( 'custom_wp_admin_css', get_template_directory_uri() . '/assets/css/zoo-admin.css', false, '' );
    }
}
add_action( 'admin_enqueue_scripts', 'zoo_admin_style' );
/**
 * Remove Script Version
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if (!function_exists('zoo_remove_script_version')) {
    function zoo_remove_script_version($src)
    {
        if (strpos($src, $_SERVER['SERVER_NAME']) != false) {
            $parts = explode('?', $src);
            return $parts[0];
        } else {
            return $src;
        }
    }
}
add_filter('script_loader_src', 'zoo_remove_script_version', 15, 1);
add_filter('style_loader_src', 'zoo_remove_script_version', 15, 1);
/**
 * Edit the except length characters.
 *
 */
if (!function_exists('zoo_custom_excerpt_length')) {
    function zoo_custom_excerpt_length()
    {
        return get_theme_mod('zoo_blog_excerpt_length', '60');
    }
}
add_filter('excerpt_length', 'zoo_custom_excerpt_length', 999);

//Include widget of theme
include get_template_directory() . '/inc/widgets/icon-field.php';
include get_template_directory() . '/inc/widgets/img-hover.php';
include get_template_directory() . '/inc/widgets/recent-post.php';
include get_template_directory() . '/inc/widgets/widget-social.php';

include get_template_directory() . '/inc/widgets/filter-price-list.php';
include get_template_directory() . '/inc/widgets/filter-in-stock.php';
include get_template_directory() . '/inc/widgets/filter-on-sale.php';
//Helper of theme for check conditional of customize and meta options
include get_template_directory() . '/inc/theme-functions/helper.php';


/**
 * Register the required plugins for this theme.
 */
add_action('tgmpa_register', 'zoo_theme_register_required_plugins');
if (!function_exists('zoo_theme_register_required_plugins')) {
    function zoo_theme_register_required_plugins()
    {
        $zoo_directory_plugins = get_template_directory() . '/inc/plugins/';
        $plugins = array(
            array(
                'name' => esc_html__('WPBakery Page Builder', 'doma'),
                'slug' => 'js_composer',
                'required' => true,
                'source' => $zoo_directory_plugins . 'js_composer.zip',
                'version' => '5.6'
            ),
            array(
                'name' => esc_html__('Slider Revolution', 'doma'),
                'slug' => 'revslider',
                'required' => true,
                'source' => $zoo_directory_plugins . 'revslider.zip',
                'version' => '5.4.8.1'
            ),
            array(
                'name' => esc_html__('WooCommerce', 'doma'),
                'slug' => 'woocommerce',
                'required' => true,
            ),
            array(
                'name' => esc_html__('Clever Mega Menu', 'doma'),
                'slug' => 'clever-mega-menu',
                'required' => false,
                'source' => $zoo_directory_plugins . 'clever-mega-menu.zip',
                'version' => '1.0.8'
            ),
            array(
                'name' => esc_html__('Contact Form 7', 'doma'),
                'slug' => 'contact-form-7',
                'required' => false,
            ),
            array(
                'name' => esc_html__('Clever Visual Composer Addon', 'doma'),
                'slug' => 'clever-vc-addon',
                'required' => true,
                'source' => $zoo_directory_plugins . 'clever-vc-addon.zip',
                'version' => '1.2.2'
            ),
            array(
                'name' => esc_html__('Zoo Framework', 'doma'),
                'slug' => 'zoo-framework',
                'required' => true,
                'source' => $zoo_directory_plugins . 'zoo-framework.zip',
                'version' => '1.0.0'
            ),
            array(
                'name' => esc_html__('Clever Layered Navigation', 'doma'),
                'slug' => 'clever-layered-navigation',
                'required' => true,
                'source' => $zoo_directory_plugins . 'clever-layered-navigation.zip',
                'version' => '1.3.0'
            ),
            array(
                'name' => esc_html__('Meta Box', 'doma'),
                'slug' => 'meta-box',
                'required' => true,
            ),
            
            array(
                'name' => esc_html__('Clever Swatches', 'doma'),
                'slug' => 'clever-swatches',
                'required' => false,
                'source' => $zoo_directory_plugins . 'clever-swatches.zip',
                'version' => '2.1.1'
            ),
            array(
                'name' => esc_html__('Currency Switcher for WooCommerce', 'doma'),
                'slug' => 'currency-switcher-woocommerce',
                'required' => false,
            ),array(
                'name' => esc_html__('WP User Avatar', 'doma'),
                'slug' => 'wp-user-avatar',
                'required' => false,
            ),array(
                'name' => esc_html__('Ajax Search Lite', 'doma'),
                'slug' => 'ajax-search-lite',
                'required' => false,
            ),
            array(
                'name' => esc_html__('Newsletter', 'doma'),
                'slug' => 'newsletter',
                'required' => false,
            ),
            array(
                'name' => esc_html__('YITH WooCommerce Wishlist', 'doma'),
                'slug' => 'yith-woocommerce-wishlist',
                'required' => false,
            ),
            array(
                'name' => esc_html__('YITH WooCommerce Compare', 'doma'),
                'slug' => 'yith-woocommerce-compare',
                'required' => false,
            ),
            array(
                'name' => esc_html__('YITH WooCommerce Social Login', 'doma'),
                'slug' => 'yith-woocommerce-social-login',
                'required' => false,
            ),
            array(
                'name' => esc_html__('Better AMP - WordPress Complete AMP', 'doma'),
                'slug' => 'better-amp',
                'required' => false,
            ),
            array(
                'name' => esc_html__('WC Marketplace', 'doma'),
                'slug' => 'dc-woocommerce-multi-vendor',
                'required' => false,
            ),
            array(
                'name' => esc_html__('GDPR', 'doma'),
                'slug' => 'gdpr',
                'required' => false,
            ),
        );
        $config = array(
            'id' => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu' => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug' => 'themes.php',            // Parent menu slug.
            'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices' => true,                    // Show admin notices or not.
            'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message' => '',                      // Message to output right before the plugins table.
            'strings' => array(
                'page_title' => esc_html(__('Install Required Plugins', 'doma')),
                'menu_title' => esc_html(__('Install Plugins', 'doma')),
                'installing' => esc_html(__('Installing Plugin: %s', 'doma')), // %s = plugin name.
                'oops' => esc_html(__('Something went wrong with the plugin API.', 'doma')),
                'notice_can_install_required' => _n_noop(
                    'This theme requires the following plugin: %1$s.',
                    'This theme requires the following plugins: %1$s.',
                    'doma'
                ), // %1$s = plugin name(s).
                'notice_can_install_recommended' => _n_noop(
                    'This theme recommends the following plugin: %1$s.',
                    'This theme recommends the following plugins: %1$s.',
                    'doma'
                ), // %1$s = plugin name(s).
                'notice_cannot_install' => _n_noop(
                    'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
                    'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
                    'doma'
                ), // %1$s = plugin name(s).
                'notice_ask_to_update' => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                    'doma'
                ), // %1$s = plugin name(s).
                'notice_ask_to_update_maybe' => _n_noop(
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'doma'
                ), // %1$s = plugin name(s).
                'notice_cannot_update' => _n_noop(
                    'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
                    'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
                    'doma'
                ), // %1$s = plugin name(s).
                'notice_can_activate_required' => _n_noop(
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'doma'
                ), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'doma'
                ), // %1$s = plugin name(s).
                'notice_cannot_activate' => _n_noop(
                    'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
                    'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
                    'doma'
                ), // %1$s = plugin name(s).
                'install_link' => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'doma'
                ),
                'update_link' => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'doma'
                ),
                'activate_link' => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'doma'
                ),
                'return' => esc_html(__('Return to Required Plugins Installer', 'doma')),
                'plugin_activated' => esc_html(__('Plugin activated successfully.', 'doma')),
                'activated_successfully' => esc_html(__('The following plugin was activated successfully:', 'doma')),
                'plugin_already_active' => esc_html(__('No action taken. Plugin %1$s was already active.', 'doma')),  // %1$s = plugin name(s).
                'plugin_needs_higher_version' => esc_html(__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'doma')),  // %1$s = plugin name(s).
                'complete' => esc_html(__('All plugins installed and activated successfully. %1$s', 'doma')), // %s = dashboard link.
                'contact_admin' => esc_html(__('Please contact the administrator of this site for help.', 'doma')),
                'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa($plugins, $config);

    }
}

/**
 * Custom functions of theme.
 */
/* COMMENTS */
if (!function_exists('zoo_custom_comments')) {
    function zoo_custom_comments($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        $GLOBALS['comment_depth'] = $depth;
        ?>
        <li id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix') ?>>
        <div class="comment-wrap clearfix">
            <div class="comment-avatar">
                <?php if (function_exists('get_avatar')) {
                    echo wp_kses(get_avatar($comment, '55'), array('img' => array('class' => array(), 'width' => array(), 'height' => array(), 'alt' => array(), 'src' => array())));
                } ?>
            </div>
            <div class="comment-content">
                <div class="comment-meta">
                    <?php
                    printf('<h5 class="author-name">%1$s</h5>',
                        get_comment_author_link()
                    );
                    echo '<span class="date-post">' . esc_html(get_comment_date('', get_comment_ID())) . '</span>';
                    ?>
                </div>
                <?php if ($comment->comment_approved == '0') wp_kses(__("\t\t\t\t\t<span class='unapproved'>" . esc_html__('Your comment is awaiting moderation.', 'doma') . "</span>\n", 'doma'), array('span' => array('class' => array()))); ?>
                <div class="comment-body">
                    <?php comment_text() ?>
                </div>
                <div class="comment-meta-actions">
                    <?php
                    edit_comment_link(esc_html(__('Edit', 'doma')), '<span class="edit-link">', '</span>');
                    ?>
                    <?php if ($args['type'] == 'all' || get_comment_type() == 'comment') :
                        comment_reply_link(array_merge($args, array(
                            'reply_text' => esc_html(__('Reply', 'doma')),
                            'login_text' => esc_html(__('Log in to reply.', 'doma')),
                            'depth' => $depth,
                            'before' => '<span class="comment-reply">',
                            'after' => '</span>'
                        )));
                    endif; ?>
                </div>
            </div>
        </div>
    <?php }
}
if (!function_exists('zoo_custom_pings')) {
    function zoo_custom_pings($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        $GLOBALS['comment_depth'] = $depth;
        ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix') ?>>
        <div class="comment-wrap clearfix">
            <div class="comment-content">
                <div class="comment-meta">
                    <?php
                    printf('<h6 class="author-name">%1$s</h6>',
                        get_comment_author_link()
                    );
                    ?>
                </div>
                <?php if ($comment->comment_approved == '0') wp_kses(__("\t\t\t\t\t<span class='unapproved'>" . esc_html__('Your comment is awaiting moderation.', 'doma') . "</span>\n", 'doma'), array('span' => array('class' => array()))); ?>
                <div class="comment-meta-actions">
                    <?php
                    edit_comment_link(esc_html(__('Edit', 'doma')), '<span class="edit-link">', '</span>');
                    ?>
                    <?php if ($args['type'] == 'all' || get_comment_type() == 'comment') :
                        comment_reply_link(array_merge($args, array(
                            'reply_text' => esc_html(__('Reply', 'doma')),
                            'login_text' => esc_html(__('Log in to reply.', 'doma')),
                            'depth' => $depth,
                            'before' => '<span class="comment-reply">',
                            'after' => '</span>'
                        )));
                    endif; ?>
                </div>
            </div>
        </div>
    <?php }
}
if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
    add_filter('wpcf7_load_js', '__return_false');
    add_filter('wpcf7_load_css', '__return_false');
    if (!function_exists('zoo_cf7_shortcode_scripts')) {
        function zoo_cf7_shortcode_scripts()
        {
            global $post;
            if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'contact-form-7')) {
                if (function_exists('wpcf7_enqueue_scripts')) {
                    wpcf7_enqueue_scripts();
                }
                if (function_exists('wpcf7_enqueue_styles')) {
                    wpcf7_enqueue_styles();
                }
            }
        }
    }
    add_action('wp_enqueue_scripts', 'zoo_cf7_shortcode_scripts');
}
add_filter('body_class', 'zoo_body_custom_class');
if (!function_exists('zoo_body_custom_class')) {
    function zoo_body_custom_class($classes)
    {
        if (zoo_boxes()) {
            $classes[] = 'boxes-page';
        }
        return $classes;
    }
}
update_option( 'yith_wcwl_rounded_corners', 'no' );
//Custom vc row
add_action( 'vc_after_init_base', 'zoo_add_more_custom_layouts' );
function zoo_add_more_custom_layouts() {
    global $vc_row_layouts;
    array_push( $vc_row_layouts, array(
        'cells' => '16_712_14',
        'mask' => '331',
        'title' => 'Custom 1/6 + 7/12 + 1/4',
        'icon_class' => 'l_16_712_14' )
    );
    array_push( $vc_row_layouts, array(
            'cells' => '16_13_12',
            'mask' => '311',
            'title' => 'Custom 1/6 + 1/3 + 1/2',
            'icon_class' => 'l_16_13_12' )
    );array_push( $vc_row_layouts, array(
            'cells' => '16_13_13_16',
            'mask' => '418',
            'title' => 'Custom 1/6 + 1/3 + 1/3 + 1/6',
            'icon_class' => 'l_16_13_13_16' )
    );
}
//Meta function
if (!function_exists('zoo_meta')) {
   function zoo_meta()
   {
       global $wp;
       $zoo_url = home_url($wp->request);
       $zoo_meta = '';
       $zoo_img = wp_get_attachment_url(get_theme_mod('custom_logo'));
       $zoo_title = get_bloginfo('name');
       $zoo_des = get_bloginfo('description');
       if (is_page() || is_single()) {
           $zoo_title = get_the_title();
           if(!is_page()) {
               $zoo_des = apply_filters('the_excerpt', get_post_field('post_excerpt', get_the_ID()));;
           }
           if(has_post_thumbnail()){
               $zoo_img = get_the_post_thumbnail_url(get_the_ID(),'full');
           }
       }
       if(is_archive()){
           $zoo_title = get_the_archive_title();
           $zoo_des = get_the_archive_description();
       }
       $zoo_meta .= '<meta property="og:title" content="' . esc_attr($zoo_title) . '">
       <meta property="og:description" content="' . esc_attr($zoo_des) . '">
       <meta property="og:image" content="' .esc_url($zoo_img) . '">
       <meta property="og:url" content="' . esc_url($zoo_url) . '">';
       echo ent2ncr($zoo_meta);
   }
}
add_action('wp_head', 'zoo_meta');
if (!function_exists('zoo_gdpr_consent')) {
    function zoo_gdpr_consent()
    {
       if (class_exists('GDPR')) {
            
            return GDPR::get_consent_checkboxes();

       } else {
           return false;
       }
    }
}
remove_action( 'register_form', array( 'GDPR', 'consent_checkboxes' ) );