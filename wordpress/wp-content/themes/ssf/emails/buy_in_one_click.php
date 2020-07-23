<h1>Форма перезвонить</h1>

<table>
    <tr>
        <td>Имя:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($name) ? $name : '';?></td>
    </tr>
    <tr>
        <td>Телефон:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($phone) ? $phone : '';?></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($email) ? $email : '';?></td>
    </tr>
    <tr>
        <td>Название продукта:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($product_name) ? $product_name : '';?></td>
    </tr>
    <tr>
        <td>Ссылка на продукт:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo !empty($product_link) ? esc_url($product_link) : '';?></td>
    </tr>
</table>