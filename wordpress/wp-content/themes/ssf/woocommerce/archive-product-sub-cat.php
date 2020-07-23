<?php
// Category have child categories

$foreach_counter = 0;

?>

<div class="subcategories-block">
    <div class="container">
        <div class="subcategories-block__list">
            <?php
                foreach ($children as $child_cat):
                    $foreach_counter++;

                    $thumbnail_id = get_woocommerce_term_meta( $child_cat->term_id, 'thumbnail_id', true );
                    $image = wp_get_attachment_url( $thumbnail_id );

                    $category_url = get_term_link( $child_cat->term_id, $child_cat->taxonomy );

            ?>

            <a href="<?php echo $category_url;?>" class="subcategories-block__card-item">
                <span class="item-name"><?php echo $child_cat->name;?></span>
                <span class="item-img">
                    <?php
                    if ( !empty($image) ) {
                        echo '<img src="' . $image . '" alt="' . $child_cat->name . '" />';
                    }
                    ?>
                </span>
            </a>

            <?php if($foreach_counter == 4):?>
                <div class="subcategories-block__quality-block">
                    <div class="item-ico-wrap"><i class="icon-medal"></i></div>
                    <div class="item-title">Высокое качество</div>
                    <div class="item-descr">У нас вы можете приобрести только оригинальные лампы самого высокого качества. Вся продукция проверена и сертифицирована.</div>
                </div>
            <?php endif;?>

            <?php endforeach;?>

        </div>
    </div>
</div>


<?php popular_products($current_category); ?>


<?php echo do_shortcode('[shop_benefits use_default="default"]');?>