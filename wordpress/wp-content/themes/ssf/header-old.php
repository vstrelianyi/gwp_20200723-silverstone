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

    <link rel="icon" type="image/x-icon" sizes="16x16" href="<?php echo get_template_directory_uri();?>/assets/img/16x16.ico">
    <link rel="icon" type="image/x-icon" sizes="32x32" href="<?php echo get_template_directory_uri();?>/img/32x32.ico">
    <link rel="icon" type="image/png" sizes="50x50" href="<?php echo get_template_directory_uri();?>/img/50x50.png">
    <link rel="icon" type="image/png" sizes="60x60" href="<?php echo get_template_directory_uri();?>/img/60x60.png">
    <link rel="icon" type="image/png" sizes="72x72" href="<?php echo get_template_directory_uri();?>/img/72x72.png">
    <link rel="icon" type="image/png" sizes="76x76" href="<?php echo get_template_directory_uri();?>/img/76x76.png">
    <link rel="icon" type="image/png" sizes="114x114" href="<?php echo get_template_directory_uri();?>/img/114x114.png">
    <link rel="icon" type="image/png" sizes="120x120" href="<?php echo get_template_directory_uri();?>/img/120x120.png">
    <link rel="icon" type="image/png" sizes="144x144" href="<?php echo get_template_directory_uri();?>/img/144x144.png">
    <link rel="icon" type="image/png" sizes="152x152" href="<?php echo get_template_directory_uri();?>/img/152x152.png">

    <!-- CONFIG -->
    <meta name="format-detection" content="telephone=no">

    <title>Silverstone - Компания</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/main.css">

    <!-- WP_HEAD -->
    <?php wp_head(); ?>
    <!-- END WP_HEAD -->
</head>

<body <?php body_class(); ?>>

<header class="page-header">
    <div class="page-header__top-part">
        <div class="container">
            <div class="page-header__top-row">
                <a href="javascript:;" class="page-header__search only-mobile"><i class="icon-search"></i></a>

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
                            <ul>
                                <li><a href="#">Оплата и доставка</a></li>
                                <li><a href="#">Гарантия</a></li>
                                <li><a href="#">Адреса магазин-партнеров</a></li>
                            </ul>
                        </div>

                        <div class="page-header__mobile-user">
                            <a href="#" class="user-link">
                                <span class="item-img"><img src="<?php echo get_template_directory_uri();?>/assets/img/user-img.png" alt=""></span>

                                <span class="name">Александр</span>
                            </a>

                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i>
                                        <span>Личный кабинет</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="icon-history"></i>
                                        <span>История заказов</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="icon-logout"></i>
                                        <span>Выход</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a href="javascript:;" class="page-header__search"><i class="icon-search"></i></a>

                        <div class="page-header__tel-block">
                            <a href="tel:<?php echo preg_replace( '/[^0-9]/', '', fw_get_db_settings_option('phone'));?>" class="tel-link"><?php echo fw_get_db_settings_option('phone');?></a>

                            <div class="opt-list">
                                <div class="item">Бесплатно по РФ</div>

                                <div class="item"><?php echo fw_get_db_settings_option('working_hours');?></div>
                            </div>
                        </div>

                        <a href="javascript:;" class="btn brand-btn page-header__become-partner">Стать партнером</a>
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
                            <span class="count"><?php echo WC()->cart->get_cart_contents_count();?></span>
                        </span>
                        <span class="caption">Корзина</span>
                    </a>
                </div>

                <div class="page-header__user">
                    <a class="user-toggle" data-toggle="dropdown-toggle" href="javascript:;">
                        <span class="user-img"><img src="<?php echo get_template_directory_uri();?>/assets/img/user-img.png" alt=""></span>
                        <span class="name">Александр</span>
                        <i class="icon-chevron"></i>
                    </a>

                    <ul class="dropdown-menu page-header__dropdown">
                        <li>
                            <a href="#">
                                <i class="icon-user"></i>
                                <span>Личный кабинет</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-history"></i>
                                <span>История заказов</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-logout"></i>
                                <span>Выход</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

</header>