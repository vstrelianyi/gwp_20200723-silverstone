<?php

// ajax get_products
add_action('wp_ajax_landing_form', 'landing_form');
add_action('wp_ajax_nopriv_landing_form', 'landing_form');

function landing_form(){

    if( !wp_verify_nonce($_POST['nonce'], 'landing_form') ){
        exit;
    }

    $phone = !empty($_POST['landing_phone']) && is_string($_POST['landing_phone']) ? wc_clean($_POST['landing_phone']) : '';
    $name  = !empty($_POST['landing_name']) && is_string($_POST['landing_name']) ? wc_clean($_POST['landing_name']) : '';
    $email = !empty($_POST['landing_email']) && is_string($_POST['landing_email']) ? sanitize_email($_POST['landing_email']) : '';
    $form = !empty($_POST['form_type']) && is_string($_POST['form_type']) ? wc_clean($_POST['form_type']) : '';

    $recipients = explode( ',', fw_get_db_settings_option('manager_email'));
    $copy_to = explode( ',', fw_get_db_settings_option('manager_email_copy'));

    if(!empty($copy_to)){
        $bcc_email = '';
        foreach ($copy_to as $key => $to_email){
            $bcc_email .= $to_email.',';
        }
        $bcc_email = rtrim($bcc_email,',');
        $headers[] = 'Bcc: '.$bcc_email.PHP_EOL;
    }

    $message = get_email_template('landing_form.php', ['name' => $name, 'phone' => $phone, 'email' => $email]);

    $headers[]= "Content-Type: text/html;";

    $result = wp_mail( $recipients, $form.' '.date('Y-m-d H:i'), $message, $headers);

    if($result){
        echo 'success';
    }
    else{
        echo 'error';
    }

    wp_die();
}
