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
	$table = array ();
	$arr = "";
	$array_id=$_SESSION['array_id'];

$conn = new mysqli("localhost", "root", "root", "registration");
if($conn->connect_error){
  die("Ошибка: " . $conn->connect_error);

}
$username=$_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";

$qur = "SELECT * FROM users";

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
if($result = $conn->query($qur))
{
    $rowsCount = $result->num_rows; // количество полученных строк
    foreach($result as $row)
    {
     array_push($table, array($row['id'], $row['username'], $row['email'], $row['birthday'], $row['position'], $row['hobbies'], $row['current'],  $row['finish']));
    }
  $result->free();
} 
else
{
  echo "Ошибка: " . $conn->error;
}

$conn->close();
$mas = explode(" ", $arr);

$val1 = array_rand($mas, 1); 


for ($i = 0; $i < count($table); $i++) 
{

if ($table[$i][0]==$mas[$val])
{
$val1 = $i;
}
}

$val2 = array_rand($mas, 1); 


for ($i = 0; $i < count($table); $i++) 
{
if ($table[$i][0]==$mas[$val2])
{
$val2 = $i;
}
}

$val3 = array_rand($mas, 1); 

for ($i = 0; $i < count($table); $i++) 
{
if ($table[$i][0]==$mas[$val3])
{
$val3 = $i;
}
}


echo '<form method="post" id="MyForm">

<div class="test">
		<label class="q1" value="'. "$val1".'">У какого человека это хобби:'.$table[$val1][5].'</label>
		<br>

		<input type="radio" name ="hobbi" value="0">'.$table[0][1].'
		<br>
		<input type="radio" name ="hobbi" value="1">'.$table[1][1].'
		<br>
		<input type="radio" name ="hobbi" value="2">'.$table[2][1].'
		<br>
		<input type="radio" name ="hobbi" value="3">'.$table[3][1].'

	  </div>
	  
<div class="test">
<label  class="q" value="'. "$val2".'">Кто из этих людей на этой должности: '.$table[$val2][4].'</label>
<br>

<input type="radio" name ="post" value="0">'.$table[0][1].'
<br>
<input type="radio" name ="post" value="1">'.$table[1][1].'
<br>
<input type="radio" name ="post" value="2">'.$table[2][1].'
<br>
<input type="radio" name ="post" value="3">'.$table[3][1].'
</div>

<div class="test">
<label  class="q" value="'."$val3".'">Кто из этих людей занимался этими проектами: '.$table[$val3][7].'</label>
<br>

<input type="radio" name ="end" value="0">'.$table[0][1].'
<br>
<input type="radio" name ="end" value="1">'.$table[1][1].'
<br>
<input type="radio" name ="end" value="2">'.$table[2][1].'
<br>
<input type="radio" name ="end" value="3">'.$table[3][1].'
</div>

	  
	  <div class="input-group">
	  <input type = "submit" name = "submit" value="Ответить">
	  </div>
	 <div id="Result">   </div>
</form>';

	?>
<script >
document.getElementById('MyForm').addEventListener("submit", Check);
function Check(event)
{
    event.preventDefault();
	var val=document.getElementById('MyForm');


	var ans1 =  val.hobbi.value;
	var ans2 = val.post.value;
	var ans3 = val.end.value;
	
var r = document.getElementsByClassName('q');

	var cnt = 0;
	if (r[0].getAttribute('value') == ans1)
	++cnt;
	if (r[1].getAttribute('value') == ans2)
	++cnt;
	if (r[2].getAttribute('value')== ans3)
	++cnt;
	document.getElementById('Result').innerHTML=cnt + " правильных ответов!";
	
}

</script>
	</div>
	<script type="text/javascript" src="file.js"></script>
</body>
</html>