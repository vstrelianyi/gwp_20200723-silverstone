<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
global $wp;

$product_id = !empty($_REQUEST['pid']) ? $_REQUEST['pid'] : null;
$support_product = null;

if($product_id){
    $support_product = wc_get_product($product_id);
    $support_product = ($support_product instanceof WC_Product_Simple) && $support_product->is_visible() ? $support_product : null;
}


$SupportQuestions = new SupportQuestions($support_product);

add_action( 'wp_print_footer_scripts', 'ssf_support_search_js' );

?>
<div class="categories-block">
    <div class="container">
        <h2><?php echo !empty($atts['category_list_title']) ? $atts['category_list_title'] : '' ?></h2>
        <div class="categories-block__search search-tall">
            <div class="input-wrapper with-addon with-shadow">
                <div class="input-addon">
                    <i class="icon-search"></i>
                </div>
                <input id="ssf-support-search-input" class="text-input text-input__tall" type="text" placeholder="Введите ваш запрос, например “HYBRID UNO”" autocomplete="off">
                <span id="ssf-support-search-close" type="button" class="btn-close">
                    <i class="icon-close"></i>
                </span>
            </div>
            <ul id="ssf-support-search-result" class="search-result-wrapper"></ul>
        </div>
        <div class="categories-block__list">

            <?php

            if(!empty($atts['categories']) && is_array($atts['categories'])):

                $choice_product = [];

                foreach ($atts['categories'] as $category):

                    if(empty($category['cat_id'])) continue;

                    $term = get_term((int)$category['cat_id']);

                    if(!($term instanceof WP_Term)) continue;

                    $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
                    $image = wp_get_attachment_url( $thumbnail_id );

                    $category_url = get_term_link( $term->term_id, $term->taxonomy );

                    // products in category

                    // Get shirts.
                    $args = array(
                        'category' => [$term->slug],
                        'posts_per_page' => -1
                    );

                    $choice_product[$term->slug] = wc_get_products( $args );

                    $active = (!empty($_REQUEST['cat']) && $_REQUEST['cat'] == $term->slug) ? ' active' : '';

                ?>

                    <a href="#" data-toggle="modal" data-target="#produtcs-cat-<?php echo $term->slug;?>" class="categories-block__item <?php echo !empty($category['css_class']) ? $category['css_class'] : 'w25';?><?php echo $active;?>">
                    <span class="top-name">
                        <i class="<?php echo fw_get_db_term_option($term->term_id, $term->taxonomy, 'product_cat_icon');?>"></i>
                        <span><?php echo $term->name;?></span>
                    </span>

                        <span class="item-img">
                        <?php
                        if ( $image ) {
                            echo '<img src="' . $image . '" alt="' . $term->name . '" />';
                        }
                        ?>
                    </span>
                    </a>
        <?php
                endforeach;
            endif;
        ?>
        </div>
    </div>
</div>

<?php foreach($choice_product as $cat_slug => $products):?>

    <div class="popup-block" id="produtcs-cat-<?php echo $cat_slug;?>">
        <div class="popup-block__overlay">
            <div class="popup-block__popup support-block__choose-popup">
                <div class="inner-content">
                    <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>

                    <div class="popup-block__title">Ваше устройство</div>

                    <div class="support-block__models-list">
                        <?php foreach ($products as $product):?>

                        <a href="<?php echo home_url( add_query_arg( array('pid'=>$product->id, 'cat'=>$cat_slug), $wp->request ) ).'#support-block';?>" class="model-item"><?php echo $product->name;?></a>

                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endforeach;?>

