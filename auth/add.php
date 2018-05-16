<?php

    if ($_POST['reviews_f']){

        if (strlen($_POST['message']) < 10 or strlen($_POST['message'] > 300))
            message('Длинна сообщения должна состоять 10 - 300 символов');

        mysqli_query($connect, 'INSERT INTO `reviews` VALUES ("", "'.$_SESSION['id'].'", "'.mysqli_real_escape_string($connect, $_POST['message']).'")');

        go('reviews');

    }