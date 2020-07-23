<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cart-block__result-block cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <div class="top-caption">Итого:</div>

    <div class="summ-row">
        <div class="gray-caption"><?php echo WC()->cart->get_cart_contents_count();?> товара на сумму</div>
        <div class="price-num"><?php echo intval( WC()->cart->total );?> ₽</div>
    </div>

    <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

    <div class="cart-block__result-methods">
        <div class="method-item visa"><img src="<?php echo get_template_directory_uri();?>/assets/img/visa-2.svg" alt=""></div>
        <div class="method-item qiwi"><img src="<?php echo get_template_directory_uri();?>/assets/img/qiwi-2.svg" alt=""></div>
        <div class="method-item yandex"><img src="<?php echo get_template_directory_uri();?>/assets/img/yandex-2.svg" alt=""></div>
    </div>

    <?php /** Counop */?>
    <?php /** Shipping */?>
    <?php /** Fees */?>
    <?php /** Tax */?>

    <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

    <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
