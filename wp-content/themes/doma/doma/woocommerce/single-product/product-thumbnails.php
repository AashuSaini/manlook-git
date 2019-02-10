<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.5.1
 */

if (!defined('ABSPATH')) {
    exit;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();

if ($attachment_ids) {
    ?>
    <ul class="wrap-thumbs-gal"><?php
        if (has_post_thumbnail()) {
            $post_thumbnail_id = get_post_thumbnail_id($post->ID);
            $full_size_image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
            $attributes = array(
                'title' => get_post_field('post_title', $post_thumbnail_id),
                'data-caption' => get_post_field('post_excerpt', $post_thumbnail_id),
                'data-src' => $full_size_image[0],
                'data-large_image' => $full_size_image[0],
                'data-large_image_width' => $full_size_image[1],
                'data-large_image_height' => $full_size_image[2],
            );
            if (has_post_thumbnail()) {
                $html = '<li class="product-thumb-gal">';
                $html .= get_the_post_thumbnail($post->ID, 'shop_thumbnail', $attributes);
                $html .= '</li>';
            } else {
                $html = '<li class="product-thumb-gal">';
                $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'woocommerce'));
                $html .= '</li>';
            }
            echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id($post->ID));
        }
        if ($attachment_ids && has_post_thumbnail()) {
            foreach ($attachment_ids as $attachment_id) {
                $full_size_image = wp_get_attachment_image_src($attachment_id, 'full');
                $thumbnail = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');
                $attributes = array(
                    'title' => get_post_field('post_title', $attachment_id),
                    'data-caption' => get_post_field('post_excerpt', $attachment_id),
                    'data-src' => $full_size_image[0],
                    'data-large_image' => $full_size_image[0],
                    'data-large_image_width' => $full_size_image[1],
                    'data-large_image_height' => $full_size_image[2],
                );

                $html = '<li class="product-thumb-gal">';
                $html .= wp_get_attachment_image($attachment_id, 'shop_thumbnail', false, $attributes);
                $html .= '</li>';

                echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $attachment_id);
            }
        }
        ?></ul>
    <?php
}
