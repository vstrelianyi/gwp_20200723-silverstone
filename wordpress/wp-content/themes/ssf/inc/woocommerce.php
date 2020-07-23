<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package SilverStoneF1
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */

function ssf_woocommerce_setup() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'ssf_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
//function ssf_woocommerce_scripts() {
//    wp_enqueue_style( 'ssf-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );
//
//    $font_path   = WC()->plugin_url() . '/assets/fonts/';
//    $inline_font = '@font-face {
//			font-family: "star";
//			src: url("' . $font_path . 'star.eot");
//			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
//				url("' . $font_path . 'star.woff") format("woff"),
//				url("' . $font_path . 'star.ttf") format("truetype"),
//				url("' . $font_path . 'star.svg#star") format("svg");
//			font-weight: normal;
//			font-style: normal;
//		}';
//
//    wp_add_inline_style( 'ssf-woocommerce-style', $inline_font );
//}
//add_action( 'wp_enqueue_scripts', 'ssf_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function ssf_woocommerce_active_body_class( $classes ) {
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter( 'body_class', 'ssf_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function ssf_woocommerce_products_per_page() {
    return 24;
}
add_filter( 'loop_shop_per_page', 'ssf_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function ssf_woocommerce_thumbnail_columns() {
    return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'ssf_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function ssf_woocommerce_loop_columns() {
    return 3;
}
add_filter( 'loop_shop_columns', 'ssf_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function ssf_woocommerce_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => 3,
        'columns'        => 3,
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'ssf_woocommerce_related_products_args' );

// auto set County to Russia all users

add_action('woocommerce_created_customer', 'set_county_to_russia');
function set_county_to_russia($customer_id){
    $customer = new WC_Customer( $customer_id );
    $customer->set_billing_country('RU');
    $customer->set_shipping_country('RU');
    $customer->save();
}

// // Change the default country and state on checkout page. 
// // This works for a new session.
// add_filter( 'default_checkout_country', 'xa_set_default_checkout_country' );
// function xa_set_default_checkout_country() {
//     return 'RU';
// }
/**
 * Change the default country on the checkout for non-existing users only
 */
add_filter( 'default_checkout_billing_country', 'change_default_checkout_country', 10, 1 );

function change_default_checkout_country( $country ) {
    // If the user already exists, don't override country
    if ( WC()->customer->get_is_paying_customer() ) {
        return $country;
    }

    return 'RU';
}



/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
<?php
if ( function_exists( 'ssf_woocommerce_header_cart' ) ) {
ssf_woocommerce_header_cart();
}
?>
 */

if ( ! function_exists( 'ssf_woocommerce_cart_link_fragment' ) ) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function ssf_woocommerce_cart_link_fragment( $fragments ) {
        ob_start();
        ssf_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ssf_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'ssf_woocommerce_cart_link' ) ) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function ssf_woocommerce_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'ssf' ); ?>">
            <?php
            $item_count_text = sprintf(
            /* translators: number of items in the mini cart. */
                _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'ssf' ),
                WC()->cart->get_cart_contents_count()
            );
            ?>
            <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
        </a>
        <?php
    }
}

if ( ! function_exists( 'ssf_woocommerce_header_cart' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function ssf_woocommerce_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php ssf_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget( 'WC_Widget_Cart', $instance );
                ?>
            </li>
        </ul>
        <?php
    }
}

// add_action( 'woocommerce_after_shipping_rate', 'checkout_shipping_additional_field', 20, 2 );
// function checkout_shipping_additional_field( $method, $index )
// {
//     if( $method->get_id() == 'flat_rate:7' ){
//     }
// }

add_filter( 'woocommerce_cart_shipping_method_full_label', 'custom_display_zero_shipping_cost', 10, 2 );
function custom_display_zero_shipping_cost($full_label, $method){
    if( $method->get_id() == 'local_pickup:3' ){
        $full_label = 'Самовывоз' . ': <span class="woocommerce-Price-amount amount">Бесплатно</span>';
    }
    if( $method->get_id() == 'local_pickup:8' ){
        $full_label = 'ТК СДЭК / ПЭК / ДЛ' . ': <br><span class="woocommerce-Price-amount amount">(оплата доставки на терминале)</span>';
    }

    return $full_label;
}



