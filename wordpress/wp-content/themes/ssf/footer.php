<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SilverStoneF1
 */

?>

<?php

    global $post;
    global $wp_query;

    if( empty($post) || ($post->ID != 29 && !is_tax('news_cat') && !is_post_type_archive('news') && !is_singular('news'))):
        $footer_text_left_column = fw_get_db_settings_option('footer_text_left_column');
        $footer_text_right_column = fw_get_db_settings_option('footer_text_right_column');

        if(!is_shop() || is_search()){
            $footer_categories = fw_get_db_settings_option('footer_categories');
        }
?>

<div class="pre-footer">
    <div class="container">

        <?php if(!empty($footer_categories) && is_array($footer_categories)):?>

        <div class="pre-footer__categories-list">

            <?php
                foreach ($footer_categories as $category_id):

                    $product_cat = get_term_by('id', $category_id['cat_id'], 'product_cat');

                    if(!($product_cat instanceof WP_Term)) continue;

                    $thumbnail_id = get_woocommerce_term_meta( $product_cat->term_id, 'thumbnail_id', true );
                    $image = wp_get_attachment_url( $thumbnail_id );
                    $category_url = get_term_link( $product_cat->term_id, $product_cat->taxonomy );
        ?>

            <a href="<?php echo $category_url;?>" class="pre-footer__category-item">
                <span class="name"><?php echo $product_cat->name;?></span>

                <span class="item-img">
                    <?php
                    if ( $image ) {
                        echo '<img src="' . $image . '" alt="' . $product_cat->name . '" />';
                    }
                    ?>
                </span>
            </a>

            <?php endforeach; ?>

        </div>

        <?php endif;?>

        <div class="pre-footer__text-row">
            <div class="col">
                <?php echo $footer_text_left_column;?>
            </div>
            <div class="col">
                <?php echo $footer_text_right_column;?>
            </div>
        </div>
    </div>
</div>

<?php endif;?>

<footer class="page-footer">
    <div class="container">
        <div class="page-footer__row">
            <div class="page-footer__left">
                <div class="footer-logo"><img src="<?php echo get_template_directory_uri();?>/assets/img/main-logo-all-white.svg" alt=""></div>
                <div class="page-footer__promo-text">
                    <?php echo fw_get_db_settings_option('footer_text_underlogo');?>
                </div>
            </div>

            <div class="page-footer__col">
                <div class="title">Способы оплаты</div>

                <ul class="page-footer__pay-options-list">
                    <li>Банковские карты</li>
                    <li>Qiwi кошелек</li>
                    <li>Яндекс.Кошелек</li>
                    <li>Банки и терминалы</li>
                </ul>
            </div>
            <div class="page-footer__col">
                <div class="title">Частые вопросы</div>
                <?php
                wp_nav_menu( array(
                    'theme_location'  => '',
                    'menu'            => 'footer_menu',
                    'container'       => '',
                    'container_class' => '',
                    'container_id'    => '',
                ) );
                ?>
            </div>
            <div class="page-footer__col">
                <div class="title">Контакты</div>
                <a class="page-footer__tel" href="tel:<?php echo preg_replace( '/[^0-9]/', '', fw_get_db_settings_option('phone'));?>" class="tel-link"><?php echo fw_get_db_settings_option('phone');?></a>
                <ul class="page-footer__social">
                    <li>
                        <a href="<?php echo esc_url(fw_get_db_settings_option('youtube_link'));?>">
                            <i class="icon-youtube"></i>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url(fw_get_db_settings_option('vk_link'));?>">
                            <i class="icon-vk"></i>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url(fw_get_db_settings_option('facebook_link'));?>">
                            <i class="icon-fb"></i>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url(fw_get_db_settings_option('instagram_link'));?>">
                            <span class="icon-wrap"><img src="<?php echo get_template_directory_uri();?>/assets/img/icons/instagram.svg" alt=""></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-footer__copyright">
        <div class="container">
            <div class="copyright__inner"><?php echo fw_get_db_settings_option('copyright');?></div>
            <a href="#" class="page-footer__agree-link">Политика конфиденциальности</a>
        </div>
    </div>
</footer>

<div class="modal" id="modal-id-1">
	<div class="modal-content">
		<!-- button close -->
		<button class="modal-close" data-target-modal-id="1">
			<svg width="20px" height="20px" x="0px" y="0px" viewBox="0 0 47.971 47.971">
				<path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88
					c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242
					C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879
					s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
			</svg>
		</button>

		<!-- font -->
		<form>
			<input type="text" placeholder="Сумма платежа">
			<input type="text" placeholder="№ Номер заказа">
			<input type="text" placeholder="Имя">
			<input type="email" placeholder="Email">
			<textarea placeholder="Комментарии"></textarea>

			<div class="button-wrapper">
				<input type="button" value="Оплатить ремонт">
			</div>
		</form>
	</div>
</div>

<?php wp_footer(); ?>

<?php if( is_front_page() ): ?>
    <div class="hidden slider-hidden">
        <div class="slidertop-links slidertop-links--movable">
            <a class="icon icon-chat" href="#"></a><a class="icon icon-envelope" href="mailto:sale@silverstonef1.ru"></a>
        </div>
    </div>
    <script>
        $(".slidertop-links--movable").appendTo($("#rev_slider_1_1_wrapper"));
    </script>
<?php endif; ?>

<?php

//
//
//    $included_files = get_included_files();
//
//    dump(count($included_files));
//
//    foreach ($included_files as $included_file){
//
//        $included_file = substr($included_file, 38); ;
//
//        echo '<p>'.$included_file.'</p>';
//    }

?>
<!-- <script type="text/javascript" src="//consultsystems.ru/script/22879/" async charset="utf-8"></script> -->
</body>
</html>
