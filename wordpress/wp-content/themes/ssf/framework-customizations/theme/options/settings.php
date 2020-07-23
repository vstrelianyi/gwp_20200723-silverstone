<?php

    if (!defined('FW')) die('Forbidden');

    $cross_page_elements_options_path = get_stylesheet_directory().'/framework-customizations/theme/cross_page_elements_options/';

    $shop_benefits_options = include($cross_page_elements_options_path.'shop_benefits.php');

    $args = array(
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
        'order' => 'ASC',
        'parent'   => 0,
        'hide_empty' => 0,
        'exclude'   => '15',
        // optional you can exclude parent categories from listing
    );

    $categories = get_terms( $args );

    $choices = array();

    if(is_array($categories)){
        foreach ($categories as $category){
            $choices[$category->term_id] = $category->name;
        }
    }

    $choices_json = json_encode($choices);


    $all_products = wc_get_products(['posts_per_page' => 99999999,'numberposts'    => 99999999]);

    $choices_popular_products = [];

    if(!empty($all_products) && is_array($all_products)){
        foreach ($all_products as $product){
            /** @var WC_Product_Simple $product */
            $choices_popular_products[$product->get_id()] = $product->get_name();
        }
    }


    $options = array(
        'general' => array(
            'type' => 'tab',
            'title' => 'Общие',
            'options' => array(
                'phone'  => array(
                    'label' => 'Телефон',
                    'type' => 'text'
                ),
                'working_hours'  => array(
                    'label' => 'Режим работы',
                    'type' => 'text'
                ),
                'headquarters_address'  => array(
                    'label' => 'Адрес Штаб-квартиры',
                    'desc' => 'Внимание! Этот адрес не влияет на отображение на карте и не влияет на магазин.',
                    'type' => 'text'
                ),
                'coordinates' => array(
                    'label' => 'Координаты Yandex Карты',
                    'type' => 'text'
                ),
                'support_email'  => array(
                    'label' => 'Email адрес поддержки',
                    'type' => 'text'
                ),
                'manager_email'  => array(
                    'label' => 'Email адрес менеджера',
                    'type' => 'text',
                    'desc' => 'Емаил куда будут приходить письма из форм на сайте. Можно указать несколько адресов через запятую'
                ),
                'manager_email_copy'  => array(
                    'label' => 'Email адрес менеджера ( копии )',
                    'type' => 'text',
                    'desc' => 'Емаил куда будут приходить копии письем из форм на сайте. Можно указать несколько адресов через запятую'
                ),
                'sale_email'  => array(
                    'label' => 'Email адрес продаж',
                    'type' => 'text'
                ),
                'footer_categories' => array(
                    'type' => 'addable-popup',
                    'label' => __('Категории в футере', '{domain}'),
                    'desc'  => 'Внимание, для сохранение корректного отображения страницы категорий должно быть 6.',
                    'template' => '{{ choices = '.$choices_json.'; return choices[cat_id]  }}',
                    'popup-title' => null,
                    'size' => 'small', // small, medium, large
                    'limit' => 0, // limit the number of popup`s that can be added
                    'add-button-text' => __('Добавить', '{domain}'),
                    'sortable' => true,
                    'popup-options' => array(
                        'cat_id' => array(
                            'type'  => 'select',
                            'label' => __('Категория', '{domain}'),
                            'choices' => $choices,
                            /**
                             * Allow save not existing choices
                             * Useful when you use the select to populate it dynamically from js
                             */
                            'no-validate' => false,
                        ),
                    ),
                ),
                'footer_text_left_column' => array(
                    'label' => 'Текст перед футером, левая колонка.',
                    'type' => 'wp-editor'
                ),
                'footer_text_right_column' => array(
                    'label' => 'Текст перед футером, правая колонка.',
                    'type' => 'wp-editor'
                ),
                'footer_text_underlogo' => array(
                    'label'=>'Текст под лого в футере',
                    'type'=>'textarea'
                ),
                'doc_ip'  => array(
                    'label' => 'ИП',
                    'type' => 'text'
                ),
                'doc_inn'  => array(
                    'label' => 'ИНН',
                    'type' => 'text'
                ),
                'doc_ognip'  => array(
                    'label' => 'ОГНИП',
                    'type' => 'text'
                ),
                'copyright'  => array(
                    'label' => 'Copyright',
                    'type' => 'text'
                ),
            ),
        ),
        'social' => array(
            'type' => 'tab',
            'title' => 'Социальные ссылки',
            'options' => array(
                'youtube_link'  => array(
                    'label' => 'Youtube',
                    'type' => 'text'
                ),
                'vk_link'  => array(
                    'label' => 'Vk',
                    'type' => 'text'
                ),
                'facebook_link'  => array(
                    'label' => 'Facebook',
                    'type' => 'text'
                ),
                'instagram_link'  => array(
                    'label' => 'Instagram',
                    'type' => 'text'
                ),
            ),
        ),
        'cross_page_elements' => array(
            'type' => 'tab',
            'title' => 'Сквозные элементы',
            'options' => array(
                'shop_benefits_box' => array(
                    'type' => 'box',
                    'options' => $shop_benefits_options,
                    'title' => __('Стандартные настройки для "Привилегии"', '{domain}'),
                ),
            ),
        ),
        'product_cat_options' => array(
            'type' => 'tab',
            'title' => 'Категории товаров',
            'options' => array(
                'default_cat_background' => array(
                    'type'  => 'upload',
                    'label' => __('Изображение', '{domain}'),
                    'desc'  => __('Стандартный фон если не указан в категории товара', '{domain}'),
                    'images_only' => true,
                )
            ),
        ),
        'partners_address_tab' => array(
            'type' => 'tab',
            'title' => 'Адреса партнеров',
            'options' => array(
                'partners_address' => array(
                    'type' => 'addable-popup',
                    'label' => __('Город', '{domain}'),
                    'template' => '{{- city }}',
                    'popup-title' => null,
                    'size' => 'small', // small, medium, large
                    'limit' => 0, // limit the number of popup`s that can be added
                    'add-button-text' => __('Добавить город', '{domain}'),
                    'sortable' => true,
                    'popup-options' => array(
                        'city' => array(
                            'label' => __('Город', '{domain}'),
                            'type' => 'text',
                        ),
                        'stores' => array(
                            'type' => 'addable-popup',
                            'label' => __('Магазины', '{domain}'),
                            'template' => '{{- title }}',
                            'popup-title' => null,
                            'size' => 'medium', // small, medium, large
                            'limit' => 0, // limit the number of popup`s that can be added
                            'add-button-text' => __('Добавить магазин', '{domain}'),
                            'sortable' => true,
                            'popup-options' => array(
                                'logo' => array(
                                    'label' => __('Logo магазина', '{domain}'),
                                    'type' => 'upload',
                                ),
                                'title' => array(
                                    'label' => __('Название магазина', '{domain}'),
                                    'type' => 'text',
                                ),
                                'desc' => array(
                                    'label' => __('Описание', '{domain}'),
                                    'type' => 'text',
                                ),
                                'web_site' => array(
                                    'label' => __('URL сайта', '{domain}'),
                                    'type' => 'text',
                                ),
                                'phone' => array(
                                    'label' => __('Телефон', '{domain}'),
                                    'type' => 'text',
                                ),
                                'address' => array(
                                    'label' => __('Адрес', '{domain}'),
                                    'type' => 'text',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'support' => array(
            'type' => 'tab',
            'title' => 'Поддержка',
            'options' => array(
                'support_questions' => array(
                    'type' => 'addable-popup',
                    'label' => __('Категории вопросов', '{domain}'),
                    'template' => '{{- cat_name }}',
                    'popup-title' => null,
                    'size' => 'small', // small, medium, large
                    'limit' => 0, // limit the number of popup`s that can be added
                    'add-button-text' => __('Добавить категорию', '{domain}'),
                    'sortable' => true,
                    'popup-options' => array(
                        'icon' => array(
                            'label' => __('Название категории', '{domain}'),
                            'type' => 'icon-v2',
                        ),
                        'cat_name' => array(
                            'label' => __('Название категории', '{domain}'),
                            'type' => 'text',
                        ),
                        'question_answer' => array(
                            'type' => 'addable-popup',
                            'label' => __('Вопрос', '{domain}'),
                            'template' => '{{- question }}',
                            'popup-title' => null,
                            'size' => 'medium', // small, medium, large
                            'limit' => 0, // limit the number of popup`s that can be added
                            'add-button-text' => __('Добавить вопрос', '{domain}'),
                            'sortable' => true,
                            'popup-options' => array(
                                'question' => array(
                                    'label' => __('Вопрос', '{domain}'),
                                    'type' => 'text',
                                ),
                                'answer' => array(
                                    'label' => __('Ответ', '{domain}'),
                                    'type' => 'wp-editor',
                                ),
                            ),
                        ),
                    ),
                ),
                'category_questions' => array(
                    'type' => 'addable-popup',
                    'label' => __('Категории вопросов по категориям товаров', '{domain}'),
                    'template' => '{{ choices = '.$choices_json.'; return choices[cat_id]  }}',
                    'popup-title' => null,
                    'size' => 'small', // small, medium, large
                    'limit' => 0, // limit the number of popup`s that can be added
                    'add-button-text' => __('Добавить категорию', '{domain}'),
                    'sortable' => true,
                    'popup-options' => array(
                        'cat_id' => array(
                            'type'  => 'select',
                            'label' => __('Категория товара', '{domain}'),
                            'choices' => $choices,
                            /**
                             * Allow save not existing choices
                             * Useful when you use the select to populate it dynamically from js
                             */
                            'no-validate' => false,
                        ),
                        'question_answer' => array(
                            'type' => 'addable-popup',
                            'label' => __('Вопрос', '{domain}'),
                            'template' => '{{- question }}',
                            'popup-title' => null,
                            'size' => 'medium', // small, medium, large
                            'limit' => 0, // limit the number of popup`s that can be added
                            'add-button-text' => __('Добавить вопрос', '{domain}'),
                            'sortable' => true,
                            'popup-options' => array(
                                'question' => array(
                                    'label' => __('Вопрос', '{domain}'),
                                    'type' => 'text',
                                ),
                                'answer' => array(
                                    'label' => __('Ответ', '{domain}'),
                                    'type' => 'wp-editor',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'popular_products' => array(
            'type' => 'tab',
            'title' => 'Популярные товары',
            'options' => array(
                'products' => array(
                    'type'  => 'addable-box',
                    'label' => __('Популятные товары этой категории', '{domain}'),
                    'box-options' => array(
                        'product_id' => array(
                            'type'  => 'select',
                            'label' => 'Выберите товар',

                            'choices' => $choices_popular_products,
                            /**
                             * Allow save not existing choices
                             * Useful when you use the select to populate it dynamically from js
                             */
                            'no-validate' => false,
                        ),
                        'tale_css_class' => array(
                            'type'  => 'select',
                            'label' => 'Размер плитки товара',
                            'choices' => array(
                                'no_class' => '1/3',
                                'w50' => '1/2',
                            ),
                            /**
                             * Allow save not existing choices
                             * Useful when you use the select to populate it dynamically from js
                             */
                            'no-validate' => false,
                        ),
                    ),
                    'template' => '{{ choices_popular_products = '.json_encode($choices_popular_products).'; return choices_popular_products[product_id]  }}',
                    'limit' => 0, // limit the number of boxes that can be added
                    'add-button-text' => __('Довавить товар', '{domain}'),
                    'sortable' => true,
                ),
            ),
        ),
    );