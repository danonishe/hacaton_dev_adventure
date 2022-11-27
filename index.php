<?php 
session_start(); 
include('server.php');
  

  if (!isset($_SESSION['username']) )
   {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) 
  {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>
<div class>
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username']) ): ?>

		<a  href="index.php?logout='1'" class="exit">Выйти</a>
    <div id="shapka"> 
       
 <button class="knopka"  onClick="inProfile()">Мой профиль</button>
 <button class="knopka" onClick="inPeople()">Люди</button>
 <button class="knopka"  onClick="inProgress()">Мои достижения</button>
</div>

<div id="Profile">

<form method="post" action="index.php">
<div class="input-group">
  	  <label>Имя пользователя</label>
  	  <input type="text" class="p" name="username" readonly value="<?php echo $_SESSION['username']; ?>">
	 
  	</div>

  	<div class="input-group">
  	  <label>Адрес электронной почты</label>
  	  <input type="email"  class="p" name="email" readonly  value="<?php echo $_SESSION['email']; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Дата рождения</label>
  	  <input type="date"  class="p" name="birthday" readonly value="<?php echo  $_SESSION['birthday'] ; ?>">
  	</div>

	  <div class="input-group">
  	  <label>Должность</label>
  	  <input type="text"  class="p" name="position" disabled value="<?php echo  $_SESSION['position']; ?>">
  	</div>
	
	  <div class="input-group">
  	  <label>Хобби</label>
  	  <input type="text"  class="p" name="hobbies" disabled value="<?php echo$_SESSION['hobbies']; ?>">
  	</div>
	
	  <div class="input-group">
  	  <label>Текущие проекты</label>
  	  <input type="text" class="p" name="current" disabled value="<?php echo $_SESSION['current']; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Завершенные проекты</label>
  	  <input type="text" class="p" name="finish" value="<?php echo  $_SESSION['finish']; ?>" disabled>
  	</div>
	  <div class="input-group">
  	  <button type="submit" name="save_user">Сохранить</button>
  	</div>
	  <div class="input-group">
  	<button type="button" onClick="Edit()"> Редактировать</button>
  	</div>
</form>


	<script>function Edit() 
			{
				document.getElementsByClassName('p')[3].disabled=false;
				document.getElementsByClassName('p')[4].disabled=false;
				document.getElementsByClassName('p')[5].disabled=false;
				document.getElementsByClassName('p')[6].disabled=false;
			}
	</script>
    <?php endif ?>
</div>


<div id="People">
<?php
$conn = new mysqli("localhost", "root", "root", "registration");
if($conn->connect_error)
{
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM users";
if($result = $conn->query($sql))
{
    $rowsCount = $result->num_rows; // количество полученных строк
    foreach($result as $row)
	{

		echo '<form method="post" action="index.php">
		<div class="input-group">

				<label>ID</label>
				<input type="text"  class="p" name="id" readonly  value='. $row["id"] .'>
			  </div>

		<div class="input-group">
				<label>Имя пользователя</label>
				<input type="text" class="p" name="username" readonly value='. $row["username"] .'>
			  </div>
		
			  <div class="input-group">
				<label>Адрес электронной почты</label>
				<input type="email"  class="p" name="email" readonly  value='. $row["email"] .'>
			  </div>
			  <div class="input-group">
				<label>Дата рождения</label>
				<input type="date"  class="p" name="birthday" readonly value='. $row["birthday"] .'>
			  </div>
		
			  <div class="input-group">
				<label>Должность</label>
				<input type="text"  class="p" name="position" readonly value='. $row["position"] .'>
			  </div>
			
			  <div class="input-group">
				<label>Хобби</label>
				<input type="text"  class="p" name="hobbies" readonly value='. $row["hobbies"] .'>
			  </div>
			
			  <div class="input-group">
				<label>Текущие проекты</label>
				<input type="text" class="p" name="current" readonly value='. $row["current"] .'>
			  </div>
			  <div class="input-group">
				<label>Завершенные проекты</label>
				<input type="text" class="p" name="finish" value='. $row["finish"] .' readonly>
			  </div>
			  <div class="input-group">
			  <input type = "submit" name = "check" value="Yes" onCLick="Pup()">
			  </div>
			 
		</form>';

}
	
	
	
    $result->free();
}
 else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();
?>


</div>
	<div id="Progress">
	<?php 
	
	$arr = "";

$conn = new mysqli("localhost", "root", "root", "registration");
if($conn->connect_error){
  die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM users WHERE username = '$username'";
if($result = $conn->query($sql))
{
    $rowsCount = $result->num_rows; // количество полученных строк
    foreach($result as $row)
    {
      $arr = $row["array_id"];
      
    }
  $result->free();
} 
else
{
  echo "Ошибка: " . $conn->error;
}
$mas = explode(" ", $arr);


	?>

	</div>
	<script type="text/javascript" src="file.js"></script>
</body>
</html>