<h1>Форма C Лендинга Стать партнером</h1>

<table>
    <?php if(!empty($name)):?>
    <tr>
        <td>Имя:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo $name;?></td>
    </tr>
    <?php endif;?>
    <?php if(!empty($phone)):?>
    <tr>
        <td>Телефон:</td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo $phone;?></td>
    </tr>
    <?php endif;?>
    <?php if(!empty($email)):?>
        <tr>
            <td>Email:</td>
            <td>&nbsp;&nbsp;&nbsp;<?php echo $email;?></td>
        </tr>
    <?php endif;?>

</table>