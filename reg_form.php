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
            <h2>Регистрация</h2>
            <div class="form">
                <form action="register.php" method="POST">
                    <input class="input" type="text" placeholder="Фамилия" name="lName">
                    <input class="input" type="text" placeholder="Имя" name="fName">
                    <input class="input" type="text" placeholder="Отчество" name="sName">
                    <input class="input" type="text" placeholder="Номер телефона" name="phone">
                    <input class="input" type="text" placeholder="E-mail" name="email">
                    <input class="input" type="text" placeholder="Логин" name="username">
                    <input class="input" type="password" placeholder="Пароль" name="password">
                    <input class="input" type="password" placeholder="Повторите пароль" name="rePass">
                    <?php require_once __DIR__.'/session.php'; flash() ?>
                    <button class="btn btn-sub" type="submit">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>