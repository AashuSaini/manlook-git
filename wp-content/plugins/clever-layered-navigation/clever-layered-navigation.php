<?php
/**
 * Plugin Name: Clever Layered Navigation
 * Description: WooCommerce AJAX Layered Navigation, WooCommerce Product Filter adds advanced product filtering to your WooCommerce shop.
 * Version: 1.3.0
 * Author: cleversoft.co <hello.cleversoft@gmail.com>
 * Requires at least: 4.6.1
 * Tested up to: 4.9.7
 *
 * WC requires at least: 3.3.2
 * WC tested up to: 3.4.3
 *
 * Text Domain: clever-layered-navigation
 * Domain Path: /i18n/languages/
 *
 * @package clever-layered-navigation
 * @author cleversoft.co
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}


//defined all Constant
$plugin_path = plugin_dir_path( __FILE__ )."/";
$plugin_url = plugin_dir_url( __FILE__ );

define( 'ZOO_LN_VERSION', '1.3.0' );
define( 'ZOO_LN_DIRPATH', $plugin_path );
define( 'ZOO_LN_TEMPLATES_PATH', $plugin_path."templates/" );
define( 'ZOO_LN_URL', $plugin_url );
define( 'ZOO_LN_ADMIN_MENU_SLUG', 'zoo-ln-settings' );
define( 'ZOO_LN_JSPATH', $plugin_url."assets/js/" );
define( 'ZOO_LN_CSSPATH', $plugin_url."assets/css/" );
define( 'ZOO_LN_VENDOR', $plugin_url."assets/vendor/" );
define( 'ZOO_LN_GALLERYPATH', $plugin_url."assets/images/" );


//include helper functions
require_once(plugin_dir_path(__FILE__) . 'helper/data.php');


//router admin or frontend
if (Zoo\Helper\Data\zoo_ln_check_woocommerce_active()) {
    if (is_admin()) {
        //add hook admin
        require_once(ZOO_LN_DIRPATH . 'admin/hook.php');
        require_once ZOO_LN_DIRPATH.'admin/ajax.php';
    }
    require_once(ZOO_LN_DIRPATH . 'frontend/ajax.php');
    require_once(ZOO_LN_DIRPATH . 'frontend/hook.php');
} else {
    if (is_admin()) {
        if (defined('DOING_AJAX') && DOING_AJAX) {
            exit;
        } else {
            exit(sprintf(__('Clever Layered Navigation requires WooCommerce to be installed and activated. You can download %s here.', 'clever-layered-navigation'), '<a href="http://www.wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a>'));
        }
    }
}

// register Foo_Widget widget
function zoo_ln_register_widget() {
    require ZOO_LN_DIRPATH.'admin/widget.php';
    register_widget( 'Zoo_Ln_Widget' );
}

add_action( 'widgets_init', 'zoo_ln_register_widget' );
function zoo_ln_admin_script()
{
    wp_enqueue_style('zoo-ln', ZOO_LN_CSSPATH . 'admin/zoo-ln-style.css');
}
add_action( 'admin_enqueue_scripts', 'zoo_ln_admin_script' );
