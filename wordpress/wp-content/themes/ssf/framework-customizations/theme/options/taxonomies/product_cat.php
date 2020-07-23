<?php

    if (!defined('FW')) die('Forbidden');

    $tag = !empty($GLOBALS['tag']) && $GLOBALS['tag'] instanceof WP_Term ? $GLOBALS['tag'] : null;

    if( ! $tag ){
        return;
    }

    $products = wc_get_products(['category' => [$tag->slug]]);

    $choices = [];

    if(!empty($products) && is_array($products)){
        foreach ($products as $product){
            /** @var WC_Product_Simple $product */
            $choices[$product->get_id()] = $product->get_name();
        }
    }

    $options = array(
        'product_cat_icon'  => array(
            'label' => 'Иконка категории',
            'type' => 'text'
        ),
        'cat_header_background' => array(
            'type'  => 'upload',
            'label' => __('Фон категории', '{domain}'),
            'desc'  => __('Фон категории будет отображаться для родительской категории в подкатегориях', '{domain}'),
            /**
             * If set to `true`, the option will allow to upload only images, and display a thumb of the selected one.
             * If set to `false`, the option will allow to upload any file from the media library.
             */
            'images_only' => true,
            /**
             * An array with allowed files extensions what will filter the media library and the upload files.
             */
//            'files_ext' => array( 'doc', 'pdf', 'zip' ),
            /**
             * An array with extra mime types that is not in the default array with mime types from the javascript Plupload library.
             * The format is: array( '<mime-type>, <ext1> <ext2> <ext2>' ).
             * For example: you set rar format to filter, but the filter ignore it , than you must set
             * the array with the next structure array( '.rar, rar' ) and it will solve the problem.
             */
            'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
        ),
        'popular_products' => array(
            'type' => 'popup',
            'label' => __('Популярные товары', '{domain}'),
            'desc'  => 'Внимание заполняйте этот раздел уже в созданной категории, а не при её создании!',
            'popup-title' => __('Popup Title', '{domain}'),
            'button' => __('Изменить', '{domain}'),
            'size' => 'medium', // small, medium, large
            'popup-options' => array(
                'products' => array(
                    'type'  => 'addable-box',
                    'label' => __('Популятные товары этой категории', '{domain}'),
                    'desc'  => 'Здесь отображаются товары только из этой категории, если товара нет, сначала добавьте его в это категорию',
                    'box-options' => array(
                        'product_id' => array(
                            'type'  => 'select',
                            'label' => 'Выберите товар',

                            'choices' => $choices,
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
                    'template' => '{{ choices = '.json_encode($choices).'; return choices[product_id]  }}',
                    'limit' => 0, // limit the number of boxes that can be added
                    'add-button-text' => __('Довавить товар', '{domain}'),
                    'sortable' => true,
                ),
            ),
        )
    );