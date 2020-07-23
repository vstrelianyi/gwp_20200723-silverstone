<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}

if( WC()->cart->needs_payment() && !empty($available_gateways) && is_array($available_gateways) ):
?>
<div class="woocommerce-checkout-payment input-col">
    <label>Способ оплаты:</label>

    <div class="checkout-block__methods-wrapper">

    <?php foreach (array_reverse($available_gateways) as $gateway):?>

        <?php if($gateway->id == 'kassa'):?>
        <div class="checkout-block__method-item">
            <input type="radio" name="payment_method" value="<?php echo $gateway->id;?>" checked id="method-1">
            <label for="method-1">
                <i class="icon-credit-card"></i>
                <span>Онлайн-оплата</span>
            </label>
        </div>
        <?php endif;?>

        <?php if($gateway->id == 'cod'):?>
        <div class="checkout-block__method-item">
            <input type="radio" name="payment_method" value="<?php echo $gateway->id;?>" id="method-2">
            <label for="method-2">
                <i class="icon-pay-cash"></i>
                <span>Наличными</span>
            </label>
        </div>
        <?php endif;?>

        <?php if($gateway->id == 'cttc'):?>
        <div class="checkout-block__method-item">
            <input type="radio" name="payment_method" value="<?php echo $gateway->id;?>" id="method-3">
            <label for="method-3">
                <i class="icon-credit-card"></i>
                <span>Картой курьеру</span>
            </label>
        </div>
        <?php endif;?>

    <?php endforeach;?>
    </div>
</div>
<?php

endif;

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
