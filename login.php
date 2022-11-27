<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Войти</title>
  <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body >
	<div class="container">
		<div class="header">
			<h1 class="header__title">Вход</h1>
		</div>
		<div id="wrapper">
			<form id="signin" method="post" action="login.php" autocomplete="off">
				<?php include('errors.php'); ?>
				<input type="text" class="signin__input" id="name"  name="username" placeholder="Имя пользователя">
				<input type="password" class="signin__input" id="pass" name="password" placeholder="Пароль">
				<button class="signin__input signin__button" type="submit" name="login_user">&#xf0da; Войти</button>
				<p>Ещё не зарегистрированы? <a href="/register.php">Зарегистрироваться</a></p>
			</form>
		</div>
	</div>
</body>
</html>
