<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

global $product, $wp;

$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );

$image = $product ? $product->get_image( $image_size ) : '';

?>

<div class="item-card <?php echo isset($css_class) ? esc_attr($css_class) : '';?>">
    <a href="<?php echo $link;?>" class="item-card__main">
        <?php ssf_render_product_flash();?>
        <span class="item-card__img"><?php echo $image;?></span>
        <span class="item-card__name"><?php echo get_the_title();?></span>
        <span class="item-card__price">
			<span class="new-price"><?php pretty_price_format( $product->get_price() );?> ₽</span>
		</span>
    </a>
    <div class="item-card__bottom-buttons">
        <a href="<?php echo $link;?>" class="item-card__button details-btn">
            <span>Подробнее</span>
            <i class="icon-arrow"></i>
        </a>
        <?php woocommerce_template_loop_add_to_cart();?>
    </div>
</div>
