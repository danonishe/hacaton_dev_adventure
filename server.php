<?php

session_start();

// initializing variables
$username = "";
$email    = "";
$birthday = "";
$position = "";
$hobbies = "";
$current = "";
$finish = "";
$val = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) 
{
  $arr="";
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $birthday = mysqli_real_escape_string($db, $_POST['birthday']);
  $position = mysqli_real_escape_string($db, $_POST['position']);
  $hobbies = mysqli_real_escape_string($db, $_POST['hobbies']);
  $current = mysqli_real_escape_string($db, $_POST['current']);
  $finish = mysqli_real_escape_string($db, $_POST['finish']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($birthday)) { array_push($errors, "birthday is required"); }
  if (empty($position)) { array_push($errors, "position is required"); }
  if (empty($hobbies)) { array_push($errors, "hobbies is required"); }
  if (empty($current)) { array_push($errors, "current is required"); }
  if (empty($finish)) { array_push($errors, "finish is required"); }


  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
foreach($errors as $error){
echo $error;
}
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, birthday,position,hobbies,current,finish,array_id, password) 
  			  VALUES('$username', '$email','$birthday','$position', '$hobbies', '$current', '$finish', '$arr', '$password')";
  	mysqli_query($db, $query);

  	$_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['birthday'] = $birthday;
    $_SESSION['position'] = $position;
    $_SESSION['hobbies'] = $hobbies;
    $_SESSION['current'] = $current;
    $_SESSION['finish'] = $finish;
  	$_SESSION['success'] = "You are now logged in";
    echo "INSERT INTO users (username, email, birthday,position,hobbies,current,finish,array_id, password)
VALUES('$username', '$email','$birthday','$position', '$hobbies', '$current', '$finish', '$arr','$password')";
header('location: index.php');
  }
}



if  (isset($_POST['save_user']))
{
  $arr="";
  $username = mysqli_real_escape_string($db, $_SESSION['username']);
  $position = mysqli_real_escape_string($db, $_POST['position']);
  $hobbies = mysqli_real_escape_string($db, $_POST['hobbies']);
  $current = mysqli_real_escape_string($db, $_POST['current']);
  $finish = mysqli_real_escape_string($db, $_POST['finish']);

  $query = "UPDATE `users` SET `position` = '$position', `hobbies` = '$hobbies', `current` = '$current', `finish` = ' $finish' WHERE `username` = '$username'";
	mysqli_query($db, $query);
  $_SESSION['position'] = $position;
  $_SESSION['hobbies'] = $hobbies;
  $_SESSION['current'] = $current;
  $_SESSION['finish'] = $finish;
  $_SESSION['success'] = "Saved";
  header('location: index.php');
}


if (isset($_POST['check']))
{
  $username = mysqli_real_escape_string($db, $_SESSION['username']);
  $id = mysqli_real_escape_string($db, $_POST['id']);

  $query = "SELECT array_id FROM users WHERE username='$username'";
  $results = mysqli_query($db, $query);

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


$conn->close();
$id.=' '.$arr;
$sql1 = "UPDATE `users` SET `array_id` = '$id' WHERE `username` = '$username'";
	mysqli_query($db, $sql1);


 header('location: index.php');
}





if (isset($_POST['login_user'])) 
{
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) 
  {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    
  	$results = mysqli_query($db, $query);
    
  	if (mysqli_num_rows($results) == 1) 
    {

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
          $_SESSION['id'] = $row["id"];
          $_SESSION['birthday'] = $row["birthday"];
          $_SESSION['username'] = $row["username"];
          $_SESSION['email'] = $row["email"];
          $_SESSION['hobbies'] = $row["hobbies"];
          $_SESSION['current'] = $row["current"];
          $_SESSION['finish'] = $row["finish"];
          $_SESSION['position'] = $row["position"];
          $_SESSION['array_id'] = $row["array_id"];
        }
      $result->free();
    } 
    else
    {
      echo "Ошибка: " . $conn->error;
    }

    
    $conn->close();

  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}


?>