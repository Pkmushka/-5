<?php

require_once "config.php";


$error = '';
// если нажата кнопка входа
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // если не указана почта
    if (empty($email)) {
        $error .= '<p class="error">Введите адрес электронной почты.</p>';
    }

    // если не указан пароль
    if (empty($password)) {
        $error .= '<p class="error">Введите пароль.</p>';
    }
    echo empty($error);
    // если ошибок нет
    if (empty($error)) {
        // берём данные пользователя
        if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
            $query->bind_param('s', $email);
            $query->execute();
            $row = $query->get_result()->fetch_assoc();
            // смотрим, есть ли такой пользователь в базе
            if ($row) {
                // если пароль правильный
                if (password_verify($password, $row['password'])) {
                    // стартуем новую сессию
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user"] = $row;
                    $role = $row['role'];
                    // перенаправляем пользователя на внутреннюю страницу
                    if ($role == 0)
                        {header("location: welcome1.php");
                        exit;}
                    else
                        {header("location: welcome2.php");
                        exit;}
                // если пароль не подходит
                } else {
                    $error .= '<p class="error">Введён неверный пароль.</p>';
                }
            // если пользователя нет в базе
            } else {
                $error .= '<p class="error">Нет пользователя с таким адресом электронной почты.</p>';
            }
        }
    }
    // закрываем соединение с базой данных
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="keywords" content="Регистрация пользователей PHP MySQL, Авторизация пользователей PHP MySQL" /> 
		<meta name="description" content="Регистрация пользователей PHP MySQL с активацией письмом" />
		<title>SportEquip</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="./style.css" rel="stylesheet" type="text/css">
    </head>
	<body>
		<header>
			<span class="logo"><a id="toggle3">SportEquip</a></span>
			<div id="menu">
					<div class="menu">
						<ul>
							<li><a href = "login.php">Войти</a></li>
							<li><a href = "register.php">Регистрация</a></li>
						</ul>
					</div>
				</div>		
		</header>
        <!-- создаём контейнер -->
        <div class="container">
            <div class="row">
                <!-- указываем стиль адаптивной вёрстки -->
                <div class="col-md-12">
                    <!-- пишем заголовок и пояснительный текст -->
                    <h2>Вход</h2>
                    <p>Введите свою почту и пароль.</p>
                    <!-- метод, которым будем работать с формой — отправлять на сервер -->
                    <form action="" method="post">
                        <!-- поле ввода электронной почты -->
                        <div class="form-group">
                            <label>Электронная почта</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>    
                        <!-- поле ввода пароля -->
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <!-- кнопка отправки данных на сервер -->
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Войти">
                        </div>
                         </form>
                </div>
            </div>
        </div>    
    </body>
</html>