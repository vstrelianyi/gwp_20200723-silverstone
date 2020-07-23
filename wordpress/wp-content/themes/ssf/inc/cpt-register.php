<?php
function ssf_register_taxonomy(){
    register_taxonomy(
        'news_cat',
        'news',
        array(
            'label' => 'Категории Новостей',
            'hierarchical' => true,
            'query_var' => true, 
            'rewrite' => array('slug' => 'novosti', 'with_front' => true)
        )
    );
}
add_action('init', 'ssf_register_taxonomy');
function ssf_register_custom_posts_init() {
  $news_labels = array(
      'name'               => 'Новости',
      'singular_name'      => 'Новость',
      'menu_name'          => 'Новости'
  );
  $rewrite_array = array(
      'slug'               => 'novosti/%news_cat%'
  );
  $news_args = array(
    'labels'             => $news_labels,
    'public'             => true,
    'capability_type'    => 'post',
    'has_archive'        => 'novosti',
    'rewrite'            => $rewrite_array,
    'supports'           => array('title', 'editor', 'thumbnail','page-attributes','excerpt' ),
    'taxonomies'         => array( 'news_cat' ),
    'menu_icon'          => 'dashicons-format-aside'
  );
  register_post_type('news', $news_args);
}
add_action('init', 'ssf_register_custom_posts_init');

function ssf_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'news' ){
        $terms = wp_get_object_terms( $post->ID, 'news_cat' );
        if( $terms ){
            return str_replace( '%news_cat%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'ssf_show_permalinks', 1, 2 );

function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}
