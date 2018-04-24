<?php

if ($_SERVER[REQUEST_URI] == '/') $page = 'home';
else {
    $page = substr($_SERVER[REQUEST_URI], 1 );
    if (!preg_match('/^[A-z0-9]{3,15}$/', $page)) exit('error url');
}

session_start();

if (file_exists('all/'.$page.'.php')) include 'all/'.$page.'.php';

else if ($_SESSION['ulogin'] == 1 && file_exists('auth/'.$page.'.php')) include 'auth/'.$page.'.php';

else if ($_SESSION['ulogin'] != 1 && file_exists('guest/'.$page.'.php')) include 'guest/'.$page.'.php';

else exit('Страница 404');

function message($text){
    exit ('{"message" : "'.$text.'"}');
}

function go($url){
    exit ('{"go" : "'.$url.'"}');
}

function captcha_show(){
    $questions = array(
        1 => "Столица Украины?",
        2 => "Столица США?",
        3 => "Столица Великобритании?",
        4 => "Столица Германии?",
        5 => "Столица Франции?");

    $num = mt_rand(1, count($questions));
    $_SESSION['captcha'] = $num;
    echo $questions[$num];
}

function captcha_valid(){
    $answers = array(
        1 => "киев",
        2 => "вашингтон",
        3 => "лондон",
        4 => "берлин",
        5 => "париж"
    );

    if ($_SESSION['captcha'] != array_search(strtolower($_POST['captcha']), $answers)){
       message('Ответ на вопрос указан не верно!');
    }
}

function top($title) {
    echo '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>'.$title. '</title>
            <link rel="stylesheet" href="/css/style.css">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;                          subset=cyrillic" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.3.1.js"
              integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
              crossorigin="anonymous"></script>
            <script src="/js/script.js"></script>
        </head>
        <body>
            <div class="wrapper">
                <div class="menu">
                    <a href="/">Главная</a>
                    <a href="/login">Вход</a>
                    <a href="/register">Регистрация</a>
                </div>
                <div class="content">
                    <div class="block">';
}

function bottom() {
    echo '</div>
                </div>
                </div>
        </body>
    </html>';
}


