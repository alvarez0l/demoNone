<?php

session_start();  //Инициализируем сессию

//Далее идет способ сделать глобально доступным подключение к БД
function pdo(): PDO {
    static $pdo; //Объявляем статическую переменную, дабы она сохраняла свое значение после завершения функции

    if (!$pdo) {  //Если нет PDO
        $config = include __DIR__.'/config.php';  //Используется для подключения и выполнения указанного файла

        $dsn = 'mysql:dbname='.$config['db_name'].';host='.$config['db_host'];  //DSN - для подключения к БД
        $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);  //Создаем объект PDO, обеспечивает безопасное и удобное взаимодействие с БД
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //Настраиваем поведение обработки ошибок при работе с БД
    }
    return $pdo;  //Выводим результат
};

//Далее создаем новую функцию для вывода сообщений об ошибках на страницу
function flash(?string $message = null) {
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if (!empty($_SESSION['flash'])) { ?>
            <div class="alert alert-danger">
                <?=$_SESSION['flash']?>
            </div>
        <?php }
        unset($_SESSION['flash']);
    }
};

//Функция проверки авторизации
function check_auth() {
    return !!($_SESSION['user_id'] ?? false);
}