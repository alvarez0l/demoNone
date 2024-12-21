<?php

session_start();  //Импортируем файл Сессии

//Далее идет способ сделать глобально доступным подключение к БД
function pdo(): PDO {
    static $pdo; //Объявляем статическую переменную, дабы она сохраняла свое значение после завершения функции

    if (!$pdo) {  //Если нет PDO
        $config = include __DIR__.'../config.php';  //Используется для подключения и выполнения указанного файла

        $dsn = 'mysql:dbname='.$config['db_name'].';host='.$config['db_host'];  //DSN - для подключения к БД
        $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);  //Создаем объект PDO, обеспечивает безопасное и удобное взаимодействие с БД
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //Настраиваем поведение обработки ошибок при работе с БД
    }
    return $pdo;  //Выводим результат
};

//Далее создаем новую функцию для вывода всплывающих сообщений об ошибках на страницу
function flash(?string $message = null) {  //Создаем функцию и указываем, что строка message по умолчанию NULL
    if ($message) {  //Если передано значение Message
        $_SESSION['flash'] = $message;  //И если не равно NULL, то оно сохраняется в глобальном массиве сессии с ключом Flash
    } else {  //Если не передано, идет проверка есть ли в сессии сообщение Flash, если существует, то выводится следующий блок
        if (!empty($_SESSION['flash'])) { ?>
            <div class="alert alert-danger">
                <?=$_SESSION['flash']?>
            </div>
        <?php }
        unset($_SESSION['flash']);  //Затем flash удаляется из сессии, чтобы сообщение отображалось только один раз
    }
};

//Эта функция проверяет, авторизован ли пользователь в текущей сессии, и возвращает результат в виде true или false
function check_auth() {
    return !!($_SESSION['user_id'] ?? false);  //Используя глобальный массив сессии, проверяется, существует ли user_id в массиве
}