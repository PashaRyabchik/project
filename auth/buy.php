<?php

    if ($_POST['services_f']){

        $sid = array_pop($_POST);

        $price = services_price($sid);

        if (!$price)
            message('Ошибка покупки');

        if ($price > $_SESSION['balance'])
            message('Недостаточно средств');

        $_SESSION['balance'] -= $price;
        mysqli_query($connect, "UPDATE `users` SET `balance` = $_SESSION[balance] WHERE `id` = $_SESSION[id]");

        mysqli_query($connect, 'INSERT INTO `history` VALUES ("", "'.$_SESSION['id'].'", "Покупка услуги №'.$sid.'")');

        message('Покупка совершена');
    }