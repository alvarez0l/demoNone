<?php
    mysqli_connect("MySQL-8.2", "root", "", "bd_shop")
        or die("<p>Ошибка подключения к базе данных: ".mysqli_connect_error()."</p>");
    echo "<p>Вы подключились в MySQL!</p>";