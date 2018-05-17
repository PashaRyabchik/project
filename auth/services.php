<?php top('Услуги') ?>

    <h1>Услуги:</h1>

    <table>
        <tr>
            <td>Услуга 1</td>
            <td>Услуга 2</td>
            <td>Услуга 3</td>
        </tr>
        <tr>
            <td>Стоимость: <?=services_price(1)?> $</td>
            <td>Стоимость: <?=services_price(2)?> $</td>
            <td>Стоимость: <?=services_price(3)?> $</td>
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

<?php bottom() ?>