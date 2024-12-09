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
                            <form class="mt-5" method="post" action="logout.php">
                                    <button type="submit" class="btn" id="logout-btn">Выйти</button>
                            </form>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="wrap-content">
            <?php
                require_once __DIR__.'/session.php';
                $user = null;
                if (check_auth()) {
                    // Получим данные пользователя по сохранённому идентификатору
                    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
                    $stmt->execute(['id' => $_SESSION['user_id']]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                }

                require_once 'connect.php';

                $product_id = $_POST['product_id'];
                $user_id = $user['id'];
                $date = date("Y-m-d");

                mysqli_query($connectDB, "INSERT INTO `orders` (`id`, `product_id`, `user_id`, `date`)
                VALUES (NULL, '$product_id', '$user_id', '$date')");
                echo "Готово! Ваш заказ успешно принят!";
            ?>
        </div>
    </div>
</body>
</html>

