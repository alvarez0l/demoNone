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
                            ?><li><a href="orders.php">Заказы</a></li><?php
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
        <?php 
            if ($user) { 
                if ($user['type'] != 'Admin') {
                    header('Location: index.php');
                }
            } else {
                header('Location: index.php');
            }
        ?>
        <div class="content">
            <h2>Панель Администратора</h2>
            <span>Администрирование заказов возможно только с пометкой "Новое"</span>
                <table>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Email</th>
                        <th>Наименование товара</th>
                        <th>Количество</th>
                        <th>Статус заказа</th>
                    </tr>

            <?php if ($user) { ?>
                <?php if ($user['type'] == 'Admin') 
                    {
                        require_once 'connect.php';
                        $user_id = $user['id'];
                        $ticket = mysqli_query($connectDB, "SELECT * FROM `orders`");
                        $ticket = mysqli_fetch_all($ticket);
                        foreach($ticket as $obj)
                        {
                    ?>
                        <tr>
                        <td><?= $obj[1] ?></td>
                        <td><?= $obj[2] ?></td>
                        <td><?= $obj[3] ?></td>
                        <td><?= $obj[4] ?></td>
                        <td><?= $obj[5] ?></td>
                        <td><?= $obj[6] ?></td>
                        <td><?= $obj[10] ?></td>
                        <?php if ($obj[10] == "Новое") { ?>
                            <td id="redac">
                                <form action='order_edit_form.php' method='POST'>
                                    <input type='hidden' name='id' value='<?= $obj[0] ?>' />
                                    <input type='hidden' name='order_status' value='<?= $obj[10] ?>' />
                                    <input id="edit-btn" type='submit' value='Изменить'>
                                </form>
                            </td>
                            <td id="del-btn">
                                <form action='orderDelete.php' method='POST'>
                                    <input type='hidden' name='id' value='<?= $obj[0] ?>' />
                                    <input id="delete-btn" type='submit' value='Удалить'>
                                </form>
                            </td>
                        <?php } ?>
                        </tr>
                        <?php } ?>
                <?php } ?>
            <?php } ?>
                </table>
        </div>
    </div>
</body>
</html>