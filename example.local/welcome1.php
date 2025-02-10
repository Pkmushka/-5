<?php
// подключаем служебные файлы, которые создали раньше
	require_once "config.php";
$error ='';
if (isset($_POST["name"]) && isset($_POST["count"]) && isset($_POST['submit'])) {

	// подключаем служебные файлы, которые создали раньше
	require_once "config.php";
	$count = 1;
    $name = $db->real_escape_string($_POST["name"]);
    $count = $db->real_escape_string($_POST["count"]);
	$k = 0;
	for ($i = 0; $i < $count; $i++)
    	{$sql = "INSERT INTO Sport (name, cond) VALUES ('$name', 1)";
		if($db->query($sql)){
			$k = $k + 1;
		} else{
			echo "Ошибка: " . $db->error;
		}
	}
	if ($k == $count)
		{$error .= 'Данные успешно добавлены'; 
		header("Location: /welcome1.php");}
	unset($_POST["name"]);
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
                            <!-- кнопка для выхода -->
							<li><a href="logout.php" role="button" aria-pressed="true">Выход</a></li>
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
                    <h4>Привет! Добро пожаловать на сайт, ваш статус администратор.</h4>
                    <p>Внутри сайта может быть любое наполнение — можно оформлять как угодно и добавлять любой контент</p>
                    <p>

                    
                </p>
                <div id="form" class="info">
			<?php echo $error; ?> 
			<h4>Добавление инвентаря</h4>
			<form action="" method="POST">
			<table>
				<tr>
					<td>Название</td>
					<td><input type="int" size="10" name="name"></td>
				</tr>
				
				<tr>
					<td>Количество</td>
					<td><input type="int" size="10" name="count"></td>
				</tr>
			
					<td>&nbsp;</td>
					<td colspan="2"><input type="submit" value="Отправить" name="submit" ></td>
				</tr>
			</table>
			</form>
			<br>
			<p>Состояние 1 - Новый; Состояние 2 - Используемый; Состояние 3 - Сломанный</p>
			<h3>Позиции инвентаря</h3>
			<?php
			// подключаем служебные файлы, которые создали раньше
			require_once "config.php";
			$sql = "SELECT * FROM Sport";
			if($result = $db->query($sql)){
				echo "<table><tr><th>Имя</th><th>Состояние</th><th></th></tr>";
				foreach($result as $row){
					echo "<tr>";
						echo "<td>" . $row["name"] . "</td>";
						echo "<td>" . $row["cond"] . "</td>";
						echo "<td><a href='update.php?id=" . $row["id"] . "'><input type='submit' value='Изменить'></a></td>";
						echo "<td><form action='delete.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' value='Удалить'> </form></td>";
					echo "</tr>";
				}
				echo "</table>";
				$result->free();
			} else{
				echo "Ошибка: " . $db->error;
			}
			
			$db->close();
			?>
                </div>
            </div>
        </div>
        
    </body>
</html>