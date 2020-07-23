<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

/**
 * @var array $atts
 */
?>
 <div class="company-first">
        <div class="company-first__row">
            <div class="company-first__part left-part">
                <div class="inner-content">
                    <div class="title">Качественный продукт для потребителя</div>
                    <div class="descr">Компания SilverStoneF1 - лидирующий российский разработчик и производитель широкого спектра инновационной автомобильной электроники.</div>
                    <a href="<?php the_permalink( wc_get_page_id( 'shop' ) );;?>" class="btn">Купить продукцию</a>
                </div>
            </div>
            <div class="company-first__center-line">
                <div class="line"></div>
                <div class="center-logo"><img src="<?php echo get_template_directory_uri()?>/assets/img/logo-part.svg" alt=""></div>
                <div class="line"></div>
            </div>
            <div class="company-first__part right-part">
                <div class="inner-content">
                    <div class="title">Надежность и высокий спрос для партнера</div>
                    <div class="descr">Сотни тысяч клиетов по всему миру пользуются нашим продуктом, а более 200 компаний выбрали нас в качестве партнера и поставщика.</div>
                    <a href="#form-block" class="btn smooth-link">Стать партнером</a>
                </div>
            </div>
        </div>
    </div>
    <div class="company-quality">
        <div class="container">
            <h2>Высокое качество предлагаемой продукции</h2>
            <div class="company-quality__descr">
                <p>
                    Компания SilverStoneF1 - лидирующий российский разработчик и производитель широкого спектра инновационной автомобильной электроники.
                    Уже более 13-лет мы растем и развиваемся.<br>Сотни тысяч клиетов по всему миру пользуются  нашим продуктом,
                    а более 200 компаний выбрали нас в качестве партнера и поставщика.
                </p>
            </div>
           <div class="num-container">
                <div class="col">
                    <span class="num"><?php echo !empty($atts['number_1']) ? $atts['number_1'] : ''; ?></span>
                    <span class="num-info"><?php echo !empty($atts['text_1']) ? $atts['text_1'] : ''; ?></span>
                </div>
                <div class="col">
                    <span class="num"><?php echo !empty($atts['number_2']) ? $atts['number_2'] : ''; ?></span>
                    <span class="num-info"><?php echo !empty($atts['text_2']) ? $atts['text_2'] : ''; ?></span>
                </div>
                <div class="col">
                    <span class="num"><?php echo !empty($atts['number_3']) ? $atts['number_3'] : ''; ?></span>
                    <span class="num-info"><?php echo !empty($atts['text_3']) ? $atts['text_3'] : ''; ?></span>
                </div>
            </div>
            <!-- <div class="company-quality__advantages">
                <div class="company-quality__adv-item">
                    <div class="item-icon"><i class="icon-industrial-robot"></i></div>
                    <div class="caption">Собственное <br>производство</div>
                </div>
                <div class="company-quality__adv-item">
                    <div class="item-icon"><i class="icon-brain"></i></div>
                    <div class="caption">Современные <br>технологии</div>
                </div>
                <div class="company-quality__adv-item">
                    <div class="item-icon"><i class="icon-update"></i></div>
                    <div class="caption">Регулярное <br>обновление</div>
                </div>
            </div> -->
        </div>
    </div>
    <div class="company-coop">
        <div class="container">
            <div class="company-coop__row">
                <div class="company-coop__left-img"><div class="inner-img"></div></div>
                <div class="company-coop__right">
                    <div class="inner-content">
                        <h2>Выгодное и комфортное сотрудничество</h2>
                        <div class="company-coop__descr">
                            <p>Компания SilverStoneF1 - лидирующий российский разработчик и производитель широкого спектра инновационной автомобильной электроники.</p>
                            <p>Уже более 13-лет мы растем и развиваемся.  Сотни тысяч клиетов по всему миру пользуются нашим продуктом, а более 200 компаний выбрали нас в качестве партнера и поставщика.</p>
                        </div>
                        <div class="company-coop__advantages">
                            <div class="company-coop__adv-item">
                                <div class="item-icon"><i class="icon-delivery"></i></div>
                                <div class="caption">Быстрая <br>доставка</div>
                            </div>
                            <div class="company-coop__adv-item">
                                <div class="item-icon"><i class="icon-order"></i></div>
                                <div class="caption">Полная <br>поддержка</div>
                            </div>
                            <div class="company-coop__adv-item">
                                <div class="item-icon"><i class="icon-get-offer"></i></div>
                                <div class="caption">Лучшие цены <br>и скидки</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="partners">
        <div class="container">
            <h2>Наши партнеры</h2>
            <div class="partners__subtitle">Это наши друзья и союзники, которые получают специальные скидки и особый индивидуальный подход</div>
            <div class="partners__list brand-mobile-slider">
                <a href="//google.com" target="_blank" class="partners__item">
                    <span class="inner">
                        <span class="item-logo"><img src="<?php echo get_template_directory_uri()?>/assets/img/partners/merlion.png" alt=""></span>
                        <span class="item-content">
                            <span class="descr">Один из крупнейших российских дистрибьюторов компьютерной и цифровой техники, сетевого и офисного оборудования</span>
                        </span>
                    </span>
                </a>
                <a href="//google.com" target="_blank" class="partners__item">
                    <span class="inner">
                        <span class="item-logo citilink"><img src="<?php echo get_template_directory_uri()?>/assets/img/partners/citilink.png" alt=""></span>
                        <span class="item-content">
                            <span class="descr">Один из крупнейших российских магазинов онлайн - торговли. Более 50 000 товаров в каталоге.</span>
                        </span>
                    </span>
                </a>
                <a href="//google.com" target="_blank" class="partners__item">
                    <span class="inner">
                        <span class="item-logo"><img src="<?php echo get_template_directory_uri()?>/assets/img/partners/avto-49.png" alt=""></span>

                        <span class="item-content">
                            <span class="descr">Федеральная сеть магазинов, присутствующая в 40 городах европейской части Росии</span>
                        </span>
                    </span>
                </a>
                <a href="//google.com" target="_blank" class="partners__item">
                    <span class="inner">
                        <span class="item-logo"><img src="<?php echo get_template_directory_uri()?>/assets/img/partners/sotmarket.png" alt=""></span>

                        <span class="item-content">
                            <span class="descr">Крупнейший интернет магазин электроники с каталогом товаров на 12 000 позиций</span>
                        </span>
                    </span>
                </a>
                <a href="//google.com" target="_blank" class="partners__item">
                    <span class="inner">
                        <span class="item-logo"><img src="<?php echo get_template_directory_uri()?>/assets/img/partners/akc.png" alt=""></span>

                        <span class="item-content">
                            <span class="descr">Крупнейшая структура оптовых и розничных продаж, установки и сервисного обсуживания автомобильной электроники</span>
                        </span>
                    </span>
                </a>
                <a href="//google.com" target="_blank" class="partners__item">
                    <span class="inner">
                        <span class="item-logo"><img src="<?php echo get_template_directory_uri()?>/assets/img/partners/nikas.png" alt=""></span>

                        <span class="item-content">
                            <span class="descr">Федеральный бренд, объединяющий сеть розничных магазинов и оптовую компанию</span>
                        </span>
                    </span>
                </a>
                <a href="//google.com" target="_blank" class="partners__item">
                    <span class="inner">
                        <span class="item-logo"><img src="<?php echo get_template_directory_uri()?>/assets/img/partners/mcota.png" alt=""></span>
                        <span class="item-content">
                            <span class="descr">Одна из ведущих российских компаний на оптовом рынке цифровой техники и аксессуаров, основаная в 1998 году</span>
                        </span>
                    </span>
                </a>
                <a href="//google.com" target="_blank" class="partners__item">
                    <span class="inner">
                        <span class="item-logo eixenon"><img src="<?php echo get_template_directory_uri()?>/assets/img/partners/eixenon.png" alt=""></span>
                        <span class="item-content">
                            <span class="descr">Крупный интернет-магазин автозапчастей и аксуссуаров для автомобилей</span>
                        </span>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="become-dealer" id="form-block">
        <div class="container">
            <!-- <div class="brand-title">Станьте дилером <br><span class="accent">Silverstone F1</span> прямо сейчас</div> -->
            <h2 class="brand-title">Станьте дилером <br><span class="accent">Silverstone F1</span> прямо сейчас</h2>
            
            <div class="become-dealer__row">
                <form class="become-dealer__form" action="<?php echo get_permalink();?>" method="POST" enctype="multipart/form-data">
                    <?php SSF_Form_Handler::serviceFields('become_dealer');?>
                    <div class="inner">
                        <div class="form-title">Заполните форму</div>
                        
                        <div class="input-wrapper">
                            <div class="input-addon"><i class="icon-user"></i></div>
                            <input type="text" name="ssf_name" class="text-input" placeholder="Введите ваше имя" required>
                        </div>
                        
                        <div class="input-wrapper">
                            <div class="input-addon"><i class="icon-email"></i></div>
                            <input type="email" name="ssf_email" class="text-input" placeholder="Введите ваш email" required>
                        </div>
                        
                        <div class="input-wrapper">
                            <div class="input-addon"><i class="icon-form-tel"></i></div>
                            <input type="tel" class="text-input" name="ssf_phone" placeholder="Введите ваш телефон" required>
                        </div>

                        <div class="input-wrapper">
                            <div class="input-addon"><i class="icon-message"></i></div>
                            <textarea cols="40" class="textarea-input" name="ssf_message" placeholder="Введите ваш комментарий" required></textarea>
                        </div>
                        
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
                            <div class="item-icon"><i class="icon-brif"></i></div>
                            
                            <div class="item-content">Внимательно и достоверно заполните форму</div>
                        </div>
                        
                        <div class="impulse"></div>
                    </div>
                    
                    <div class="become-dealer__process-item">
                        <div class="inner">
                            <div class="item-icon"><i class="icon-discuss"></i></div>
                            
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
                            <div class="item-icon"><i class="icon-get-goods"></i></div>
                            
                            <div class="item-content">Примите продукцию <br>на свой склад</div>
                        </div>
                    </div>
                    
                    <div class="become-dealer__process-item">
                        <div class="inner">
                            <div class="item-icon"><i class="icon-money"></i></div>
                            
                            <div class="item-content">Реализуйте товар и получайте прибыль!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contacts-block">
        <div class="contacts-block__row">
            <div class="contacts-block__left">
                <div class="inner-content">
                    <h2>Контакты</h2>
                    <div class="contacts-block__caption">Штаб-квартира SilverStone F1 находится в Москве</div>
                    <div class="contacts-block__list">
                        <div class="contacts-block__item">
                            <div class="item-icon"><i class="icon-home"></i></div>
                            <div class="right-content"><?php echo fw_get_db_settings_option('headquarters_address');?></div>
                        </div>
                        <div class="contacts-block__item">
                            <div class="item-icon"><i class="icon-smartphone"></i></div>
                            <div class="right-content">
                                <a href="tel:<?php echo preg_replace( '/[^0-9]/', '', fw_get_db_settings_option('phone'));?>" class="tel-link"><?php echo fw_get_db_settings_option('phone');?></a>
                                <div class="text">Бесплатно по России <span class="accent"><?php echo fw_get_db_settings_option('working_hours');?></span></div>
                            </div>
                        </div>
                        <div class="contacts-block__item">
                            <div class="item-icon"><i class="icon-email"></i></div>
                            <div class="right-content">
                                <div>Справка: <a href="mailto:<?php echo fw_get_db_settings_option('support_email');?>"><?php echo fw_get_db_settings_option('support_email');?></a></div>
                                <div>Продажи: <a href="mailto:<?php echo fw_get_db_settings_option('sale_email');?>"><?php echo fw_get_db_settings_option('sale_email');?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contacts-block__center-line">
                <div class="line"></div>
                <div class="center-logo"><img src="<?php echo get_template_directory_uri()?>/assets/img/logo-part.svg" alt=""></div>
                <div class="line"></div>
            </div>
            <div class="contacts-block__right"><div class="contacts-block__map" id="contacts_map"></div></div>
        </div>
    </div>
    

    <script src="https://api-maps.yandex.ru/2.1/?load=package.full&lang=ru-RU" type="text/javascript"></script>

    <script>

        ymaps.ready(init);
        var contactsMap;

        function init() {

            contactsMap = new ymaps.Map("contacts_map", {
                center: <?php echo fw_get_db_settings_option('coordinates');?>,
                zoom: 12
            }, {
                searchControlNoCentering: true,
            });

            var myPlacemark = new ymaps.Placemark([55.604117, 37.5033089], {}, {
                preset: 'islands#darkOrangeIcon'
            },{

            });

            contactsMap.geoObjects.add(myPlacemark);
        }

    </script>
