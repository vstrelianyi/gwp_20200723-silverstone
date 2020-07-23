<?php if (!defined( 'FW' )) die('Forbidden');

$options = array(
    // 'marketing_icons' => array(
    //     'type' => 'box',
    //     'title' => __('Маркетинговая иконка + текст', '{domain}'),
    //     'options' => array(
    //         'm_icons' => array(
    //             'type'  => 'addable-box',
    //             'value' => array(
    //                 array(
    //                     'icon' => array(
    //                         "type" => "icon-font",
    //                         "icon-class" => "icon-price-tag",
    //                         "icon-class-without-root" => "icon-price-tag",
    //                         "pack-name" => null,
    //                         "pack-css-uri" => null,
    //                     ),
    //                     'text' => 'Выгодная цена',
    //                 ),
    //                 array(
    //                     "icon" => array(
    //                         "type" => "icon-font",
    //                         "icon-class" => "icon-diamond",
    //                         "icon-class-without-root" => "icon-diamond",
    //                         "pack-name" => null,
    //                         "pack-css-uri" => null,
    //                         ),
    //                     "text" => "Долговечность",
    //                 ),
    //                 array(
    //                     "icon" => array(
    //                         "type" => "icon-font",
    //                         "icon-class" => "icon-like",
    //                         "icon-class-without-root" => "icon-like",
    //                         "pack-name" => null,
    //                         "pack-css-uri" => null,
    //                         ),
    //                     "text" => "Удобно использовать"
    //                 ),
    //             ),
    //             'label' => __('Иконка + текст', '{domain}'),
    //             'desc'  => __('Иконку и описание', '{domain}'),
    //             'box-options' => array(
    //                 'icon' => array(
    //                     'type'  => 'icon-v2',

    //                     /**
    //                      * small | medium | large | sauron
    //                      * Yes, sauron. Definitely try it. Great one.
    //                      */
    //                     'preview_size' => 'medium',

    //                     /**
    //                      * small | medium | large
    //                      */
    //                     'modal_size' => 'medium',

    //                     /**
    //                      * There's no point in configuring value from code here.
    //                      *
    //                      * I'll document the result you get in the frontend here:
    //                      * 'value' => array(
    //                      *   'type' => 'icon-font', // icon-font | custom-upload
    //                      *
    //                      *   // ONLY IF icon-font
    //                      *   'icon-class' => '',
    //                      *   'icon-class-without-root' => false,
    //                      *   'pack-name' => false,
    //                      *   'pack-css-uri' => false
    //                      *
    //                      *   // ONLY IF custom-upload
    //                      *   // 'attachment-id' => false,
    //                      *   // 'url' => false
    //                      * ),
    //                      */

    //                     'label' => __('Иконка', '{domain}'),
    //                 ),
    //                 'text' => array( 'type' => 'text', 'label' => 'Текст под иконкой' ),
    //             ),
    //             'template' => '{{- text }}', // box title
    //             'limit' => 10, // limit the number of boxes that can be added
    //             'add-button-text' => __('Добавить', '{domain}'),
    //             'sortable' => true,
    //         ),
    //     ),
    // ),
    'main' => array(
        'type' => 'box',
        'title' => __('Дополнительная информация', '{domain}'),
        'options' => array(
            'tab_desc' => array(
                'type' => 'tab',
                'options' => array(
                    'product_desc'  => array(
                        'type'  => 'wp-editor',
                        'label' => __('Таб описание', '{domain}'),
                        'desc'  => __('Описание которое показывается в табе, ниже основного описания товара', '{domain}'),
                        'size' => 'large', // small, large
                        'editor_height' => 400,
                        'wpautop' => true,
                        'editor_type' => false, // tinymce, html

                        /**
                         * By default, you don't have any shortcodes into the editor.
                         *
                         * You have two possible values:
                         *   - false:   You will not have a shortcodes button at all
                         *   - true:    the default values you provide in wp-shortcodes
                         *              extension filter will be used
                         *
                         *   - An array of shortcodes
                         */
                        'shortcodes' => false // true, array('button', map')

                        /**
                         * Also available
                         * https://github.com/WordPress/WordPress/blob/4.4.2/wp-includes/class-wp-editor.php#L80-L94
                         */
                    ),
                ),
                'title' => __('Описание', '{domain}'),
                'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
            ),
            // 'tab_characteristics' => array(
            //     'type' => 'tab',
            //     'options' => array(
            //         'characteristics_tables' => array(
            //             'type'  => 'addable-box',
            //             'label' => __('Таблицы', '{domain}'),
            //             'box-options' => array(
            //                 'title' => array( 'type' => 'text', 'label' => 'Название таблицы' ),
            //                 'position' => array(
            //                     'type'  => 'switch',
            //                     'label' => __('Позиция', '{domain}'),
            //                     'left-choice' => array(
            //                         'value' => 'left',
            //                         'label' => __('Слева', '{domain}'),
            //                     ),
            //                     'right-choice' => array(
            //                         'value' => 'right',
            //                         'label' => __('Справа', '{domain}'),
            //                     ),
            //                 ),
            //                 'rows' => array(
            //                     'type'  => 'addable-option',
            //                     'label' => __('Ряд в таблины', '{domain}'),
            //                     'desc'  => __('Введите ключ - значение разделяя символом | ,<br> Пример: Емкость Аккумулятора | 5000мА', '{domain}'),
            //                     'option' => array( 'type' => 'text' ),
            //                     'add-button-text' => __('Добать ряд', '{domain}'),
            //                     'sortable' => true,
            //                 ),
            //             ),
            //             'template' => '{{- title }}, Позиция: {{- position }}', // box title
            //             'add-button-text' => __('Добавить таблицу', '{domain}'),
            //             'sortable' => true,
            //         ),
            //     ),
            //     'title' => __('Характеристики', '{domain}'),
            //     'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
            // ),
            'tab_characteristics' => array(
                'type' => 'tab',
                'options' => array(
                    'characteristics_tables'  => array(
                        'type'  => 'wp-editor',
                        'label' => __('Таблицы', '{domain}'),
                        'desc'  => __('Описание которое показывается в табе, ниже основного описания товара', '{domain}'),
                        'size' => 'large', // small, large
                        'editor_height' => 400,
                        'wpautop' => true,
                        'editor_type' => 'html', // tinymce, html

                        /**
                         * By default, you don't have any shortcodes into the editor.
                         *
                         * You have two possible values:
                         *   - false:   You will not have a shortcodes button at all
                         *   - true:    the default values you provide in wp-shortcodes
                         *              extension filter will be used
                         *
                         *   - An array of shortcodes
                         */
                        'shortcodes' => false // true, array('button', map')

                        /**
                         * Also available
                         * https://github.com/WordPress/WordPress/blob/4.4.2/wp-includes/class-wp-editor.php#L80-L94
                         */
                    ),
                ),
                'title' => __('Характеристики', '{domain}'),
                'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
            ),
            'tab_video' => array(
                'type' => 'tab',
                'options' => array(
                    'video_url'  => array(
                        'type'  => 'text',
                        'label' => __('Url video', '{domain}'),
                        'desc'  => __('Url формата "https://www.youtube.com/watch?v=_sI_Ps7JSEk"', '{domain}'),
                    ),
                ),
                'title' => __('Видео', '{domain}'),
                'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
            ),
            'tab_support' => array(
                'type' => 'tab',
                'options' => array(
                    'support_files'  => array(
                        'type'  => 'addable-option',
                        'label' => __('Файлы', '{domain}'),
                        'option' => array(
                            'type'  => 'upload',
                            'value' => array(
                                /*
                                'attachment_id' => '9',
                                'url' => '//site.com/wp-content/uploads/2014/02/whatever.jpg'
                                */
                                // if value is set in code, it is not considered and not used
                                // because there is no sense to set hardcode attachment_id
                            ),
                            'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                            'label' => __('Label', '{domain}'),
                            'desc'  => __('Description', '{domain}'),
                            'help'  => __('Help tip', '{domain}'),
                            /**
                             * If set to `true`, the option will allow to upload only images, and display a thumb of the selected one.
                             * If set to `false`, the option will allow to upload any file from the media library.
                             */
                            'images_only' => false,
                            /**
                             * An array with allowed files extensions what will filter the media library and the upload files.
                             */
//                            'files_ext' => array( 'doc', 'pdf', 'zip', 'txt', 'jpg',  ),
                            /**
                             * An array with extra mime types that is not in the default array with mime types from the javascript Plupload library.
                             * The format is: array( '<mime-type>, <ext1> <ext2> <ext2>' ).
                             * For example: you set rar format to filter, but the filter ignore it , than you must set
                             * the array with the next structure array( '.rar, rar' ) and it will solve the problem.
                             */
                            'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
                        ),
                        'add-button-text' => __('Добавить файл', '{domain}'),
                        'sortable' => true,
                    ),
                ),
                'title' => __('Поддержка', '{domain}'),
            ),
            'tab_footer' => array(
                'type' => 'tab',
                'options' => array(
                    'popup_benefits' => array(
                        'type' => 'popup',
                        'label' => 'Привилегии',
                        'popup-title' => 'Привилегии',
                        'button' => 'Изменить',
                        'size' => 'medium',
                        'popup-options' => array(
                            'use_default' => array(
                                'type'  => 'switch',
                                'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                                'label' => __('Использовать данные', '{domain}'),
                                'desc'  => 'Сквозные настройки настраиваются <a href="themes.php?page=fw-settings">здесь</a>',
                                'left-choice' => array(
                                    'value' => 'default',
                                    'label' => __('Сквозные', '{domain}'),
                                ),
                                'right-choice' => array(
                                    'value' => 'custom',
                                    'label' => __('Настраиваемые', '{domain}'),
                                ),
                            ),
                            'icon_1'    => array(
                                'type'  => 'icon-v2',
                                'preview_size' => 'medium',
                                'modal_size' => 'medium',
                                'label' => __('Иконка', '{domain}'),
                            ),
                            'title_1'    => array(
                                'type'  => 'text',
                                'label' => __( 'Заголовок 1', 'fw' ),
                            ),
                            'text_1'    => array(
                                'type'  => 'textarea',
                                'label' => __( 'Текст 1', 'fw' ),
                            ),
                            'icon_2'    => array(
                                'type'  => 'icon-v2',
                                'preview_size' => 'medium',
                                'modal_size' => 'medium',
                                'label' => __('Иконка', '{domain}'),
                            ),
                            'title_2'    => array(
                                'type'  => 'text',
                                'label' => __( 'Заголовок 2', 'fw' ),
                            ),
                            'text_2'    => array(
                                'type'  => 'textarea',
                                'label' => __( 'Текст 2', 'fw' ),
                            ),
                            'icon_3'    =>  array(
                                'type'  => 'icon-v2',
                                'preview_size' => 'medium',
                                'modal_size' => 'medium',
                                'label' => __('Иконка', '{domain}'),
                            ),
                            'title_3'    => array(
                                'type'  => 'text',
                                'label' => __( 'Заголовок 3', 'fw' ),
                            ),
                            'text_3'    => array(
                                'type'  => 'textarea',
                                'label' => __( 'Текст 3', 'fw' ),
                            ),
                        ),
                    ),
                ),
                'title' => __('Футер', '{domain}'),
            )
        ),
    ),
    'support' => array(
        'type' => 'box',
        'title' => __('Блок поддержки', '{domain}'),
        'options' => array(
            'support_renewal' => array(
                'type' => 'tab',
                'options' => array(
                    'support_renewal_text'  => array(
                        'type'  => 'wp-editor',
                        'label' => __('Обновление', '{domain}'),
                        'size' => 'large', // small, large
                        'editor_height' => 400,
                        'wpautop' => true,
                        'editor_type' => false, // tinymce, html

                        /**
                         * By default, you don't have any shortcodes into the editor.
                         *
                         * You have two possible values:
                         *   - false:   You will not have a shortcodes button at all
                         *   - true:    the default values you provide in wp-shortcodes
                         *              extension filter will be used
                         *
                         *   - An array of shortcodes
                         */
                        'shortcodes' => false // true, array('button', map')

                        /**
                         * Also available
                         * https://github.com/WordPress/WordPress/blob/4.4.2/wp-includes/class-wp-editor.php#L80-L94
                         */
                    ),
                ),
                'title' => __('Обновление', '{domain}'),
                'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
            ),
            'support_archive' => array(
                'type' => 'tab',
                'options' => array(
                    'support_archive_text'  => array(
                        'type'  => 'wp-editor',
                        'label' => __('Таб архив', '{domain}'),
                        'size' => 'large', // small, large
                        'editor_height' => 400,
                        'wpautop' => true,
                        'editor_type' => false, // tinymce, html

                        /**
                         * By default, you don't have any shortcodes into the editor.
                         *
                         * You have two possible values:
                         *   - false:   You will not have a shortcodes button at all
                         *   - true:    the default values you provide in wp-shortcodes
                         *              extension filter will be used
                         *
                         *   - An array of shortcodes
                         */
                        'shortcodes' => false // true, array('button', map')

                        /**
                         * Also available
                         * https://github.com/WordPress/WordPress/blob/4.4.2/wp-includes/class-wp-editor.php#L80-L94
                         */
                    ),
                ),
                'title' => __('Архив', '{domain}'),
                'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
            ),
            'support_driver' => array(
                'type' => 'tab',
                'options' => array(
                    'support_driver_text'  => array(
                        'type'  => 'wp-editor',
                        'label' => __('Таб драйвер', '{domain}'),
                        'size' => 'large', // small, large
                        'editor_height' => 400,
                        'wpautop' => true,
                        'editor_type' => false, // tinymce, html

                        /**
                         * By default, you don't have any shortcodes into the editor.
                         *
                         * You have two possible values:
                         *   - false:   You will not have a shortcodes button at all
                         *   - true:    the default values you provide in wp-shortcodes
                         *              extension filter will be used
                         *
                         *   - An array of shortcodes
                         */
                        'shortcodes' => false // true, array('button', map')

                        /**
                         * Also available
                         * https://github.com/WordPress/WordPress/blob/4.4.2/wp-includes/class-wp-editor.php#L80-L94
                         */
                    ),
                ),
                'title' => __('Драйвер', '{domain}'),
                'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
            ),
            'support_reboot' => array(
                'type' => 'tab',
                'options' => array(
                    'support_reboot_text'  => array(
                        'type'  => 'wp-editor',
                        'label' => __('Таб перезагрузка', '{domain}'),
                        'desc'  => __('Описание которое показывается в табе, ниже основного описания товара', '{domain}'),
                        'size' => 'large', // small, large
                        'editor_height' => 400,
                        'wpautop' => true,
                        'editor_type' => false, // tinymce, html

                        /**
                         * By default, you don't have any shortcodes into the editor.
                         *
                         * You have two possible values:
                         *   - false:   You will not have a shortcodes button at all
                         *   - true:    the default values you provide in wp-shortcodes
                         *              extension filter will be used
                         *
                         *   - An array of shortcodes
                         */
                        'shortcodes' => false // true, array('button', map')

                        /**
                         * Also available
                         * https://github.com/WordPress/WordPress/blob/4.4.2/wp-includes/class-wp-editor.php#L80-L94
                         */
                    ),
                ),
                'title' => __('Перезагрузка', '{domain}'),
                'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
            ),
            'support_qa' => array(
                'type' => 'tab',
                'options' => array(
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
                'title' => __('FAQ вопрос ответ', '{domain}'),
                'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
            ),
        ),
    ),

);