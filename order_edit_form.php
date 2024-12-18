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
                            <form class="mt-5" method="post" action="logout.php">
                                    <button type="submit" class="btn" id="logout-btn">Выйти</button>
                            </form>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="content">
            <?php
                $order_id = $_POST["id"];
                $order_status = $_POST["order_status"];
            ?>
            <form method="POST" action="orderEdit.php">
                <div class="edit-form">
                    <input type='hidden' name='id' value='<?= $order_id ?>' />
                    <label for="status">Изменить "<?php echo $order_status ?>" на</label>
                    <select name="status" id="status" class="inp">
                        <option value="Ждёт подтверждения">Ждёт подтверждения</option>
                        <option value="Одобрен">Одобрен</option>
                        <option value="Отклонен">Отклонен</option>
                    </select>
                    <label for="status">?</label>
                <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</body>
<footer>
    <span>+7 978 900 90 90 - Телефон для заявок</span>
    <span>Все права защищены</span>
</footer>
</html>