<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

//global $wp_query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {

//
//    $shop_page_id = wc_get_page_id( 'shop' );
//    $shop_home_arr = array( get_the_title($shop_page_id), get_permalink($shop_page_id));
//
//    // insert to breadcrumbs array on second position
//    array_splice($breadcrumb, 1, 0, array($shop_home_arr));

//    dump($breadcrumb);


//    if(is_wc_endpoint_url()){
//        dump('endpoint');
//    }
//
//
//    dump($wp_query->query);


	echo $wrap_before;






	foreach ( $breadcrumb as $key => $crumb ) {

	    echo '<li>';

        if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a><i class="icon-arrow"></i>';
		} else {
			echo '<span>'.esc_html( $crumb[0] ).'</span>';
		}

	    echo '</li>';
	}

	echo $wrap_after;

}
