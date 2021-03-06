<?php

if (is_numeric($_GET['ref'])){
    setcookie('ref', $_GET['ref'], strtotime('+1 week'));

    header('location: /home');
}

if ($_SERVER[REQUEST_URI] == '/') $page = 'home';
else {
    $page = substr($_SERVER[REQUEST_URI], 1 );
    if (!preg_match('/^[A-z0-9]{3,15}$/', $page)) not_found();
}

$connect = mysqli_connect('localhost', 'root', '', 'project');
if (!$connect) exit('Mysqli error!');

session_start();

if (file_exists('all/'.$page.'.php')) include 'all/'.$page.'.php';
else if ($_SESSION['id'] && file_exists('auth/'.$page.'.php')) include 'auth/'.$page.'.php';
else if (!$_SESSION['id'] && file_exists('guest/'.$page.'.php')) include 'guest/'.$page.'.php';
else not_found();

function message($text){
    exit ('{"message" : "'.$text.'"}');
}

function go($url){
    exit ('{"go" : "'.$url.'"}');
}

function not_found(){
    exit('Страница 404');
}

function random_str($num = 30){
    return substr(str_shuffle('0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'), 0, $num);
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
       message('Ответ на вопрос указан неверно!');
    }
}

//blocking the page
function work(){
    if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1')
        exit('Ведутся технические работы');
}

function email_valid(){
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    message('E-mail указан неверно!');
}

function bbcode($text){
    $search = array(
        '[b]',
        '[/b]',
        '[i]',
        '[/i]',
        '[url=',
        '=name=',
        '[/url]',
    );

    $replace = array(
        '<b>',
        '</b>',
        '<i>',
        '</i>',
        '<a target="_blank" href="',
        '">',
        '</a>',
    );

    return str_replace($search, $replace, $text);
}

function password_valid(){
    if (!preg_match('/^[A-z0-9]{6,30}$/', $_POST['password']))
    message('Пароль указан неверно и может содержать 6 - 30 символов!');
    $_POST['password'] = md5($_POST['password']);
}

function services_promo($code){
    $arr = array(
        'fdf4s65a8' => 10,
        'ihi74h36d' => 50
    );
    return $arr[$code];
}

function calc_promo($id){
    if ($_SESSION['promo']) $promo = $_SESSION['promo'];
    else $promo = 0;

    $per = (services_price($id) * $promo) / 100;
    return (services_price($id) - $per);
}

function services_price($id){
    $arr = array(
        1 => 10,
        2 => 50,
        3 => 100
    );
    return $arr[$id];
}

function send_mail($email, $title, $text){
    mail($email, $title, '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>'.$title.'</title>
</head>

<body style="margin: 0">
    <div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD">
        <div style="margin: 0; background: #464E78; padding: 25px; color: white">'.$title.'</div>
        <div style="padding: 30px">
            <div style="background: white; border-radius: 10px; padding: 25px; border: 1px solid #EEEFF2">'.$text.'</div>
        </div>
    </div>
</body>
</html>', "From: admin@mysite.com\r\nMINE-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8");
}

function top($title) {
    echo '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>'.$title. '</title>
            <link rel="stylesheet" href="/css/style.css">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;                          subset=cyrillic" rel="stylesheet">
            <script src="/js/jquery-1.12.4.min.js"></script>
            <script src="/js/script.js"></script>
        </head>
        <body>
            <div class="wrapper">
                <div class="menu">
                    <a href="/contact">Обратная связь</a>
                ';
                
                if ($_SESSION['id'])
                    echo'
                      <a href="/profile">Профайл</a>
                    <a href="/history">История</a>
                    <a href="/referral">Рефералы</a>
                    <a href="/reviews">Отзывы</a> 
                    <a href="/services">Услуги</a>                   
                    <a href="/logout">Выход</a>
                    ';
                    else
                        echo '
                    <a href="/login">Вход</a>
                    <a href="/register">Регистрация</a>
                    ';
                    echo'
                </div>
                <div class="content">
                    <div class="block">';
}

function bottom() {
    echo '</div>
                </div>
                </div>
                <!-- BEGIN JIVOSITE CODE {literal} -->
<script type=\'text/javascript\'>
    (function(){ var widget_id = \'z20DGL1qrv\';var d=document;var w=window;function l(){
    var s = document.createElement(\'script\'); s.type = \'text/javascript\'; s.async = true; s.src = \'//code.jivosite.com/script/widget/\'+widget_id; var ss = document.getElementsByTagName(\'script\')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState==\'complete\'){l();}else{if(w.attachEvent){w.attachEvent(\'onload\',l);}else{w.addEventListener(\'load\',l,false);}}})();
    </script>
<!-- {/literal} END JIVOSITE CODE -->
        </body>
    </html>';
}


