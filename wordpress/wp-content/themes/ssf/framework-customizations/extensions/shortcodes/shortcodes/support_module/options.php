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

    'title'    => array(
        'type'  => 'text',
        'label' => __( 'Заголовок', 'fw' ),
    ),
    'text' => array(
        'type'  => 'textarea',
        'label' => __( 'Текст', 'fw' ),
    ),
    'category_list_title' => array(
        'type'  => 'text',
        'label' => __( 'Заголовок категории товаров', 'fw' ),
    ),
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
                'label' => __('Ширина плитки', '{domain}'),
                'choices' => array(
                    'w25' => '1/4 контейнера',
                    'w30' => '1/3 контейнера',
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