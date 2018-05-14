<?php

    if ($_POST['edit_f']){
        if ($_POST['password'] && md5($_POST['password']) != $_SESSION['password']){
            password_valid();
            mysqli_query($connect, "UPDATE `users` SET `password` = '.$_POST[password].' WHERE `id` = '$_SESSION[id]'");
        }

        if ($_POST['ip'] != $_SESSION['ip']) {

            if ($_POST['ip']){
                $arr = explode(',', $_POST['ip']);

                if (count($arr) <= 0 || count($arr) > 4)
                    message('Лимит 1 - 5 IP');

                    foreach ($arr as $key => $value){
                        if (!filter_var($value, FILTER_VALIDATE_IP))
                            message("IP $value указан неверно!");

                    }

                    $_SESSION['ip'] = $_POST['ip'];

                } else $_SESSION['ip'] = '';

            mysqli_query($connect, "UPDATE `users` SET `ip` = '.$_SESSION[ip].' WHERE `id` = '$_SESSION[id]'");

            }

        if ($_POST['protected'] != $_SESSION['protected']) {
            if ($_POST['protected'] == 1)
                $_SESSION['protected'] = 1;
            else
                $_SESSION['protected'] = 0;

            mysqli_query($connect, "UPDATE `users` SET `protected` = '$_SESSION[protected]' WHERE `id` = '$_SESSION[id]'");
        }

        message('Сохранено');

    }


