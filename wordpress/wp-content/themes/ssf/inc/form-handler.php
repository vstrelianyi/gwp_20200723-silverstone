<?php

if ( !class_exists( 'WooCommerce' ) ) {
    return;
}

require_once 'google-recaptcha.php';

// Global variable with SSF_Form_Errors class item;
$SsfFormErrors = new SSF_Form_Errors;

$SsfGoogleRecaptcha = new SSF_Google_Recaptcha;


class SSF_Form_Handler{


    public $forms = [

        'ssf_update_personal_data',

    ];


    public static function init(){

        add_action( 'template_redirect', array( __CLASS__, 'update_personal_data' ) );
        add_action( 'template_redirect', array( __CLASS__, 'change_password' ) );
        add_action( 'template_redirect', array( __CLASS__, 'change_address' ) );
        add_action( 'template_redirect', array( __CLASS__, 'add_camera' ) );
        add_action( 'template_redirect', array( __CLASS__, 'become_dealer' ) );
        add_action( 'template_redirect', array( __CLASS__, 'need_help' ) );
        add_action( 'template_redirect', array( __CLASS__, 'buy_in_one_click' ) );
    }

    public static function errorsHandler(){
        global $SsfFormErrors;
        return $SsfFormErrors;
    }

    public static function googleRecaptcha() {
        global $SsfGoogleRecaptcha;
        return $SsfGoogleRecaptcha;
    }

    public static function checkRequestDist($form){
        if( 'POST' == strtoupper( $_SERVER['REQUEST_METHOD'] ) && !empty( $_POST['action'] ) && $_POST['action'] == $form ){
            $nonce = !empty($_REQUEST[$form.'_nonce']) ? $_REQUEST[$form.'_nonce'] : '';
            if( wp_verify_nonce($nonce, $form) ){
                return true;
            }
        }
        return false;
    }

    public static function serviceFields($form){
        wp_nonce_field($form, $form.'_nonce');
        echo '<input type="hidden" name="action" value="'.$form.'" />';
        self::googleRecaptcha()->add_field();
    }


    public static function update_personal_data(){
        if( ! self::checkRequestDist('ssf_update_personal_data') ){
            return;
        }

        wc_nocache_headers();

        $account_email = ! empty( $_POST['account_email'] ) ? substr( sanitize_email( wc_clean( $_POST['account_email'] ) ), 0, 100) : '';
        $first_name = ! empty( $_POST['first_name'] ) ? substr( wc_clean( $_POST['first_name'] ), 0, 100) : '';
        $last_name = ! empty( $_POST['last_name'] ) ? substr( wc_clean( $_POST['last_name'] ), 0, 100) : '';
        $phone = ! empty( $_POST['phone'] ) ? substr( wc_clean( $_POST['phone'] ), 0 ,100) : '';

        $current_user = wp_get_current_user();
        $customer = new WC_Customer( $current_user->ID );

        // Email
        if( ! is_email($account_email) ){
            self::errorsHandler()->addError('account_email', 'Некорректный Емаил адрес');
        }
        elseif (email_exists($account_email) && ($current_user->user_email !== $account_email)){
            self::errorsHandler()->addError('account_email', 'Этот адрес электронной почты уже зарегистрирован.');
        }

        // try to save email;
        if( self::errorsHandler()->hasNoErrors() && ($current_user->user_email !== $account_email) ){
            $user = new stdClass();
            $user->ID = $current_user->ID;
            $user->user_email = $account_email;
            $result = wp_update_user( $user );

            if(is_wp_error($result)){
                self::errorsHandler()->addError('account_email', $result->get_error_message());
            }
            else{
                $customer->set_billing_email( $account_email );
                $customer->set_email( $account_email );
            }
        }

        if(self::errorsHandler()->hasNoErrors()){
            self::errorsHandler()->addSuccess('Данные успешно обновлены!');
        }

        $customer->set_billing_first_name( $first_name );
        $customer->set_shipping_first_name( $first_name );
        $customer->set_first_name( $first_name );

        $customer->set_billing_last_name( $last_name );
        $customer->set_shipping_last_name( $last_name );
        $customer->set_last_name( $last_name );

        $customer->set_billing_phone($phone);

        $customer->save();

        self::errorsHandler()->writeSession();
        wp_safe_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;
    }

