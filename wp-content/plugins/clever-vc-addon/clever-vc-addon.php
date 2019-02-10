<?php
/**
 * Plugin Name: Clever Visual Composer Addon
 * Plugin URI:  http://www.zootemplate.com/wordpress-plugins/clevervcaddon
 * Description: An ultimate addon for Visual Composer and Zoo Theme Core.
 * Author:      Zootemplate
 * Version:     1.2.2
 * Author URI:  http://zootemplate.com/
 * Text Domain: cvca
 */

/**
 * Plugin version
 *
 * @var  string
 */
define( 'CVCA_VERSION', '1.2.2' );

/**
 * Plugin DIR
 *
 * @var  string
 */
define( 'CVCA_DIR', __DIR__ . '/' );

/**
 * Plugin URI
 *
 * @var  string
 */
define( 'CVCA_URI', preg_replace('/^http(s)?:/', '', plugins_url( '/', __FILE__ ) ) );

/**
 * Do activation
 *
 * @param  bool  $network
 *
 * @internal  Used as a callback
 */
register_activation_hook( __FILE__, function()
{
    try {
        if (version_compare(PHP_VERSION, '5.6', '<')) {
            throw new \Exception('Clever Visual Composer Addon requires PHP version 5.6 at least. Please upgrade to latest version for better performance and security!');
        }
        if (!defined('WPB_VC_VERSION') || version_compare(WPB_VC_VERSION, '5.4.7', '<')) {
            throw new \Exception('Clever Visual Composer Addon requires Visual Composer version 5.4.7 at least. Please install and activate the latest version of Visual Composer for better performance and security!');
        }
    } catch (Exception $e) {
        if (defined('DOING_AJAX') && DOING_AJAX) {
            wp_send_json_error();
        } else {
            exit( $e->getMessage() );
        }
    }

    flush_rewrite_rules(false);
});

/**
 * Do deactivation
 *
 * @param  bool  $network
 *
 * @internal  Used as a callback
 */
register_deactivation_hook( __FILE__, function()
{
    flush_rewrite_rules(false);
});

/**
 * Do installation
 *
 * @internal  Used as a callback
 */
add_action( 'plugins_loaded', function()
{
    require CVCA_DIR . 'src/helpers/filesystem.php';
    require CVCA_DIR . 'vendor/vafpress-post-formats-ui/vp-post-formats-ui.php';

    load_plugin_textdomain('cvca', false, CVCA_DIR . 'i18n');

    cvca_load_php_files(CVCA_DIR . 'src/helpers', ['filesystem.php']);
    cvca_load_php_files(CVCA_DIR . 'src/post-types');
    require CVCA_DIR . 'src/meta-data/meta-boxes.php';
}, 10, 0 );

/**
 * Load shortcodes
 */
add_action('after_setup_theme', function()
{
    cvca_load_php_files(CVCA_DIR . 'src/shortcodes');
}, PHP_INT_MAX, 0);
