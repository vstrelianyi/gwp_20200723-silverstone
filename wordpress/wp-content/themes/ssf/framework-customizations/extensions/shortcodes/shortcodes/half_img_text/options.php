<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(

    'position' => array(
        'type'  => 'switch',
        'value' => 'left',
        'label' => __('Положение картинки', '{domain}'),
        'left-choice' => array(
            'value' => 'left',
            'label' => __('Слева', '{domain}'),
        ),
        'right-choice' => array(
            'value' => 'right',
            'label' => __('Справа', '{domain}'),
        ),
    ),
    'title'    => array(
        'type'  => 'text',
        'label' => __( 'Title', 'fw' ),
    ),
    'text' => array(
        'type'  => 'wp-editor',
        'label' => __( 'Текст', 'fw' ),
    ),
    'img' => array(
        'type'  => 'upload',
        'label' => __('Изображение', '{domain}'),
    ),
    'icon' => array(
        'type'  => 'icon-v2',
        'preview_size' => 'medium',
        'modal_size' => 'medium',
        'label' => __('Иконка', '{domain}'),
    ),
);