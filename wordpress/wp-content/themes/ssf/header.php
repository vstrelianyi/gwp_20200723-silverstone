<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SilverStoneF1
 */




?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- ADAPTIVITY -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#ff9800">

    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#ff9800">

    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-touch-fullscreen" content="yes">

    <link rel="icon" type="image/x-icon" sizes="16x16" href="<?php echo get_template_directory_uri();?>/assets/img/16x16.ico?v=2">
    <link rel="icon" type="image/x-icon" sizes="32x32" href="<?php echo get_template_directory_uri();?>/assets/img/32x32.ico?v=2">
    <link rel="icon" type="image/png" sizes="50x50" href="<?php echo get_template_directory_uri();?>/assets/img/50x50.png?v=2">
    <link rel="icon" type="image/png" sizes="60x60" href="<?php echo get_template_directory_uri();?>/assets/img/60x60.png?v=2">
    <link rel="icon" type="image/png" sizes="72x72" href="<?php echo get_template_directory_uri();?>/assets/img/72x72.png?v=2">
    <link rel="icon" type="image/png" sizes="76x76" href="<?php echo get_template_directory_uri();?>/assets/img/76x76.png?v=2">
    <link rel="icon" type="image/png" sizes="114x114" href="<?php echo get_template_directory_uri();?>/assets/img/114x114.png?v=2">
    <link rel="icon" type="image/png" sizes="120x120" href="<?php echo get_template_directory_uri();?>/assets/img/120x120.png?v=2">
    <link rel="icon" type="image/png" sizes="144x144" href="<?php echo get_template_directory_uri();?>/assets/img/144x144.png?v=2">
    <link rel="icon" type="image/png" sizes="152x152" href="<?php echo get_template_directory_uri();?>/assets/img/152x152.png?v=2">

    <!-- CONFIG -->
    <meta name="format-detection" content="telephone=no">

    <!-- CSS -->
    <!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/main.css"> -->

    <!-- WP_HEAD -->
    <?php wp_head(); ?>
    <!-- END WP_HEAD -->
</head>

<body <?php body_class(); ?>>

<header class="page-header">
    <div class="page-header__top-part">
        <div class="container">
            <div class="page-header__top-row">
                <a href="javascript:;" data-toggle="modal" data-target="#search-popup" class="page-header__search only-mobile"><i class="icon-search"></i></a>

                <a href="<?php echo home_url();?>" class="page-header__logo">
                    <img src="<?php echo get_template_directory_uri();?>/assets/img/main-logo-blue.svg" alt="" class="main-logo">
                    <img src="<?php echo get_template_directory_uri();?>/assets/img/tablet-logo.svg" alt="" class="tablet-logo">
                </a>

                <a href="javascript:;" class="page-header__menu-toggle" id="menu-toggle"><span></span></a>

                <div class="page-header__menu" id="header-menu">
                    <div class="inner-flex">
                        <div class="page-header__top-nav">
                            <div class="mobile-caption">Меню</div>
                            <?php
                                wp_nav_menu( array(
                                    'theme_location'  => '',
                                    'menu'            => 'top_menu',
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                ) );
                            ?>
                        </div>

                        <div class="page-header__mobile-nav">
                            <?php
                                wp_nav_menu( array(
                                    'theme_location'  => '',
                                    'menu'            => 'mob_1',
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                ) );
                            ?>
                        </div>

                        <div class="page-header__mobile-user">

                            <?php if(is_user_logged_in()):?>

                            <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>" class="user-link">
                                <span class="item-img"><?php echo get_wp_user_avatar( wp_get_current_user()->ID, 220); ?></span>
                                <span class="name"><?php echo wp_get_current_user()->user_nicename;?></span>
                            </a>

                            <ul>
                                <li>
                                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                                        <i class="icon-user"></i>
                                        <span>Личный кабинет</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo wc_get_account_endpoint_url( 'orders' );?>">
                                        <i class="icon-history"></i>
                                        <span>История заказов</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo wc_get_account_endpoint_url( 'customer-logout' );?>">
                                        <i class="icon-logout"></i>
                                        <span>Выход</span>
                                    </a>
                                </li>
                            </ul>

                            <?php else:?>

                            <a class="page-header__login-button" data-toggle="modal" data-target="#auth-popup" href="javascript:;">
                                <i class="icon-user-2"></i>
                                <span>Кабинет</span>
                            </a>

                            <?php endif;?>
                        </div>

                        <a data-toggle="modal" data-target="#search-popup" href="javascript:;" class="page-header__search"><i class="icon-search"></i></a>

                        <div class="page-header__tel-block">
                            <a href="tel:<?php echo preg_replace( '/[^0-9]/', '', fw_get_db_settings_option('phone'));?>" class="tel-link"><?php echo fw_get_db_settings_option('phone');?></a>

                            <div class="opt-list">
                                <div class="item">Бесплатно по РФ</div>

                                <div class="item"><?php echo fw_get_db_settings_option('working_hours');?></div>
                            </div>
                        </div>

                        <!-- <a href="<?php the_permalink(361);?>" target="_blank" class="btn brand-btn page-header__become-partner">Стать партнером</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header__bottom-part">
        <div class="container">
            <div class="page-header__bottom-row">
                <div class="page-header__bottom-nav">
                    <?php
                        wp_nav_menu( array(
                            'theme_location'  => '',
                            'menu'            => 'shop_menu',
                            'container'       => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'walker'          => new Shop_Walker_Nav_Menu(),
                        ) );
                    ?>
                </div>


                <div class="page-header__cart-wrap">
                    <a href="<?php the_permalink( wc_get_page_id( 'cart' ) ); ?>" class="page-header__cart">
								<span class="ico-wrap">
									<i class="icon-cart"></i>

									<span class="count cart_items_quantity"><?php echo WC()->cart->get_cart_contents_count();?></span>
								</span>

                        <span class="caption">Корзина</span>
                    </a>
                </div>

                <?php if(is_user_logged_in()):?>

                    <div class="page-header__user">

                        <a class="user-toggle" data-toggle="dropdown-toggle" href="javascript:;">
                            <span class="user-img"><?php echo get_wp_user_avatar( wp_get_current_user()->ID, 60); ?></span>
                            <span class="name"><?php echo wp_get_current_user()->user_nicename;?></span>
                            <i class="icon-chevron"></i>
                        </a>

                        <ul class="dropdown-menu page-header__dropdown">
                            <li>
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                                    <i class="icon-user"></i>
                                    <span>Личный кабинет</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo wc_get_account_endpoint_url( 'orders' );?>">
                                    <i class="icon-history"></i>
                                    <span>История заказов</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo wc_get_account_endpoint_url( 'customer-logout' );?>">
                                    <i class="icon-logout"></i>
                                    <span>Выход</span>
                                </a>
                            </li>
                        </ul>

                    </div>

                <?php else:?>

                    <div class="page-header__user">
                        <a class="page-header__login-button" data-toggle="modal" data-target="#auth-popup" href="javascript:;">
                            <i class="icon-user-2"></i>
                            <span>Кабинет</span>
                        </a>
                    </div>

                <?php endif;?>

            </div>
        </div>
    </div>

