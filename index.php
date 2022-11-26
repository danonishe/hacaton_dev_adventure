<?php 
  session_start(); 

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
	<script type="text/javascript" src="file.js"></script>
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
    <table>
        <tr><td>Ваше имя</td><td><?php echo $_SESSION['username']; ?></td></tr>
        <tr><td>Ваша почта</td><td><?php echo $_SESSION['email']; ?></td></tr>
        <tr><td>Ваша должность</td><td><?php echo $_SESSION['position']; ?></td></tr>
		<tr><td>Ваши хобби</td><td><?php echo $_SESSION['hobbies']; ?></td></tr>
		<tr><td>Ваши текущие проекты</td><td><?php echo $_SESSION['current']; ?></td></tr>
		<tr><td>Ваши завершенные проекты</td><td><?php echo $_SESSION['finish']; ?></td></tr>
    </table>
	<button class="but">Редактировать</button>
    <?php endif ?>
</div>
<div id="People">

<?php
$conn = new mysqli("localhost", "root", "root", "registration");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM users";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
	echo '<table>';
	echo '<tr><td>Имя</td><td>День прождения</td><td>Ваш e-mail</td><td>Должность</td><td>Хобби</td><td>Текущие проекты</td><td>завершенные проекты</td><td>';
    foreach($result as $row)
	{
		echo '<tr><td>'. $row["username"] .'</td><td>'. $row["birthday"] .'</td><td>'. $row["email"] .'</td><td>'. $row["position"] .'</td><td>'. $row["hobbies"] .'</td><td>'. $row["current"] .'</td><td>'. $row["finish"] .'</td><td> ';
    }
	echo '</table>';
    $result->free();
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();
?>


</div>
	<div id="Progress">
		страница 2
	</div>
</body>
</html>