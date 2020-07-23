<?php

add_filter( 'woocommerce_checkout_fields' , 'custom_remove_woo_checkout_fields' );

function custom_remove_woo_checkout_fields( $fields ) {

    // remove billing fields
//    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);

    $fields['billing']['billing_first_name']['required'] = false;

    unset($fields['billing']['billing_company']);
//    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
//    unset($fields['billing']['billing_city']);
    // unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']['required']);
    unset($fields['billing']['billing_state']);
//    unset($fields['billing']['billing_phone']);
//    unset($fields['billing']['billing_email']);

    //unset($fields['account']['account_password']);
    //unset($fields['account']['account_password-2']);

//     remove shipping fields
    unset($fields['shipping']['shipping_first_name']);
    unset($fields['shipping']['shipping_last_name']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_1']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['shipping']['shipping_city']);
    unset($fields['shipping']['shipping_postcode']);
    unset($fields['shipping']['shipping_country']);
    unset($fields['shipping']['shipping_state']);

    // remove order comment fields
//    unset($fields['order']['order_comments']);


    return $fields;
}

add_filter('woocommerce_process_checkout_field_billing_address_1',function ($value){

    $checkout_street = !empty($_POST['checkout_street']) ? wc_clean($_POST['checkout_street']) : '';
    $checkout_house_number = !empty($_POST['checkout_house_number']) ? wc_clean($_POST['checkout_house_number']) : '';
    $checkout_user_building = !empty($_POST['checkout_user_building']) ? wc_clean($_POST['checkout_user_building']) : '';
    $checkout_user_apartment = !empty($_POST['checkout_user_apartment']) ? wc_clean($_POST['checkout_user_apartment']) : '';
    $checkout_user_entrance = !empty($_POST['checkout_user_entrance']) ? wc_clean($_POST['checkout_user_entrance']) : '';

    $address = $checkout_street;
    $address .= ' '.(!empty($checkout_house_number) ? 'дом '.$checkout_house_number : '');
    $address .= ', '.(!empty($checkout_user_building) ? 'корпус '.$checkout_user_building : '');
    $address .= ', '.(!empty($checkout_user_entrance) ? 'подъезд '.$checkout_user_entrance : '');
    $address .= ', '.(!empty($checkout_user_apartment) ? 'квартира '.$checkout_user_apartment.'.' : '');

    return $address;
});

add_filter('woocommerce_process_checkout_field_billing_email',function ($value){

    $user = wp_get_current_user();

    /** @var WP_User $user */

    if($user->exists() && empty($value)){
        return $user->user_email;
    }

    return $value;
});

add_filter('woocommerce_checkout_update_customer_data', '__return_false');