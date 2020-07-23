<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'woocommerce' ),
		'shipping' => __( 'Shipping address', 'woocommerce' ),
	), $customer_id );
} else {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'woocommerce' ),
	), $customer_id );
}

global $woocommerce;
$woo_user = $woocommerce->customer;

if(! $woo_user instanceof WC_Customer){
    return;
}

$user_state =  $woo_user->get_billing_state();
$user_city = $woo_user->get_billing_city();

$user_street       = get_user_meta( $woo_user->get_id(),'user_street', true);
$user_house_number = get_user_meta( $woo_user->get_id(),'user_house_number', true);
$user_building     = get_user_meta( $woo_user->get_id(),'user_building', true);
$user_apartment    = get_user_meta( $woo_user->get_id(),'user_apartment', true);
$user_entrance     = get_user_meta( $woo_user->get_id(),'user_entrance', true);
$user_comment      = get_user_meta( $woo_user->get_id(),'user_comment', true);
?>
<div class="cabinet-block__main-heading">Адрес доставки</div>

<form class="cabinet-block__form" method="POST">
    <div class="input-col">
        <label for="cabinet-city">Область:</label>
        <input type="text" class="text-input" id="cabinet-city" name="user_state" value="<?php echo $user_state;?>">
    </div>

    <div class="input-col">
        <label for="cabinet-city">Город:</label>
        <input type="text" class="text-input" id="cabinet-city" name="billing_city" value="<?php echo $user_city;?>">
    </div>

    <div class="input-col">
        <label for="cabinet-street">Улица:</label>

        <input type="text" class="text-input" id="cabinet-street" value="<?php echo $user_street;?>" name="user_street">
    </div>

    <div class="cabinet-block__form-row">
        <div class="input-col w6">
            <label for="cabinet-number">Дом:</label>

            <input type="text" class="text-input" id="cabinet-number" value="<?php echo $user_house_number;?>" name="user_house_number">
        </div>

        <div class="input-col w6">
            <label for="cabinet-part">Корпус:</label>

            <input type="text" class="text-input" id="cabinet-part" value="<?php echo $user_building;?>" name="user_building">
        </div>
    </div>

    <div class="cabinet-block__form-row">
        <div class="input-col w6">
            <label for="cabinet-flat">Квартира:</label>

            <input type="text" class="text-input" id="cabinet-flat" value="<?php echo $user_apartment;?>" name="user_apartment">
        </div>

        <div class="input-col w6">
            <label for="cabinet-part-2">Подьезд:</label>

            <input type="text" class="text-input" id="cabinet-part-2" value="<?php echo $user_entrance;?>" name="user_entrance">
        </div>
    </div>

    <div class="input-col">
        <label for="tel-cabinet">Комментарий:</label>

        <textarea class="textarea-input" placeholder="Мой второй номер телефона: 8 (800) 666-36-36" name="user_comment"><?php echo $user_comment;?></textarea>
    </div>

    <button type="submit" class="btn cabinet-block__submit-button">Сохранить</button>

    <?php SSF_Form_Handler::serviceFields('ssf_update_address');?>

</form>

