<?php

    $query = mysqli_query($connect, 'SELECT `text` FROM `history` WHERE `userid` = '.$_SESSION['id'].' LIMIT '.$_SESSION['loader'].', 2');

    if (!mysqli_num_rows($query)){
        if ($_SESSION['loader'] == 0) exit('empty');
        else exit('end');
    }

    $_SESSION['loader'] += 2;
    while ($row = mysqli_fetch_assoc($query)){
        echo '<p>'.$row['text'].'</p>';
    }
