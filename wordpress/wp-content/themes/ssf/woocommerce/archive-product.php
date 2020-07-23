<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

wc_print_notices();



if(is_search()){
    get_template_part('product-search', 'result');
}
elseif(is_shop()){

    $shop_page = get_post( wc_get_page_id( 'shop' ) );

    if($shop_page){
        echo apply_filters( 'the_content', $shop_page->post_content );
    }
}
else{

    $current_category = get_queried_object();

    $image = fw_get_db_term_option($current_category->term_id, $current_category->taxonomy, 'cat_header_background');

    if(empty($image)){
        $image = fw_get_db_settings_option('default_cat_background');
    }

    $children = get_categories( array(
        'child_of'      => $current_category->term_id,
        'taxonomy'      => 'product_cat',
        'hide_empty'    => false,
    ) );

    /**
     * Hook: woocommerce_before_main_content.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */

    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

    do_action('woocommerce_before_main_content');

    // category header / category desc
?>
    <div class="top-information">
        <div class="top-information__bg-img">
            <?php if(!empty($image['url'])):?>
            <img src="<?php echo $image['url'];?>" alt="">
            <?php endif;?>
        </div>
        <div class="container">
            <div class="breadcrumbs">
                <?php
                    woocommerce_breadcrumb(array(
                        'delimiter'   => '',
                        'wrap_before' => '<ul>',
                        'wrap_after'  => '</ul>',
                        'before'      => '',
                        'after'       => '',
                        'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
                    ));
                ?>
            </div>
            <h1><?php echo $current_category->name;?></h1>
            <div class="top-information__descr"><?php echo $current_category->description;?></div>
        </div>
    </div>
<?php

    if(!empty($children) && is_array($children)){

        include( locate_template( 'woocommerce/archive-product-sub-cat.php', false, false ) );
    }
    else{

        /**
         * Hook: woocommerce_archive_description.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */

        remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
        remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

        do_action('woocommerce_archive_description');

        if($current_category->parent != 0){
            $parent_term = get_term($current_category->parent);
            $back_url = get_term_link( $parent_term->term_id, $parent_term->taxonomy );
            $back_url_text = $parent_term->name;
        }
        else{
            $back_url = get_permalink(wc_get_page_id( 'shop' ));
            $back_url_text = 'магазин';
        }
?>
        <div class="category-topbar">
            <div class="container">
                <div class="category-topbar__row">
                    <a href="<?php echo $back_url;?>" class="category-topbar__back-button">
                        <i class="icon-arrow"></i>
                        <span>Назад<span class="hidden-mobile"> в <?php echo mb_strtolower($back_url_text);?></span></span>
                    </a>
                    <div class="category-topbar__sort-wrap">
                        <div class="caption">Сортировать:</div>
                        <div class="category-topbar__sort-select">
                            <?php woocommerce_catalog_ordering();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

        if (woocommerce_product_loop()) {

            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked wc_print_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
            remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

            do_action('woocommerce_before_shop_loop');

            $wc_loop_total = wc_get_loop_prop('total');

            woocommerce_product_loop_start();

            if ( $wc_loop_total ) {

                echo '<div class="category__list">';

                while (have_posts()) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     *
                     * @hooked WC_Structured_Data::generate_product_data() - 10
                     */
                    do_action('woocommerce_shop_loop');

                    wc_get_template_part('content', 'product-detail');
                    // if($wc_loop_total < 39){
                    // }
                    // else{
                    //     wc_get_template_part('content', 'product');
                    // }
                }

                if($wc_loop_total < 6){
                    echo '<div class="category__empty-place"><div class="item-icon"><i class="icon-industrial-robot"></i></div><div class="caption">Мы постоянно работаем над увеличением линейки нашей продукции :)</div></div>';
                }

                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action('woocommerce_after_shop_loop');

                echo '</div>';
            }


            woocommerce_product_loop_end();



            echo do_shortcode('[shop_benefits use_default="default"]');

        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        }

        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
        do_action('woocommerce_after_main_content');

        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
        do_action('woocommerce_sidebar');
    }
}

get_footer();
