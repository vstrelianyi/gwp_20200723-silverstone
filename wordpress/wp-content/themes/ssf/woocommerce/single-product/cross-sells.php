<?php

global $product;

if(!($product instanceof WC_Product)){
    return;
}

$limit = 3;
$columns = 3;
$orderby = 'rand';
$order = 'desc';

// Get visible cross sells then sort them at random.
$cross_sells = array_filter( array_map( 'wc_get_product', $product->get_cross_sell_ids() ), 'wc_products_array_filter_visible' );

wc_set_loop_prop( 'name', 'cross-sells' );
wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_cross_sells_columns', $columns ) );

// Handle orderby and limit results.
$orderby     = apply_filters( 'woocommerce_cross_sells_orderby', $orderby );
$order       = apply_filters( 'woocommerce_cross_sells_order', $order );
$cross_sells = wc_products_array_orderby( $cross_sells, $orderby, $order );
$limit       = apply_filters( 'woocommerce_cross_sells_total', $limit );
$cross_sells = $limit > 0 ? array_slice( $cross_sells, 0, $limit ) : $cross_sells;


if( empty($cross_sells) || !is_array($cross_sells) ){
    return;
}

?>
<div class="recommended">
    <div class="container">
        <h2>Рекомендуемые аксессуары</h2>
        <div class="recommended__list">
            <?php
                foreach ( $cross_sells as $cross_sell ){

                    $post_object = get_post( $cross_sell->get_id() );

                    setup_postdata( $GLOBALS['post'] =& $post_object );

                    wc_get_template_part( 'content', 'product' );
                }
            ?>
        </div>
    </div>
</div>
<?php wp_reset_postdata();?>