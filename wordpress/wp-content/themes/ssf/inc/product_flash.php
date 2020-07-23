<?php

function ssf_render_product_flash(){

    global $product;

    if( ! ($product instanceof WC_Product_Simple) ){
        return;
    }

    // if ( $product->is_on_sale() && !is_product() ){

    //     $regular_price = $product->get_regular_price();
    //     $sale_price    = $product->get_sale_price();

    //     $sale_percent = ( ( (int) $regular_price - (int) $sale_price ) / (int) $regular_price ) * 100;
    //     $sale_percent = (int) $sale_percent;
    //     echo is_single() ? '<span class="product__img-tag discount"><span>Скидка -'.$sale_percent.'%</span></span>' : '<span class="item-card__tag discount">Скидка '.$sale_percent.'%</span>';
    //     // return;
    // }
    // if ( $product->is_on_sale() ){

    //     $regular_price = $product->get_regular_price();
    //     $sale_price    = $product->get_sale_price();

    //     $sale_percent = ( ( (int) $regular_price - (int) $sale_price ) / (int) $regular_price ) * 100;

    //     echo is_single() ? '<span class="product__img-tag discount"><span>Скидка -'.$sale_percent.'%</span></span>' : '<span class="item-card__tag discount">Скидка -'.$sale_percent.'%</span>';
    //     return;
    // }

    $terms = get_the_terms( $product->get_id(), 'product_tag' );

    if( $terms === false || is_wp_error($terms)){
        return;
    }
    if (!is_product()) {
        foreach ($terms as $term){
            $css_class = fw_get_db_term_option($term->term_id, $term->taxonomy, 'flash_css_class', '');
            if($css_class == 'za-rulem'){
                echo '<span class="item-card__tag '.esc_attr($css_class).'"><img src="'.get_stylesheet_directory_uri().'/assets/img/zr-logo-white.svg"/></span>';
            }
            else if(!empty($css_class)){
                echo '<span class="item-card__tag '.esc_attr($css_class).'">'.$term->name.'</span>';
                // return;  We'll show all tags.. 
            }
        }
    }
    // foreach ($terms as $term){

    //     $css_class = fw_get_db_term_option($term->term_id, $term->taxonomy, 'flash_css_class', '');

    //     if(!empty($css_class)){
    //         echo is_single() ? '<span class="azaza product__img-tag '.esc_attr($css_class).'"><span>'.$term->name.'</span></span>' : '<span class="item-card__tag '.esc_attr($css_class).'">'.$term->name.'</span>';
    //         return;
    //     }
    // }
}

function ssf_render_product_discount(){
    global $product;

    if( ! ($product instanceof WC_Product_Simple) ){
        return;
    }
    if ( $product->is_on_sale() && !is_product() ){

        $regular_price = $product->get_regular_price();
        $sale_price    = $product->get_sale_price();

        $sale_percent = ( ( (int) $regular_price - (int) $sale_price ) / (int) $regular_price ) * 100;
        $sale_percent = (int) $sale_percent;
        echo is_single() ? '<span class="item-card__discount"><span>Скидка -</span><span>'.$sale_percent.'%</span></span>' : '<span class="item-card__discount"><span>Скидка </span><span>'.$sale_percent.'%</span></span>';
        // return;
    }
}