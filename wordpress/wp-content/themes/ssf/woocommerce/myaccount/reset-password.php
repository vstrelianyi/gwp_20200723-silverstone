<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $SsfFormErrors;

$u = wp_get_current_user();

//dump($u);


?>

<div class="cabinet-block__main-heading">Изменить пароль</div>
<form class="cabinet-block__form" method="POST">
    <div class="input-col">
        <label for="old-password">Текущий пароль:</label>
        <div class="input-wrapper with-addon<?php echo $SsfFormErrors->hasError('account_password') ? ' error' : '';?>">
            <input type="password" class="text-input" id="old-password" name="account_password" required>
            <div class="input-addon"><i class="icon-lock"></i></div>
        </div>
        <?php
        if($SsfFormErrors->hasError('account_password')){
            echo '<div class="error-message">';
            foreach ($SsfFormErrors->getErrors('account_password') as $error){
                echo '<p>'.$error.'</p>';
            }
            echo '</div>';
        }
        ?>
    </div>

    <div class="input-col">
        <label for="new-password">Новый пароль:</label>
        <input type="password" class="text-input<?php echo $SsfFormErrors->hasError('account_new_password') ? ' error' : '';?>" id="new-password" name="account_new_password" required>
        <?php
        if($SsfFormErrors->hasError('account_new_password')){
            echo '<div class="error-message">';
            foreach ($SsfFormErrors->getErrors('account_new_password') as $error){
                echo '<p>'.$error.'</p>';
            }
            echo '</div>';
        }
        ?>
    </div>

    <div class="input-col">
        <label for="new-password-2">Повторите новый пароль:</label>
        <input type="password" class="text-input<?php echo $SsfFormErrors->hasError('account_new_password_confirm') ? ' error' : '';?>" id="new-password-2" name="account_new_password_confirm" required>
        <?php
        if($SsfFormErrors->hasError('account_new_password_confirm')){
            echo '<div class="error-message">';
            foreach ($SsfFormErrors->getErrors('account_new_password_confirm') as $error){
                echo '<p>'.$error.'</p>';
            }
            echo '</div>';
        }
        ?>
    </div>

    <button type="submit" class="btn cabinet-block__submit-button">Сохранить</button>

    <?php SSF_Form_Handler::serviceFields('ssf_change_password');?>
</form>