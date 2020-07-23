<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
//
global $product;

/** @var WC_Product $product */

$product_thumbnail_id = get_post_thumbnail_id();
$product_gallery_ids  = $product->get_gallery_attachment_ids(); // ids or empty array

if(!empty($product_thumbnail_id)) {
    array_unshift($product_gallery_ids, (int) $product_thumbnail_id);
}

$product_gallery = [];

if(!empty($product_gallery_ids) && is_array($product_gallery_ids)) {

    $counter = 0;

    foreach ($product_gallery_ids as $img_id) {

        $product_gallery[$counter]['img'] = wp_get_attachment_image($img_id, 'big-thumb', false, ['class'=>'']);
        $product_gallery[$counter]['src'] = wp_get_attachment_image_src($img_id, 'full')[0];

        $counter++;
    }
}

?>
<!--<div id="product---><?php //the_ID(); ?><!--" --><?php //wc_product_class(); ?>
<!---->
<!--	--><?php
//		/**
//		 * Hook: woocommerce_before_single_product_summary.
//		 *
//		 * @hooked woocommerce_show_product_sale_flash - 10
//		 * @hooked woocommerce_show_product_images - 20
//		 */
//		do_action( 'woocommerce_before_single_product_summary' );
//	?>
<!---->
<!--	<div class="summary entry-summary">-->
<!--		--><?php
//			/**
//			 * Hook: woocommerce_single_product_summary.
//			 *
//			 * @hooked woocommerce_template_single_title - 5
//			 * @hooked woocommerce_template_single_rating - 10
//			 * @hooked woocommerce_template_single_price - 10
//			 * @hooked woocommerce_template_single_excerpt - 20
//			 * @hooked woocommerce_template_single_add_to_cart - 30
//			 * @hooked woocommerce_template_single_meta - 40
//			 * @hooked woocommerce_template_single_sharing - 50
//			 * @hooked WC_Structured_Data::generate_product_data() - 60
//			 */
//			do_action( 'woocommerce_single_product_summary' );
//		?>
<!--	</div>-->
<!---->
<!--	--><?php
//		/**
//		 * Hook: woocommerce_after_single_product_summary.
//		 *
//		 * @hooked woocommerce_output_product_data_tabs - 10
//		 * @hooked woocommerce_upsell_display - 15
//		 * @hooked woocommerce_output_related_products - 20
//		 */
//		do_action( 'woocommerce_after_single_product_summary' );
//	?>
<!--</div>-->

