<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Регистрация</h2>
  </div>

  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Имя пользователя</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Адрес электронной почты</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Пароль</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Подтвердите пароль</label>
  	  <input type="password" name="password_2">
  	</div>

	  <div class="input-group">
  	  <label>Дата рождения</label>
  	  <input type="date" name="birthday" value="<?php echo $birthday; ?>">
  	</div>

	  <div class="input-group">
  	  <label>Должность</label>
  	  <input type="text" name="position" value="<?php echo $position; ?>">
  	</div>
	
	  <div class="input-group">
  	  <label>Хобби</label>
  	  <input type="text" name="hobbies" value="<?php echo $hobbies; ?>">
  	</div>
	
	  <div class="input-group">
  	  <label>Текущие проекты</label>
  	  <input type="text" name="current" value="<?php echo $current; ?>">
  	</div>
	
	  <div class="input-group">
  	  <label>Завершенные проекты</label>
  	  <input type="text" name="finish" value="<?php echo $finish; ?>">
  	</div>
	
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Зарегистрироваться</button>
  	</div>


	
  	<p>
  		Уже зарегестрированы <a href="login.php">Войти</a>
  	</p>
  </form>
</body>
</html>
