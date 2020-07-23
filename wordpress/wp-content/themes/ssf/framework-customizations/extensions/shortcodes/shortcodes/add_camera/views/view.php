<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
//dump($atts);
?>

<div class="top-information top-information__bg-img add-camera">
    <!-- <div class="top-information__bg-img add-camera">
        <img src="<?php echo get_template_directory_uri();?>/assets/img/add-camera-bg.jpg" alt="">
    </div> -->
    <div class="container">
        <div class="breadcrumbs">
            <?php
            woocommerce_breadcrumb(array(
                'delimiter'   => '',
                'wrap_before' => '<ul>',
                'wrap_after'  => '</ul>',
                'before'      => '',
                'after'       => '',
                'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
            ));
            ?>
        </div>
        <h1 class="small-title"><?php echo !empty($atts['title']) ? $atts['title'] : '' ?></h1>
        <div class="top-information__descr"><?php echo !empty($atts['text']) ? $atts['text'] : '' ?></div>
    </div>
</div>

<form action="<?php echo get_permalink();?>" method="POST" enctype="multipart/form-data">

    <?php SSF_Form_Handler::serviceFields('add_camera');?>


    <div class="add-camera">
        <div class="container">
            <div class="add-camera__block">
                <div class="add-camera__form-part">
                    <div class="add-camera__form-left-part">
                        <div class="add-camera__main-label">Добавить, редактировать<br>или удалить камеру</div>
                    </div>
                    <div class="add-camera__form-main-part">
                        <div class="radio-group">
                            <div class="radio-wrapper">
                                <input type="radio" name="operation_type" id="add-camera-radio"  value="Добавить" checked>
                                <label for="add-camera-radio">Добавить</label>
                            </div>
                            <div class="radio-wrapper">
                                <input type="radio" name="operation_type" id="edit-camera-radio" value="Редактировать">
                                <label for="edit-camera-radio">Редактировать</label>
                            </div>
                            <div class="radio-wrapper">
                                <input type="radio" name="operation_type" id="delete-camera-radio" value="Удалить">
                                <label for="delete-camera-radio">Удалить</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add-camera__form-part">
                    <div class="add-camera__form-left-part">
                        <div class="add-camera__main-label">Данные о камере</div>
                    </div>

                    <div class="add-camera__form-main-part">
                        <div class="input-col">
                            <label for="add-camera-type">Тип радара: *</label>

                            <div class="select-wrapper">
                                <select class="nice-select" name="camera_type">
                                    <option value="Стационарный">Стационарный</option>
                                    <option value="Переносной">Мобильный</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-col">
                            <label for="add-camera-model">Название радара, камеры, комплекса ФВФ*</label>

                            <div class="input-wrapper">
                                <input type="text" class="text-input" id="add-camera-model" name="camera_model" required placeholder="Арена, Крис, Кордон, Не определен">
                            </div>
                        </div>

                        <div class="input-col">
                            <label for="add-camera-points">Направление радара:</label>

                            <div class="select-wrapper">
                                <select class="nice-select" name="camera_points">
                                    <option value="Вперед">Север</option>
                                    <option value="Назад">Юг</option>
                                    <option value="Назад">Запад</option>
                                    <option value="Назад">Восток</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add-camera__form-part">
                    <div class="add-camera__form-left-part">
                        <div class="add-camera__main-label">Местоположение радара, комплекса ФВФ</div>
                    </div>

                    <div class="add-camera__form-main-part">
                        <div class="input-col">
                            <label for="add-camera-region">Укажите регион, город, ближайший населенный пункт*</label>
                            <div class="input-wrapper">
                                <input type="text" class="text-input" id="add-camera-region" name="camera_region">
                            </div>
                        </div>

                        <div class="input-col">
                            <label for="add-camera-address">Улица, дом, ближайший объект</label>

                            <div class="input-wrapper">
                                <input type="text" class="text-input" id="add-camera-address" name="camera_address">
                            </div>
                        </div>

                        <div class="input-col">
                            <label for="add-camera-coord">Координаты камеры, радара</label>

                            <div class="input-wrapper">
                                <input type="text" class="text-input" id="add-camera-coord" name="camera_coordinates" placeholder="Желательно в формате 53.653456, 54.7958475">
                            </div>
                            <div class="camera__sub-info">
                                <p>Координаты местоположения камеры вы можете взять в интернет картах</p>
                                <ul>
                                    <li><a href="https://www.google.ru/maps" target="_blank">https://www.google.ru/maps</a></li>
                                    <li><a href="https://yandex.ru/maps" target="_blank">https://yandex.ru/maps</a></li>
                            </div>

                        </div>

                        <div class="input-col">
                            <label for="add-camera-direction">Какие направления охватывает</label>

                            <div class="input-wrapper">
                                <textarea class="textarea-input" id="add-camera-direction" name="camera_direction"
                                placeholder="Укажите направление радара, куда смотрит камера при движении автомобиля: Направлена в лицо при движении к ул. Весенняя, в спину при движении к ул.Солнечная."></textarea>
                            </div>
                        </div>

                        <div class="input-col">
                            <label>Ограниение скорости на данном участке (км)</label>

                            <div class="select-wrapper">
                                <select class="nice-select" name="speed_limitation">
                                    <?php

                                    if(!empty($atts['max_speed']) && is_array($atts['max_speed']) ):
                                        foreach ($atts['max_speed'] as $speed):
                                            ?>
                                            <option value="<?php echo $speed;?>"><?php echo $speed;?></option>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="add-camera__file-input" >
                            <input type="file" id="addCameraFile" name="camera_photo[]" multiple>
                            <label for="addCameraFile" id ="dropContainer">
                                <i class="icon-file"></i>
                                <span class="file-name">Перетащите документы (фото) или добавьте вручную</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="add-camera__form-part">
                    <div class="add-camera__form-left-part">
                        <div class="add-camera__main-label">Ваши данные</div>
                    </div>

                    <div class="add-camera__form-main-part">
                        <div class="input-col">
                            <label for="add-camera-detector-model">Модель радар-детектора, гибридного устройства, GPS-видеорегистратора</label>
                            <div class="input-wrapper">
                                <input type="text" class="text-input" id="add-camera-detector-model" name="camera_detector_model" placeholder="Например: Monaco GS, Sochi Z, Fuji">
                            </div>
                        </div>
                        <div class="input-col">
                            <label for="add-camera-detector-version">Дата последнего обновления GPS базы</label>
                            <div class="input-wrapper">
                                <input type="text" class="text-input" id="add-camera-detector-version" name="base_version">
                            </div>
                        </div>
                        <?php if(!is_user_logged_in()):?>
                        <div class="add-camera__form-row">
                            <div class="input-col w6">
                                <label for="add-camera-name">Имя*</label>

                                <div class="input-wrapper with-addon">
                                    <input type="text" class="text-input" id="add-camera-name" required name="ssf_name">
                                    <div class="input-addon"><i class="icon-user"></i></div>
                                </div>
                            </div>

                            <div class="input-col w6">
                                <label for="add-camera-email">E-mail*</label>

                                <div class="input-wrapper with-addon">
                                    <input type="email" class="text-input" id="add-camera-email" required name="ssf_email">
                                    <div class="input-addon"><i class="icon-email"></i></div>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>

                    </div>
                </div>

                <div class="add-camera__form-part">
                    <div class="add-camera__form-left-part">
                        <div class="add-camera__main-label">Комментарий</div>
                    </div>

                    <div class="add-camera__form-main-part">
                        <div class="input-col">
                            <label for="add-camera-comment">Есть дополнительная информация?</label>
                            <div class="input-wrapper">
                                <textarea class="textarea-input" id="add-camera-comment" name="camera_comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn add-camera__submit-button">Отправить</button>
            </div>
        </div>
    </div>
</form>