<?php

//add_filter( 'wc_order_statuses', 'wc_renaming_order_status' );
//
//function wc_renaming_order_status( $order_statuses ) {
//
//    foreach ( $order_statuses as $key => $status ) {
//        if ( 'wc-completed' === $key )
//            $order_statuses['wc-completed'] = _x( 'Order Received', 'Order status', 'woocommerce' );
//    }
//    return $order_statuses;
//}