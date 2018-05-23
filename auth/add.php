<?php

    if ($_POST['reviews_f']){

        if (strlen($_POST['message']) < 10 or strlen($_POST['message'] > 300))
            message('Длинна сообщения должна состоять 10 - 300 символов');

        //check BB code
        $arr = array('b', 'i');
        foreach ($arr as $val){
            if (substr_count($_POST['message'], "[$val]") != substr_count($_POST['message'], "[/$val]")){
                message('Найден лишний или незакрытый тег ВВ кода');
            }
        }
        $url_arr = array(
            substr_count($_POST['message'], '[url='),
            substr_count($_POST['message'], '=name='),
            substr_count($_POST['message'], '[/url]'),
        );
        if (count(array_count_values($url_arr)) != 1){
            message('Найден лишний или незакрытый тег ВВ кода (url)');
        }


        mysqli_query($connect, 'INSERT INTO `reviews` VALUES ("", "'.$_SESSION['id'].'", "'.mysqli_real_escape_string($connect, $_POST['message']).'")');

        go('reviews');

    }