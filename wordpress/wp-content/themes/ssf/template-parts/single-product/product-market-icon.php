<?php

global $product;

$icon_array = fw_get_db_post_option($product->id, 'm_icons');

// if(empty($icon_array) || !is_array($icon_array)) return;

?>


<div class="product__advantages">
    <div class="container">
        <div class="product__adv-list">
            <!-- <?php foreach ($icon_array as $icon):?>
            <div class="product__advantage-item">
                <div class="item-icon"><?php echo !empty($icon['icon']['icon-class']) ? ('<i class="'.$icon['icon']['icon-class'].'"></i>') : '';?></div>
                <div class="caption"><?php echo !empty($icon['text']) ? $icon["text"] : '';?></div>
            </div>
            <?php endforeach;?> -->
        </div>
    </div>
</div>