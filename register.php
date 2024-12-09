<?php

require_once __DIR__.'/session.php';  //Импортируем файл Сессии

$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");  //Создаем переменную, обращаемся к PDO, кт. готовит SQL-запрос в БД
$stmt->execute(['username' => $_POST['username']]);  //Выполняет подготовленный запрос, передавая значения для подстановки в массив
if ($stmt->rowCount() > 0) {  //Проверка количества строк
    header('Location: /demo1/reg_form.php'); //Возврат на форму регистрации
    flash('Это имя пользователя уже занято.'); //Ошибка
    die;
};
if (strlen($_POST['username']) <= 3) {  //Проверка на количесво символов в логине
    flash('Логин должен состоять более чем из 3-х символов.');
    header('Location: /demo1/reg_form.php');
    die;
};
if (strlen($_POST['password']) < 4) {  //Проверка на количество символов в пароле
    flash('Пароль должен состоять как минимум из 8 символов.');
    header('Location: /demo1/reg_form.php');
    die;
};

$stmt = pdo()->prepare("INSERT INTO `users` (`username`, `password`, `firstName`, `lastName`, `surName`, `phone`, `email`) VALUES (:username, :password, :fName, :lName, :sName, :phone, :email)"); //Создаем переменную, обращаемся к PDO, кт. готовит SQL-запрос в БД
$stmt->execute([ //Выполняет подготовленный запрос, передавая значения для подстановки в массив
    'username' => $_POST['username'],  //Имя
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),  //Захешированный пароль при помощи функции password_hash
    'fName' => $_POST['fName'],  //Имя
    'lName' => $_POST['lName'],  //Фамилия
    'sName' => $_POST['sName'],  //Отчество
    'phone' => $_POST['phone'],  //Телефон
    'email' => $_POST['email'],  //Почта
]);

header('Location: log_form.php');  //Перевод на страницу Логина