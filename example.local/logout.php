<?php
// стартуем сессию
session_start();

// закрываем сессию
if (session_destroy()) {
    // перекидываем пользователя на страницу ввода логина и пароля
    header("Location: /");
    exit;
}
?>