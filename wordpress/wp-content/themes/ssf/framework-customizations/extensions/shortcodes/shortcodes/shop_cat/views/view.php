<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

if(empty($atts['categories']) || !is_array($atts['categories'])){
    return;
}


?>
<div class="categories-block">
    <div class="container">
        <div class="categories-block__list">

            <?php

                foreach ($atts['categories'] as $category):

                    if(empty($category['cat_id'])) continue;

                    $term = get_term((int)$category['cat_id']);

                    if(!($term instanceof WP_Term)) continue;

                    $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
                    $image = wp_get_attachment_url( $thumbnail_id );

                    $category_url = get_term_link( $term->term_id, $term->taxonomy );
            ?>

            <a href="<?php echo $category_url;?>" class="categories-block__item <?php echo !empty($category['css_class']) ? $category['css_class'] : 'w25';?>">
                <span class="top-name">
                    <i class="<?php echo fw_get_db_term_option($term->term_id, $term->taxonomy, 'product_cat_icon');?>"></i>
                    <span><?php echo $term->name;?></span>
                </span>

                <span class="item-img">
                    <?php
                    if ( $image ) {
                        echo '<img src="' . $image . '" alt="' . $term->name . '" />';
                    }
		            ?>
                </span>
            </a>
            <?php endforeach;?>
        </div>
    </div>
</div>

<?php wp_reset_postdata();?>