<?php

/* My account customization */

/*----------------------------------------------------------------------------*/
// redirects for login / logout
/*----------------------------------------------------------------------------*/


    add_action('wp_logout','logout_redirect');

    function logout_redirect(){
        wp_redirect( home_url() );
        exit;
    }

    // add_action('template_redirect', function(){
    //     if( is_account_page() && !is_user_logged_in() ){
    //         wp_redirect(home_url());
    //         exit;
    //     }
    // });

    add_action('template_redirect', function(){
        if( is_account_page() && !is_user_logged_in() &&!is_wc_endpoint_url( 'lost-password' ) ){
            wp_redirect(home_url());
            exit;
        }
    });

    

    // add active class to account menu item instead of is-active, other remove
    add_filter('woocommerce_account_menu_item_classes', function($classes){
        if(in_array('is-active', $classes)){
            return array('active');
        }
        return array();
    });


    require_once __DIR__.DIRECTORY_SEPARATOR.'add-reset-password-page.php';
    require_once __DIR__.DIRECTORY_SEPARATOR.'edit-my-account-nav-menu.php';

