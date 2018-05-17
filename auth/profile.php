<?php top('Профайл') ?>

    <h1>Редактировать</h1>
    <p>Текущий баланс: <b><?=$_SESSION['balance']?> $</b></p>
    <p><input type="password" placeholder="Новый пароль" id="password"></p>
    <p><input type="text" placeholder="Список ip" id="ip" value="<?=$_SESSION['ip']?>"></p>

    <p><select id="protected">
            <?php echo str_replace('"'.$_SESSION['protected'].'"', '"'.$_SESSION['protected'].'"selected', '<option value="0">Подтверждение входа Выкл.</option> <option value="1">Подтверждение входа Вкл.</option>') ?>
        </select></p>

    <p><button onclick="post_query('aform', 'edit', 'password.ip.protected')">Сохранить</button></p>

<?php bottom() ?>