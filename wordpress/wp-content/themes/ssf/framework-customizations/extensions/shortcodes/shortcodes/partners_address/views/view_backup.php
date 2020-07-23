<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
$p_add = fw_get_db_settings_option('partners_address');

$search_param_name = 'partner_stores';

$search_string = !empty($_REQUEST[$search_param_name]) ? _wp_specialchars( trim( $_REQUEST[$search_param_name] ) ) : null;

?>
<div class="top-information">
    <div class="top-information__bg-img">
        <!-- <img src="img/warranty-bg.jpg" alt=""> -->
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

        <h1>Где купить нашу продукцию?</h1>

        <div class="top-information__descr">Вы можете купить продукцию Silver StoneF1 на территории всей России у наший официальных партнеров. Все магазины партнеров представлены на этой странице. Просто введите свой город в поле ниже и выберите подходящий вам магазин.</div>

        <div id="locations-search-wrapper" class="locations-block__search-input-wrapper">


            <form action="<?php echo fw_current_url()?>" method="GET">
                <input id="city-search-input" type="text" class="text-input" placeholder="Введите ваш город" name="<?php echo $search_param_name;?>" value="<?php echo $search_string;?>" autocomplete="off">
                <button class="search-button"><i class="icon-search"></i></button>
            </form>
            <div class="locations-block__search-dropdown" id="locations-search-dropdown">

                <ul>
                    <?php
                        if(!empty($p_add) && is_array($p_add)):
                            foreach ($p_add as $location):
                                if(empty($location['city'])) continue;
                    ?>
                    <li class="city-search-item" onclick="location.href ='<?php echo add_query_arg( $search_param_name, $location['city'], fw_current_url() )?>';"><?php echo $location['city'];?></li>
                    <?php
                            endforeach;
                        endif;
                    ?>
                </ul>

                <a href="javascript:;" class="search-dropdown-close" id="locations-search-dropdown-close">
                    <span class="close-text">Закрыть поиск</span>
                    <i class="icon-chevron"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php if(empty( $search_string )):?>
<div class="locations-block">
    <div class="locations-block__cities-block" id="location-cities-block">
        <div class="container">
            <div class="locations-block__cities-list">
                <ul>
                    <?php
                        if(!empty($p_add) && is_array($p_add)):
                            foreach ($p_add as $location):
                                if(empty($location['city'])) continue;
                    ?>
                    <li>
                        <a href="<?php echo add_query_arg( $search_param_name, $location['city'], fw_current_url() )?>">
                            <i class="icon-map-marker"></i>
                            <span><?php echo $location['city'];?></span>
                        </a>
                    </li>
                    <?php
                            endforeach;
                        endif;
                    ?>
                </ul>
                <a href="javascript:;" id="location-show-more" class="locations-block__mobile-show-more">
                    <span>Показать все города</span>
                    <i class="icon-chevron"></i>
                </a>
            </div>
        </div>
    </div>
    <?php echo do_shortcode('[mapplic id="519"]'); ?>
</div>
<?php else:?>
    <div class="locations-block">
        <div class="container">
            <div class="locations-block__stores-list" id="location-stores-block">

                <?php

                    $city = $search_string;

                    foreach ($p_add as $location){
                        if (!empty($location['city']) && mb_strtoupper($location['city']) == mb_strtoupper($city)){
                            $target_city = $location;
                        }
                    }

                    if (!empty($target_city['stores']) && is_array($target_city['stores'])):
                        foreach ($target_city['stores'] as $store):
                ?>

                <div class="locations-block__store-item">
                    <div class="locations-block__card">
                        <div class="locations-block__card-img"><img src="<?php echo !empty($store['logo']['url']) ? $store['logo']['url'] : '' ?>" alt=""></div>

                        <div class="locations-block__item-content">
                            <div class="locations-block__item-name"><?php echo !empty($store['title']) ? $store['title'] : '' ?></div>

                            <div class="locations-block__item-descr"><?php echo !empty($store['desc']) ? $store['desc'] : '' ?></div>

                            <div class="locations-block__item-contacts">
                                <?php if(!empty($store['desc'])):?>
                                <a href="//<?php echo $store['web_site'];?>" class="cont-row">
                                    <i class="icon-www"></i>
                                    <span><?php echo $store['web_site'];?></span>
                                </a>
                                <?php endif;?>
                                <?php if(!empty($store['phone'])):?>
                                <a href="tel:<?php echo preg_replace( '/[^0-9]/', '', $store['phone']);?>" class="cont-row">
                                    <i class="icon-tel"></i>
                                    <span><?php echo $store['phone'];?></span>
                                </a>
                                <?php endif;?>
                                <?php if(!empty($store['address'])):?>
                                <div class="cont-row">
                                    <i class="icon-home"></i>
                                    <span><?php echo $store['address'];?></span>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        endforeach;
                    endif;
                ?>
            </div>

            <a href="javascript:;" id="location-show-more-stores" class="locations-block__mobile-show-more stores-button">
                <span>Показать все магазины</span>
                <i class="icon-chevron"></i>
            </a>
        </div>
    </div>
<?php endif;?>
