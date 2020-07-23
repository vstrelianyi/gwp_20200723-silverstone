<?php

    add_action('wp_ajax_ssf_get_cart_count', 'ssf_get_cart_count');
    add_action('wp_ajax_nopriv_ssf_get_cart_count', 'ssf_get_cart_count');

    function ssf_get_cart_count(){
        echo WC()->cart->get_cart_contents_count();
        wp_die();
    }