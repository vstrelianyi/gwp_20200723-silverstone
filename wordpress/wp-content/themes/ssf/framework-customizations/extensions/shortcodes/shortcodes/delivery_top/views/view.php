<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
?>
<div class="top-information">
    <div class="top-information__bg-img"><img src="<?php echo !empty($atts['background']['url']) ? $atts['background']['url'] : '' ?>" alt=""></div>

    <div class="container">
        <div class="breadcrumbs">
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
        </div>

        <h1><?php echo !empty($atts['title']) ? $atts['title'] : ''; ?></h1>

        <div class="top-information__descr no-mw"><?php echo !empty($atts['text']) ? $atts['text'] : ''; ?></div>

        <div class="pay-delivery__pay-list">

            <?php
                if(!empty($atts['tiles']) && is_array($atts['tiles'])):
                    foreach ($atts['tiles'] as $tile):
            ?>
            <div class="pay-delivery__pay-method">
                <div class="pay-delivery__method-img"><img src="<?php echo !empty($tile['img']['url']) ? $tile['img']['url'] : '' ?>" alt=""></div>

                <div class="pay-delivery__method-name"><?php echo !empty($tile['title']) ? $tile['title'] : '' ?></div>
            </div>
            <?php
                    endforeach;
                endif;
            ?>
        </div>
    </div>
</div>