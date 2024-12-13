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
                            <button type="submit" class="btn" id="cart-btn">В корзину</button>
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
</html>