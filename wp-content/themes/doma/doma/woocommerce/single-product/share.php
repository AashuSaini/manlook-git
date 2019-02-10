<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.5.0
 */
global $product;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="single-meta">
  <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

  <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

  <?php do_action( 'woocommerce_product_meta_end' ); ?>
</div>
<ul class="socials-sharing">
    <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"
                            class="post_share_facebook icon-around" onclick="javascript:window.open(this.href,
                  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"
                            title="<?php echo esc_html__('Share to facebook', 'doma') ?>"><i
                    class="cs-font clever-icon-facebook"></i> </a></li>
    <li class="twitter"><a href="https://twitter.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
                  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;"
                           title="<?php echo esc_html__('Share to twitter', 'doma') ?>"
                           class="product_share_twitter icon-around"><i class="cs-font clever-icon-twitter"></i></a></li>
    <li class="googleplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
                  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"
                              title="<?php echo esc_html__('Share to google plus', 'doma') ?>"
                              class="icon-around"><i class="cs-font clever-icon-googleplus"></i></a></li>
    <li class="pinterest"><a
                href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php if (function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php echo get_the_title(); ?>"
                class="product_share_email icon-around"
                title="<?php echo esc_html__('Share to pinterest', 'doma') ?>"><i
                    class="cs-font clever-icon-pinterest"></i></a></li>
    <li class="mail"><a
                href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(get_the_excerpt()); ?> <?php the_permalink(); ?>"
                class="product_share_email icon-around"
                title="<?php echo esc_html__('Sent to mail', 'doma') ?>"><i class="cs-font clever-icon-mail-1"></i></a>
    </li>
</ul>
<?php do_action('vendor_store_shop_link','wcmp_after_add_to_cart_form', 10); ?>

