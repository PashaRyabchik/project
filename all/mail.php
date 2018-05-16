<?php

    if ($_POST['contact_f']){

        email_valid();
        captcha_valid();

        if (strlen($_POST['message']) < 10 or strlen($_POST['message'] > 500))
            message('Длинна сообщения должна состоять 10 - 500 символов');

        $message = htmlspecialchars($_POST['message']);
        mail('admin@i.ua', 'Обращение в службу поддержки','E-mail отправителя: <b>'.$_POST['email'].'</b><p>'.$message.'</p>');

        message('Сообщение отправлено');

    }

    ?>