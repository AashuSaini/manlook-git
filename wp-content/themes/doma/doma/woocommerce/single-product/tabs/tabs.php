<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
do_action('zoo_custom_html_inner_after');
do_action('zoo_custom_html_wrap_after');
$tabs = apply_filters('woocommerce_product_tabs', array());
if (zoo_woo_enable_share()) {
    do_action('zoo_woocommerce_template_single_sharing');
}
$tabs_class = '';
//Change layout tab to accordion follow layout
if (zoo_woo_gallery_layout_single() == 'sticky-accordion' || zoo_woo_gallery_layout_single() == 'images-center') {
    $tabs_class .= ' zoo-accordion';
} else {
    $tabs_class .= ' wc-tabs-wrapper';
}
if (!empty($tabs)) : ?>
    <div class="zoo-woo-tabs <?php echo ent2ncr($tabs_class); ?>">
        <?php
        if (zoo_woo_gallery_layout_single() != 'sticky-accordion' && zoo_woo_gallery_layout_single() != 'images-center') {
            ?>
            <ul class="tabs wc-tabs zoo-tabs">
                <?php foreach ($tabs as $key => $tab) : ?>
                    <li class="<?php echo esc_attr($key); ?>_tab">
                        <a href="#tab-<?php echo esc_attr($key); ?>"><?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', esc_html($tab['title']), $key); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php } ?>
        <div class="tab-content">
            <?php foreach ($tabs as $key => $tab) :
                if (zoo_woo_gallery_layout_single() == 'sticky-accordion' || zoo_woo_gallery_layout_single() == 'images-center') {
                    ?>
                    <div class="zoo-group-accordion">
                    <h3 class="tab-heading"><?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', esc_html($tab['title']), $key); ?>
                        <i class="cs-font clever-icon-down"></i></h3>
                <?php } ?>
                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr($key); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr($key); ?>">
                    <h3 class="tab-heading"><?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', esc_html($tab['title']), $key); ?></h3>
                    <?php call_user_func($tab['callback'], $key, $tab); ?>
                </div>
                <?php
                if (zoo_woo_gallery_layout_single() == 'sticky-accordion' || zoo_woo_gallery_layout_single() == 'images-center') {
                    ?></div>
                <?php } ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
