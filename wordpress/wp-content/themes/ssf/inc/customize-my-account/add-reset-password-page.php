<?php
/**
* @snippet       WooCommerce Add New Tab @ My Account
* @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
* @sourcecode    https://businessbloomer.com/?p=21253
* @credits       https://github.com/woothemes/woocommerce/wiki/2.6-Tabbed-My-Account-page
* @author        Rodolfo Melogli
* @testedwith    WooCommerce 3.4.5
*/


// ------------------
// 1. Register new endpoint to use for My Account page
// Note: Resave Permalinks or it will give 404 error

function ssf_add_reset_password_endpoint() {
    add_rewrite_endpoint( 'reset-password', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'ssf_add_reset_password_endpoint' );


// ------------------
// 2. Add new query var

function ssf_add_reset_password_query_vars( $vars ) {
    $vars[] = 'reset-password';
    return $vars;
}

add_filter( 'query_vars', 'ssf_add_reset_password_query_vars', 0 );


// ------------------
// 3. Insert the new endpoint into the My Account menu

function ssf_add_reset_password_link_my_account( $items ) {
    $items['reset-password'] = 'Изменить пароль';
    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'ssf_add_reset_password_link_my_account' );


// ------------------
// 4. Add content to the new endpoint

function ssf_reset_password_content() {

    wc_get_template( 'myaccount/reset-password.php' );
}

add_action( 'woocommerce_account_reset-password_endpoint', 'ssf_reset_password_content' );
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format


function ssf_reset_password_endpoint_title($title){
    return 'Изменить пароль';
}
add_filter( 'woocommerce_endpoint_reset-password_title', 'ssf_reset_password_endpoint_title' );


function add_endpoint_reset_pass_vars($d){
    $result = array_merge($d, ['reset-password' => 'reset-password']);
    return $result;
}
// Woocommerce Hook - Add query variable for user's banked hours purchase history
add_filter('woocommerce_get_query_vars', 'add_endpoint_reset_pass_vars', 0);

