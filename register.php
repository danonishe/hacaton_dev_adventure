<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Регистрация</title>
  <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
  <div class="container">
		<div class="header">
			<h1 class="header__title">Регистрация</h1>
		</div>
		<div id="wrapper">
			<form id="signin" method="post" action="register.php" autocomplete="off">
				<?php include('errors.php'); ?>
				<input type="text" class="signin__input" name="username" placeholder="Имя пользователя" value="<?php echo $username; ?>">
				<input type="email" class="signin__input" name="email" placeholder="Адрес электронной почты" value="<?php echo $email; ?>">
				<input type="password" class="signin__input" name="password_1" placeholder="Пароль">
				<input type="password" class="signin__input" name="password_2" placeholder="Подтвердите пароль">
				<input type="date" class="signin__input" name="birthday" placeholder="Дата рождения" value="<?php echo $birthday; ?>">
				<input type="text" class="signin__input" name="position" placeholder="Должность" value="<?php echo $position; ?>">
				<input type="text" class="signin__input" name="hobbies" placeholder="Хобби" value="<?php echo $hobbies; ?>">
				<textarea type="text" class="signin__input" name="current" placeholder="Текущие проекты" value="<?php echo $current; ?>"></textarea>
				<textarea type="text" class="signin__input" name="finish" placeholder="Завершенные проекты" value="<?php echo $finish; ?>"></textarea>
				<!-- <button class="signin__input signin__button" type="submit" name="login_user">&#xf0da; Войти</button>
				<p>Ещё не зарегистрированы? <a href="/register.php">Зарегистрироваться</a></p> -->
				<button type="submit" class="signin__input signin__button signin__reg" name="reg_user">Зарегистрироваться</button>
				<p>Уже зарегестрированы? <a href="login.php">Войти</a></p>
			</form>
		</div>
  </div>
</body>
</html>
