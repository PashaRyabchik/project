<?php top('Услуги') ?>

    <h1>Услуги:</h1>

    <table>
        <tr>
            <td>Услуга 1</td>
            <td>Услуга 2</td>
            <td>Услуга 3</td>
        </tr>
        <tr>
            <td>Стоимость: <?=calc_promo(1)?> $</td>
            <td>Стоимость: <?=calc_promo(2)?> $</td>
            <td>Стоимость: <?=calc_promo(3)?> $</td>
        </tr>
        <tr>
            <td>
                <input type="hidden" value="1" id="sid1">
                <button onclick="post_query('buy', 'services', 'sid1')">Купить</button></td>
            <td>
                <input type="hidden" value="2" id="sid2">
                <button onclick="post_query('buy', 'services', 'sid2')">Купить</button></td>
            </td>
            <td>
                <input type="hidden" value="3" id="sid3">
                <button onclick="post_query('buy', 'services', 'sid3')">Купить</button></td>
            </td>
        </tr>
    </table>

    <h1>Получить скидку</h1>
    <p><input type="text" placeholder="Промокод" id="code"></p>
    <p><button onclick="post_query('buy', 'promo', 'code')">Отправить</button></p>

<?php bottom() ?>