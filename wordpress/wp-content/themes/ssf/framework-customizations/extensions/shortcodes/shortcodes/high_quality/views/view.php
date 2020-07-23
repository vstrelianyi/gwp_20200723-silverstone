<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

?>
<div class="company-quality" style="background-image: <?php echo !empty($atts['background']['url']) ? 'url('.$atts['background']['url'].')' : 'none' ?>">
    <div class="container">
        <h2><?php echo !empty($atts['title']) ? $atts['title'] : '' ?></h2>
        <div class="company-quality__descr">
            <?php echo !empty($atts['text']) ? $atts['text'] : '' ?>
        </div>
        <div class="company-quality__advantages">
            <?php
                if(is_array($atts['tiles'])):
                    foreach ($atts['tiles'] as $tile):
            ?>
            <div class="company-quality__adv-item">
                <div class="item-icon"><i class="<?php echo !empty($tile['icon']['icon-class']) ? $tile['icon']['icon-class'] : '' ?>"></i></div>
                <div class="caption"><?php echo !empty($tile['title']) ? $tile['title'] : '' ?></div>
            </div>
            <?php
                    endforeach;
                endif;
            ?>
        </div>
    </div>
</div>