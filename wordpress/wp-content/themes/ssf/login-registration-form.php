<div class="popup-block login-popup__popup-block" id="auth-popup">
    <div class="popup-block__overlay login-popup__popup-overlay">
        <div class="popup-block__popup login-popup">
            <div class="inner-content">
                <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>

                <div class="login-popup__top-tabs">
                    <a href="javascript:;" data-toggle="tab" data-target="#auth-reg" class="login-popup__tab-item">
                        <span>Регистрация</span>
                    </a>

                    <a href="javascript:;" data-toggle="tab" data-target="#auth-login" class="login-popup__tab-item active">
                        <span>Вход</span>
                    </a>
                </div>

                <div class="login-popup__tabs-content-wrap">
                    <div class="login-popup__tab-pane" id="auth-reg">
                        <div class="inner-content">
                            <div class="login-popup__form-title">Регистрация</div>

                            <form class="login-popup__form" id="ssf_ajax_register_form">
                                <div class="input-col">
                                    <label for="auth-reg-name">Имя:</label>

                                    <div class="input-wrapper with-addon">
                                        <input name="ssf_username" type="text" class="text-input" id="auth-reg-name">
                                        <div class="input-addon"><i class="icon-user"></i></div>
                                    </div>
                                </div>

                                <div class="input-col">
                                    <label for="auth-reg-email">E-mail:</label>

                                    <div class="input-wrapper with-addon">
                                        <input name="ssf_email" type="email" class="text-input" id="auth-reg-email" required>
                                        <div class="input-addon"><i class="icon-email"></i></div>
                                    </div>
                                </div>

                                <div class="input-col">
                                    <label for="auth-reg-tel">Телефон:</label>

                                    <div class="input-wrapper with-addon">
                                        <input name="ssf_tel" type="tel" class="text-input" id="auth-reg-tel">
                                        <div class="input-addon"><i class="icon-form-tel"></i></div>
                                    </div>
                                </div>

                                <div class="input-col">
                                    <label for="auth-reg-password">Пароль:</label>

                                    <div class="input-wrapper with-addon">
                                        <input name="ssf_password" type="password" class="text-input" id="auth-reg-password" required>
                                        <div class="input-addon"><i class="icon-lock"></i></div>
                                    </div>
                                </div>

                                <div class="input-col">
                                    <label for="auth-reg-password-2">Повторите пароль:</label>

                                    <div class="input-wrapper">
                                        <input name="ssf_password_confirm" type="password" class="text-input" id="auth-reg-password-2" required>
                                    </div>
                                </div>

                                <div class="input-col ajax-error-message" style="color:red;display: none" >
                                    <label for="auth-reg-password-2" style="color:red;">Ошибка:</label>

                                    <p style="font-size: 14px; padding-left: 10px;"></p>
                                </div>

                                <div class="checkbox-wrapper">
                                    <input type="checkbox" checked id="auth-reg-agree">
                                    <label for="auth-reg-agree">Согласен с <a href="#">политикой обработки персональных данных</a></label>
                                </div>

                                <button name="ssf_ajax_registration" type="submit" value="register" class="btn login-popup__submit ssf_ajax_login_registration_submit">Зарегистрироваться</button>

                                <?php wp_nonce_field( 'ssf_ajax_registration_login', 'ssf_ajax_registration_nonce');?>

                            </form>
                        </div>
                    </div>

                    <div class="login-popup__tab-pane active" id="auth-login">
                        <div class="inner-content">
                            <div class="login-popup__form-title">Вход</div>

                            <form class="login-popup__form" method="POST" id="ssf_ajax_login_form">
                                <div class="input-col">
                                    <label for="auth-login-email">E-mail:</label>

                                    <div class="input-wrapper with-addon">
                                        <input type="email" name="ssf_username" class="text-input" id="auth-login-email" required>
                                        <div class="input-addon"><i class="icon-email"></i></div>
                                    </div>
                                </div>

                                <div class="input-col">
                                    <label for="auth-login-password">Пароль:</label>

                                    <div class="input-wrapper with-addon">
                                        <input type="password" name="ssf_password" class="text-input" id="auth-login-password" required>
                                        <div class="input-addon"><i class="icon-lock"></i></div>
                                    </div>
                                </div>

                                <div class="input-col ajax-error-message" style="color:red;display: none" >
                                    <label for="auth-reg-password-2" style="color:red;">Ошибка:</label>

                                    <p style="font-size: 14px; padding-left: 10px;"></p>
                                </div>
                                <a class="text-link" href="<?php echo wp_lostpassword_url(); ?>">
                                    Забыли пароль?
                                </a>
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" checked id="auth-login-agree">
                                    <label for="auth-login-agree">Запомнить меня</a></label>
                                </div>

                                <button type="submit" class="btn login-popup__submit ssf_ajax_login_registration_submit">Вход</button>

                                <?php wp_nonce_field( 'ssf_ajax_registration_login', 'ssf_ajax_login_nonce');?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>