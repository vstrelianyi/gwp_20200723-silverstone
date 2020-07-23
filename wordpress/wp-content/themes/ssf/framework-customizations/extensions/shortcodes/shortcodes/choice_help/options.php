<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'title'    => array(
		'type'  => 'text',
		'label' => __( 'Заголовок', 'fw' ),
	),
    'color' => array(
        'type'  => 'switch',
        'value' => 'dark',
        'label' => __('Цветовая схема', '{domain}'),
        'left-choice' => array(
            'value' => 'dark',
            'label' => __('Темная', '{domain}'),
        ),
        'right-choice' => array(
            'value' => 'white',
            'label' => __('Светлая', '{domain}'),
        ),
    )
);