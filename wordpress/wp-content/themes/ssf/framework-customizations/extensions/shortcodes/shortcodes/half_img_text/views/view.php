<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

?>
<div class="warranty-block">
    <div class="container">
        <div class="warranty-block__descr-item<?php echo !empty($atts['position']) && $atts['position'] == 'right' ? ' reverse' : ''; ?>">
            <div class="warranty-block__img-block">
                <div class="inner-img"><img src="<?php echo !empty($atts['img']['url']) ? $atts['img']['url'] : '' ?>">" alt=""></div>
            </div>

            <div class="warranty-block__main-content">
                <div class="warranty-block__top-heading">
                    <i class="<?php echo !empty($atts['icon']['icon-class']) ? $atts['icon']['icon-class'] : '' ?>"></i>
                    <span><?php echo !empty($atts['title']) ? $atts['title'] : '' ?></span>
                </div>

                <?php echo !empty($atts['text']) ? $atts['text'] : '' ?>

            </div>
        </div>
    </div>
</div>