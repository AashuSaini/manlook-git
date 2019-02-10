<?php
/**
 Template Name: Inner

 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    3.4.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $wp;
get_header('shop');

if(get_theme_mod('zoo_choose_sidebar_filter') == 'widget-ajax'){
    wp_enqueue_script('zoo-woocommerce-ajax-filter');
}
?>
<div id="woo-cover-page" class="cover-without-slider" 
style="padding-top:90px;padding-bottom:90px;background-color:#ffffff;background-image:url(../wp-content/uploads/2019/02/shop-banner.jpg);">
      <div class="container"><h2 class="shop-cover-title"><?php the_title(); ?></h2></div>
</div>

<main id="main-page" class="wrap-site-main">
    <div id="primary" class="zoo-woo-page container <?php echo esc_attr(zoo_woo_sidebar()) ?>">
        <?php
        do_action('zoo_woo_print_notices');
        ?>
        <div id="top-product-page">
            <?php wc_get_template_part('/woocommerce/theme-custom/top-left-product', 'page');?>
            <?php do_action('zoo_woocommerce_breadcrumb');?>
            <?php if(get_theme_mod('zoo_disable_columns') == '1'){ ?>
            <div class="center-top-product-page">
                <ul class="layout-control-column">
                    <li><a href="<?php echo esc_url(home_url( $wp->request )) ?>" class="item" data-column="3"><i class="box"></i><i class="box"></i><i class="box"></i></a></li>
                    <li><a href="<?php echo esc_url(home_url( $wp->request )) ?>" class="item" data-column="4"><i class="box"></i><i class="box"></i><i class="box"></i><i class="box"></i></a></li>
                    <li><a href="<?php echo esc_url(home_url( $wp->request )) ?>" class="item" data-column="5"><i class="box"></i><i class="box"></i><i class="box"></i><i class="box"></i><i class="box"></i></a></li>
                    <li><a href="<?php echo esc_url(home_url( $wp->request )) ?>" class="item" data-column="6"><i class="box"></i><i class="box"></i><i class="box"></i><i class="box"></i><i class="box"></i><i class="box"></i></a></li>
                </ul>
            </div>
            <?php } ?>
            <?php
            /**
             *
             * woocommerce_before_shop_loop hook.
             *
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action('woocommerce_before_shop_loop');
            ?>

        </div>
        <div class="row">
            <?php
            if (zoo_woo_sidebar() == 'left-sidebar' || zoo_woo_sidebar() == 'canvas-sidebar' || zoo_woo_sidebar() == 'horizontal-sidebar') {
                /**
                 * woocommerce_sidebar hook.
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */
                get_template_part('woocommerce/woo-sidebar', 'left');
            }
            /**
             * woocommerce_before_main_content hook.
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             */
            do_action('woocommerce_before_main_content');
            check_vendor() ? get_template_part('/woocommerce/theme-custom/vendor', 'info') : '';
            if ( have_posts() ) {
                woocommerce_product_loop_start();

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         *
                         * @hooked WC_Structured_Data::generate_product_data() - 10
                         */
                        do_action( 'woocommerce_shop_loop' );

                        wc_get_template_part( 'content', 'product' );
                    }
                }

                woocommerce_product_loop_end();

                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            } else {
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action( 'woocommerce_no_products_found' );
            }
            /**
             * woocommerce_after_main_content hook.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action('woocommerce_after_main_content');
            if (zoo_woo_sidebar() == 'right-sidebar') {
                /**
                 * woocommerce_sidebar hook.
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */
                get_template_part('woocommerce/woo-sidebar', 'right');
            }
            ?>
        </div>
    </div>
	
	 <!--- Main Page Content----->
        <div class="container">
            <?php while (have_posts()) : the_post();
                get_template_part('content', 'page');
                if (comments_open() || get_comments_number()) :
                    comments_template('', true);
                endif;
            endwhile; ?>
        </div>
   
</main>
<?php
get_footer('shop'); ?>
