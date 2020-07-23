<?php /* Template Name: Landing_template */


get_header('landing');

?>
    <header class="page-header">
        <div class="container">
            <div class="page-header__row">
                <div class="page-header__logo">
                    <a href="<?php echo home_url();?>">
                        <img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/main-logo.svg" alt="">
                    </a>
                </div>
                <div class="page-header__description">Лидирующий производитель <br>автомобильной продукции в России и СНГ</div>
                <div class="page-header__tel-block">
                    <a href="tel:<?php echo preg_replace( '/[^0-9]/', '', fw_get_db_settings_option('phone'));?>" class="tel-link"><?php echo fw_get_db_settings_option('phone');?></a>
                    <div class="opt-list">
                        <div class="item">Бесплатно по РФ</div>
                        <div class="item"><?php echo fw_get_db_settings_option('working_hours');?></div>
                    </div>
                </div>
                <a href="javascript:;" data-toggle="modal" data-target="#callback-popup" class="page-header__callback-button">
                    <span>Вам перезвонить?</span>
                    <span class="tel-circle"><i class="icon-phone"></i></span>
                </a>
            </div>
        </div>
    </header>

    <div class="first-block">
        <div class="container">
            <div class="first-block__content">
                <div class="title">Станьте дилером <br>компаний Silverstone F1</div>
                <div class="description">Получайте прибыль от реализации нашей продукции на территории всего СНГ</div>
                <a href="javascript:;" data-toggle="anchor" data-target="#form-block" class="btn">Стать партнером</a>
            </div>

            <div class="first-block__man-img"></div>

            <div class="first-block__advantages">
                <div class="item">
                    <div class="item-icon"><i class="icon-hands"></i></div>
                    <div class="item-content">
                        <div class="title">Соблюдение договоренностей</div>
                        <div class="descr">Всегда работаем честно и исполняем обязательства в срок</div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-icon"><i class="icon-wallet"></i></div>
                    <div class="item-content">
                        <div class="title">Лучшая цена продукции</div>

                        <div class="descr">Минимальная цена и выгодная маржа на качественный продукт </div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-icon"><i class="icon-percent"></i></div>
                    <div class="item-content">
                        <div class="title">Процент с региона</div>
                        <div class="descr">Эксклюзивные условия для региональных представителей</div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-icon"><i class="icon-delivery"></i></div>
                    <div class="item-content">
                        <div class="title">Регулярные поставки</div>
                        <div class="descr">Товар всегда в срок, никаких повреждений и минимум брака</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="second-block">
        <div class="container">
            <div class="second-block__map-block"><img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/second-block-map.png" alt=""></div>
            <div class="second-block__content">
                <p>Более 200-х компаний выбрали «Silverstone F1» в качестве производителя и поставщика автомобильной продукции.</p>
                <p>Мы сотрудничаем с самыми крупными федеральными сетями, а также с пока еще небольшими предпринимателями.</p>
                <a href="javascript:;" data-toggle="anchor" data-target="#form-block" class="btn">Стать партнером</a>
            </div>
        </div>
    </div>

    <div class="conditions">
        <div class="container">
            <div class="conditions__top-block">
                <div class="item">
                    <div class="item-icon">
                        <img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/icons/camera.svg" alt="">
                    </div>
                    <div class="item-content">
                        <div class="title">Комбо-устройства</div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-icon">
                        <img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/icons/radar.svg" alt="">
                    </div>
                    <div class="item-content">
                        <div class="title">Радар-детекторы</div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-icon">
                        <img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/icons/dvr.svg" alt="">
                    </div>
                    <div class="item-content">
                        <div class="title">Видеорегистраторы</div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-icon">
                        <img class="sm-ico" src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/icons/parking-radar.svg" alt="">
                    </div>
                    <div class="item-content">
                        <div class="title">Парктроники</div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-icon">
                        <img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/icons/car-sensors.svg" alt="">
                    </div>
                    <div class="item-content">
                        <div class="title">Камеры и мониторы</div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-icon">
                        <img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/icons/lenses.svg" alt="">
                    </div>
                    <div class="item-content">
                        <div class="title">Линзы</div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-icon">
                        <img class="sm-ico" src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/icons/fara.svg" alt="">
                    </div>
                    <div class="item-content">
                        <div class="title">Автолампы</div>
                    </div>
                </div>
            </div>

            <div class="brand-title">Особые условия для наших дилеров</div>

            <div class="conditions__list brand-mobile-slider">
                <div class="conditions__item">
                    <div class="inner">
                        <div class="item-icon">
                            <i class="icon-garanty"></i>
                        </div>
                        <div class="item-content">
                            <div class="title">Гарантия Качества</div>
                            <div class="descr">Оригинальная продукция собственного производства. 12 месяцев гарантии. Профессиональный сервисный центр</div>
                        </div>
                    </div>
                </div>

                <div class="conditions__item">
                    <div class="inner">
                        <div class="item-icon">
                            <i class="icon-turnback"></i>
                        </div>
                        <div class="item-content">
                            <div class="title">Возврат без проблем</div>
                            <div class="descr">Быстро и удобно заменим бракованный товар или без вопросов вернем за него деньги. Никаких проблем и длительного ожидания</div>
                        </div>
                    </div>
                </div>

                <div class="conditions__item">
                    <div class="inner">
                        <div class="item-icon">
                            <i class="icon-percetages"></i>
                        </div>
                        <div class="item-content">
                            <div class="title">Индивидуальные скидки</div>
                            <div class="descr">К каждому дилеру индивидуальный подход. Значительные скидки постоянным партнерам. Лучшие цены с максимальной для Вас маржой</div>
                        </div>
                    </div>
                </div>

                <div class="conditions__item">
                    <div class="inner">
                        <div class="item-icon">
                            <i class="icon-free-delivery"></i>
                        </div>
                        <div class="item-content">
                            <div class="title">Бесплатная доставка</div>
                            <div class="descr">Бесплатно привезем товар в ваш магазин в Москве или сами отгрузим заказ в отделение любой транспортной компании</div>
                        </div>
                    </div>
                </div>

                <div class="conditions__item item-get-offer">
                    <a href="javascript:;" data-toggle="anchor" data-target="#form-block" class="conditions__get-offer">
                        <span class="item-icon"><i class="icon-percernatage-main"></i></span>
                        <span class="item-title">Получить<br> персональное предложение прямо сейчас</span>
                    </a>
                </div>

                <div class="conditions__item">
                    <div class="inner">
                        <div class="item-icon">
                            <i class="icon-delivery2"></i>
                        </div>
                        <div class="item-content">
                            <div class="title">Любой объем</div>
                            <div class="descr">Собственное современное производство обеспечит вас бесперебойными поставками продукции любого объема</div>
                        </div>
                    </div>
                </div>

                <div class="conditions__item">
                    <div class="inner">
                        <div class="item-icon">
                            <i class="icon-girl"></i>
                        </div>
                        <div class="item-content">
                            <div class="title">Опытная поддержка</div>
                            <div class="descr">Мы производим и поставляем автомобильную продукцию уже более 10-ти лет. Полностью поделимся с вами всем нашим опытом</div>
                        </div>
                    </div>
                </div>

                <div class="conditions__item">
                    <div class="inner">
                        <div class="item-icon">
                            <i class="icon-man"></i>
                        </div>
                        <div class="item-content">
                            <div class="title">Личный менеджер</div>
                            <div class="descr">За каждым клиентом закрепляется персональный менеджер. Он всегда поможет вам по всем вопросам</div>
                        </div>
                    </div>
                </div>

                <div class="conditions__item">
                    <div class="inner">
                        <div class="item-icon">
                            <i class="icon-hands"></i>
                        </div>
                        <div class="item-content">
                            <div class="title">Долгосрочные отношения</div>
                            <div class="descr">Мы уважаем и ценим каждого партнера и выстраиваем максимально длительные и обоюдно выгодные отношения</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="partners">
        <div class="container">
            <div class="brand-title">Наши надежные партнеры</div>
            <div class="partners__list brand-mobile-slider">
                <a href="https://merlion.com/" target="_blank" class="partners__item">
					<span class="inner">
						<span class="item-logo"><img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/merlion.png" alt=""></span>
						<span class="item-content">
							<span class="descr">Крупнейший российский дистрибьютор компьютерной и цифровой техники, сетевого и офисного оборудования</span>
						</span>
					</span>
                </a>

                <a href="https://www.citilink.ru/" target="_blank" class="partners__item">
					<span class="inner">
						<span class="item-logo citilink"><img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/citilink.png" alt=""></span>
						<span class="item-content">
							<span class="descr">Один из крупнейших российских магазинов онлайн-торговли. Более 50 000 товаров представленнокаталоге.</span>
						</span>
					</span>
                </a>

                <a href="http://www.auto49.ru" target="_blank" class="partners__item">
					<span class="inner">
						<span class="item-logo"><img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/avto-49.png" alt=""></span>
						<span class="item-content">
							<span class="descr">Федеральная сеть магазинов автомобильной продукции, присутствующая в 40 городах европейской части Росии</span>
						</span>
					</span>
                </a>

                <a href="http://www.sotmarket.ru" target="_blank" class="partners__item">
					<span class="inner">
						<span class="item-logo"><img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/sotmarket.png" alt=""></span>
						<span class="item-content">
							<span class="descr">Один из крупнейших интернет-магазинов электроники в России с каталогом товаров на 12 000 позиций</span>
						</span>
					</span>
                </a>
            </div>
        </div>
    </div>

    <div class="statistics">
        <div class="container">
            <div class="brand-title">Немного нашей <br>статистики <br>за 2017 год</div>

            <div class="statistics__list">
                <div class="statistics__item">
                    <div class="num-block"><span class="count-block">700,000</span> +</div>

                    <div class="descr">Всего произведено и реализовано товаров</div>
                </div>

                <div class="statistics__item">
                    <div class="num-block"><span class="count-block">320,000</span> +</div>

                    <div class="descr">Новых покупателей<br>и клиентов</div>
                </div>

                <div class="statistics__item">
                    <div class="num-block"><span class="count-block">100,000</span> +</div>

                    <div class="descr">Заказов мы выполнили<br>в нашем магазине</div>
                </div>

                <div class="statistics__item">
                    <div class="num-block"><span class="count-block">63</span></div>

                    <div class="descr">Партнера присоеденились<br>к дилерской сети</div>
                </div>
            </div>
        </div>
    </div>

    <div class="become-dealer" id="form-block">
        <div class="container">
            <div class="brand-title">Станьте дилером <br><span class="accent">Silverstone F1</span> прямо сейчас</div>

            <div class="become-dealer__row">
                <form class="become-dealer__form">
                    <div class="inner">
                        <div class="form-title">Заполните форму</div>

                        <div class="input-wrapper">
                            <div class="input-addon"><i class="icon-user"></i></div>
                            <input type="text" class="text-input" placeholder="Введите ваше имя" name="landing_name" required>
                        </div>

                        <div class="input-wrapper">
                            <div class="input-addon"><i class="icon-mail"></i></div>
                            <input type="email" class="text-input" placeholder="Введите ваш email" name="landing_email" required>
                        </div>

                        <div class="input-wrapper">
                            <div class="input-addon"><i class="icon-phone-2"></i></div>
                            <input type="tel" class="text-input" placeholder="Введите ваш телефон" name="landing_phone" required>
                        </div>

                        <input type="hidden" name="form_type" value="Стать партнером">

                        <button type="submit" class="btn submit-button">Стать партнером</button>

                        <div class="checkbox-wrapper">
                            <input type="checkbox" checked hidden id="become-dealer-check">

                            <label for="become-dealer-check">
                                <span>Я принимаю условия <a href="#">Пользовательского соглашения</a> и согласен на обработку персональных данных</span>
                            </label>
                        </div>
                    </div>
                </form>

                <div class="become-dealer__process">
                    <div class="become-dealer__process-item">
                        <div class="inner">
                            <div class="item-icon"><i class="icon-document"></i></div>

                            <div class="item-content">Внимательно и достоверно заполните форму</div>
                        </div>

                        <div class="impulse"></div>
                    </div>

                    <div class="become-dealer__process-item">
                        <div class="inner">
                            <div class="item-icon"><i class="icon-read"></i></div>

                            <div class="item-content">Обсудите с менеджером индивидуальные условия</div>
                        </div>
                    </div>

                    <div class="become-dealer__process-item">
                        <div class="inner">
                            <div class="item-icon"><i class="icon-sign"></i></div>

                            <div class="item-content">Подпишите договор</div>
                        </div>
                    </div>

                    <div class="become-dealer__process-item">
                        <div class="inner">
                            <div class="item-icon"><i class="icon-discuss"></i></div>

                            <div class="item-content">Сделайте заказ у личного менеджера</div>
                        </div>
                    </div>

                    <div class="become-dealer__process-item">
                        <div class="inner">
                            <div class="item-icon"><i class="icon-get-good"></i></div>

                            <div class="item-content">Примите продукцию <br>на свой склад</div>
                        </div>
                    </div>

                    <div class="become-dealer__process-item">
                        <div class="inner">
                            <div class="item-icon"><i class="icon-money"></i></div>

                            <div class="item-content">Реализуй товар и получай прибыль!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer">
        <div class="container">
            <div class="page-footer__row">
                <div class="page-footer__left">
                    <div class="footer-logo"><img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/main-logo-white.svg" alt=""></div>
                    <div class="descr">Лидирующий производитель автомобильной продукции <br>в России и СНГ</div>
                </div>
                <div class="page-footer__center">ИП Манников Александр<br>ИНН 504010712262<br>ОГРНИП 312504015600043</div>
                <div class="page-footer__right">Россия, г. Москва, 117574,<br>пр-д Одоевского, д. 2А, <br>гск. «Голубино» </div>
            </div>
            <div class="page-footer__copyright">
                Copyright © 2008-2018, Silverstone F1. <br>Все права защищены.
            </div>
        </div>
    </footer>

    <div class="callback-popup__preload"><img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/callback-bg.png" alt=""></div>

    <div class="popup-block" id="callback-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="popup-block__overlay">
            <div class="popup-block__popup callback-popup">
                <div class="inner-content">
                    <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>

                    <div class="popup-block__title">Вам перезвонить?</div>

                    <form class="callback-popup__form">
                        <div class="input-wrapper">
                            <div class="input-addon"><i class="icon-user"></i></div>
                            <input type="text" class="text-input" placeholder="Введите ваше имя" name="landing_name" required>
                        </div>

                        <div class="input-wrapper">
                            <div class="input-addon"><i class="icon-phone-2"></i></div>
                            <input type="tel" class="text-input" placeholder="Введите ваш телефон" name="landing_phone" required>
                        </div>

                        <input type="hidden" name="form_type" value="Вам перезвонить?">

                        <button type="submit" class="btn submit-button">Заказать звонок</button>

                        <div class="bottom-caption">Нажав на кнопку «Заказать звонок», вы автоматически соглашаетесь на <a href="#">обработку персональных данных.</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-block" id="thanks-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="popup-block__overlay">
            <div class="popup-block__popup thanks-popup">
                <div class="inner-content">
                    <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>
                    <div class="thanks-icon"><img src="<?php echo get_template_directory_uri();?>/separate_landing_page/img/icons/success-ico.svg" alt=""></div>
                    <div class="popup-block__title">Ваша заявка успешно принята!</div>
                    <div class="popup-block__caption">Мы свяжемся с вами в ближайшее время.</div>
                </div>
            </div>
        </div>
    </div>

<?php

get_footer('landing');

