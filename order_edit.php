<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Edit</title>
</head>
<body>
    <div class="wrapper">
        <div class="wrap-header">
            <header class="header">
                <div id="logo">notAsK</div>
                <ul class="nav">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="catalog.php">Каталог</a></li>
                    <li><a href="services.php">Услуги</a></li>
                    <li><a href="sub.php">Оставить заявку</a></li>
                    <?php
                        require_once __DIR__.'/session.php';

                        $user = null;

                        if (check_auth()) {
                            // Получим данные пользователя по сохранённому идентификатору
                            $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
                            $stmt->execute(['id' => $_SESSION['user_id']]);
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        }
                    ?>
                    <?php if ($user == null) { ?>
                        <li><a href="login_form.php">Войти</a></li>
                    <?php } ?>
                    <?php if ($user) { ?>
                        <?php if ($user['group'] == 'Admin') { ?>
                            <li><a href="register_form.php">Регистрация нового пользователя</a></li>
                            <li><a href="subs.php">Заявки</a></li>
                        <?php } ?>
                        <li><a href="orders.php">Заказы</a></li>
                        <form class="mt-5" method="post" action="logout.php">
                                <button type="submit" class="btn" id="logout-btn">Выйти</button>
                        </form>
                    <?php } ?>
                </ul>
            </header>
        </div>
        <div class="wrap-content">
            <?php
                $order_id = $_POST["id"];
                $order_status = $_POST["order_status"];
            ?>
            <form method="POST" action="order_edits.php">
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