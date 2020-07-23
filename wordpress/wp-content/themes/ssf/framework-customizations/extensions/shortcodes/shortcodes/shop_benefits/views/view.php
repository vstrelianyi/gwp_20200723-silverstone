<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

$icon_1 = $atts['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_icon_1') : (!empty($atts['icon_1']) ? $atts['icon_1'] : '');
$icon_2 = $atts['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_icon_2') : (!empty($atts['icon_2']) ? $atts['icon_2'] : '');
$icon_3 = $atts['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_icon_3') : (!empty($atts['icon_3']) ? $atts['icon_3'] : '');
$title_1 = $atts['use_default'] == 'default' ? fw_get_db_settings_option('default_shop_benefits_title_1') : (!empty($atts['title_1']) ? $atts['title_1'] : '');
$title_2 = $atts['use_default'] == 'default' ? fw_get_db_settings_option('default_shop_benefits_title_2') : (!empty($atts['title_2']) ? $atts['title_2'] : '');
$title_3 = $atts['use_default'] == 'default' ? fw_get_db_settings_option('default_shop_benefits_title_3') : (!empty($atts['title_3']) ? $atts['title_3'] : '');
$text_1 = $atts['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_text_1') : (!empty($atts['text_1']) ? $atts['text_1'] : '');
$text_2 = $atts['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_text_2') : (!empty($atts['text_2']) ? $atts['text_2'] : '');
$text_3 = $atts['use_default'] == 'default'  ? fw_get_db_settings_option('default_shop_benefits_text_3') : (!empty($atts['text_3']) ? $atts['text_3'] : '');
;?>
<div class="advantages-block">
    <div class="container">
        <div class="advantages-block__list">
            <div class="advantages-block__item">
                <div class="advantages-block__item-icon"><i class="<?php echo $icon_1;?>"></i></div>
                <div class="advantages-block__title"><?php echo $title_1;?></div>
                <div class="advantages-block__descr"><?php echo $text_1;?></div>
            </div>
            <div class="advantages-block__item">
                <div class="advantages-block__item-icon"><i class="<?php echo $icon_2;?>"></i></div>
                <div class="advantages-block__title"><?php echo $title_2;?></div>
                <div class="advantages-block__descr"><?php echo $text_2;?></div>
            </div>
            <div class="advantages-block__item">
                <div class="advantages-block__item-icon"><i class="<?php echo $icon_3;?>"></i></div>
                <div class="advantages-block__title"><?php echo $title_3;?></div>
                <div class="advantages-block__descr"><?php echo $text_3;?></div>
            </div>
        </div>
    </div>
</div>
