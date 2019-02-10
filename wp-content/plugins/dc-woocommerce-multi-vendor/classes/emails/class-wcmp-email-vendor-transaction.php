<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('WC_Email_Vendor_Commission_Transactions')) :

    /**
     * New Order Email
     *
     * An email sent to the admin when a new order is received/paid for.
     *
     * @class 		WC_Email_Vendor_Commission_Transactions
     * @version		2.0.0
     * @package		WooCommerce/Classes/Emails
     * @extends 	WC_Email
     *
     * @property DC_Commission $object
     */
    class WC_Email_Vendor_Commission_Transactions extends WC_Email {

        /**
         * Constructor
         */
        function __construct() {
            global $WCMp;
            $this->id = 'vendor_commissions_transaction';
            $this->title = __('Transactions (for Vendor)', 'dc-woocommerce-multi-vendor');
            $this->description = __('New commissions have been credited to vendor.', 'dc-woocommerce-multi-vendor');

            //$this->heading = __('Vendor\'s New Transaction', 'dc-woocommerce-multi-vendor');
            //$this->subject = __('[{site_title}] New Transaction', 'dc-woocommerce-multi-vendor');

            $this->template_base = $WCMp->plugin_path . 'templates/';
            $this->template_html = 'emails/vendor-commissions-transaction.php';
            $this->template_plain = 'emails/plain/vendor-commissions-transaction.php';


            // Call parent constructor
            parent::__construct();
        }

        /**
         * trigger function.
         *
         * @access public
         *
         * @param Commission $commission Commission paid
         */
        function trigger($trans_id, $vendor_id) {

            if (!isset($trans_id) && !isset($vendor_id))
                return;

            $this->vendor = get_wcmp_vendor_by_term($vendor_id);
            $commissions = get_post_meta($trans_id, 'commission_detail', true);
            if (!empty($commissions)) {
                foreach ($commissions as $commission_id => $order_id) {
                    $orders_array[] = $order_id;
                }
            }
            $this->commissions = $commissions;
            $this->orders = $orders_array;
            $this->transaction_id = $trans_id;
            $this->recipient = $this->vendor->user_data->user_email;
            if ( $this->is_enabled() && $this->get_recipient() ) {
                $this->send($this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments());
            }
        }
        
        /**
         * Get email subject.
         *
         * @access  public
         * @return string
         */
        public function get_default_subject() {
            return apply_filters('wcmp_vendor_commissions_transaction_email_subject', __('[{site_title}] New Transaction', 'dc-woocommerce-multi-vendor'), $this->object);
        }

        /**
         * Get email heading.
         *
         * @access  public
         * @return string
         */
        public function get_default_heading() {
            return apply_filters('wcmp_vendor_commissions_transaction_email_heading', __('Vendor\'s New Transaction', 'dc-woocommerce-multi-vendor'), $this->object);
        }

        /**
         * get_content_html function.
         *
         * @access public
         * @return string
         */
        function get_content_html() {
            global $WCMp;
            ob_start();
            wc_get_template($this->template_html, array(
                'commissions' => $this->commissions,
                'orders' => $this->orders,
                'email_heading' => $this->get_heading(),
                'vendor' => $this->vendor,
                'transaction_id' => $this->transaction_id,
                'sent_to_admin' => false,
                'plain_text' => false,
                'email'         => $this,
                    ), 'dc-product-vendor/', $this->template_base);
            return ob_get_clean();
        }

        /**
         * get_content_plain function.
         *
         * @access public
         * @return string
         */
        function get_content_plain() {
            ob_start();
            wc_get_template($this->template_plain, array(
                'commissions' => $this->commissions,
                'orders' => $this->orders,
                'email_heading' => $this->get_heading(),
                'vendor' => $this->vendor,
                'transaction_id' => $this->transaction_id,
                'sent_to_admin' => false,
                'plain_text' => false,
                'email'         => $this,
                    ), 'dc-product-vendor/', $this->template_base);
            return ob_get_clean();
        }

        /**
         * Initialise Settings Form Fields
         *
         * @access public
         * @return void
         */
        function init_form_fields() {
            global $WCMp;
            $this->form_fields = array(
                'enabled' => array(
                    'title' => __('Enable/Disable', 'dc-woocommerce-multi-vendor'),
                    'type' => 'checkbox',
                    'label' => __('Enable notification for this email', 'dc-woocommerce-multi-vendor'),
                    'default' => 'yes'
                ),
                'subject' => array(
                    'title' => __('Subject', 'dc-woocommerce-multi-vendor'),
                    'type' => 'text',
                    'description' => sprintf(__('This controls the email subject line. Leave it blank to use the default subject: <code>%s</code>.', 'dc-woocommerce-multi-vendor'), $this->get_default_subject()),
                    'placeholder' => '',
                    'default' => ''
                ),
                'heading' => array(
                    'title' => __('Email Heading', 'dc-woocommerce-multi-vendor'),
                    'type' => 'text',
                    'description' => sprintf(__('This controls the main heading contained in the email notification. Leave it blank to use the default heading: <code>%s</code>.', 'dc-woocommerce-multi-vendor'), $this->get_default_heading()),
                    'placeholder' => '',
                    'default' => ''
                ),
                'email_type' => array(
                    'title' => __('Email Type', 'dc-woocommerce-multi-vendor'),
                    'type' => 'select',
                    'description' => __('Choose format for the email that will be sent.', 'dc-woocommerce-multi-vendor'),
                    'default' => 'html',
                    'class' => 'email_type wc-enhanced-select',
                    'options' => $this->get_email_type_options()
                )
            );
        }

    }

    

endif;
