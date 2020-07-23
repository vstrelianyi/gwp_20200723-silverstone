<?php

    add_action( 'wp_ajax_ssf_ajax_comments', 'ssf_ajax_comments' ); // wp_ajax_{action} for registered user
    add_action( 'wp_ajax_nopriv_ssf_ajax_comments', 'ssf_ajax_comments' ); // wp_ajax_nopriv_{action} for not registered users

    function ssf_get_comments($post_id, $type = '', $arg = []){

        $meta_query = [
            'relation' => 'OR',
            [
                'key' => 'comment_type',
                'value' => 'qa',
                'compare' => $type == 'qa' ? '=' : 'NOT EXISTS'
            ]
        ];

        $std_arg = ['status'  => 'approve', 'parent'  => 0, 'post_id' => (int) $post_id, 'meta_query' => $meta_query];

        return get_comments( array_merge($std_arg, $arg) );
    }

    function ssf_ajax_comments() {

        $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );

        if ( is_wp_error( $comment ) ) {

            $ressult['result'] = 'error';

            $error_data = intval( $comment->get_error_data() );
            if ( ! empty( $error_data ) ) {
                $ressult['message'] = $comment->get_error_message();
            } else {
                $ressult['message'] = 'Unknown error';
            }
        }
        else{

            if( isset($_POST['comment_type']) && $_POST['comment_type'] == 'comment_qa' ){
                add_comment_meta($comment->comment_ID, 'comment_type', 'qa', false);
            }

            $ressult['result'] = 'success';
        }

        echo json_encode($ressult);

        wp_die();
    }

    function ssf_comment_form() {

        $user = wp_get_current_user();
?>
    <div class="popup-block" id="review-popup">
        <div class="popup-block__overlay">
            <div class="popup-block__popup reviews__popup">
                <div class="inner-content">
                    <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>
                    <div class="popup-block__popup-icon"><i class="icon-question"></i></div>
                    <div class="popup-block__title"><?php echo $user->display_name;?>, оставьте свой отзыв!</div>
                    <form class="popup-block__reviews-form ssf-comment-form"  action="<?php echo site_url('/wp-comments-post.php');?>" method="post">
                        <label for="popup-textarea-question">Отзыв:</label>
                        <textarea name="comment" class="textarea-input comment-popup-textarea" required></textarea>
                        <input type="hidden" name="comment_type" value="comment">
                        <div class="reviews__popup-row">
                            <div class="reviews__popup-rating">
                                <div class="caption">Ваша оценка товара:</div>
                                <div id="comment-product-rating" class="rate-block"></div>
                            </div>
                            <button type="submit" class="btn submit-button">Отправить</button>
                            <?php
                                comment_id_fields();
                                if (current_user_can('unfiltered_html')) {
                                    wp_nonce_field('unfiltered-html-comment_' . get_the_ID(), '_wp_unfiltered_html_comment', false);
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-block" id="review-success">
        <div class="popup-block__overlay">
            <div class="popup-block__popup popup-block__success">
                <div class="inner-content">
                    <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>
                    <div class="popup-block__success-icon"><i class="icon-success"></i></div>
                    <div class="popup-block__success-title">Ваш отзыв успешно получен!</div>
                    <div class="popup-block__success-caption">Мы опубликуем его сразу после проверки!</div>
                </div>
            </div>
        </div>
    </div>

<?php }

    function ssf_comment_qa_form($id = 0) {

    $user = wp_get_current_user();

    ?>
    <div class="popup-block" id="question-popup">
        <div class="popup-block__overlay">
            <div class="popup-block__popup reviews__popup">
                <div class="inner-content">
                    <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>
                    <div class="popup-block__popup-icon"><i class="icon-question"></i></div>
                    <div class="popup-block__title"><?php echo $user->display_name;?>, задайте свой вопрос!</div>
                    <form class="popup-block__reviews-form ssf-comment-form" action="<?php echo site_url('/wp-comments-post.php');?>" method="post">
                        <label for="popup-textarea-question">Вопрос:</label>
                        <textarea name="comment" class="textarea-input comment-popup-textarea"></textarea>
                        <input type="hidden" name="comment_type" value="comment_qa">
                        <button type="submit" class="btn submit-button">Отправить</button>
                        <div class="popup-block__small-caption">Мы ответим вам в течении максимум 2-х рабочих дней.</div>
                        <?php
                            comment_id_fields( (int) $id );
                            if (current_user_can('unfiltered_html')) {
                                wp_nonce_field('unfiltered-html-comment_' . get_the_ID(), '_wp_unfiltered_html_comment', false);
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-block" id="question-success">
        <div class="popup-block__overlay">
            <div class="popup-block__popup popup-block__success">
                <div class="inner-content">
                    <a href="javascript:;" data-toggle="dismiss" class="popup-block__close"></a>
                    <div class="popup-block__success-icon"><i class="icon-success"></i></div>
                    <div class="popup-block__success-title">Ваш вопрос успешно получен!</div>
                    <div class="popup-block__success-caption">Мы опубликуем его сразу как дадим ответ!</div>
                </div>
            </div>
        </div>
    </div>

<?php }

    function ssf_render_comment(WP_Comment $comment) {
        ob_start();

        $answers_array = $comment->get_children();

        $children_exists =  (! empty($answers_array));

        if ( empty( $comment->comment_author ) ) {
            if ( $comment->user_id && $user = get_userdata( $comment->user_id ) )
                $author = $user->display_name;
            else
                $author = __('Anonymous');
        } else {
            $author = $comment->comment_author;
        }

        $rating = get_comment_meta($comment->comment_ID, 'rating', true);

?>
        <div class="reviews__item-wrap<?php echo $children_exists ? ' active' : '';?>">
            <div class="reviews__item">
                <div class="item-img"><?php echo get_wp_user_avatar( $comment->user_id, 60);?></div>
                <div class="item-content">
                    <div class="reviews__item-top">
                        <div class="name"><?php echo apply_filters( 'get_comment_author', $author, $comment->comment_ID, $comment )?></div>
                        <div class="date"><?php echo date( 'H:i d.m.Y',strtotime($comment->comment_date));?></div>
                        <?php if(!empty($rating) && is_numeric($rating)):?>
                        <div class="rating-block jq-ry-container" data-rateyo-rating="<?php echo $rating;?>" readonly="readonly" style="width: 113px;"><div class="jq-ry-group-wrapper"><div class="jq-ry-normal-group jq-ry-group"><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#A8A9AB" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg></div><div class="jq-ry-rated-group jq-ry-group" style="width: 78.7611%;"><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg><svg width="17px" height="17px" viewBox="0 0 17 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#344B8E" style="margin-left: 7px;"><g id="Canvas" transform="translate(-17817 -495)"><g id="Shape"><use xlink:href="#path0_fill" transform="translate(17817 495)"></use></g></g><defs><path id="path0_fill" d="M 8.90195 0.263541L 11.0643 5.31475L 16.6003 5.78413C 16.9843 5.81685 17.1405 6.28968 16.849 6.53858L 12.6499 10.1291L 13.9082 15.4706C 13.9955 15.8418 13.588 16.1337 13.2581 15.9365L 8.50054 13.1047L 3.74296 15.9365C 3.41223 16.1329 3.00559 15.8409 3.09285 15.4706L 4.35118 10.1291L 0.151211 6.53772C -0.140248 6.28882 0.0150805 5.81599 0.399911 5.78326L 5.93588 5.31389L 8.09826 0.263541C 8.24835 -0.0878471 8.75186 -0.0878471 8.90195 0.263541Z"></path></defs></svg></div></div></div>
                        <?php endif;?>
                    </div>
                    <div class="reviews__item-text">
                        <p><?php echo apply_filters( 'comment_text', $comment->comment_content, $comment, [] );?></p>
                    </div>
                    <div class="reviews__bottom">
                        <div class="reviews__likes-wrap">
                            <?php render_like_links($comment->comment_ID);?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if($children_exists && is_array($answers_array)):
                    foreach ($answers_array as $answer):
                        if ( empty( $answer->comment_author ) ) {
                            if ( $answer->user_id && $user = get_userdata( $answer->user_id ) )
                                $author = $user->display_name;
                            else
                                $author = __('Anonymous');
                        } else {
                            $author = $answer->comment_author;
                        }
            ?>
            <div class="reviews__answers-block">
                <div class="reviews__item reviews__item--answer">
                    <div class="item-img"><?php echo get_wp_user_avatar( $answer->user_id, '60' );?></div>
                    <div class="item-content">
                        <div class="reviews__item-top">
                            <div class="name">Ответ от <?php echo apply_filters( 'get_comment_author', $author, $answer->comment_ID, $answer )?></div>
                            <div class="date"><?php echo date( 'H:i d.m.Y',strtotime($answer->comment_date));?></div>
                        </div>
                        <div class="reviews__item-text">
                            <p><?php echo apply_filters( 'comment_text', $answer->comment_content, $answer, [] );?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    endforeach;
                endif;
            ?>
        </div>
<?php
        return ob_get_clean();
    }

    function ssf_render_comment_qa(WP_Comment $comment) {
    ob_start();

    $answers_array = $comment->get_children();

    $children_exists =  (! empty($answers_array));

    if ( empty( $comment->comment_author ) ) {
        if ( $comment->user_id && $user = get_userdata( $comment->user_id ) )
            $author = $user->display_name;
        else
            $author = __('Anonymous');
    } else {
        $author = $comment->comment_author;
    }

    ?>
        <div class="reviews__item-wrap">
            <div class="reviews__item">
                <div class="item-img"><?php echo get_wp_user_avatar( $comment->user_id, 60);?></div>
                <div class="item-content">
                    <div class="reviews__item-top">
                        <div class="name"><?php echo apply_filters( 'get_comment_author', $author, $comment->comment_ID, $comment )?></div>
                        <div class="date"><?php echo date( 'H:i d.m.Y',strtotime($comment->comment_date));?></div>
                    </div>
                    <div class="reviews__item-text">
                        <p><?php echo apply_filters( 'comment_text', $comment->comment_content, $comment, [] );?></p>
                    </div>
                    <?php if($children_exists):?>
                    <a href="javascript:;" class="reviews__answer-toggle">
                        <i class="icon-message"></i>
                        <span class="captions-wrap">
                            <span class="unactive-caption">Показать ответ</span>
                            <span class="active-caption">Скрыть ответ</span>
                        </span>
                        <i class="icon-chevron"></i>
                    </a>
                    <?php endif;?>
                </div>
            </div>
            <?php
                if($children_exists && is_array($answers_array)):
                    foreach ($answers_array as $answer):
                        if ( empty( $answer->comment_author ) ) {
                            if ( $answer->user_id && $user = get_userdata( $answer->user_id ) )
                                $author = $user->display_name;
                            else
                                $author = __('Anonymous');
                        } else {
                            $author = $answer->comment_author;
                        }
            ?>
            <div class="reviews__answers-block">
                <div class="reviews__item reviews__item--answer">
                    <div class="item-img"><?php echo get_wp_user_avatar( $comment->user_id, 60);?></div>
                    <div class="item-content">
                        <div class="reviews__item-top">
                            <div class="name">Ответ от <?php echo apply_filters( 'get_comment_author', $author, $answer->comment_ID, $answer )?></div>
                            <div class="date"><?php echo date( 'H:i d.m.Y',strtotime($answer->comment_date));?></div>
                        </div>
                        <div class="reviews__item-text">
                            <p><?php echo apply_filters( 'comment_text', $answer->comment_content, $answer, [] );?></p>
                        </div>
                        <div class="reviews__bottom">
                            <div class="reviews__likes-wrap">
                                <?php render_like_links($comment->comment_ID);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    endforeach;
                endif;
            ?>
        </div>
    <?php
    return ob_get_clean();
}

    add_action( 'wp_ajax_ssf_comment_lazy_load', 'ssf_comment_lazy_load' ); // wp_ajax_{action} for registered user
    add_action( 'wp_ajax_nopriv_ssf_comment_lazy_load', 'ssf_comment_lazy_load' ); // wp_ajax_nopriv_{action} for not registered users

    function ssf_comment_lazy_load() {

        $offset = is_numeric( $_REQUEST['offset'] ) ? (int) $_REQUEST['offset'] : null;
        $post_id = is_numeric( $_REQUEST['post_id'] ) ? (int) $_REQUEST['post_id'] : null;

        if(!empty($offset) && !empty($post_id)) {

            $comment_type = !empty($_POST['comment_type']) && $_POST['comment_type'] == 'qa' ? 'qa' : 'comment';

            $comments = ssf_get_comments($post_id, $comment_type,[
                'offset'  => $offset,
                'number' => 9999,
            ]);

            $html = '';

            if(is_array($comments)) {
                foreach ($comments as $comment) {
                    $html .= ($comment_type == 'qa') ? ssf_render_comment_qa($comment) : ssf_render_comment($comment);
                }
                echo json_encode(['result' => 'success', 'html' => $html]);
                wp_die();
            }
        }

        echo json_encode(['result' => 'error']);
        wp_die();
    }

    // Likes

    function render_like_links($comment_id){

        $data = get_comment_meta($comment_id,'likes_data', true);

        $data_a = json_decode($data, true);

        $like_count = !empty($data_a['like']) && is_array($data_a['like']) ? count($data_a['like']) : 0;
        $dislike_count = !empty($data_a['dislike']) && is_array($data_a['dislike']) ? count($data_a['dislike']) : 0;

        echo render_like_icon_link('like', $comment_id, $like_count);
        echo render_like_icon_link('dislike', $comment_id, $dislike_count);
    }
    function render_like_icon_link($type, $comment_id,  $count = 0){

        $attr = is_user_logged_in() ? 'data-comment_id="'.( (int) $comment_id ).'" data-like_action="'. esc_attr($type) .'"' : 'data-toggle="modal" data-target="#auth-popup"';

        ob_start();
        ?>
        <a href="javascript:;" class="item <?php echo is_user_logged_in() ? 'do_comment_like' : '';?> <?php echo $type == 'like' ? 'like-button' : 'dislike-button';?>" <?php echo $attr;?>>
            <i class="icon-like"></i>
            <span class="count_value"><?php echo $count;?></span>
        </a>
        <?php
        return ob_get_clean();
    }

    add_action( 'wp_ajax_ajax_comment_like', 'ajax_comment_like' );

    function ajax_comment_like(){

        $user = wp_get_current_user();
        $comment_id = !empty($_POST['comment_id']) && is_numeric($_POST['comment_id']) ? (int) $_POST['comment_id'] : null;
        $like_action = !empty($_POST['like_action']) && ( $_POST['like_action'] == 'like' || $_POST['like_action'] == 'dislike' ) ? $_POST['like_action'] : null;

        if( ! ( $user->exists() && $comment_id && $like_action) ){
            return;
        }

        $data   = get_comment_meta($comment_id,'likes_data', true);
        $data_a = json_decode($data, true);
        $data_a = isset($data_a['like']) && isset($data_a['dislike']) && is_array($data_a['like']) && is_array($data_a['dislike']) ? $data_a : [ 'like' => [], 'dislike' => [] ];

        if( $like_action == 'like' ){
            if( ($key = array_search ($user->ID, $data_a['like'])) !== false ){
                unset($data_a['like'][$key]);
            }
            else{
                $data_a['like'][] = $user->ID;
            }
            $result = count($data_a['like']);

        }
        elseif( $like_action == 'dislike' ){
            if( ($key = array_search ($user->ID, $data_a['dislike'])) !== false ){
                unset($data_a['dislike'][$key]);
            }
            else{
                $data_a['dislike'][] = $user->ID;
            }
            $result = count($data_a['dislike']);
        }
        else{
            wp_die();
        }

        update_comment_meta($comment_id, 'likes_data', json_encode($data_a));

        echo $result;

        wp_die();
    }