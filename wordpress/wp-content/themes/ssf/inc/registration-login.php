<?php

    if(is_user_logged_in()){
        return;
    }

    function ssf_login_registration_form() {

       get_template_part('login-registration-form');
    }
    add_action('wp_footer','ssf_login_registration_form');


    add_action('wp_ajax_ssf_ajax_registration_login', 'ssf_ajax_registration_login', 0);
    add_action('wp_ajax_nopriv_ssf_ajax_registration_login', 'ssf_ajax_registration_login');

    function ssf_ajax_registration_login(){
        if( !empty($_REQUEST['ssf_ajax_registration_nonce']) && wp_verify_nonce($_REQUEST['ssf_ajax_registration_nonce'], 'ssf_ajax_registration_login') ){

            $username = !empty($_REQUEST['ssf_username']) ? $_REQUEST['ssf_username'] : '';
            $password = !empty($_REQUEST['ssf_password']) ? $_REQUEST['ssf_password'] : '';
            $password_confirm = !empty($_REQUEST['ssf_password_confirm']) ? $_REQUEST['ssf_password_confirm'] : '';
            $email = !empty($_REQUEST['ssf_email']) ? $_REQUEST['ssf_email'] : '';
            $phone = !empty($_REQUEST['ssf_tel']) ? $_REQUEST['ssf_tel'] : '';

            if ( strcmp( $password, $password_confirm ) !== 0 ) {
                echo json_encode(['result' => 'error', 'message' => 'Пароли не совпадают' ]);
                wp_die();
            }

            $new_customer = wc_create_new_customer( sanitize_email( $email ), '', $password );

            if ( is_wp_error( $new_customer ) ) {
                echo json_encode(['result' => 'error', 'message' => $new_customer->get_error_message()]);
               }
            else{

                $customer = new WC_Customer($new_customer);

                if(!empty($phone)) {
                    $customer->set_billing_phone(wc_clean($phone));
                }

                if(!empty($username)){
                    $customer->set_billing_first_name(wc_clean( $username ));
                    $customer->set_shipping_first_name(wc_clean( $username ));
                }

                $customer->set_billing_email($email);

                $customer->save();

                wc_set_customer_auth_cookie( $new_customer );
                echo json_encode(['result' => 'success']);
            }
        }
        if( !empty($_REQUEST['ssf_ajax_login_nonce']) && wp_verify_nonce($_REQUEST['ssf_ajax_login_nonce'], 'ssf_ajax_registration_login') ){

            $creds = array(
                'user_login'    => !empty($_POST['ssf_username']) ? trim( $_POST['ssf_username'] ) : '',
                'user_password' => !empty($_POST['ssf_password']) ? $_POST['ssf_password'] : '',
                'remember'      => isset( $_POST['rememberme'] ),
            );

            // Perform the login
            $user = wp_signon( apply_filters( 'woocommerce_login_credentials', $creds ), is_ssl() );

            if ( is_wp_error( $user ) ) {
                echo json_encode(['result' => 'error', 'message' => 'Неверный имя пользователя или пароль']);
            }
            else{
                echo json_encode(['result' => 'success']);
            }
        }
        wp_die();
    }

    add_action('wp_enqueue_scripts', function(){

        wp_enqueue_script('ajax-reg-login', get_template_directory_uri() .'/js/ajax-reg-login.js', array('jquery'), null, true );

    }, 999999);