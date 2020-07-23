<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

    $user_id = WC()->customer->get_id();

    $billing_first_name = WC()->customer->get_billing_first_name();
    $billing_phone = WC()->customer->get_billing_phone();

    $billing_city = WC()->customer->get_billing_city();
    $checkout_street = get_user_meta( $user_id,'user_street', true);
    $checkout_house_number = get_user_meta( $user_id,'user_house_number', true);
    $checkout_user_building = get_user_meta( $user_id,'user_building', true);
    $checkout_user_apartment = get_user_meta( $user_id,'user_apartment', true);
    $checkout_user_entrance = get_user_meta( $user_id,'user_entrance', true);
    $order_comments = get_user_meta( $user_id,'user_comment', true);

?>

<div class="checkout-block__main-block">
    <div class="checkout-block__main-row">
        <div class="checkout-block__left-part">


<!--            --><?php
//            $fields = $checkout->get_checkout_fields( 'billing' );
//
//            foreach ( $fields as $key => $field ) {
//                if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
//                    $field['country'] = $checkout->get_value( $field['country_field'] );
//                }
//                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
//            }
//            ?>


            <?php if(is_user_logged_in()):?>
            <div class="input-col">
                <label for="name-input">Имя:</label>

                <div class="input-wrapper with-addon form-row validate-required">
                    <input type="text" class="text-input" id="name-input" name="billing_first_name" value="<?php echo $billing_first_name?>" data-a-value="<?php echo $billing_first_name?>">
                    <div class="input-addon"><i class="icon-support-user"></i></div>
                </div>
            </div>

            <div class="input-col">
                <label for="tel-input">Телефон:</label>

                <div class="input-wrapper with-addon">
                    <input type="tel" class="text-input" id="tel-input" name="billing_phone" value="<?php echo $billing_phone?>" data-a-value="<?php echo $billing_phone?>" required>
                    <div class="input-addon"><i class="icon-form-tel"></i></div>
                </div>
            </div>

            <div class="checkbox-wrapper">
                <input type="checkbox" checked id="check-account-values">
                <label for="check-account-values">Адрес доставки из кабинета</label>
            </div>
            <?php else:?>
            <div class="hidden">
            <?php
            //    $fields = $checkout->get_checkout_fields( 'billing' );

            //    foreach ( $fields as $key => $field ) {
            //        if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
            //            $field['country'] = $checkout->get_value( $field['country_field'] );
            //        }
            //        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
            //    }
            // woocommerce_form_field( $key, $args, $value = null );
            
            
            ?>
            </div>
            <input id="createaccount" type="hidden" name="createaccount" value="1" />

            <div class="input-col">
                <label for="name-input">Имя:</label>
                <div class="input-wrapper with-addon">
                    <input type="text" class="text-input" id="name-input" name="billing_first_name">
                    <div class="input-addon"><i class="icon-support-user"></i></div>
                </div>
            </div>
            <div class="input-col">
                <label for="email-input">E-mail:</label>
                <div class="input-wrapper with-addon">
                    <input type="email" class="text-input" id="email-input" name="billing_email" required>
                    <div class="input-addon"><i class="icon-email"></i></div>
                </div>
            </div>
            <div class="input-col">
                <label for="tel-input">Телефон:</label>
                <div class="input-wrapper with-addon">
                    <input type="tel" class="text-input" id="tel-input" name="billing_phone" required>
                    <div class="input-addon"><i class="icon-form-tel"></i></div>
                </div>
            </div>
            <!-- <div class="input-col">
                <label for="_account_password">Пароль:</label>
                <div class="input-wrapper with-addon">
                    <input id="_account_password" type="password" class="text-input"  name="account_password" required>
                    <div class="input-addon"><i class="icon-lock"></i></div>
                </div>
            </div>
            <div class="input-col">
                <label for="_account_password_confirmation">Повторите пароль:</label>
                <input id="_account_password_confirmation" type="password" class="text-input" name="account_password_confirmation" required>
            </div> -->

            <?php endif;?>

        </div>

        <div class="checkout-block__right-part">
            <?php
                //  if(!is_user_logged_in()){
                    echo "<div class='input-col col-bil-country'>";
                    woocommerce_form_field( 'billing_country', array(
                    'type'          => 'country', // text, textarea, select, radio, checkbox, password, about custom validation a little later
                    'required'	=> true, // actually this parameter just adds "*" to the field
                    'class'         => array('misha-field', 'form-row-wide'), // array only, read more about classes and styling in the previous step
                    'label'         => 'Страна',
                    'label_class'   => 'misha-label', // sometimes you need to customize labels, both string and arrays are supported
                    ), $checkout->get_value( 'shipping_country' ) );
                    echo "</div>";
                // }
                ?>
            <div class="input-col">
                <label for="cabinet-city">Город:</label>
                <input type="text" class="text-input" id="cabinet-city" name="billing_city" value="<?php echo $billing_city;?>" data-a-value="<?php echo $billing_city;?>" required>
            </div>

            <div class="input-col">
                <label for="cabinet-street">Улица:</label>
                <input type="text" class="text-input" id="cabinet-street" name="checkout_street" value="<?php echo $checkout_street;?>" data-a-value="<?php echo $checkout_street;?>" required>
            </div>
            <div class="input-col form-row form-row-wide address-field validate-required validate-postcode" id="billing_postcode_field" data-priority="90" data-o_class="form-row form-row-wide address-field validate-required validate-postcode">
                <label for="billing_postcode" class="">Почтовый индекс</label>
                <input type="text" class="input-text text-input" name="billing_postcode" id="billing_postcode" placeholder="" autocomplete="postal-code">
            </div>
            <div class="checkout-block__form-row">
                <div class="input-col w6">
                    <label for="cabinet-number">Дом:</label>
                    <input type="text" class="text-input" id="cabinet-number" name="checkout_house_number" value="<?php echo $checkout_house_number;?>" data-a-value="<?php echo $checkout_house_number;?>" required>
                </div>

                <div class="input-col w6">
                    <label for="cabinet-part">Корпус:</label>
                    <input type="text" class="text-input" id="cabinet-part" name="checkout_user_building" value="<?php echo $checkout_user_building;?>" data-a-value="<?php echo $checkout_user_building;?>">
                </div>
            </div>

            <div class="checkout-block__form-row">
                <div class="input-col w6">
                    <label for="cabinet-flat">Квартира:</label>
                    <input type="text" class="text-input" id="cabinet-flat" name="checkout_user_apartment" value="<?php echo $checkout_user_apartment;?>" data-a-value="<?php echo $checkout_user_apartment;?>">
                </div>

                <div class="input-col w6">
                    <label for="cabinet-part-2">Подьезд:</label>
                    <input type="text" class="text-input" id="cabinet-part-2" name="checkout_user_entrance" value="<?php echo $checkout_user_entrance;?>" data-a-value="<?php echo $checkout_user_entrance;?>">
                </div>
            </div>

            <div class="input-col">
                <label for="tel-cabinet">Комментарий:</label>
                <textarea class="textarea-input" name="order_comments" data-a-value="<?php echo $order_comments;?>"><?php echo $order_comments;?></textarea>
            </div>


        </div>
    </div>
    <div id="order_review" class="woocommerce-checkout-review-order">
        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
    </div>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>

<?php endif; ?>