<?php

function ssf_live_search_scripts()
{
    wp_enqueue_script('live-search', get_template_directory_uri() .'/js/live-search.js', array('jquery'), null, true );
    wp_localize_script('live-search', 'liveSearch',[
        'nonce' => wp_create_nonce('get_product_for_live_search'),
        'action' => 'get_product_for_live_search',
    ]);

}
add_action('wp_enqueue_scripts', 'ssf_live_search_scripts', 20);


// search only in title
function wpse_11826_search_by_title( $search, $wp_query ) {
    if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
        global $wpdb;

        $q = $wp_query->query_vars;
        $n = ! empty( $q['exact'] ) ? '' : '%';

        $search = array();

        foreach ( ( array ) $q['search_terms'] as $term )
            $search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );

        if ( ! is_user_logged_in() )
            $search[] = "$wpdb->posts.post_password = ''";

        $search = ' AND ' . implode( ' AND ', $search );
    }

    return $search;
}

add_filter( 'posts_search', 'wpse_11826_search_by_title', 10, 2 );


// ajax get_products
add_action('wp_ajax_get_product_for_live_search', 'get_product_for_live_search');
add_action('wp_ajax_nopriv_get_product_for_live_search', 'get_product_for_live_search');

function get_product_for_live_search(){

    if( !wp_verify_nonce($_POST['nonce'], 'get_product_for_live_search') ){
        exit;
    }

    $args = array(
        'limit' => -1,
    );
    $products = wc_get_products( $args );

    if(!empty($products) && is_array($products)){
       foreach ($products as $product){
            /** @var WC_Product_Simple $product */

            $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink($product->get_id()), $product );

            $image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );

            $image = $product ? $product->get_image( $image_size ) : '';
?>
            <li class="live-search-item" onClick="window.location.href = '<?php echo $link;?>'">
               <span class="img-wrapper"><?php echo $image;?></span>
               <span class="name"><?php echo $product->get_title();?></span>
            </li>
<?php
       }
    }

    wp_reset_postdata();
    wp_reset_query();
    wp_die();
}


