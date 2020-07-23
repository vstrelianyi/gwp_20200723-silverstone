<h1>Редактирование базы радаров и камер ГИБДД</h1>

<table>
    <tr>
        <td>Действие:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($operation_type) ? $operation_type : '';?></td>
    </tr>
    <tr>
        <td>Тип радара:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($camera_type) ? $camera_type : '';?></td>
    </tr>
    <tr>
        <td>Название радара:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($camera_model) ? $camera_model : '';?></td>
    </tr>
    <tr>
        <td>Направление радара:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($camera_points) ? $camera_points : '';?></td>
    </tr>
    <tr>
        <td>Укажите регион:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($camera_region) ? $camera_region : '';?></td>
    </tr><tr>
        <td>Улица, дом, ближайший объект:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($camera_address) ? $camera_address : '';?></td>
    </tr>
    <tr>
        <td>Координаты камеры, радара:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($camera_coordinates) ? $camera_coordinates : '';?></td>
    </tr>
    <tr>
        <td>Какие направления охватывает</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($camera_direction) ? $camera_direction : '';?></td>
    </tr>
    <tr>
        <td>Ограниение скорости на данном участке (км)</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($speed_limitation) ? $speed_limitation : '';?></td>
    </tr>
    <tr>
        <td>Модель радар-детектора:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($camera_detector_model) ? $camera_detector_model : '';?></td>
    </tr>
    <tr>
        <td>Дата последнего обновления GPS базы:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($base_version) ? $base_version : '';?></td>
    </tr>
    <tr>
        <td>Имя</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($ssf_name) ? $ssf_name : '';?></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($ssf_email) ? $ssf_email : '';?></td>
    </tr>
    <tr>
        <td>Комментарий:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($camera_comment) ? $camera_comment : '';?></td>
    </tr>

</table>