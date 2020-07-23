<?php
/**
 * Created by PhpStorm.
 * User: Dev
 * Date: 03.10.2018
 * Time: 18:37
 */

add_action( 'woocommerce_thankyou', 'redirect_after_success_checkout');

function redirect_after_success_checkout( $order_id ){

    global $SsfFormErrors;

    $order = new WC_Order( $order_id );

    $SsfFormErrors->addSuccess('Заказ принят')->writeSession();

    // $url = '/thank-you';
    // $url = esc_url( home_url( '/order-received' ) );
    // if ( $order->status != 'failed' ) {
    //     wp_redirect($url);
    //     exit;
    // }
}