<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <title>Интернет-магазин</title>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <nav>
                <ul class="menu">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="catalog.php">Каталог</a></li>
                    <li><a href="orders.php">Заказы</a></li>
                    <?php
                        require_once __DIR__.'/session.php';
                        $user = null;
                        require_once __DIR__.'/getUser.php';

                        if ($user == null) {
                    ?>
                        <li><a href="log_form.php">Вход</a></li>
                        <li><a href="reg_form.php">Регистрация</a></li>
                    <?php 
                        }
                        if ($user) { 
                            if ($user['type'] == 'Admin') { ?>
                                <li><a href="admin_panel.php">Admin's Panel</a></li>
                            <?php } ?>
                            <form method="post" action="logout.php">
                                    <button type="submit" class="btn" id="logout-btn">Выйти</button>
                            </form>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="wrap-content">
            <h2>Заказы</h2>
            <form method="post" action="orders.php">
                <label for="sort">Фильтр заказов</label>
                <select name="sort" id="sort">
                    <option value="Отсутствует">Отсутствует</option>
                    <option value="Ждёт подтверждения">Ждёт подтверждения</option>
                    <option value="Одобрен">Одобрен</option>
                    <option value="Отклонен">Отклонен</option>
                </select>
                <button type="submit" class="btn btn-primary">Сортировать</button>
            </form>
                <table>
                    <tr>
                        <th>Номер заказа</th>
                        <th>Код товара</th>
                        <th>Статус заказа</th>
                        <th>--------</th>
                        <th>Ключ пользователя</th>
                        <th>Дата</th>
                    </tr>

            <?php if ($user) { ?>
                <?php if ($user['group'] == 'Admin') 
                    {
                        require_once 'connect.php';
                        $user_id = $user['id'];
                        @$sort = $_POST['sort'];
                        if ($sort == "Отсутствует" || $sort == "") {
                            $ticket = mysqli_query($connectDB, "SELECT * FROM `orders`");
                        } else {
                            $ticket = mysqli_query($connectDB, "SELECT * FROM `orders` WHERE `order_id` = '$sort'");
                        }
                        $ticket = mysqli_fetch_all($ticket);
                        foreach($ticket as $obj)
                        {
                    ?>
                        <tr>
                        <td><?= $obj[0] ?></td>
                        <td><?= $obj[1] ?></td>
                        <td><?= $obj[2] ?></td>
                        <td id="redac">
                            <form action='order_edit.php' method='POST'>
                                <input type='hidden' name='id' value='<?= $obj[0] ?>' />
                                <input type='hidden' name='order_status' value='<?= $obj[2] ?>' />
                                <input id="edit-btn" type='submit' value='Изменить'>
                            </form>
                        </td>
                        <td><?= $obj[3] ?></td>
                        <td><?= $obj[4] ?></td>
                        <td id="del-btn">
                            <form action='order_delete.php' method='POST'>
                                <input type='hidden' name='id' value='<?= $obj[0] ?>' />
                                <input id="delete-btn" type='submit' value='Удалить'>
                            </form>
                        </td>
                        </tr>
                        <?php } ?>
                <?php } else 
                {
                    require_once 'connect.php';
                    $user_id = $user['id'];
                    @$sort = $_POST['sort'];
                    if ($sort == "Отсутствует" || $sort == "") {
                        $ticket = mysqli_query($connectDB, "SELECT * FROM `orders` WHERE `user_id` = $user_id");
                    } else {
                        $ticket = mysqli_query($connectDB, "SELECT * FROM `orders` WHERE `user_id` = $user_id AND `order_id` = '$sort'");
                    }
                    $ticket = mysqli_fetch_all($ticket);
                    foreach($ticket as $obj)
                    {
                ?>
                    <tr>
                    <td><?= $obj[0] ?></td>
                    <td><?= $obj[1] ?></td>
                    <td><?= $obj[2] ?></td>
                    <td><?= $obj[3] ?></td>
                    <td><?= $obj[4] ?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
                </table>
        </div>
    </div>
</body>
</html>