<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(

    'title'    => array(
        'type'  => 'text',
        'label' => __( 'Title', 'fw' ),
    ),
    'text' => array(
        'type'  => 'textarea',
        'label' => __( 'Текст', 'fw' ),
    ),
    'background' => array(
        'type'  => 'upload',
        'label' => __('Фон', '{domain}'),
    ),
    'tiles' => array(
        'type' => 'addable-popup',
        'label' => __('Плитки', '{domain}'),
        'template' => '{{- title }}',
        'popup-title' => null,
        'size' => 'small', // small, medium, large
        'limit' => 0, // limit the number of popup`s that can be added
        'add-button-text' => __('Add', '{domain}'),
        'sortable' => true,
        'popup-options' => array(
            'img' =>array(
                'type'  => 'upload',
                'label' => __('Изображение', '{domain}'),
            ),
            'title' => array(
                'label' => __('Заголовок', '{domain}'),
                'type' => 'text',
            ),
        ),
    )
);