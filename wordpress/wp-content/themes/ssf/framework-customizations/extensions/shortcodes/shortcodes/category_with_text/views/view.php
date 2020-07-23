<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

    $args = array(
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
        'order' => 'ASC',
        'parent' => 0,
        'hide_empty' => 0,
        'exclude' => [15],
    );

    $categories = get_terms($args);

    shuffle($categories);
    $foreach_counter = 0;

?>
<div class="pre-footer">
    <div class="container">

        <?php if( !empty($atts['show_cat']) && $atts['show_cat'] == 'true' ): // true as string ?>

            <div class="pre-footer__categories-list">
                <?php
                foreach ($categories as $category):

                    if($foreach_counter++ == 6 ) break;

                    $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
                    $image = wp_get_attachment_url( $thumbnail_id );

                    $category_url = get_term_link( $category->term_id, $category->taxonomy );
                    ?>
                    <a href="<?php echo $category_url;?>" class="pre-footer__category-item">
                        <span class="name"><?php echo $category->name;?></span>
                        <span class="item-img"><img src="<?php echo $image;?>" alt="<?php echo $category->name;?>"></span>
                    </a>
                <?php endforeach;?>
            </div>

        <?php endif;?>

        <div class="pre-footer__text-row">
            <div class="col">
                <?php echo !empty($atts['left_text']) ? $atts['left_text'] : '';?>
             </div>
            <div class="col">
                <?php echo !empty($atts['right_text']) ? $atts['right_text'] : '';?>
            </div>
        </div>
    </div>
</div>