<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

/**
 * My Account navigation.
 * @since 2.6.0
 */

?>


<div class="woocommerce-MyAccount-content">
    <div class="cabinet-block">
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

            <h1 class="cabinet-block__mobile-title">Кабинет</h1>

            <div class="cabinet-block__main-panel">
                <div class="cabinet-block__main-panel-row">
                    <div class="cabinet-block__left-part">
                        <div class="cabinet-block__main-img-block">
                            <div class="img-wrapper"><?php echo get_wp_user_avatar( wp_get_current_user()->ID, 220); ?></div>

                            <?php if(!isAdmin()):?>
                                <a href="javascript:;" id="avatar-upload-button" class="cabinet-block__upload-button"><i class="icon-upload"></i></a>
                                <div style="display: none;">
                                    <?php avatar_uploader();?>
                                </div>
                            <?php else:?>
                                <a href="<?php echo admin_url('profile.php');?>" id="avatar-upload-button" class="cabinet-block__upload-button"><i class="icon-upload"></i></a>
                            <?php endif;?>
                        </div>

                        <?php do_action( 'woocommerce_account_navigation' ); ?>
                    </div>

                    <div class="cabinet-block__center-part">
                        <?php
                        /**
                         * My Account content.
                         * @since 2.6.0
                         */
                        do_action( 'woocommerce_account_content' );
                        ?>
                    </div>



                    <div class="cabinet-block__right-part">
                        <div class="cabinet-block__wedo">
                            <div class="top-title">Мы предоставляем</div>

                            <div class="wedo-item">
                                <div class="item-icon"><i class="icon-update1"></i></div>

                                <div class="caption"><b>Регулярные обновления</b> прошивки нашей продукции, а также базы камер. <br>На нашем сайте вы можете скачать актуальные обновления.</div>
                            </div>

                            <div class="wedo-item">
                                <div class="item-icon"><i class="icon-warranty"></i></div>

                                <div class="caption"><b>Гарантию качества</b><br> и оригинальность продукции собственного производства. 12 месяцев гарантии. <br>Профессиональный сервисный центр.</div>
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
    </div>
</div>
