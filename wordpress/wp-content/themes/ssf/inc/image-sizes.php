<?php

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'big-thumb', 300, 300 ); // 300 в ширину и без ограничения в высоту
//    add_image_size( 'homepage-thumb', 220, 180, true ); // Кадрирование изображения
}