<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$user = wp_get_current_user();
//dump($user);

global $woocommerce, $SsfFormErrors;
$woo_user = $woocommerce->customer;

//dump($woo_user);

//dump($woo_user);

$ssf_user_first_name = $woo_user->get_billing_first_name();
$ssf_user_last_name = $woo_user->get_billing_last_name();
$ssf_user_email = $woo_user->email;
$ssf_user_phone = $woo_user->get_billing_phone();

//dump(WC()->session->get_session_data());

?>

    <div class="cabinet-block__main-heading">Личные данные</div>

    <form class="cabinet-block__form" method="POST">
        <div class="input-col">
            <label for="last-name">Фамилия:</label>

            <input type="text" class="text-input" id="last-name" value="<?php echo esc_attr($ssf_user_last_name);?>" name="last_name">
        </div>

        <div class="input-col">
            <label for="first-name">Имя:</label>

            <input type="text" class="text-input" id="first-name" value="<?php echo esc_attr($ssf_user_first_name);?>" name="first_name">
        </div>

        <div class="input-col">
            <label for="email-cabinet">E-mail:</label>

            <div class="input-wrapper with-addon<?php echo $SsfFormErrors->hasError('account_email') ? ' error' : '';?>">
                <input type="email" class="text-input" id="email-cabinet" name="account_email" value="<?php echo esc_attr($ssf_user_email);?>" required>
                <div class="input-addon"><i class="icon-email"></i></div>
            </div>
            <?php
            if($SsfFormErrors->hasError('account_email')){
                echo '<div class="error-message">';
                foreach ($SsfFormErrors->getErrors('account_email') as $error){
                    echo '<p>'.$error.'</p>';
                }
                echo '</div>';
            }
            ?>
        </div>

        <div class="input-col">
            <label for="tel-cabinet">Телефон:</label>

            <div class="input-wrapper with-addon">
                <input type="tel" class="text-input" id="tel-cabinet" value="<?php echo esc_attr($ssf_user_phone);?>" name="phone">
                <div class="input-addon"><i class="icon-form-tel"></i></div>
            </div>
        </div>


        <button type="submit" class="btn cabinet-block__submit-button">Сохранить</button>

        <?php SSF_Form_Handler::serviceFields('ssf_update_personal_data');?>

    </form>