<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
?>
<div class="top-information top-information--white">
    <div class="top-information__bg-img"><img src="<?php echo !empty($atts['background']['url']) ? $atts['background']['url'] : '#';?>" alt=""></div>

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

        <h1><?php echo !empty($atts['title']) ? $atts['title'] : '';?></h1>

        <div class="top-information__descr no-mw"><?php echo !empty($atts['text']) ? $atts['text'] : '';?></div>

        <div class="warranty-block__adv-list">
            <?php
								if(is_array($atts['tiles'])):
									$idx = 0;
										foreach ($atts['tiles'] as $tile) :
            ?>
            <div class="warranty-block__adv-item" data-tile-id="<?php echo $idx?>">
                <div class="item-icon"><i class="<?php echo !empty($tile['icon']['icon-class']) ? $tile['icon']['icon-class'] : '';?>"></i></div>
                <div class="item-title"><?php echo !empty($tile['title']) ? $tile['title'] : '';?></div>
                <div class="item-descr"><?php echo !empty($tile['text']) ? $tile['text'] : '';?></div>
            </div>
						<?php
							$idx++;
                    endforeach;
                endif;
            ?>
        </div>
    </div>
</div>