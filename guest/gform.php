<?php

    if ($_POST['login_f']){
        captcha_valid();
        message('Ok');
    }

    if ($_POST['register_f']){
        go('login');
    }

    if ($_POST['recovery_f']){
        message('Восстановление пароля');
    }

    if ($_POST['confirm_f']){
        message('Подтверждение');
    }