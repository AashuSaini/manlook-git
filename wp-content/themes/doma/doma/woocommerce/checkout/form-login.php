<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
  return;
}

$info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );
$info_message .= ' <a href="#" class="showlogin">' . __( 'Click here to login', 'woocommerce' ) . '</a>';
wc_print_notice( $info_message, 'notice' );?>

<div class="wrap-login" id="customer_login">

    <div class="login form">
        <form method="post" class="login" style="display: none">
          <h3><?php _e('Login', 'woocommerce'); ?></h3>

            <?php do_action('woocommerce_login_form_start'); ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                       placeholder="<?php esc_attr_e('Username or email address', 'woocommerce'); ?> *" id="username"
                       value="<?php echo (!empty($_POST['username'])) ? esc_attr($_POST['username']) : ''; ?>"/>
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input class="woocommerce-Input woocommerce-Input--text input-text"
                       placeholder="<?php esc_attr_e('Password', 'woocommerce'); ?> *" type="password" name="password"
                       id="password"/>
            </p>

            <p class="form-row"><label for="rememberme" class="inline">
                    <input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox"
                           id="rememberme" value="forever"/> <?php _e('Remember me', 'woocommerce'); ?>
                </label>
                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php _e('Lost your password?', 'woocommerce'); ?></a>
            </p>
            <p class="form-row">
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                <input type="submit" class="woocommerce-Button button" name="login"
                       value="<?php esc_attr_e('Login', 'woocommerce'); ?>"/>
            </p>

            <?php do_action('woocommerce_login_form_end'); ?>
            <?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') { ?>
                <a href="#" class="btn btn-show-register light"
                   title="<?php esc_attr_e('Register', 'doma'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></a>
                <?php
            } ?>
            <?php do_action('woocommerce_login_form'); ?>
        </form>


    </div>
    <?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') : ?>
    <div class="register form" style="display:none">

        <form method="post" class="register">
          <h3><?php _e('Register', 'woocommerce'); ?></h3>

            <?php do_action('woocommerce_register_form_start'); ?>

            <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input type="text" placeholder="<?php esc_attr_e('Username', 'woocommerce'); ?> *" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
                </p>

            <?php endif; ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email"
                       id="reg_email" placeholder="<?php esc_attr_e('Email address', 'woocommerce'); ?> *"
                       value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>"/>
            </p>

            <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password"
                           placeholder="<?php esc_attr_e('Password', 'woocommerce'); ?> *" id="reg_password"/>
                </p>

            <?php endif; ?>

            <!-- Spam Trap -->
            <div style="<?php echo((is_rtl()) ? 'right' : 'left'); ?>: -999em; position: absolute;"><label
                        for="trap"><?php _e('Anti-spam', 'woocommerce'); ?></label><input type="text" name="email_2"
                                                                                          id="trap" tabindex="-1"
                                                                                          autocomplete="off"/></div>

            <?php do_action('woocommerce_register_form'); ?>

            <p class="woocomerce-form-row form-row">
                <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                <input type="submit" class="woocommerce-Button button" name="register"
                       value="<?php esc_attr_e('Register', 'woocommerce'); ?>"/>
            </p>

            <?php do_action('woocommerce_register_form_end'); ?>
            <a href="#" class="btn btn-show-login light"
               title="<?php esc_attr_e('Login', 'woocommerce'); ?>"><?php esc_html_e('Login', 'woocommerce'); ?></a>
               
           <?php do_action('register_form'); ?>
        </form>

    </div>

</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>