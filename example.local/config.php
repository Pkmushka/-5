<?php
define('DBSERVER', 'MySQL-8.0:3306'); // сервер с базой данных
define('DBUSERNAME', 'root'); // имя пользователя
define('DBPASSWORD', 'root'); // пароль
define('DBNAME', 'reg'); // название базы
 
/* соединяемся с базой */
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);
 
// проверяем соединение
if($db === false){
    die("Ошибка соединения с базой. " . mysqli_connect_error());
}
?>