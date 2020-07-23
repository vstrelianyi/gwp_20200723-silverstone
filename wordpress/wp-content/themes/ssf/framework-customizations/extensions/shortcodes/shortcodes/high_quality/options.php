<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(

    'title'    => array(
        'type'  => 'text',
        'label' => __( 'Title', 'fw' ),
    ),
    'text' => array(
        'type'  => 'wp-editor',
        'label' => __( 'Текст', 'fw' ),
    ),
    'background' => array(
        'type'  => 'upload',
        'label' => __('Фон', '{domain}'),
    ),
    'tiles' => array(
        'type' => 'addable-popup',
        'label' => __('Плитки', '{domain}'),
        'desc'  => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '{domain}'),
        'template' => '{{- title }}',
        'popup-title' => null,
        'size' => 'small', // small, medium, large
        'limit' => 0, // limit the number of popup`s that can be added
        'add-button-text' => __('Add', '{domain}'),
        'sortable' => true,
        'popup-options' => array(
            'icon' => array(
                'type'  => 'icon-v2',
                'preview_size' => 'medium',
                'modal_size' => 'medium',
                'label' => __('Иконка', '{domain}'),
            ),
            'title' => array(
                'label' => __('Textarea', '{domain}'),
                'type' => 'text',
            ),
        ),
    )
);