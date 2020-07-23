<?php

add_filter( 'woocommerce_account_menu_items', 'edit_my_account_nav_menu', 999 );

function edit_my_account_nav_menu( $items ) {

    $link_icon = [
        'dashboard' => 'icon-main-questions',
        'edit-address' => 'icon-delivery-home',
        'orders' => 'icon-history',
        'reset-password' => 'icon-lock',
        'customer-logout' => 'icon-quit'
    ];

    $link_name = [
        'dashboard' => 'Личные данные',
        'edit-address' => 'Адрес доставки',
        'orders' => 'История заказов',
        'reset-password'=>'Изменить пароль',
        'customer-logout' => 'Выйти'
    ];

    foreach ($items as $end_point => $item){

        // Rename
        if(isset($link_name[$end_point])){
            $item = $items[$end_point] = $link_name[$end_point];
        }

        // Add icon
        $icon = '';
        if(isset($link_icon[$end_point])){
            $icon = '<i class="'.$link_icon[$end_point].'">';
        }

        $items[$end_point] = $icon.'</i><span>'.$item.'</span><i class="icon-chevron"></i>';


    }


    $items = array_merge(array_flip( array_keys($link_icon) ), $items) ; // sort to order in $link_icon


    unset($items['downloads']);
    unset($items['edit-account']);

    return $items;
}