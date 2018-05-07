<?php top('Профайл') ?>

    <h1>Редактировать</h1>
    <p><input type="password" placeholder="Новый пароль" id="password"></p>
    <p><button onclick="post_query('aform', 'edit', 'password')">Сохранить</button></p>

<?php bottom() ?>