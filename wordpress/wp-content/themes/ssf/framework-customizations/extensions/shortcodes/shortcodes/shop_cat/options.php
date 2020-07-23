<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$args = array(
    'taxonomy' => 'product_cat',
    'orderby' => 'name',
    'order' => 'ASC',
    'parent'   => 0,
    'hide_empty' => 0,
    'exclude'   => '15',
    // optional you can exclude parent categories from listing
);

$categories = get_terms( $args );

$choices = array();

if(is_array($categories)){
    foreach ($categories as $category){
        $choices[$category->term_id] = $category->name;
    }
}

$choices_json = json_encode($choices);

$options = array(

	'categories'    => array(
        'type' => 'addable-popup',
        'label' => __('Категория', '{domain}'),
//        'desc'  => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '{domain}'),
        'template' => '{{ choices = '.$choices_json.'; return choices[cat_id]  }}',
        'popup-title' => null,
        'size' => 'small', // small, medium, large
        'limit' => 0, // limit the number of popup`s that can be added
        'add-button-text' => __('Добавить', '{domain}'),
        'sortable' => true,
        'popup-options' => array(
            'cat_id' => array(
                'type'  => 'select',
                'label' => __('Категория', '{domain}'),
                'choices' => $choices,
                /**
                 * Allow save not existing choices
                 * Useful when you use the select to populate it dynamically from js
                 */
                'no-validate' => false,
            ),
            'css_class' => array(
                'type'  => 'select',
                'value' => 'w25',
                'label' => __('Css class', '{domain}'),
                'choices' => array(
                    'w25' => 'w25',
                    'w30' => 'w30',
                ),
                /**
                 * Allow save not existing choices
                 * Useful when you use the select to populate it dynamically from js
                 */
                'no-validate' => false,
            ),
        ),
    ),


);