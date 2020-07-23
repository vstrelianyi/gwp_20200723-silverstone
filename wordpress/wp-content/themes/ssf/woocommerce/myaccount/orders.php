<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//dump($customer_orders->orders);

do_action( 'woocommerce_before_account_orders', $has_orders );

// Rename only for this page


$status_name = array(
  "pending"           => "Идет обработка",
  "processing"        => "Идет обработка",
  "awaiting-shipment" => "В пути",
  "on-hold"           => "Идет обработка",
  "completed"         => "Успешно доставлен",
  "cancelled"         => "Отменен",
  "refunded"          => "Выполнен возврат",
  "failed"            => "Отменен",
);

$status_css_class = array(
    "pending"           => "process",
    "processing"        => "process",
    "awaiting-shipment" => "delivery",
    "on-hold"           => "process",
    "completed"         => "ready",
    "cancelled"         => "returned",
    "refunded"          => "returned",
    "failed"            => "returned",
);

$status_icon = array(
    "pending" => "icon-clock",
    "processing" => "icon-clock",
    "awaiting-shipment" => "icon-delivery-cabinet",
    "on-hold" => "icon-clock",
    "completed" => "icon-verified",
    "cancelled" => "icon-close",
    "refunded" => "icon-return-cabinet",
    "failed" => "icon-close",
);

if ( $has_orders ) : ?>

    <div class="cabinet-block__main-heading">История заказов</div>

    <div class="cabinet-block__history-list">
        <?php

        foreach ($customer_orders->orders as $order):

            if(!($order instanceof WC_Order)){ // only for storm autocomplete
                continue;
            }

//            dump($order->get_status());

            $css_clas = !empty($status_css_class[$order->get_status()]) ? $status_css_class[$order->get_status()] : "process";
            $icon = !empty($status_icon[$order->get_status()]) ? $status_icon[$order->get_status()] : "icon-clock";
            $status = !empty($status_name[$order->get_status()]) ? $status_name[$order->get_status()] : "Идет обработка";

            ?>

            <div class="cabinet-block__history-item">
                <a href="javascript:;" data-toggle="slide-toggle" class="cabinet-block__history-item-toggle">
                    <span class="left-part">Заказ №<?php echo $order->get_order_number(); ?></span>
                    <span class="center-part"><?php pretty_price_format( $order->get_total() );?> руб.</span>
                    <span class="status-part <?php echo $css_clas;?>"><i class="<?php echo $icon;?>"></i></span>
                </a>

                <div class="cabinet-block__history-item-content">
                    <div class="inner-content">
                        <div class="order-num">Заказ №<?php echo $order->get_order_number(); ?></div>

                        <ul>
                            <?php

                            $foreach_counter = 0;
                            foreach ($order->get_items() as $item):
                                $foreach_counter++;
                                ?>
                                <li><?php echo $foreach_counter.'. '.$item->get_name().' ('.$item->get_quantity().'шт.)';?></li>
                            <?php endforeach;?>
                            <li><b>Сумма: <?php pretty_price_format( $order->get_total() );?> руб.</b></li>
                            <li><b>Статус: <span class="status <?php echo $css_clas;?>"><?php echo $status;?></span></b></li>
                        </ul>
                    </div>
                </div>
            </div>

        <?php endforeach;?>


    </div>

<?php else : ?>

    <p>У вас пока нет заказов.</p>
    <p><a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">В магазин</a></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
