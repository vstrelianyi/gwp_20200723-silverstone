<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

wc_print_notices();

?>
<?php do_action( 'woocommerce_before_cart' ); ?>

    <div class="cart-block">
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
            <h1 class="cart-block__main-title" style="margin-top: -10px;">Корзина</h1>
            <div class="cart-block__main-row">
                <div class="cart-block__main-content">
                    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                        <div class="woocommerce-cart-form__contents">
                            <?php do_action( 'woocommerce_before_cart_table' ); ?>
                            <div class="cart-block__table-head">
                                <div class="th"></div>
                                <div class="th">Продукт</div>
                                <div class="th">Количество</div>
                                <div class="th">Цена за шт.</div>
                                <div class="th"></div>
                            </div>

                            <div class="cart-block__table-body">
                                <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                                <?php
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
                                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                        ?>

                                        <div class="cart-block__table-item woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                                            <div class="td product-thumbnail">
                                                <div class="cart-block__img-wrapper">
                                                    <?php
                                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                                    echo wp_kses_post( $thumbnail );
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="td product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                                <div class="val-content">
                                                    <?php
                                                    if ( ! $product_permalink ) {
                                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                                    } else {
                                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                    }

                                                    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                    // Meta data.
                                                    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                                    // Backorder notification.
                                                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>' ) );
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="td product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                                <div class="val-content">
                                                    <div class="cart-block__count-wrap">
                                                        <?php
                                                        if ( $_product->is_sold_individually() ) {
                                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                        } else {
                                                            $product_quantity = woocommerce_quantity_input( array(
                                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                                'input_value'  => $cart_item['quantity'],
                                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                                'min_value'    => '0',
                                                                'product_name' => $_product->get_name(),
                                                            ), $_product, false );
                                                        }

                                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                                        ?>
                                                        <a href="javascript:;" class="count-button minus"></a>
                                                        <a href="javascript:;" class="count-button plus"></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="td product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                                <div class="val-content">
                                                    <b>
                                                        <?php
                                                            /** @var WC_Product_Simple $_product */

//                                                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.

                                                        echo intval( $_product->get_price() );
                                                        ?> ₽
                                                    </b>
                                                </div>
                                            </div>

                                            <div class="td product-remove">
                                                <?php
                                                // @codingStandardsIgnoreLine
                                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                                    '<a href="%s" class="cart-block__delete-button remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="icon-close"></i></a>',
                                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                    __( 'Remove this item', 'woocommerce' ),
                                                    esc_attr( $product_id ),
                                                    esc_attr( $_product->get_sku() )
                                                ), $cart_item_key );
                                                ?>

                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                endforeach;
                                ?>


                                <?php do_action( 'woocommerce_cart_contents' ); ?>

                                <?php /** Coupon area */?>

                                <button style="display: none" type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

                                <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                            </div>

                            <?php do_action( 'woocommerce_after_cart_table' ); ?>
                        </div>
                    </form>
                </div>
                <div class="cart-block__side-part">
                    <?php
                    /**
                     * Cart collaterals hook.
                     *
                     * @hooked woocommerce_cross_sell_display
                     * @hooked woocommerce_cart_totals - 10
                     */

                    remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
                    do_action( 'woocommerce_cart_collaterals' );
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php do_action( 'woocommerce_after_cart' ); ?>