</header>

<div class="popup-block" id="search-popup">
    <div class="popup-block__overlay search-popup__popup-overlay">
        <div class="popup-block__popup search-popup">
            <div class="inner-content">
                <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>

                <div class="search-popup__main-title">Поиск</div>

                <div class="search-popup__main-wrapper" id="search-popup-wrapper">

                    <form action="/" method="get">
                        <input type="text" class="text-input" name="s" placeholder="Введите ваш запрос, например “HYBRID UNO”" required autocomplete="off">
                        <input type="hidden" name="post_type" value="product">
                        <button type="submit" class="search-button"><i class="icon-search"></i></button>
                    </form>


                    <div class="search-popup__search-dropdown" id="main-search-dropdown">
                        <ul class="customScrollbar" id="search-result-list">
<!--                            <li>-->
<!--                                <span class="img-wrapper"><img src="--><?php //echo get_template_directory_uri();?><!--/assets/img/video-reg.png" alt=""></span>-->
<!--                                <span class="name"><span class="marked">Ко</span>мбо-устройство SilverStone F1 HYBRID UNO A12</span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <span class="img-wrapper"><img src="--><?php //echo get_template_directory_uri();?><!--/assets/img/video-reg.png" alt=""></span>-->
<!--                                <span class="name"><span class="marked">Ко</span>мбо-устройство SilverStone F1 HYBRID UNO A12</span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <span class="img-wrapper"><img src="--><?php //echo get_template_directory_uri();?><!--/assets/img/video-reg.png" alt=""></span>-->
<!--                                <span class="name"><span class="marked">Ко</span>мбо-устройство SilverStone F1 HYBRID UNO A12</span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <span class="img-wrapper"><img src="--><?php //echo get_template_directory_uri();?><!--/assets/img/video-reg.png" alt=""></span>-->
<!--                                <span class="name"><span class="marked">Ко</span>мбо-устройство SilverStone F1 HYBRID UNO A12</span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <span class="img-wrapper"><img src="--><?php //echo get_template_directory_uri();?><!--/assets/img/video-reg.png" alt=""></span>-->
<!--                                <span class="name"><span class="marked">Ко</span>мбо-устройство SilverStone F1 HYBRID UNO A12</span>-->
<!--                            </li>-->
                        </ul>

                        <a href="javascript:;" class="search-dropdown-close" id="main-search-dropdown-close">
                            <span class="close-text">Закрыть поиск</span>
                            <i class="icon-chevron"></i>
                        </a>
                    </div>
                </div>

                <div class="search-popup__mobile-placeholder">Введите ваш запрос, например <a href="#">каталог продукции</a></div>
            </div>
        </div>
    </div>
</div>