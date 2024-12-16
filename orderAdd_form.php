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
            <h2>Страница формирования заказа</h2>
            <p class="content_p">
                <?php
                    if ($user == null) { 
                        header('Location: log_form.php');
                    }
                    $orderName = $_POST['orderName'];
                ?>
                <span>Укажите необходимые данные для заказа товара <?= $orderName  ?></span>
            </p>
            <form class="mt-5" method="POST" action="orderAdd.php">
                <input class="input" type="text" placeholder="Количество" name="amount">
                <input class="input" type="text" placeholder="Адрес доставки" name="address">
                <input type="text" value="<?= $orderName  ?>" name="orderName" hidden>
                <?php require_once __DIR__.'/session.php'; flash() ?>
                <button type="submit" class="btn">Оформить заказ</button>
            </form>
        </div>
    </div>
</body>
</html>

