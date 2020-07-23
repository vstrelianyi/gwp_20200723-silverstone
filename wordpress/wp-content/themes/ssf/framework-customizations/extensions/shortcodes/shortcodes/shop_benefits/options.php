<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
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
		'type'  => 'text',
		'label' => __( 'Код иконки 1', 'fw' ),
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
        'type'  => 'text',
        'label' => __( 'Код иконки 2', 'fw' ),
    ),
    'title_2'    => array(
        'type'  => 'text',
        'label' => __( 'Заголовок 2', 'fw' ),
    ),
    'text_2'    => array(
        'type'  => 'textarea',
        'label' => __( 'Текст 2', 'fw' ),
    ),
    'icon_3'    => array(
        'type'  => 'text',
        'label' => __( 'Код иконки 3', 'fw' ),
    ),
    'title_3'    => array(
        'type'  => 'text',
        'label' => __( 'Заголовок 3', 'fw' ),
    ),
    'text_3'    => array(
        'type'  => 'textarea',
        'label' => __( 'Текст 3', 'fw' ),
    ),
);