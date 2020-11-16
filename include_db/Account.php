<?php
    $mail = filter_var(trim($_POST['email_id']),
    FILTER_SANITIZE_STRING);
    $username = filter_var(trim($_POST['username']),
    FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']),
    FILTER_SANITIZE_STRING);

    if (mb_strlen($mail) < 5 || mb_strlen($mail) > 90){
        echo "Недопустимая длина почты";
        exit();
    } else if (mb_strlen($password) < 2 || mb_strlen($password) > 16){
        echo "Недопустимая длина пароля (от 2 до 16)";
        exit();
    } else if (mb_strlen($username) < 2 || mb_strlen($username) > 60){
        echo "Недопустимая длина Никнейма";
        exit();
    }

    $password = md5($password."g21ksa3kdl4");

    $mysql = @new mysqli('localhost', 'root', 'root', 'registration');
    if ($mysql->connect_errno) exit('Ошибка подключения');
    $mysql->set_charset('utf-8');
    $mysql->query("INSERT INTO `registration` (`mail`, `password`, `username`) VALUES ('$mail', '$password', '$username')");

    $mysql->close();

    header('Location: index.html');
    exit();
?>



