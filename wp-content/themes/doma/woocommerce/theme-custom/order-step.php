<?php
/**
 * Template Order step
 * @since: zoo-theme 1.0
 */
?>
<div id="order-step">
    <?php if (is_cart()){?>
        <?php esc_html_e('Shopping Cart', 'doma') ?>
    <?php }if (is_checkout() && !is_order_received_page()){ ?>
        <?php esc_html_e('Check Out Detail', 'doma') ?>
    <?php }if (is_order_received_page()) {?>
        <?php esc_html_e('Order Complete', 'doma'); }?>
</div>