<div class="product__top">
    <div class="container">
        <h1 class="product__name"><?php the_title();?></h1>

        <div class="product__top-row">
            <div class="product__images-wrap">
                <div class="product__main-images-slider">
                    <?php
                        if(!empty($product_gallery) ):
                            foreach ($product_gallery as $img):
                    ?>
                    <a data-fancybox="product-gallery" href="<?php echo $img['src'];?>" class="item">
                        <span class="inner-flex"><?php echo $img['img'];?></span>
                        <?php ssf_render_product_flash();?>
                    </a>
                    <?php
                            endforeach;
                        endif;
                    ?>
                </div>
                <div class="product__nav-images-slider">

                    <?php
                        if(!empty($product_gallery)){

                            $counter = 0;

                            foreach ($product_gallery as $img) {
                                if($counter < 7){
                                    echo '<a data-fancybox href="'.$img["src"].'" class="item"><div class="inner-flex">'.$img["img"].'</div></a>';
                                }
                                else{
                                    echo '<a data-fancybox="product-gallery" href="'.$img["src"].'" class="view-all"><div class="inner-flex"><div class="caption">еще <b>'.( sizeof($product_gallery) - 7 ).'</b> фото</div></div></a>';
                                    break;
                                }

                                $counter++;
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="product__top-right">
                <div class="product__top-description">
                    <a href="javascript:;" class="product__description-mobile-more">Читать далее</a>
                    <?php echo wpautop( get_the_content() );?>
                </div>
                <div class="product__info-row">
                    <?php if($product->is_in_stock()):?>
                        <div class="product__availability green">
                            <i class="icon-correct"></i>
                            <span>Есть в наличии</span>
                        </div>
                    <?php else:?>
                        <div class="product__availability red">
                            <i class="icon-cancel"></i>
                            <span>Нет в наличии</span>
                        </div>
                    <?php endif;?>



                    <?php if( $product->is_on_sale() ):?>

                    <div class="product__price">
                        <div class="old-price"><?php echo $product->get_regular_price().' ₽';?></div>
                        <div class="new-price"><?php echo $product->get_sale_price().' ₽';?></div>
                    </div>

                    <?php else: ?>

                        <div class="product__price">
                            <div class="old-price"></div>
                            <div class="new-price"><?php echo $product->get_price().' ₽';?></div>
                        </div>

                    <?php endif;?>

                    <div class="product__reviews">
                        <div class="rating-block" data-rateyo-rating="<?php echo $product->get_average_rating();?>"></div>
                        <div class="reviews-count"><?php echo ssf_get_comments($product->get_id(),'comment', ['count'=>1]);?> отзывов</div>
                    </div>
                </div>

                <?php if($product->is_in_stock()):?>

                        <div class="product__act-row">
                            <div class="product__quant-wrap">
                                <div class="caption">Количество:</div>
                                <div class="input-wrap">
                                    <input type="number" min="1" max="25" class="text-input single_product_quantity" value="1" name="quantity">
                                </div>
                            </div>

                            <?php woocommerce_template_loop_add_to_cart();?>

                            <a href="javascript:;" data-toggle="modal" data-target="#oneclick-popup"
                               class="btn btn--bordered product__one-click">
                                <span>Купить в 1 клик</span>
                                <i class="icon-click"></i>
                            </a>
                        </div>

                <?php else:?>
                <div class="product__unavailable-block">
                    <div class="caption">Позвоните по бесплатному номеру, чтобы узнать о ближайшем поступлении этого товара.</div>

                    <a href="tel:<?php echo preg_replace( '/[^0-9]/', '', fw_get_db_settings_option('phone'));?>" class="tel-link"><?php echo fw_get_db_settings_option('phone');?></a>
                </div>
                <?php endif;?>

                <div class="product__wedo">
                    <div class="top-title">Мы предоставляем</div>
                    <div class="wedo-item">
                        <div class="item-icon"><i class="icon-credit-card"></i></div>
                        <div class="caption"><b>Удобную оплату:</b> наличными при получении, банковской картой, QIWI, Яндекс, интернет-банком онлайн на нашем сайте</div>
                    </div>
                    <div class="wedo-item">
                        <div class="item-icon"><i class="icon-delivery"></i></div>
                        <div class="caption"><b>Быструю доставку</b> по всей стране: курьером до двери, транспортной компанией, почтой россии</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php  get_template_part('template-parts/single-product/product-market', 'icon' );?>

<?php  get_template_part('template-parts/single-product/product-meta', 'tabs' );?>

<?php wc_get_template('single-product/cross-sells.php');?>

<?php woocommerce_upsell_display();?>

<?php    // Benefits

    $benefits_data = fw_get_db_post_option( $product->get_id(), 'popup_benefits' );

    $benefits_data['use_default'] = !empty($benefits_data['use_default']) ? $benefits_data['use_default'] : 'default';

    $benefits_icon_1 = $benefits_data['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_icon_1') : (!empty($benefits_data['icon_1']['icon-class']) ? $benefits_data['icon_1']['icon-class'] : '');
    $benefits_icon_2 = $benefits_data['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_icon_2') : (!empty($benefits_data['icon_2']['icon-class']) ? $benefits_data['icon_2']['icon-class'] : '');
    $benefits_icon_3 = $benefits_data['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_icon_3') : (!empty($benefits_data['icon_3']['icon-class']) ? $benefits_data['icon_3']['icon-class'] : '');
    $benefits_title_1 = $benefits_data['use_default'] == 'default' ? fw_get_db_settings_option('default_shop_benefits_title_1') : (!empty($benefits_data['title_1']) ? $benefits_data['title_1'] : '');
    $benefits_title_2 = $benefits_data['use_default'] == 'default' ? fw_get_db_settings_option('default_shop_benefits_title_2') : (!empty($benefits_data['title_2']) ? $benefits_data['title_2'] : '');
    $benefits_title_3 = $benefits_data['use_default'] == 'default' ? fw_get_db_settings_option('default_shop_benefits_title_3') : (!empty($benefits_data['title_3']) ? $benefits_data['title_3'] : '');
    $benefits_text_1 = $benefits_data['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_text_1') : (!empty($benefits_data['text_1']) ? $benefits_data['text_1'] : '');
    $benefits_text_2 = $benefits_data['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_text_2') : (!empty($benefits_data['text_2']) ? $benefits_data['text_2'] : '');
    $benefits_text_3 = $benefits_data['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_text_3') : (!empty($benefits_data['text_3']) ? $benefits_data['text_3'] : '');
;?>
<div class="advantages-block">
    <div class="container">
        <div class="advantages-block__list">
            <div class="advantages-block__item">
                <div class="advantages-block__item-icon"><i class="<?php echo $benefits_icon_1;?>"></i></div>
                <div class="advantages-block__title"><?php echo $benefits_title_1;?></div>
                <div class="advantages-block__descr"><?php echo $benefits_text_1;?></div>
            </div>
            <div class="advantages-block__item">
                <div class="advantages-block__item-icon"><i class="<?php echo $benefits_icon_2;?>"></i></div>
                <div class="advantages-block__title"><?php echo $benefits_title_2;?></div>
                <div class="advantages-block__descr"><?php echo $benefits_text_2;?></div>
            </div>
            <div class="advantages-block__item">
                <div class="advantages-block__item-icon"><i class="<?php echo $benefits_icon_3;?>"></i></div>
                <div class="advantages-block__title"><?php echo $benefits_title_3;?></div>
                <div class="advantages-block__descr"><?php echo $benefits_text_3;?></div>
            </div>
        </div>
    </div>
</div>


<div class="popup-block" id="oneclick-popup">
    <div class="popup-block__overlay">
        <div class="popup-block__popup popup-block__oneclick">
            <div class="inner-content">
                <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>
                <div class="popup-block__title">Быстрый заказ</div>
                <form class="popup-block__oneclick-form" method="POST">
                    <div class="input-wrapper with-addon">
                        <div class="input-addon"><i class="icon-user"></i></div>
                        <input type="text" class="text-input" name="ssf_name" placeholder="Введите ваше имя" required>
                    </div>
                    <div class="input-wrapper with-addon">
                        <div class="input-addon"><i class="icon-email"></i></div>
                        <input type="email" class="text-input" name="ssf_email" placeholder="Введите вашу почту" required>
                    </div>
                    <div class="input-wrapper with-addon">
                        <div class="input-addon"><i class="icon-form-tel"></i></div>
                        <input type="tel" class="text-input" name="ssf_phone" placeholder="Введите ваш телефон" required>
                    </div>
                    <button type="submit" data-target="#oneclick-success" class="btn submit-button">Позвоните мне</button>
                    <input type="hidden" name="product_name" value="<?php echo $product->get_name();?>">
                    <input type="hidden" name="product_link" value="<?php the_permalink();?>">
                    <?php SSF_Form_Handler::serviceFields('buy_in_one_click');?>
                    <div class="popup-block__agree">Нажав на кнопку «Позвонить мне», вы автоматически соглашаетесь на <a href="#">обработку персональных данных.</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
