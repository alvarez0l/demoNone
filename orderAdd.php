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
        <?php
            if ($user == null) { 
                header('Location: log_form.php');
            }
            if ($_POST['address'] == null) {  //Валидация повтора пароля
                flash('Пароли не совпадают. Повторите попытку');
                header('Location: orderAdd_form.php');
                die;
            };
            if ($_POST['amount'] == null) {  //Валидация повтора пароля
                flash('Пароли не совпадают. Повторите попытку');
                header('Location: orderAdd_form.php');
                die;
            };

            require_once __DIR__.'/session.php';
            $user = null;
            if (check_auth()) {
                // Получим данные пользователя по сохранённому идентификатору
                $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
                $stmt->execute(['id' => $_SESSION['user_id']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            require_once 'connect.php';

            $orderName = $_POST['orderName'];
            $amount = $_POST['amount'];
            $address = $_POST['address'];
            $user_id = $user['id'];
            $user_LN = $user['lastName'];
            $user_FN = $user['firstName'];
            $user_SN = $user['surName'];
            $user_email = $user['email'];
            $date = date("Y-m-d");

            mysqli_query($connectDB, "INSERT INTO `orders` (`id`, `lastName`, `firstName`, `sureName`, `email`, `orderName`, `amount`, `userID`, `address`, `date`)
            VALUES (NULL, '$user_LN', '$user_FN', '$user_SN', '$user_email', '$orderName', '$amount', '$user_id', '$address', '$date')");
            echo "Готово! Ваш заказ успешно принят!";
            // sleep(2);
            // header('Location: catalog.php');
        ?>
    </div>
</body>
</html>