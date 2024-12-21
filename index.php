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
                                <li><a id="a-admin" href="admin_panel.php">Admin's Panel</a></li>
                            <?php } ?>
                            <form class="mt-5" method="post" action="logout.php">
                                    <button type="submit" class="btn" id="logout-btn">Выйти</button>
                            </form>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="content">
            <h2>Интернет-магазин "Авоська"</h2>
            <p class="content_p">
                <span>Добро пожаловать в интернет-магазин "Авоська"!</span>
                <span>Здесь вы можете заказать бытовые товары со склада нашего магазина</span>
            </p>
            <div class="index-photo"></div>
            <div class="catalog">
                <?php
                    require_once 'connect.php';
                    $i=0;
                    $products = mysqli_query($connectDB, "SELECT * FROM `goods`");
                    $products = mysqli_fetch_all($products);
                    foreach($products as $obj) {
                ?>
                    <div class="catalog-card">
                        <div class="catalog-head">
                            <img class="img-prod" src="<?= $obj[4] ?>" alt="product_photo">
                            <span><?= $obj[1] ?></span>
                        </div>
                        <div class="catalog-content">
                            <span>Количество: <?= $obj[2] ?> шт.</span>
                            <span>Цена: <?= $obj[3] ?> руб.</span>
                            <span>Код товара: <?= $obj[0] ?></span>
                            <form class="form" method="POST" action="orderAdd_form.php">
                                <input type="text" value="<?= $obj[1] ?>" name="orderName" hidden>
                                <button type="submit" class="btn" id="cart-btn">В корзину</button>
                            </form>
                        </div>
                    </div>
                <?php
                        $i+=1;
                        if ($i==4) break;
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<footer>
    <div class="footer">
        <span>Нужна помощь? +7 (978)-900-90-90 - Звонок бесплатный</span>
        <span>Проект интернет-магазин "Авоська". Все права защищены.</span>
    </div>
</footer>
</html>