    public static function change_password(){
        if( ! self::checkRequestDist('ssf_change_password') ){
            return;
        }

        wc_nocache_headers();

        $current_user = wp_get_current_user();

        $password = !empty($_POST['account_password']) && is_string($_POST['account_password']) ? $_POST['account_password'] : '';
        $new_password = !empty($_POST['account_new_password']) && is_string($_POST['account_new_password']) ? $_POST['account_new_password'] : '';
        $new_password_confirm = !empty($_POST['account_new_password_confirm']) && is_string($_POST['account_new_password_confirm']) ? $_POST['account_new_password_confirm'] : '';

        if( wp_check_password( $password, $current_user->user_pass, $current_user->ID ) ){

            if( strcmp($new_password,$new_password_confirm) !== 0 ){
                self::errorsHandler()->addError('account_new_password_confirm', 'Новый пароль и подтверждение не совпадают.');
            }elseif(mb_strlen($new_password) < 6){
                self::errorsHandler()->addError('account_new_password_confirm', 'Пароль должен содержать не мене 6 символов.');
            }

        }
        else{
            self::errorsHandler()->addError('account_password', 'Вы ввели неверный пароль от учетной записи');
        }

        if(self::errorsHandler()->hasNoErrors()){

            $user = new stdClass();
            $user->ID = $current_user->ID;
            $user->user_pass = $new_password;
            wp_update_user($user);

            self::errorsHandler()->addSuccess('Данные успешно обновлены!');
        }

        self::errorsHandler()->writeSession();
        wp_safe_redirect( wc_get_endpoint_url( 'reset-password', '', wc_get_page_permalink( 'myaccount' )) );
        exit;
    }

    public static function change_address(){
        if( ! self::checkRequestDist('ssf_update_address') ){
            return;
        }

        wc_nocache_headers();

        $var_names = ['user_state', 'billing_city', 'user_street', 'user_house_number', 'user_building', 'user_apartment', 'user_entrance', 'user_comment'];

        $vars = [];

        foreach ($var_names as $var_name){
            $vars[$var_name] = !empty($_POST[$var_name]) ? substr(wc_clean($_POST[$var_name]), 0, 100) : '';
        }

        extract($vars);

        $user_id = get_current_user_id();

        if($user_id == 0){
            return;
        }

        update_user_meta($user_id,'user_street', $user_street );
        update_user_meta($user_id,'user_house_number', $user_house_number );
        update_user_meta($user_id,'user_building', $user_building );
        update_user_meta($user_id,'user_apartment', $user_apartment );
        update_user_meta($user_id,'user_entrance', $user_entrance );
        update_user_meta($user_id,'user_comment', $user_comment );

        $customer = new WC_Customer($user_id);

        // Область
        $customer->set_billing_state($user_state);
        $customer->set_shipping_state($user_state);

        // Город
        $customer->set_billing_city($billing_city);
        $customer->set_shipping_city($billing_city);

        $address = $user_street;
        $address .= ' '.(!empty($user_house_number) ? 'дом '.$user_house_number : '');
        $address .= ', '.(!empty($user_building) ? 'корпус '.$user_building : '');
        $address .= ', '.(!empty($user_entrance) ? 'подъезд '.$user_entrance : '');
        $address .= ', '.(!empty($user_apartment) ? 'квартира '.$user_apartment.'.' : '');

        $customer->set_billing_address($address);
        $customer->set_shipping_address($address);

        $customer->save();

        self::errorsHandler()->addSuccess('Данные успешно обновлены!');

        self::errorsHandler()->writeSession();
        wp_safe_redirect( wc_get_endpoint_url( 'edit-address', '', wc_get_page_permalink( 'myaccount' )) );
        exit;
    }

