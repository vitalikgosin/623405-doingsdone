<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

    <p><?php printf( __( 'Thanks for creating an account on %1$s. Your username is %2$s', 'woocommerce' ), esc_html( $blogname ), '<strong>' . esc_html( $user_login ) . '</strong>' ); ?></p>

<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>

    <p><?php printf( __( 'Your password has been automatically generated: %s', 'woocommerce' ), '<strong>' . esc_html( $user_pass ) . '</strong>' ); ?></p>

<?php endif; ?>

    <p><?php printf( __( 'You can access your account area to view your orders and change your password here: %s.', 'woocommerce' ), make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ) ); ?></p>

<?php do_action( 'woocommerce_email_footer', $email );

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

    <p><?php printf( __( "Hi there. Your recent order on %s has been completed. Your order details are shown below for your reference:", 'woocommerce' ), get_option( 'blogname' ) ); ?></p>

<?php

/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

    <p><?php printf( __( 'Thanks for creating an account on %1$s. Your username is %2$s', 'woocommerce' ), esc_html( $blogname ), '<strong>' . esc_html( $user_login ) . '</strong>' ); ?></p>

<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>

    <p><?php printf( __( 'Your password has been automatically generated: %s', 'woocommerce' ), '<strong>' . esc_html( $user_pass ) . '</strong>' ); ?></p>

<?php endif; ?>

    <p><?php printf( __( 'You can access your account area to view your orders and change your password here: %s.', 'woocommerce' ), make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ) ); ?></p>

<?php do_action( 'woocommerce_email_footer', $email );
