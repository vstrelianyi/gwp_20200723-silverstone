<?php

global $product;

$watch_url = fw_get_db_post_option($product->id, 'video_url');

if ( filter_var( $watch_url, FILTER_VALIDATE_URL) ) {
    $query_arr = explode( '=', parse_url( $watch_url, PHP_URL_QUERY ) );
    $video_id = array_pop( $query_arr );
    $video_url = 'https://www.youtube.com/embed/' . $video_id;
}

?>

<div class="product__spec-wrap">
    <div class="product__spec-tabs">
        <div class="container">
            <div class="product__tabs-list">
                <div class="inner-list">
                    <a href="javascript:;" data-target="#tab-1" class="product__spec-tab active">
                        <span>Описание</span>
                        <i class="icon-chevron"></i>
                    </a>
                    <a href="javascript:;" data-target="#tab-2" class="product__spec-tab">
                        <span>Характеристики</span>
                        <i class="icon-chevron"></i>
                    </a>
                    <a href="javascript:;" data-target="#tab-3" class="product__spec-tab">
                        <span>Видео</span>
                        <i class="icon-chevron"></i>
                    </a>
                    <a href="javascript:;" data-target="#tab-4" class="product__spec-tab">
                        <span>Вопрос - ответ</span>
                        <i class="icon-chevron"></i>
                    </a>
                    <a href="javascript:;" data-target="#tab-5" class="product__spec-tab">
                        <span>Отзывы</span>
                        <i class="icon-chevron"></i>
                    </a>
                    <a href="javascript:;" data-target="#tab-6" class="product__spec-tab">
                        <span>Поддержка</span>
                        <i class="icon-chevron"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="product__spec-tabs-content">
            <div id="tab-1" class="product__spec-tab-cont active">
                <div class="inner-content">
                    <?php echo fw_get_db_post_option($product->id, 'product_desc');?>
                </div>
            </div>
            <div id="tab-2" class="product__spec-tab-cont">
                <div class="inner-content">
                    <div class="char-wrapper">
                        <?php echo fw_get_db_post_option($product->id, 'characteristics_tables');?>
                    </div>
                </div>
            </div>

            <div id="tab-3" class="product__spec-tab-cont">
                <div class="inner-content">
                    <?php if ( ! empty( $video_url ) ) { ?>
                    <iframe width="560" height="315" src="<?php echo $video_url;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?php } ?>
                </div>
            </div>

            <div id="tab-4" class="product__spec-tab-cont">
                <div class="inner-content">
                    <?php get_template_part('template-parts/single-product/product', 'qa' );?>
                </div>
            </div>


            <?php get_template_part('template-parts/single-product/product', 'comments' );?>

            <div id="tab-6" class="product__spec-tab-cont">
                <div class="inner-content">
                    <?php attached_docs($product->id);?>
                </div>
            </div>
        </div>
    </div>
</div>
