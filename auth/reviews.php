<?php top('Отзывы') ?>

    <h1>Отзывы</h1>
    <p><textarea id="message" placeholder="Текст сообщения" rows="10"></textarea></p>
    <p><button onclick="post_query('add', 'reviews', 'message')">Добавить</button>

    <h1>Список отзывов</h1>

<?php

    $query = mysqli_query($connect, 'SELECT `text`, `userid` FROM `reviews` ORDER BY `id` DESC ');

    if (!mysqli_num_rows($query)) exit('Список отзывов пустой');


    while ($row = mysqli_fetch_assoc($query)){

    $user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `email` FROM `users` WHERE `id` = $row[userid]"));

    echo '<div class="reviews"><span>Отправитель: '.$user['email'].'</span>'.nl2br(htmlspecialchars($row['text']), false).'</div>';
}

bottom() ?>