    public static function add_camera(){
        if( ! self::checkRequestDist('add_camera') ){
            return;
        }

        $form_field_names = [ 'operation_type:string', 'camera_type:string', 'camera_model:string', 'camera_points:string', 'camera_region:string', 'camera_address:string', 'camera_coordinates:string', 'camera_direction:string', 'speed_limitation:string', 'camera_photo:file', 'camera_detector_model:string', 'base_version:string', 'camera_comment:string', 'ssf_name:string', 'ssf_email:string'];
        $form_fields = [];

        foreach ($form_field_names as $name){
            if(strpos($name, ':file') ){
                $name = str_replace(':file', '', $name);
                $form_fields[$name] = !empty($_FILES[$name]) ? $_FILES[$name] : null;
                continue;
            }
            if(strpos($name, ':string') ){
                $name = str_replace(':string', '', $name);
                $form_fields[$name] = !empty($_POST[$name]) && is_string($_POST[$name]) ? wc_clean($_POST[$name]) : '';
                continue;
            }
        }

        if(is_user_logged_in()){
            $user = wp_get_current_user();
            if($user instanceof WP_User){
                $form_fields['ssf_name'] = $user->first_name;
                $form_fields['ssf_email'] = $user->user_email;
            }
        }

        $attachments = [];
        if(!empty($form_fields['camera_photo']['tmp_name']) && is_array($form_fields['camera_photo']['tmp_name']) && 20 > count($form_fields['camera_photo']['tmp_name'])){
            foreach ($form_fields['camera_photo']['tmp_name'] as $key => $path){
                if(is_file($path) && filesize($path) < 3000000 && !is_executable($path)){
                    $file = array(
                        'name'     => isset($form_fields['camera_photo']['name'][$key]) ? $form_fields['camera_photo']['name'][$key] : '' ,
                        'type'     => isset($form_fields['camera_photo']['type'][$key]) ? $form_fields['camera_photo']['type'][$key] : '' ,
                        'tmp_name' => isset($form_fields['camera_photo']['tmp_name'][$key]) ? $form_fields['camera_photo']['tmp_name'][$key] : '' ,
                        'error'    => isset($form_fields['camera_photo']['error'][$key]) ? $form_fields['camera_photo']['error'][$key] : '' ,
                        'size'     => isset($form_fields['camera_photo']['size'][$key]) ? $form_fields['camera_photo']['size'][$key] : '' ,
                    );
                    $uploaded = wp_handle_upload($file, ['test_form' => FALSE]);
                    if(!empty($uploaded['file'])){
                        $attachments[] = $uploaded['file'];
                    }
                }
            }
        }

        $recipients = explode( ',', fw_get_db_settings_option('manager_email'));
        $copy_to = explode( ',', fw_get_db_settings_option('manager_email_copy'));

        if(!empty($copy_to)){
            $bcc_email = '';
            foreach ($copy_to as $key => $email){
                $bcc_email .= $email.',';
            }
            $bcc_email = rtrim($bcc_email,',');
            $headers[] = 'Bcc: '.$bcc_email.PHP_EOL;
        }


        $message = get_email_template('add_camera.php', $form_fields);

        $headers[]= "Content-Type: text/html;";

        $result = wp_mail( $recipients, 'form-'.date('Y-m-d H:i'), $message, $headers, $attachments);

        if(!empty($attachments)){
            foreach ($attachments as $file){
                wp_delete_file($file);
            }
        }

        if($result){
            self::errorsHandler()->addSuccess('Данные отправлены!');
            self::errorsHandler()->writeSession();
        }

        wc_nocache_headers();

        wp_redirect( (!empty($_POST['_wp_http_referer']) && is_string($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : '/') );

        exit();
    }

    public static function need_help(){
        add_action( 'wp_print_footer_scripts', function() {
            self::googleRecaptcha()->add_form_script( 'needhelp' );
        } );

        if( ! self::checkRequestDist('ssf_heed_help') || ! self::googleRecaptcha()->verify_response() ) {
            return;
        }

        $ssf1_email = !empty($_POST['ssf1_email']) && is_string($_POST['ssf1_email']) ? wc_clean($_POST['ssf1_email']) : '';
        $name = !empty($_POST['ssf_name']) && is_string($_POST['ssf_name']) ? wc_clean($_POST['ssf_name']) : '';

        $recipients = explode( ',', fw_get_db_settings_option('manager_email'));
        $copy_to = explode( ',', fw_get_db_settings_option('manager_email_copy'));

        if(!empty($copy_to)){
            $bcc_email = '';
            foreach ($copy_to as $key => $email){
                $bcc_email .= $email.',';
            }
            $bcc_email = rtrim($bcc_email,',');
            $headers[] = 'Bcc: '.$bcc_email.PHP_EOL;
        }

        $message = get_email_template('need_help.php', ['name' => $name, 'ssf1_email' => $ssf1_email]);

        $headers[]= "Content-Type: text/html;";

        $result = wp_mail( $recipients, 'form-'.date('Y-m-d H:i'), $message, $headers);

        if($result){
            self::errorsHandler()->addSuccess('Мы перезвоним в ближайшее время!');
            self::errorsHandler()->writeSession();
        }

        wc_nocache_headers();

        wp_redirect( (!empty($_POST['_wp_http_referer']) && is_string($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : '/') );

        exit();
    }

    public static function buy_in_one_click(){
        add_action( 'wp_print_footer_scripts', function() {
            self::googleRecaptcha()->add_form_script( 'buyinoneclick' );
        } );

        if( ! self::checkRequestDist('buy_in_one_click') || ! self::googleRecaptcha()->verify_response() ){
            return;
        }

        $phone = !empty($_POST['ssf_phone']) && is_string($_POST['ssf_phone']) ? substr( wc_clean($_POST['ssf_phone']), 0, 100) : '';
        $name = !empty($_POST['ssf_name']) && is_string($_POST['ssf_name']) ? substr( wc_clean($_POST['ssf_name']), 0, 100) : '';
        $email = ! empty( $_POST['ssf_email'] ) ? substr( sanitize_email( wc_clean( $_POST['ssf_email'] ) ), 0, 100) : '';

        $product_link = !empty($_POST['product_link']) ? esc_url($_POST['product_link']) : '';
        $product_name = !empty($_POST['product_name']) ? substr( wc_clean($_POST['product_name']),0,100) : '';

        $message = get_email_template('buy_in_one_click.php', compact('phone', 'name', 'email', 'product_link', 'product_name'));

        $recipients = explode( ',', fw_get_db_settings_option('manager_email'));
        $copy_to = explode( ',', fw_get_db_settings_option('manager_email_copy'));

        if(!empty($copy_to)){
            $bcc_email = '';
            foreach ($copy_to as $key => $email){
                $bcc_email .= $email.',';
            }
            $bcc_email = rtrim($bcc_email,',');
            $headers[] = 'Bcc: '.$bcc_email.PHP_EOL;
        }

        $headers[]= "Content-Type: text/html;";

        $result = wp_mail( $recipients, 'form-'.date('Y-m-d H:i'), $message, $headers);

        if($result){
            self::errorsHandler()->addSuccess('Мы перезвоним в ближайшее время!');
            self::errorsHandler()->writeSession();
        }

        wc_nocache_headers();

        wp_redirect( (!empty($_POST['_wp_http_referer']) && is_string($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : '/') );

        exit();
    }

    public static function become_dealer(){
        add_action( 'wp_print_footer_scripts', function() {
            self::googleRecaptcha()->add_form_script( 'becomedealer' );
        } );

        if( ! self::checkRequestDist('become_dealer') || ! self::googleRecaptcha()->verify_response() ){
            return;
        }

        $name = !empty($_POST['ssf_name']) && is_string($_POST['ssf_name']) ? wc_clean($_POST['ssf_name']) : '';
        $ssf_email = !empty($_POST['ssf_email']) && is_string($_POST['ssf_email']) ? wc_clean($_POST['ssf_email']) : '';
        $ssf_phone = !empty($_POST['ssf_phone']) && is_string($_POST['ssf_phone']) ? wc_clean($_POST['ssf_phone']) : '';
        $ssf_message = !empty($_POST['ssf_message']) && is_string($_POST['ssf_message']) ? wc_clean($_POST['ssf_message']) : '';

        $recipients = explode( ',', fw_get_db_settings_option('manager_email'));
        $copy_to = explode( ',', fw_get_db_settings_option('manager_email_copy'));

        if(!empty($copy_to)){
            $bcc_email = '';
            foreach ($copy_to as $key => $email){
                $bcc_email .= $email.',';
            }
            $bcc_email = rtrim($bcc_email,',');
            $headers[] = 'Bcc: '.$bcc_email.PHP_EOL;
        }

        $message = get_email_template('become_dealer.php', ['name' => $name, 'ssf_email' => $ssf_email, 'ssf_phone' => $ssf_phone, 'ssf_message' => $ssf_message]);


        $headers[]= "Content-Type: text/html;";

        $result = wp_mail( $recipients, 'form-'.date('Y-m-d H:i'), $message, $headers);

        if($result){
            self::errorsHandler()->addSuccess('Мы перезвоним в ближайшее время!');
            self::errorsHandler()->writeSession();
        }

        wc_nocache_headers();

    }
}


class SSF_Form_Errors{

    public $errors, $success;

    public $errors_session_var = 'ssf_form_handler_errors';
    public $success_session_var = 'ssf_form_handler_success';

    public $result_popup_id = 'result_popup';
    /**
     * SSF_Form_Errors constructor.
     * @param $errors
     */
    public function __construct()
    {
        // Start woocommerce session for not logged users
        add_action('woocommerce_init', function() {
            if (!is_user_logged_in() && !is_admin()) {
                if (!WC()->session->has_session()) {
                    WC()->session->set_customer_session_cookie(true);
                }
            }
        });
        add_action('wp_footer',[$this, 'render_with_success_popup']);
        add_action('wp_footer', [$this, 'clear_session_vars'], 9999999999);
    }


    public function hasAnyError(){
        return !empty($this->errors);
    }

    public function hasNoErrors(){
        return empty($this->errors);
    }

    public function hasError($input_name){
        $errors = WC()->session->get($this->errors_session_var);
        return !empty($errors[$input_name]);
    }
    public function getErrors($input_name){
        $errors = WC()->session->get($this->errors_session_var);
        return !empty($errors[$input_name]) && is_array($errors[$input_name]) ? $errors[$input_name] : [];
    }

    public function addError( $field_name, $message ){
        $this->errors[$field_name][] = $message;
    }

    public function addSuccess( $message ){
        $this->success = $message;
        return $this;
    }

    public function render_with_success_popup(){
        $success_message = $this->getSuccessMessage();
        if(empty($success_message)){
            return;
        }
    ?>
        <div class="popup-block" id="<?php echo $this->result_popup_id;?>">
            <div class="popup-block__overlay">
                <div class="popup-block__popup popup-block__success">
                    <div class="inner-content">
                        <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>
                        <div class="popup-block__success-icon"><i class="icon-success"></i></div>
                        <div class="popup-block__success-title"><?php echo $success_message;?></div>
    <!--					<div class="popup-block__success-caption"></div>-->
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.onload = function(){
                openModal('#<?php echo $this->result_popup_id;?>');
            };
        </script>
    <?php
    }

    public function getSuccessMessage(){
        $success = WC()->session->get($this->success_session_var);
        if (!empty($success)) {
            return WC()->session->get($this->success_session_var);
        }
        return '';
    }

    // Work with session
    public function writeSession(){
        WC()->session->set($this->errors_session_var, $this->errors);
        WC()->session->set($this->success_session_var, $this->success);
    }

    public function clear_session_vars(){
        WC()->session->set($this->errors_session_var, null);
        WC()->session->set($this->success_session_var, null);
    }
}

SSF_Form_Handler::init();

function get_email_template($template, $vars){

    $path = get_template_directory().DIRECTORY_SEPARATOR.'emails'.DIRECTORY_SEPARATOR.$template;

    if(!file_exists($path)){
        return;
    }

    extract($vars);

    ob_start();

    include $path;

    return ob_get_clean();
}


// SSF TODO send mails
//  # call manager
//  # call manager
