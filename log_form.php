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
            <h2>Авторизация</h2>
            <div class="form">
                <form action="login.php" method="POST">
                    <input type="text" placeholder="Логин" name="login">
                    <input type="password" placeholder="Пароль" name="pass">
                    <button type="submit">Авторизоваться</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>