<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(

    'title'    => array(
        'type'  => 'text',
        'label' => __( 'Title', 'fw' ),
    ),
    'tiles' => array(
        'type' => 'addable-popup',
        'label' => __('Плитки', '{domain}'),
        'template' => '{{- tab_title }}',
        'desc'  => __('Внимание, должно быть 4 таба, для корректного отображения', '{domain}'),
        'popup-title' => null,
        'size' => 'medium', // small, medium, large
        'limit' => 0, // limit the number of popup`s that can be added
        'add-button-text' => __('Add', '{domain}'),
        'sortable' => true,
        'popup-options' => array(
            'tab_title' => array(
                'type'  => 'text',
                'label' => __( 'Заголовок таба', 'fw' ),
            ),
            'text_delivery' =>array(
                'type'  => 'wp-editor',
                'label' => __('Текст доставки', '{domain}'),
            ),
            'title' => array(
                'label' => __('Заголовок оплаты', '{domain}'),
                'type' => 'text',
            ),
            'text_payment' =>array(
                'type'  => 'wp-editor',
                'label' => __('Текст оплаты', '{domain}'),
            ),
        ),
    )
);