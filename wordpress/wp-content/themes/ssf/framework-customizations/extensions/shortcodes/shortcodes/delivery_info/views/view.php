<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

$counter = 0;

?>
<div class="pay-delivery__main-content">
    <div class="container">
        <h2><?php echo !empty($atts['title']) ? $atts['title'] : ''; ?></h2>

        <div class="pay-delivery__top-tabs-wrapper">
            <div class="pay-delivery__top-tabs">

                <?php
                    if( !empty($atts['tiles']) && is_array($atts['tiles']) ):
                        foreach ($atts['tiles'] as $tile):
                            $counter++
                ?>
                <a href="javascript:;" data-toggle="tab" data-target="#delivery-tab-<?php echo $counter;?>" class="pay-delivery__tab-item<?php echo $counter == 1 ? ' active' : '';?>">
                    <span><?php echo !empty($tile['tab_title']) ? $tile['tab_title'] : ''; ?></span>
                    <i class="icon-chevron"></i>
                </a>
                <?php
                        endforeach;
                    endif;
                    $counter = 0;
                ?>

            </div>
        </div>

        <div class="pay-delivery__tab-content">

            <?php
                if( !empty($atts['tiles']) && is_array($atts['tiles']) ):
                    foreach ($atts['tiles'] as $tile):
                        $counter++
            ?>
            <div class="pay-delivery__tab-pane<?php echo $counter == 1 ? ' active' : '';?>" id="delivery-tab-<?php echo $counter;?>">

                <?php echo !empty($tile['text_delivery']) ? $tile['text_delivery'] : ''; ?>

                <div class="pay-delivery__pay-part">
                    <div class="top-heading">
                        <i class="icon-pay-wallet"></i>
                        <span><?php echo !empty($tile['title']) ? $tile['title'] : ''; ?></span>
                    </div>

                    <?php echo !empty($tile['text_payment']) ? $tile['text_payment'] : ''; ?>

                </div>
            </div>
            <?php
                        endforeach;
                    endif;
            ?>

        </div>
    </div>
</div>