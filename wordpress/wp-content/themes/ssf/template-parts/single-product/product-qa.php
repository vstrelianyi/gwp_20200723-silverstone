<?php

    global $post;

    $product_id = !empty($_REQUEST['pid']) ? $_REQUEST['pid'] : null;
    $support_product = null;

    if($product_id){
        $support_product = wc_get_product($product_id);
        $support_product = ($support_product instanceof WC_Product_Simple) && $support_product->is_visible() ? $support_product : null;
    }

    $id = !empty($support_product) ? $support_product->get_id() : $post->ID;

    $all_parent_comments_qa = ssf_get_comments($id, 'qa');

    $comment_quantity = count($all_parent_comments_qa);
    $comment_on_page = 5;
?>


<div class="reviews">
    <div class="reviews__topbar">
        <div class="quant">Всего <?php echo ssf_get_comments($id, 'qa',['count' => 1]);?> вопроса</div>

        <?php if(is_user_logged_in()):?>
            <div class="reviews__top-act-wrap">
                <a href="javascript:;" data-toggle="modal" data-target="#question-popup" class="btn btn--accent">Задать вопрос</a>
            </div>
        <?php else:?>
            <div class="reviews__top-act-wrap">
                <div class="caption">Оставлять вопросы могут только<br>зарегистрированные пользователи</div>
                <a href="javascript:;" class="btn btn--accent">Регистрация</a>
            </div>
        <?php endif;?>

    </div>

    <div class="reviews__list">
        <?php
            if(!empty($all_parent_comments_qa) && is_array($all_parent_comments_qa)) {
                foreach (array_slice($all_parent_comments_qa,0,5 ) as $comment) {
                    echo ssf_render_comment_qa($comment);
                }
            }
        ?>
    </div>

    <?php if($comment_quantity > $comment_on_page):?>
        <a href="javascript:;" class="reviews__load-more ssf-comment-lazy-load" data-offset="<?php echo $comment_on_page;?>" data-post-id="<?php echo $id; ?>" data-comment_type='qa'>Показать еще <?php echo ($comment_quantity - $comment_on_page); ?> вопроса</a>
    <?php endif;?>
</div>

<?php
    if(is_user_logged_in()){
        ssf_comment_qa_form($id);
    }
?>
