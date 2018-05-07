<?php

    if ($_POST['edit_f']){
        if ($_POST['password'] && md5($_POST['password']) != $_POST['password']){
            password_valid();
            mysqli_query($connect, "UPDATE `users` SET `password` = '.$_POST[password].'");
        }
        message('Пароль изменен');
    }