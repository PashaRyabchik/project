<?php top('Подтверждение') ?>

    <h1>Подтверждение</h1>

    <p><input type="text" placeholder="Код" id="code"></p>
    <p><input type="text" placeholder="<?captcha_show()?>" id="captcha"></p>
    <p><button onclick="post_query('gform', 'login', 'code.captcha')                       ">Подтвердить</button></p>

<?php bottom() ?>