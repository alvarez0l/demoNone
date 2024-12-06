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
                    <li><a href="/">Admin's Panel</a></li>
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="catalog.php">Каталог</a></li>
                    <li><a href="orders.php">Заказы</a></li>
                    <li><a href="log_form.php">Вход</a></li>
                    <li><a href="reg_form.php">Регистрация</a></li>
                    <li><a href="/">Выход</a></li>
                </ul>
            </nav>
        </div>
        <div class="content">
            <h2>Интернет-магазин "Авоська"</h2>
            <p class="content_p">
                <span>Добро пожаловать в интернет-магазин "Авоська"!</span>
                <span>Здесь вы можете заказать бытовые товары со склада нашего магазина</span>
            </p>
            <?php
                require 'connect.php';
            ?>
        </div>
    </div>
</body>
</html>