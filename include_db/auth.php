<?php
    $mail = filter_var(trim($_POST['email_id']),
        FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']),
        FILTER_SANITIZE_STRING);

    if (mb_strlen($mail) < 5 || mb_strlen($mail) > 90){
        echo "Недопустимая длина почты";
        exit();
    } else if (mb_strlen($password) < 2 || mb_strlen($password) > 16){
        echo "Недопустимая длина пароля (от 2 до 16)";
        exit();
    }

    $password = md5($password."asdfg892023");

    $mysql = @new mysqli('localhost', 'root', 'root', 'registration');
    if ($mysql->connect_errno) exit('Ошибка подключения');
    $mysql->set_charset('utf-8');
    $result = $mysql->query("SELECT * FROM `registration` WHERE `mail` = '$mail' AND `password` = '$password'");
    $mail = $result->fetch_assoc();
    if (count($mail) == 0){
        echo "Пользователь не найден";
        exit();
    }

    setcookie('user', $mail['name'], time() + 3600 * 24, "/");

    $mysql->close();
    header('Location: index.html');
    exit();
?>