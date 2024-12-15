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
                            ?><li><a href="orders.php">Заказы</a></li>
                            <li><a href="cart.php">Корзина</a></li><?php
                            if ($user['type'] == 'Admin') { ?>
                                <li><a href="admin_panel.php">Admin's Panel</a></li>
                            <?php } ?>
                            <form class="mt-5" method="post" action="logout.php">
                                    <button type="submit" class="btn" id="logout-btn">Выйти</button>
                            </form>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="content">
            <h2>Ваши заказы</h2>
            <p class="content_p">
                <span>Ваши заказы</span>
                <span></span>
            </p>
            <table>
                <tr>
                    <th>Номер заказа</th>
                    <th>Наименование товара</th>
                    <th>Статус заказа</th>
                    <th>Ключ пользователя</th>
                    <th>Дата</th>
                </tr>

            <?php if ($user) { 
                require_once 'connect.php';
                $user_id = $user['id'];
                @$sort = $_POST['sort'];
                $ticket = mysqli_query($connectDB, "SELECT * FROM `orders` WHERE `userID` = $user_id");
                $ticket = mysqli_fetch_all($ticket);
                foreach($ticket as $obj)
                { ?>
                    <tr>
                        <td><?= $obj[0] ?></td>
                        <td><?= $obj[5] ?></td>
                        <td><?= $obj[10] ?></td>
                        <td><?= $obj[7] ?></td>
                        <td><?= $obj[9] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>