<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'show_cat' => array(
        'type'  => 'checkbox',
        'value' => true, // checked/unchecked
        'label' => __('Категории?', '{domain}'),
        'text'  => __('Показывать?', '{domain}'),
    ),
	'left_text'    => array(
		'type'  => 'textarea',
		'label' => __( 'Текст слева', 'fw' ),
	),
    'right_text'    => array(
        'type'  => 'textarea',
        'label' => __( 'Текст справа', 'fw' ),
    )
);