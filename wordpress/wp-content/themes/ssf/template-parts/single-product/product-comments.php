<?php

    global $post;

    $all_parent_comments = ssf_get_comments($post->ID);

    $comment_quantity = count($all_parent_comments);
    $comment_on_page = 5;

?>

<div id="tab-5" class="product__spec-tab-cont">
    <div class="inner-content">
        <div class="reviews">
            <div class="reviews__topbar">
                <div class="quant">Всего <?php echo $comment_quantity;?> отзывов</div>

                <?php if(is_user_logged_in()):?>
                    <div class="reviews__top-act-wrap">
                        <a href="javascript:;" data-toggle="modal" data-target="#review-popup" class="btn btn--accent">Оставить отзыв</a>
                    </div>
                <?php else:?>
                    <div class="reviews__top-act-wrap">
                        <div class="caption">Оставлять отзывы могут только<br>зарегистрированные пользователи</div>
                        <a href="javascript:;" class="btn btn--accent">Регистрация</a>
                    </div>
                <?php endif;?>
            </div>

            <div id="reviews__list" class="reviews__list">
                <?php
                    if(!empty($all_parent_comments) && is_array($all_parent_comments)) {
                        foreach (array_slice($all_parent_comments,0,5 ) as $comment) {
                            echo ssf_render_comment($comment);
                        }
                    }
                ?>
            </div>

            <?php if($comment_quantity > $comment_on_page):?>
            <a href="javascript:;" class="reviews__load-more ssf-comment-lazy-load" data-offset="<?php echo $comment_on_page;?>" data-post-id="<?php echo $post->ID;?>">Показать еще <?php echo ($comment_quantity - $comment_on_page); ?> комментария</a>
            <?php endif;?>
        </div>
    </div>
</div>
<?php
    if(is_user_logged_in()){
        ssf_comment_form();
    }
?>