<?php

    function go_auth($data)
    {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
        go('profile');
    }


    //Form login
    if ($_POST['login_f']){
        email_valid();
        password_valid();
        captcha_valid();

        $em = $_POST['email'];
        $pas = $_POST['password'];
        if (!mysqli_num_rows(mysqli_query($connect, "SELECT `id` FROM `users` WHERE `email` = '".$em."' && `password` = '".$pas."'")) ) message('Аккаунт не найден!');

        $row = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '".$em."'"));

        if ($row['ip']){
            $arr = explode(',', $row['ip']);

            if (!in_array($SERVER['REMOVE_ADDR'], $arr)) {
                    message("Доступ запрещен для этого IP!");
            }
        }

        if ($row['protected'] == 1){

            $code = random_str(5);

            $_SESSION['confirm'] = array(
                'type' => 'login',
                'data' => $row,
                'code' => $code
            );

            mail($_POST['email'], 'Подтверждение входа',"Код подтверждения входа                   <b>$code</b>" );

            go('confirm');
        }
    go_auth($row);

    }


    //Form register
    else if ($_POST['register_f']){
        email_valid();
        password_valid();
        captcha_valid();

        $emai = $_POST['email'];
        if (mysqli_num_rows(mysqli_query($connect, "SELECT `id` FROM `users` WHERE `email` = '".$emai."'")) ) message('Этот E-mail занят!');

        $passw = $_POST['password'];
        $code = random_str(5);

        $_SESSION['confirm'] = array(
            'type' => 'register',
            'email' => $emai,
            'password' => $passw,
            'code' => $code
        );

        mail($emai, 'Регистрация',"Код подтверждения регистрации                   <b>$code</b>" );

        go('confirm');

    }


    //Form recovery
    else if ($_POST['recovery_f']){
        email_valid();
        captcha_valid();

        $ema = $_POST['email'];
        if (!mysqli_num_rows(mysqli_query($connect, "SELECT `id` FROM `users` WHERE `email` = '".$ema."'")) ) message('Аккаунт не найден!');

        $code = random_str(5);

        $_SESSION['confirm'] = array(
            'type' => 'recovery',
            'email' => $ema,
            'code' => $code
        );

        mail($emai, 'Восстановление пароля',"Код подтверждения восстановления пароля: <b>$code</b>" );

        go('confirm');
    }


    //Form confirm
    else  if ($_POST['confirm_f']){
        if ($_SESSION['confirm']['type'] == 'register'){
            if ($_SESSION['confirm']['code'] != $_POST['code']) {
                message('Код подтверждения регистрации указан не верно!');
            }

            if (is_numeric($_COOKIE['ref']))
                $ref = $_COOKIE['ref'];
            else
                $ref = 0;

            $email = $_SESSION['confirm']['email'];
            $password = $_SESSION['confirm']['password'];
            mysqli_query($connect, 'INSERT INTO `users` VALUES ("", "'.$email.'",                "'.$password.'","", 0, '.$ref.')');
            unset($_SESSION['confirm']);
            go('login');
        }

        else if ($_SESSION['confirm']['type'] == 'recovery'){
            if ($_SESSION['confirm']['code'] != $_POST['code']) {
                message('Код подтверждения указан не верно!');
            }

            $newpass = random_str(10);

            mysqli_query($connect, "UPDATE `users` SET `password` = '".md5($newpass)."' WHERE `email` = '".$_SESSION['confirm']['email']."' ");
            unset($_SESSION['confirm']);
            message("Ваш новый пароль: $newpass");
        }

        else if ($_SESSION['confirm']['type'] == 'login') {
            if ($_SESSION['confirm']['code'] != $_POST['code'])
                message('Код подтверждения указан не верно!');

                go_auth($_SESSION['confirm']['data']);

        }

        else not_found();
    }
