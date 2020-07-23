<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */


global $post;

//dd($post->post_title);


?>
<div class="need-help<?php echo !empty($atts['color']) && $atts['color'] == 'white' ? ' need-help--white' : '' ;?>">
    <div class="container">
        <h2><?php echo !empty($atts['title']) ? $atts['title'] : '';?></h2>

        <form class="need-help__form" method="POST">
            <div class="need-help__form-row">
                <div class="input-wrapper with-addon">
                    <div class="input-addon"><i class="icon-user"></i></div>
                    <input type="text" class="text-input" placeholder="Введите ваше имя" required="" name="ssf_name">
                </div>

                <div class="input-wrapper with-addon">
                    <div class="input-addon"><i class="icon-email"></i></div>
                    <input type="email" class="text-input" placeholder="Введите ваш email" required="" name="ssf1_email">
                </div>

                <button type="submit" class="btn btn-rect need-help__submit">Отправить</button>

                <?php SSF_Form_Handler::serviceFields('ssf_heed_help');?>
            </div>
        </form>
    </div>
</div>