<div class="support-block <?php if($support_product) {echo 'single-product-support';}?>" id="support-block">
    <div class="container">
        <div class="support-block__help-wrapper">
            <?php if($support_product): ?>
                <div class="support-info__tabs-wrapper">
                    <div class="support-info__tabs">
                        <a href="javascript:;" data-toggle="tab" data-target="#support-info-1" class="support-info__tab-item active">
                            <i class="icon-update"></i>
                            <span>Обновление</span>
                            <i class="icon-chevron"></i>
                        </a>
    
                        <a href="javascript:;" data-toggle="tab" data-target="#support-info-2" class="support-info__tab-item">
                            <i class="icon-archive"></i>
                            <span>Архив</span>
                            <i class="icon-chevron"></i>
                        </a>
                        <?php if(fw_get_db_post_option($support_product->get_id(), 'support_driver_text', null)):?>
                        <a href="javascript:;" data-toggle="tab" data-target="#support-info-3" class="support-info__tab-item">
                            <i class="icon-settings"></i>
                            <span>Драйвер</span>
                            <i class="icon-chevron"></i>
                        </a>
                        <?php endif;?>
    
                        <?php if(fw_get_db_post_option($support_product->get_id(), 'support_reboot_text', null)):?>
                        <a href="javascript:;" data-toggle="tab" data-target="#support-info-4" class="support-info__tab-item">
                            <i class="icon-refresh"></i>
                            <span>Перезагрузка</span>
                            <i class="icon-chevron"></i>
                        </a>
                        <?php endif;?>
    
    
                        <a href="javascript:;" data-toggle="tab" data-target="#support-info-5" class="support-info__tab-item">
                            <i class="icon-faq"></i>
                            <span>Вопрос-ответ</span>
                            <i class="icon-chevron"></i>
                        </a>
    
                        <a href="javascript:;" data-toggle="tab" data-target="#support-info-6" class="support-info__tab-item">
                            <i class="icon-file"></i>
                            <span>Документы</span>
                            <i class="icon-chevron"></i>
                        </a>
                    </div>
                </div>
            <?php endif;?>
            <div class="support-block__tabs-content-wrap">
                <?php $SupportQuestions->render_qa_groups();?>
                <?php if($support_product): ?>
                    <div class="support-info__tab-content">

                        <div id="support-info-1" class="support-info__tab-pane active">
                            <?php echo fw_get_db_post_option($support_product->get_id(), 'support_renewal_text');?>
                        </div>

                        <div id="support-info-2" class="support-info__tab-pane">
                            <?php echo fw_get_db_post_option($support_product->get_id(), 'support_archive_text');?>
                        </div>

                        <?php if(fw_get_db_post_option($support_product->get_id(), 'support_driver_text', null)):?>
                        <div id="support-info-3" class="support-info__tab-pane">
                            <?php echo fw_get_db_post_option($support_product->get_id(), 'support_driver_text', null);?>
                        </div>
                        <?php endif;?>

                        <?php if(fw_get_db_post_option($support_product->get_id(), 'support_reboot_text', null)):?>
                        <div id="support-info-4" class="support-info__tab-pane">
                            <?php echo fw_get_db_post_option($support_product->get_id(), 'support_reboot_text', null);?>
                        </div>
                        <?php endif;?>

                        <div id="support-info-5" class="support-info__tab-pane">
                            <?php get_template_part('template-parts/single-product/product', 'qa' );?>
                        </div>

                        <div id="support-info-6" class="support-info__tab-pane">
                            <?php attached_docs($support_product->get_id());?>
                        </div>
                    </div>
                <?php endif;?>
            </div>

            <div class="support-block__right-part">

            <?php

                if($support_product):
                    $image = $support_product->get_image( apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' ) );
            ?>
                    <div class="support-block__product-item">
                        <a href="<?php echo $support_product->get_permalink();?>" class="support-block__product-card">
                            <span class="img-wrapper"><?php echo $image;?></span>
                            <span class="name"><?php echo $support_product->get_title()?></span>
                            <span class="bottom-row">
                            <div class="rating-block jq-ry-container" data-rateyo-rating="<?php echo $support_product->get_average_rating();?>" readonly="readonly" style="width: 113px;"><div class="jq-ry-group-wrapper"><div class="jq-ry-normal-group jq-ry-group"><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg></div><div class="jq-ry-rated-group jq-ry-group" style="width: 78.7611%;"><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg></div></div></div>
                            <span class="details-link">
                                <span>Подробнее</span>
                                <i class="icon-arrow"></i>
                            </span>
                        </span>
                        </a>
                    </div>
            <?php endif;?>
                <div class="support-block__tabs-wrapper">
                    <div class="support-block__tabs">

                        <?php
                            if($support_product) {
                                $SupportQuestions->render_single_list();
                            }
                            else {
                                $SupportQuestions->render_list();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="top-information">
    <div class="top-information__bg-img"><img src="<?php echo get_template_directory_uri();?>/assets/img/support-bg.jpg" alt=""></div>

    <div class="container">

        <h1><?php echo !empty($atts['title']) ? $atts['title'] : '' ?></h1>

        <div class="top-information__descr"><?php echo !empty($atts['text']) ? $atts['text'] : '' ?></div>

        <!-- <div id="locations-search-wrapper" class="locations-block__search-input-wrapper">
            <input id="support_search_input" type="text" class="text-input <?php echo $SupportQuestions->isDisplayProduct() ? 'product-show' : '';?>" placeholder="Введите ваш запрос, например “гарантия на устройства”" <?php echo !$SupportQuestions->isDisplayProduct() ? 'autofocus' : '';?>>

            <button class="search-button"><i class="icon-search"></i></button>

            <div class="locations-block__search-dropdown" id="locations-search-dropdown">

                <?php $SupportQuestions->render_questions_list()?>

                <a href="javascript:;" class="search-dropdown-close" id="locations-search-dropdown-close">
                    <span class="close-text">Закрыть поиск</span>
                    <i class="icon-chevron"></i>
                </a>
            </div>
        </div> -->

        <div class="support-block__top-info-row">
            <a href="<?php the_permalink(238);?>" class="support-block__add-camera">
                <i class="icon-videocamera"></i>
                <span>Добавить / удалить камеру из базы</span>
            </a>

            <a href="#" class="support-block__login-button" data-toggle="modal" data-target="#auth-popup">
                <i class="icon-email"></i>
                <span>Подписаться на обновления</span>
            </a>

            <!-- <?php if(is_user_logged_in()): ?>

            <div class="support-block__user-info">
                <i class="icon-user-2"></i>
                <div class="right-content">
                    <div>Ваш номер клиента</div>
                    <b><?php echo get_current_user_id();?></b>
                </div>
            </div>

            <?php else:?>

            <a href="#" class="support-block__login-button" data-toggle="modal" data-target="#auth-popup">
                <i class="icon-sign-in"></i>
                <span>Зарегистрируйтесь или войдите</span>
            </a>

            <?php endif;?> -->

        </div>
    </div>
</div>

