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

    // 'camera_type' => array(
    //     'type'  => 'addable-option',
    //     'label' => __('Тип камеры', '{domain}'),
    //     'desc'  => __('Типы камеры которые отображаются в выпадающим меню', '{domain}'),
    //     'option' => array( 'type' => 'text' ),
    //     'add-button-text' => __('Добавить тип', '{domain}'),
    //     'sortable' => true,
    // ),

    'max_speed' => array(
        'type'  => 'addable-option',
        'label' => __('Ограничение скорости', '{domain}'),
        'desc'  => __('Ограничение скорости которые отображаются в выпадающим меню', '{domain}'),
        'option' => array( 'type' => 'text' ),
        'add-button-text' => __('Добавить тип', '{domain}'),
        'sortable' => true,
    ),


);