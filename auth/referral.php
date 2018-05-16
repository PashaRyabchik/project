<?php top('Рефералы') ?>

    <h1>Рефералы</h1>
    <p>Ваша реферальная ссылка: <b>http://project?ref=<?=$_SESSION['id']?></b></p>

<?php
    $query = mysqli_query($connect, "SELECT `email` FROM `users` WHERE `referral` = $_SESSION[id]");

    if (!mysqli_num_rows($query)) exit('<p>Список рефералов пуст</p>');

    $i = 1;
    while ($row = mysqli_fetch_assoc($query)){
        echo '<p># '.($i ++).' '.$row['email'].'</p>';
    }

    bottom() ?>