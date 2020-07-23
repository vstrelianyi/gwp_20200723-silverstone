<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

// If checkout registration is disabled and not logged in, the user cannot checkout
// if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
//     echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
//     return;
// }

?>

<div class="checkout-block">
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

        <h1 class="checkout-block__main-title">Оформление заказа</h1>

            <div class="before-checkout-form">
                <?php if (!is_user_logged_in()): ?>
                    <a class="text-link checkout-block__already-have" href="<?php echo wp_lostpassword_url(); ?>">
                        <i class="icon-lock"></i>
                        <span>Забыли логин / пароль?</span>
                    </a>
                
                <?php endif; ?>
                <?php
                    remove_action('woocommerce_before_checkout_form','woocommerce_checkout_coupon_form', 10);
                    do_action( 'woocommerce_before_checkout_form', $checkout );
                ?>
            </div>

            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">


                <?php if ( $checkout->get_checkout_fields() ) : ?>

                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                    <?php do_action( 'woocommerce_checkout_billing' ); ?>

                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                <?php endif; ?>

                <div class="checkout-block__bottom-buttons">
                    <a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>" class="back-button">
                        <i class="icon-arrow"></i>
                        <span>Назад в корзину</span>
                    </a>

                    <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>

                    <button type="submit" name="woocommerce_checkout_place_order" class="btn submit-button">Оформить заказ</button>
                </div>

            </form>

    </div>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

